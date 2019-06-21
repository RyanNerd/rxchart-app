<?php
declare(strict_types=1);

namespace Willow\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Routing\Route;

class ValidateRequest
{
    /**
     * Validation middleware
     *
     * @param Request $request
     * @param RequestHandler $handler
     * @return ResponseInterface
     */
    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface
    {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');

        /** @var Route $route */
        $route = $request->getAttribute('route');
        $pattern = $route->getPattern();
        // If this is an authenticate request then we let this through (this is how we get an API key)
        if (strstr($pattern, 'authenticate')) {
            return $handler->handle($request);
        }

        // Put your logic here to determine if request is authorized and/or is admin
        if (true) {
            $responseBody = $responseBody
                ->setIsAdmin()
                ->setIsAuthenticated();
            return $handler->handle($request->withAttribute('response_body', $responseBody));
        }

        // Short circuit the request by returning a response with status of 401;
        $responseBody = $responseBody->setStatus(401)->setMessage('Invalid API Key');
        return $responseBody();
    }
}
