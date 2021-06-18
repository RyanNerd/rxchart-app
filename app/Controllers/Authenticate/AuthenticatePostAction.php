<?php
declare(strict_types=1);

namespace Willow\Controllers\Authenticate;

use DateTime;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Main\GUID;
use Willow\Middleware\ResponseBody;
use Willow\Models\User;

class AuthenticatePostAction
{
    /**
     * AuthenticatePostAction constructor.
     * @param User $userModel
     */
    public function __construct(private User $userModel) {
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return ResponseInterface
     * @throws Exception
     */
    public function __invoke(Request $request, Response $response): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        $body = $responseBody->getParsedRequest();

        // Find the record matching username in the the User table
        $userName = $body['username'];
        $user = $this->userModel->where('UserName', '=', $userName)->first();

        // Is the user not found or is the password not valid?
        if ($user === null || !password_verify($body['password'], $user->PasswordHash)) {
            $responseBody = $responseBody
                ->setStatus(ResponseBody::HTTP_UNAUTHORIZED)
                ->setData(null)
                ->setMessage('Not authorized');
            return $responseBody();
        }

        // Request is authorized. Save the current API_KEY to memory.
        $apiKey = $user->API_KEY;

        // Calculate if the API_KEY is stale (30-days since a new login)
        $interval = $user->Updated->diff(new DateTime('now'));
        if ($interval->d > 30) {
            $apiKey = GUID::v4();
        }

        // Is the API_KEY stale?
        if ($apiKey !== $user->API_KEY) {
            // Update the user record with the new API_KEY
            $user->API_KEY = $apiKey;
        }

        $user->Updated = new DateTime();

        // Did the user update fail?
        if (!$user->save()) {
            // Save failed for some reason, so reject the request.
            $responseBody = $responseBody
                ->setStatus(ResponseBody::HTTP_INTERNAL_SERVER_ERROR)
                ->setData(null)
                ->setMessage('Unable to set new API_KEY');
            return $responseBody();
        }

        // Request is valid and authenticated!
        $responseBody = $responseBody
            ->setIsAuthenticated()
            ->setStatus(ResponseBody::HTTP_OK)
            ->setData([
                'apiKey' => $user->API_KEY,
                'organization' => $user->Organization
            ])
            ->setMessage('API Key set');
        return $responseBody();
    }
}
