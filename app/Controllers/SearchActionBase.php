<?php
declare(strict_types=1);

namespace Willow\Controllers;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;

class SearchActionBase extends ActionBase
{
    /**
     * @param Request $request
     * @param Response $response
     * @return ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        $model = clone $this->model;

        // Get the request to build the query
        $parsedBody = $responseBody->getParsedRequest();

        // @see https://laravel.com/docs/6.x/queries#where-clauses
        $where = $parsedBody['where'] ?? [];
        foreach ($where as $item) {
            $column = $item['column'];
            $comparison = $item['comparison'] ?? '=';
            $value = $item['value'];
            $model = $model->where($column, $comparison, $value);
        }

        // ORDER_BY Section (optional)
        // @see https://laravel.com/docs/6.x/queries#ordering-grouping-limit-and-offset
        if (array_key_exists('order_by', $parsedBody)) {
            foreach ($parsedBody['order_by'] as $orderBy) {
                $model = $model->orderBy($orderBy['column'], $orderBy['direction']);
            }
        }

        // LIMIT Section (optional)
        if (array_key_exists('limit', $parsedBody)) {
            $model = $model->limit($parsedBody['limit']);
        }

        // TRASHED Section [SOFT DELETES]
        // withTrashed
        if (array_key_exists('with_trashed', $parsedBody)) {
            if ($parsedBody['with_trashed']) {
                $model = $model->withTrashed();
            }
        }

        // onlyTrashed
        if (array_key_exists('only_trashed', $parsedBody)) {
            if ($parsedBody['only_trashed']) {
                $model = $model->onlyTrashed();
            }
        }

        // Perform the query
        $models = $model->get();

        // Did we get any results?
        if ($models !== null && count($models) > 0) {
            $data = $models->toArray();
            $status = ResponseBody::HTTP_OK;
        } else {
            $data = null;
            $status = ResponseBody::HTTP_NOT_FOUND;
        }

        $responseBody = $responseBody
            ->setData($data)
            ->setStatus($status);
        return $responseBody();
    }
}
