<?php
/** @noinspection PhpMultipleClassDeclarationsInspection */
declare(strict_types=1);

namespace Willow\Controllers;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;

class SearchActionBase extends ActionBase
{
    /**
     * @param Request $request
     * @param Response $response
     * @return ResponseInterface
     * @throws JsonException
     * @link https://laravel.com/docs/8.x/queries
     */
    public function __invoke(Request $request, Response $response): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');

        // Get the request to build the query
        $parsedBody = $responseBody->getParsedRequest();

        // Special handling for withTrashed and onlyTrashed
        if (array_key_exists('withTrashed', $parsedBody)) {
            $model = $this->model::withTrashed(true);
        } elseif (array_key_exists('onlyTrashed', $parsedBody)) {
            $model = $this->model::onlyTrashed();
        } else {
            $model = $this->model;
        }
        $model = $model->clone();

        foreach ($parsedBody as $key => $value) {
            switch ($key) {
                case 'onlyTrashed':
                case 'withTrashed':
                    break;
                case 'id':      // Ignore id
                    break;      // continue
                case 'api_key': // Ignore api_key
                    break;      // continue
                default:
                    if (is_array($value)) {
                        foreach ($value as $params) {
                            if (is_array($params)) {
                                $model = $model->$key(...$params);
                            } else {
                                $model = $model->$key($params);
                            }
                        }
                    } else {
                        // Invalid parameters
                        $responseBody = $responseBody
                            ->setData(null)
                            ->setStatus(ResponseCodes::HTTP_BAD_REQUEST)
                            ->setMessage('invalid parameters for: ' . $key);
                        return $responseBody();
                    }
            }
        }

        // Perform the query
        $models = $model->get();

        // Did we get any results?
        if ($models !== null && count($models) > 0) {
            $data = $models->toArray();
            $status = ResponseCodes::HTTP_OK;
        } else {
            $data = null;
            $status = ResponseCodes::HTTP_NOT_FOUND;
        }

        $responseBody = $responseBody
            ->setData($data)
            ->setStatus($status);
        return $responseBody();
    }
}
