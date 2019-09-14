<?php
declare(strict_types=1);

namespace Willow\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Routing\Route;
use Willow\Models\User;

class ValidateRequest
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        if ($this->user === null) {
            $this->user = $user;
        }
    }

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

        // Get the API key from the request
        $apiKey = $responseBody->getParsedRequest()['api_key'] ?? null;

        // Is there an API key?
        if ($apiKey !== null) {
            $user = $this->user->where('API_KEY', '=', $apiKey)->first();

            if ($user !== null) {
                if ($user->API_KEY === $apiKey) {

                    // Make all valid authentications admin
                    $responseBody = $responseBody
                        ->setUserId($user->Id)
                        ->setIsAdmin()
                        ->setIsAuthenticated();
                    return $handler->handle($request->withAttribute('response_body', $responseBody));
                }
            }
        } else {
            /** @var Route $route */
            $route = $request->getAttribute('route');
            $pattern = $route->getPattern();

            // If this is an authenticate request then we let this through (this is how we get an API key)
            if (strstr($pattern, 'authenticate')) {
                return $handler->handle($request);
            }
        }

        // Short circuit the request by returning a response with status of 401;
        $responseBody = $responseBody
            ->setStatus(401)
            ->setMessage('Invalid API Key');
        return $responseBody();
    }
}
