<?php
declare(strict_types=1);

namespace Willow\Controllers;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;

class GetActionBase extends ActionBase
{
    /**
     * Handle GET request
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return ResponseInterface
     * @throws JsonException
     */
    public function __invoke(Request $request, Response $response, array $args): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');

        $model =  $this->model;

        $clientId = $args['id'] ?? null;
        if ($clientId !== null) {
            $parsedRequest = $responseBody->getParsedRequest();
            if (array_key_exists('with-trashed', $parsedRequest) && $parsedRequest['with-trashed'] === 'yes') {
                $model = $model
                    ->where('Id', '=', $clientId)
                    ->withTrashed()
                    ->first();
            } else {
                $model = $model->find($clientId);
            }
        } else {
            $model = null;
        }

        // If the record is not found then 404 error, otherwise status is 200.
        if ($model === null) {
            $data = null;
            $status = ResponseCodes::HTTP_NOT_FOUND;
        } else {
            // Remove any protected fields from the response
            $data = $model->attributesToArray();
            $status = ResponseCodes::HTTP_OK;
        }

        // Set the status and data of the ResponseBody
        $responseBody = $responseBody
            ->setData($data)
            ->setStatus($status);

        // Return the response as JSON
        return $responseBody();
    }
}
