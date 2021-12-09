<?php
/** @noinspection PhpMultipleClassDeclarationsInspection */
declare(strict_types=1);

namespace Willow\Controllers;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;

class SearchValidatorBase extends ActionBase
{
    private const ALLOWED_PARAMETER_KEYS = [
        'api_key',
        'id',
        'crossJoin',
        'distinct',
        'first',
        'groupBy',
        'having',
        'inRandomOrder',
        'join',
        'latest',
        'leftJoin',
        'limit',
        'offset',
        'onlyTrashed',
        'orWhere',
        'orWhereBetween',
        'orWhereColumn',
        'orWhereIn',
        'orWhereNotBetween',
        'orWhereNotIn',
        'orWhereNotNull',
        'orWhereNull',
        'orderBy',
        'orderByDesc',
        'rightJoin',
        'select',
        'sharedLock',
        'skip',
        'take',
        'withTrashed',
        'where',
        'whereBetween',
        'whereColumn',
        'whereDate',
        'whereDay',
        'whereIn',
        'whereMonth',
        'whereNotBetween',
        'whereNotIn',
        'whereNotNull',
        'whereNull',
        'whereTime',
        'whereYear'
    ];

    /**
     * @param Request $request
     * @param RequestHandler $handler
     * @return ResponseInterface
     * @throws JsonException
     */
    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        $parsedBody = $responseBody->getParsedRequest();
        $parsedKeys = array_keys($parsedBody);

        foreach ($parsedKeys as $key) {
            if (!in_array($key, self::ALLOWED_PARAMETER_KEYS, true)) {
                $responseBody->registerParam('invalid', $key, null);
            }
        }

        // If any missing required or invalid then respond with invalid request.
        if ($responseBody->hasMissingRequiredOrInvalid()) {
            $responseBody = $responseBody
                ->setData(null)
                ->setStatus(ResponseCodes::HTTP_BAD_REQUEST)
                ->setMessage('Invalid search criteria');
            return $responseBody();
        }

        return $handler->handle($request);
    }
}
