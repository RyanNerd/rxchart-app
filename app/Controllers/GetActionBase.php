<?php
declare(strict_types=1);

namespace Willow\Controllers;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Models\ModelBase;

class GetActionBase
{
    /**
     * @var ModelBase
     */
    protected $model;

    /**
     * Handle GET request
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(Request $request, Response $response, array $args): ResponseInterface
    {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');

        $id = $args['id'];

        // If id is 'all' then get ALL the models in the table.
        if ($id === 'all') {
            $models = $this->model->get()->all();
            $dataTables = [];
            if ($models !== null) {
                /** @var ModelBase $model */
                foreach ($models as $model) {
                    $data = $model->toArray();
                    $this->sanitize($data, $model);
                    $dataTables[] = $data;
                }
            } else {
                $dataTables = [];
            }

            $responseBody = $responseBody
                ->setData($dataTables)
                ->setStatus(200);
            return $responseBody();
        }

        // Load the model with the given id (PK)
        $model = $this->model->find($args['id']);

        // If the record is not found then 404 error, otherwise status is 200.
        if ($model === null) {
            $data = null;
            $status = 404;
        } else {
            // Remove any protected fields from the response
            $data = $model->toArray();
            $this->sanitize($data, $model);

            $status = 200;
        }

        // Set the status and data of the ResponseBody
        $responseBody = $responseBody
            ->setData($data)
            ->setStatus($status);

        // Return the response as JSON
        return $responseBody();
    }

    private function sanitize(array &$data, ModelBase $model): void
    {
        foreach ($data as $field => $value) {
            if (array_key_exists($field, $model::FIELDS)) {
                $dataType = $model::FIELDS[$field];
                if ($dataType{0} === '*') {
                    unset($data[$field]);
                }
            }
        }
    }
}