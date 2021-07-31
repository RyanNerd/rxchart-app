<?php
declare(strict_types=1);

namespace Willow\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Routing\RouteContext;
use Willow\Middleware\ResponseBody;

class ApiValidator
{
    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface {

        // If we are trying to authenticate [get an API_KEY] then carry on.
        if (!array_key_exists('api_key', $request->getQueryParams())) {
            $route = RouteContext::fromRequest($request)->getRoute();
            if (substr($route->getPattern(), -13) === '/authenticate' && $route->getMethods()[0] === 'POST') {
                return $handler->handle($request);
            }
        }

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
