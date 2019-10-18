<?php
declare(strict_types=1);

namespace Willow\Controllers\PasswordReset;

use DateTime;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Main\GUID;
use Willow\Middleware\ResponseBody;
use Willow\Models\User;

class PasswordResetPostAction
{
    /**
     * @var User
     */
    protected $userModel;

    /**
     * AuthenticatePostAction constructor.
     * @param User $userModel
     */
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return ResponseInterface
     * @throws \Exception
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        $body = $responseBody->getParsedRequest();

        // Find the record matching username in the the User table
        $userName = $body['username'];
        $user = $this->userModel->where('UserName', '=', $userName)->first();

        // Is the user not found or is the old_password not valid or the api_key is invalid?
        if ($user === null || $user->API_KEY != $body['api_key'] || !password_verify($body['old_password'], $user->PasswordHash)) {
            $responseBody = $responseBody
                ->setStatus(401)
                ->setData(null)
                ->setMessage('Not authorized');
            return $responseBody();
        }

        // Request is authorized. Calculate new API_KEY
        $user->API_KEY = GUID::v4();

        // Update PasswordHash
        $user->PasswordHash = password_hash($body['new_password'], PASSWORD_DEFAULT);

        // Did the user update fail?
        if (!$user->save()) {
            // Save failed for some reason, so reject the request.
            $responseBody = $responseBody
                ->setStatus(500)
                ->setData(null)
                ->setMessage('Unable to set new password');
            return $responseBody();
        }

        // Request is valid and authenticated with new API_KEY
        $responseBody = $responseBody
            ->setIsAuthenticated()
            ->setStatus(200)
            ->setData(['apiKey' => $user->API_KEY])
            ->setMessage('Password reset');
        return $responseBody();
    }
}

