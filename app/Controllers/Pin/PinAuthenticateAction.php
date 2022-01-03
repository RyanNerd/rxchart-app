<?php
declare(strict_types=1);

namespace Willow\Controllers\Pin;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;
use Willow\Models\Pin;

class PinAuthenticateAction
{
    public function __construct(private Pin $pin) {
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return ResponseInterface
     * @throws JsonException
     */
    public function __invoke(Request $request, Response $response): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        $parsedRequest = $responseBody->getParsedRequest();
        $pinValue = $parsedRequest['pin_value'];
        $pinModel = $this->pin->where('PinValue', '=', $pinValue)->first();
        if ($pinModel === null) {
            $responseBody = $responseBody
                ->setStatus(ResponseCodes::HTTP_NOT_FOUND)
                ->setData(null)
                ->setMessage('PIN Not Found');
            return $responseBody();
        }

        $responseBody = $responseBody
            ->setStatus(ResponseCodes::HTTP_OK)
            ->setData($pinModel->toArray())
            ->setMessage('Todo: TokenOrNoToken');
        return $responseBody();
    }
}
