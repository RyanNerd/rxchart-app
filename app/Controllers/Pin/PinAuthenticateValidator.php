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
    private const ALLOWED = ['pin_value', 'uploaded_files'];

    /**
     * @throws JsonException
     */
    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        $parsedRequest = $responseBody->getParsedRequest();

        // Reject any items that are not allowed
        foreach ($parsedRequest as $item => $value) {
            if (!in_array($item, self::ALLOWED, true)) {
                $responseBody->registerParam('invalid', $item, null, 'invalid parameter ' . $item);
            }
        }

        $pinValue = $parsedRequest['pin_value'] ?? '';

        // pin_value is required and can't be empty
        if (!V::key('pin_value')->validate($parsedRequest) || !V::notEmpty()->validate($pinValue)) {
            $responseBody->registerParam('required', 'pin_value', 'string');
        }

        // pin_value must be exactly six characters in length
        if (!V::length(6, 6)->validate($pinValue)) {
            $responseBody->registerParam(
                'invalid',
                'pin_value',
                'string',
                'pin_value must be six characters in length'
            );
        }

        // pin_value must be a string only containing digits
        if (!V::digit()->validate($parsedRequest['pin_value'])) {
            $responseBody->registerParam('invalid', 'pin_value', 'string');
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
