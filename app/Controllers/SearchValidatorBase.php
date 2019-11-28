<?php
declare(strict_types=1);

namespace Willow\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Willow\Middleware\ResponseBody;
use Willow\Models\ModelBase;

class SearchValidatorBase
{
    protected const VALID_COMPARISON_STRINGS = [
        '=',
        '>',
        '<',
        '>=',
        '<=',
        '<>',
        'LIKE',
        'like'
    ];

    /**
     * @var ModelBase
     */
    protected $model;

    /**
     * @param Request $request
     * @param RequestHandler $handler
     * @return ResponseInterface
     */
    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface
    {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        $parsedBody = $responseBody->getParsedRequest();
        $model = $this->model;

        // where is required
        if (!array_key_exists('where', $parsedBody) && !$model->allowAll) {
            $responseBody->registerParam('required', 'where', 'array<object>');
        } else {
            foreach ($parsedBody['where'] as $item) {
                $column = $item['column'] ?? '';

                // Check the white listed columns for the model.
                // If the column is not in the white list then register it as invalid.
                if (!array_key_exists($column, $model::FIELDS)) {
                    $responseBody->registerParam('invalid', $column, 'column');
                } else {
                    if (!array_key_exists('column', $item)) {
                        $responseBody->registerParam('required', 'where->column', 'string');
                    }

                    if (!array_key_exists('value', $item)) {
                        $responseBody->registerParam('required', 'where->value', 'string');
                    }

                    // Is a comparison item given?
                    if (array_key_exists('comparison', $item)) {
                        // Make sure the comparison string is valid
                        if (!in_array($item['comparison'], self::VALID_COMPARISON_STRINGS)) {
                            $responseBody->registerParam('invalid', 'where->comparison', 'string');
                        }
                    }
                }
            }

            // Is limit requested?
            if (array_key_exists('limit', $parsedBody)) {
                // The limit value MUST be an integer.
                if (!is_int($parsedBody['limit'])) {
                    $responseBody->registerParam('invalid', 'limit', 'integer');
                }
            }
        }

        // If any missing required or invalid then respond with invalid request.
        if ($responseBody->hasMissingRequiredOrInvalid()) {
            $responseBody = $responseBody
                ->setData(null)
                ->setStatus(400);
            return $responseBody();
        }

        return $handler->handle($request);
    }
}
