<?php
declare(strict_types=1);

namespace Willow\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Willow\Middleware\ResponseBody;

abstract class WriteValidatorBase
{
    /**
     * This is intended to be overridden with the model field list.
     */
    protected const MODEL_FIELDS = [];

    protected ?IRules $rules = null;

    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface
    {
        $responseBody = $request->getAttribute('response_body');
        if ($this->rules !== null) {
            $rules = $this->rules;
            $responseBody = $rules($responseBody, static::MODEL_FIELDS);
        }

        // If there are any missing or required data points then we short circuit and return invalid request.
        if ($responseBody->hasMissingRequiredOrInvalid()) {
            $responseBody = $responseBody
                ->setStatus(ResponseBody::HTTP_BAD_REQUEST)
                ->setMessage('Missing or invalid request');
            return $responseBody();
        }

            return $handler->handle($request);
    }
}
