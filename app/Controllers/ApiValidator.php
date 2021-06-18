<?php
declare(strict_types=1);

namespace Willow\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Willow\Middleware\ResponseBody;

class ApiValidator
{
    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        if (!$responseBody->getIsAuthenticated()) {
            // Short circuit the request by returning a response with status of 401;
            $responseBody = $responseBody
                ->setStatus(ResponseBody::HTTP_UNAUTHORIZED)
                ->setMessage('Invalid or missing API Key');
            return $responseBody();
        }
        return $handler->handle($request);
    }
}
