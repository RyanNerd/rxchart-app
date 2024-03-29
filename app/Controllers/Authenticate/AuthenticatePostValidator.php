<?php
declare(strict_types=1);

namespace Willow\Controllers\Authenticate;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Respect\Validation\Validator as V;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;

class AuthenticatePostValidator
{
    private const ALLOWED = ['username', 'password', 'id', 'uploaded_files'];

    /**
     * @throws JsonException
     */
    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        $parsedRequest = $responseBody->getParsedRequest();

        foreach ($parsedRequest as $item => $value) {
            if (!in_array($item, self::ALLOWED, true)) {
                $responseBody->registerParam('invalid', $item, null);
            }
        }

        // User is required
        if (!V::key('username')->validate($parsedRequest) || !V::notEmpty()->validate($parsedRequest['username'])) {
            $responseBody->registerParam('required', 'username', 'string');
        }

        // Password is required
        if (!V::key('password')->validate($parsedRequest) || !V::notEmpty()->validate($parsedRequest['password'])) {
            $responseBody->registerParam('required', 'password', 'string');
        }

        // id can be part of the request, but it MUST be null/empty
        if (V::key('id')->validate($parsedRequest) && V::notEmpty()->validate($parsedRequest['id'])) {
            $responseBody->registerParam('invalid', 'id', 'null');
        }

        // If there are any missing required, or invalid data points then we short circuit and return invalid request.
        if ($responseBody->hasMissingRequiredOrInvalid()) {
            $responseBody = $responseBody
                ->setStatus(ResponseCodes::HTTP_BAD_REQUEST)
                ->setMessage('Missing or invalid request');
            return $responseBody();
        }

        return $handler->handle($request);
    }
}
