<?php
declare(strict_types=1);

namespace Willow\Controllers\Authenticate;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;

class AuthenticatePostAction
{
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        $body = $responseBody->getParsedRequest();

        // Hard code this for now
        if ($body['username'] === 'switchpoint' && $body['password'] === 'switchpoint123' ) {
            $responseBody = $responseBody
                ->setStatus(200)
                ->setData(['apiKey' => 'TEMP_APIKEY'])
                ->setMessage('API Key set');
        } else {
            $responseBody = $responseBody
                ->setStatus(401)
                ->setData(null)
                ->setMessage('Not authorized');
        }

        return $responseBody();
    }
}