<?php
declare(strict_types=1);

namespace Willow\Controllers;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Request;
use Slim\Routing\RouteContext;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;

class ApiValidator
{
    /**
     * @throws JsonException
     */
    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface {

        // If we are trying to authenticate [get an API_KEY] then carry on.
        if (!array_key_exists('api_key', $request->getQueryParams())) {
            $route = RouteContext::fromRequest($request)->getRoute();
            if ($route && $route->getMethods()[0] === 'POST') {
                $pattern = $route->getPattern();

                if (str_ends_with($pattern, '/pin/authenticate')) {
                    return $handler->handle($request);
                }

                if (str_ends_with($pattern, '/authenticate')) {
                    return $handler->handle($request);
                }
            }
        }

        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        if (!$responseBody->getIsAuthenticated()) {
            // Short circuit the request by returning a response with status of 401;
            $responseBody = $responseBody
                ->setStatus(ResponseCodes::HTTP_UNAUTHORIZED)
                ->setMessage('Invalid or missing API Key');
            return $responseBody();
        }
        return $handler->handle($request);
    }
}
