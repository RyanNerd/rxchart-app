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
        $model = $this->model;

        // Destroy the model given the id.
        if ($model::destroy($args['id']) === 1) {
            $status = ResponseCodes::HTTP_OK;
        } else {
            $status = ResponseCodes::HTTP_NOT_FOUND;
        }

        // Set the status and data of the ResponseBody
        $responseBody = $responseBody
            ->setData(null)
            ->setStatus($status);

        // Return the response as JSON
        return $responseBody();
    }
}
