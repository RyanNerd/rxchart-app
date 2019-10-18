<?php
declare(strict_types=1);

namespace Willow\Controllers\PasswordReset;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Willow\Middleware\ResponseBody;
use Respect\Validation\Validator as V;

class PasswordResetPostValidator
{
    private const ALLOWED = ['username', 'new_password', 'old_password', 'id', 'api_key'];

    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface
    {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        $parsedRequest = $responseBody->getParsedRequest();

        foreach ($parsedRequest as $item => $value) {
            if (!in_array($item, self::ALLOWED)) {
                $responseBody->registerParam('invalid', $item, null);
            }
        }

        // User is required
        if (!V::key('username')->validate($parsedRequest) || !V::notEmpty()->validate($parsedRequest['username'])) {
            $responseBody->registerParam('required', 'username', 'string');
        }

        // old_password is required
        if (!V::key('old_password')->validate($parsedRequest) || !V::notEmpty()->validate($parsedRequest['old_password'])) {
            $responseBody->registerParam('required', 'old_password', 'string');
        }

        // new_password is required
        if (!V::key('new_password')->validate($parsedRequest) || !V::notEmpty()->validate($parsedRequest['old_password'])) {
            $responseBody->registerParam('required', 'new_password', 'string');
        }

        // new_password must be at least 8 characters long
        if (!V::length(8, 300)->validate($parsedRequest['new_password'])) {
            $responseBody->registerParam('invalid', 'new_password', 'string');
        }

        // If there are any missing required, or invalid data points then we short circuit and return invalid request.
        if ($responseBody->hasMissingRequiredOrInvalid()) {
            $responseBody = $responseBody
                ->setStatus(400)
                ->setMessage('Missing or invalid request');
            return $responseBody();
        }

        return $handler->handle($request);
    }
}