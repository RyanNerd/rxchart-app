<?php
declare(strict_types=1);

namespace Willow\Controllers\Pin;

use Exception;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;
use Willow\Models\Pin;

class PinGenerateAction
{
    private const DIGIT_COUNT = 6;

    /**
     * Pin Generate Action constructor
     * @private $pin The Pin model
     */
    public function __construct(private Pin $pin) {
    }

    /**
     * Handle Generate request
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return ResponseInterface
     * @throws JsonException
     * @throws Exception
     */
    public function __invoke(Request $request, Response $response, array $args): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        $parsedRequest = $responseBody->getParsedRequest();
        $clientId = $parsedRequest['client_id'];

        $pinModel = clone $this->pin;
        do {
            $pinValue = random_int(10 ** (self::DIGIT_COUNT - 1), (10 ** self::DIGIT_COUNT) -1);
            $pinExists = $this->pin
                ->where('ResidentId', '=', $clientId)
                ->where('PinValue', '=', $pinValue)
                ->first();
        } while ($pinExists !== null);

        $pinModel->ResidentId = $clientId;
        $pinModel->PinValue = $pinValue;
        if ($pinModel->save() === false) {
            $responseBody = $responseBody
                ->setStatus(ResponseCodes::HTTP_INTERNAL_SERVER_ERROR)
                ->setData(null)
                ->setMessage('Unable to save generated PIN');
        } else {
            $pinArray = str_split((string)$pinValue);
            $responseBody = $responseBody
                ->setStatus(ResponseCodes::HTTP_OK)
                ->setData(["client_id" => $clientId, "pin" => $pinValue, "pin_array" => $pinArray]);
        }
        return $responseBody();
    }
}
