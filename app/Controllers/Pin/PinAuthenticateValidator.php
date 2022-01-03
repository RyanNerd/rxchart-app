<?php
declare(strict_types=1);

namespace Willow\Controllers\Pin;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Respect\Validation\Validator as V;
use Slim\Psr7\Request;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;

class PinAuthenticateValidator
{
    private const ALLOWED = ['pin_value', 'id'];

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

        // pin_value is required
        if (!V::key('pin_value')->validate($parsedRequest) || !V::notEmpty()->validate($parsedRequest['pin_value'])) {
            $responseBody->registerParam('required', 'pin_value', 'string');
        }

        // id can be part of the request, but it MUST be null/empty
        if (V::exists()->validate($parsedRequest['id']) && V::notEmpty()->validate($parsedRequest['id'])) {
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
