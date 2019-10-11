<?php
declare(strict_types=1);

namespace Willow\Controllers\Authenticate;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Main\GUID;
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

        $userName = $body['username'] ?? null;

        $user = $this->userModel->where('UserName', '=', $userName)->first();

        // Is the user not found or is the password not valid?
        if ($user === null || !password_verify($body['password'], $user->PasswordHash)) {
            $responseBody = $responseBody
                ->setStatus(401)
                ->setData(null)
                ->setMessage('Not authorized');
        } else {
            // Request is valid. Create new API_KEY for the user.
            $user->API_KEY = GUID::v4();

            // Save the API_KEY
            if ($user->save()) {
            $responseBody = $responseBody
                ->setIsAuthenticated()
                ->setStatus(200)
                ->setData(['apiKey' => $user->API_KEY])
                ->setMessage('API Key set');
            } else {
                // Save failed for some reason, so reject the request.
                $responseBody = $responseBody
                    ->setStatus(500)
                    ->setData(null)
                    ->setMessage('Unable to set new API_KEY');
            }
        }

        return $responseBody();
    }
}
