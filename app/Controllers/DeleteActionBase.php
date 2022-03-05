<?php
declare(strict_types=1);

namespace Willow\Controllers;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;

abstract class DeleteActionBase extends ActionBase
{
    /**
     * Handle DELETE request
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return ResponseInterface
     * @throws JsonException
     */
    public function __invoke(Request $request, Response $response, array $args): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        $parsedRequest = $responseBody->getParsedRequest();
        $model = $this->model;
        $id = $args['id'];
        $model = $model->find($id);

        $status = ResponseCodes::HTTP_NOT_FOUND;
        if ($model !== null) {
            if (array_key_exists('force', $parsedRequest) && $parsedRequest['force'] === "true") {
                $isDeleted = $model->forceDelete();
            } else {
                $isDeleted = $model->delete();
            }
            $status= $isDeleted ? ResponseCodes::HTTP_OK : ResponseCodes::HTTP_INTERNAL_SERVER_ERROR;
        }

        // Set the status and data of the ResponseBody
        $responseBody = $responseBody
            ->setData(null)
            ->setStatus($status);

        // Return the response as JSON
        return $responseBody();
    }
}
