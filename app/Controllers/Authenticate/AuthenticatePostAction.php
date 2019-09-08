<?php
declare(strict_types=1);

namespace Willow\Controllers\Authenticate;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Models\User;

class AuthenticatePostAction
{
    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        $body = $responseBody->getParsedRequest();

        $userName = $body['username'];
        $user = $this->userModel->where('UserName', '=', $userName)->first();

        if ($user === null || !password_verify($body['password'], $user->PasswordHash)) {
            $responseBody = $responseBody
                ->setStatus(401)
                ->setData(null)
                ->setMessage('Not authorized');
        } else {
            $responseBody = $responseBody
                ->setStatus(200)
                ->setData(['apiKey' => $user->API_KEY])
                ->setMessage('API Key set');
        }

        return $responseBody();
    }
}
