<?php
declare(strict_types=1);

namespace Willow\Controllers;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;

abstract class WriteActionBase extends ActionBase
{
    public function __invoke(Request $request, Response $response): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        $body = $responseBody->getParsedRequest();
        $model = $this->model;

        $primaryKeyName = $model->getKeyName();

        // Does the request body have an Id / PrimaryKeyName?
        if (array_key_exists($primaryKeyName, $body) && $body[$primaryKeyName] !== null) {
            // Look up the model record.
            $model = $model->find($body[$primaryKeyName]);

            // If we couldn't find the record then respond with 404 (not found) status.
            if ($model === null) {
                $responseBody = $responseBody
                    ->setData(null)
                    ->setStatus(ResponseBody::HTTP_NOT_FOUND);
                return $responseBody();
            }
        }

        $columnAttributes = ModelValidatorBase::getColumnAttributes($this->model::class);
        $columnNames = array_keys($columnAttributes);

        // Replace each key value from the parsed request into the model and save.
        foreach ($body as $key => $value) {
            // Ignore Primary Key
            if ($key === $primaryKeyName) {
                continue;
            }

            // Ignore timestamps
            if ($model->timestamps) {
                if ($key === $model::CREATED_AT || $key === $model::UPDATED_AT) {
                    continue;
                }
            }

            // Only update fields listed in the model::FIELDS array
            if (in_array($key, $columnNames, true)) {
                $model->$key = $value;
            }
        }

        // Update the model on the database.
        if ($model->save()) {
            $responseBody = $responseBody
                ->setData($model->attributesToArray())
                ->setStatus(ResponseBody::HTTP_OK);
        } else {
            // Unable to save for some reason so we return error status.
            $responseBody = $responseBody
                ->setData(null)
                ->setStatus(ResponseBody::HTTP_INTERNAL_SERVER_ERROR)
                ->setMessage('Unable to save changes to ' . $model->getTableName());
        }

        return $responseBody();
    }
}
