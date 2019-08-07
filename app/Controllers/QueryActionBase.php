<?php
declare(strict_types=1);

namespace Willow\Controllers;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Models\ModelBase;

abstract class QueryActionBase extends ActionBase
{
    /**
     * @var ModelBase
     */
    protected $model;

    /**
     * @var array | null
     */
    protected $relations = null;

    /**
     * @var bool When set to true it allows queries with the value of * to return all records for the table.
     */
    protected $allowAll = false;

    /**
     * Handle GET query request
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
        $parsedRequest = $responseBody->getParsedRequest();

        $value = $args['value'];
        $models = null;

        switch ($value) {
            // SELECT *
            case '*':
                {
                    if ($this->allowAll) {
                        if ($this->relations === null) {
                            $models = $this
                                ->model
                                ->get()
                                ->all();
                        } else {
                            assert(is_array($this->relations), '$this->relations must be an array');
                            $models = $this
                                ->model
                                ->with($this->relations)
                                ->get()
                                ->all();
                        }
                    }
                    break;
                }

            // SELECT * WHERE _columnName=value AND _columnName=value [...]
            case '_':
                {
                    $model = $this->model;
                    foreach ($parsedRequest as $item => $value) {
                        if ($item{0} === '_') {
                            $columnName = substr($item, 1);
                            $model = $model->where($columnName, '=', $value);
                        }
                    }

                    if ($this->relations === null) {
                        $models = $model
                            ->get();
                    } else {
                        $models = $model
                            ->with($this->relations)
                            ->get();
                    }

                    break;
                }

            // SELECT * WHERE `column_name` `operator` `value`
            default:
                {
                    $columnName = $parsedRequest['column_name'];
                    $operator = $parsedRequest['operator'] ?? '=';

                    if ($this->relations === null) {
                        $models = $this
                            ->model
                            ->where($columnName, $operator, $value)
                            ->get();
                    } else {
                        $models = $this
                            ->model
                            ->with($this->relations)
                            ->where($columnName, $operator, $value)->get();
                    }
                }
        }

        if ($models !== null) {
            if (count($models) > 0) {
                $dataTables = [];
                /** @var ModelBase $model */
                foreach ($models as $model) {
                    $data = $model->toArray();
                    $this->sanitize($data, $model::FIELDS);
                    $dataTables[] = $data;
                }

                $responseBody = $responseBody
                    ->setData($dataTables)
                    ->setStatus(200);
            } else {
                $responseBody = $responseBody
                    ->setData(null)
                    ->setStatus(404);
            }
        } else {
            $responseBody = $responseBody
                ->setData(null)
                ->setStatus(400)
                ->setMessage('invalid request');
        }

        return $responseBody();
    }
}