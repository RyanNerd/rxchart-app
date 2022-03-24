<?php
declare(strict_types=1);

namespace Willow\Controllers\Pin;

use Carbon\Carbon;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;
use Willow\Models\MedHistory;
use Willow\Models\Medicine;
use Willow\Models\Pin;
use Willow\Models\Resident;
use Willow\Models\User;

class PinAuthenticateAction
{
    public function __construct(private Pin $pin, private User $user, private Resident $resident, private Medicine $medicine) {
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

        // We're using a generated PIN to authenticate.
        $pinModel = $this->pin->where('PinValue', '=', $pinValue)->first();

        // Respond with a status of 404 if the pin isn't found.
        if ($pinModel === null) {
            $responseBody = $responseBody
                ->setStatus(ResponseCodes::HTTP_NOT_FOUND)
                ->setData(null)
                ->setMessage('PIN Not Found');
            return $responseBody();
        }

        $userId = $pinModel->UserId;
        $clientId = $pinModel->ResidentId;

        // Find the Client (Resident) record given the client and user IDs
        $clientModel = $this->resident
            ->where('Id', '=', $clientId)
            ->where('UserId', '=', $userId)
            ->first();

        // Respond with a 404 status if we can't find the client record
        if ($clientModel === null) {
            $responseBody = $responseBody
                ->setStatus(ResponseCodes::HTTP_NOT_FOUND)
                ->setData(null)
                ->setMessage('Client record not found');
            return $responseBody();
        }

        // Find the User record given the user ID.
        $userModel = $this->user->where('Id', '=', $userId)->first();

        // Respond with a 404 status if we can't find the User record
        if ($userModel === null) {
            $responseBody = $responseBody
                ->setStatus(ResponseCodes::HTTP_NOT_FOUND)
                ->setData(null)
                ->setMessage('Unable to determine organization request');
            return $responseBody();
        }

        // Load MedHistory for the client for today only
        $medHistory = $this
            ->resident
            ->find($clientModel->Id)
            ->medLog()
            ->where('Out', '>', 0)
            ->whereDate('Updated', '=', Carbon::now())
            ->get(['Id', 'MedicineId', 'Updated', 'Notes', 'Out']);

        // If there's not any logged checked out drugs then respond with a 404 status
        if (count($medHistory) === 0) {
            $responseBody = $responseBody
                ->setStatus(ResponseCodes::HTTP_NOT_FOUND)
                ->setData(null)
                ->setMessage('MedHistory records not found');
            return $responseBody();
        }

        // Build out the checkout medication list
        $medCheckoutList = [];
        foreach ($medHistory as $medLog) {
            $medicine = $this->medicine->find($medLog->MedicineId);
            $medCheckoutList[] = [
                'Id' => $medLog->Id,
                'Drug' => $medicine->Drug ?? 'Unknown',
                'Updated' => $medLog->Updated,
                'Notes' => $medLog->Notes,
                'Out' => $medLog->Out
            ];
        }

        // Build out the return payload
        $data = [
            'api_key' => $userModel->API_KEY,
            'organization' => $userModel->Organization,
            'client_info' => ['first_name' => $clientModel->FirstName, 'last_name' => $clientModel->LastName],
            'pin_info' => $pinModel->toArray(),
            'med_checkout' => $medCheckoutList
        ];

        // Respond with a 200 status and the payload
        $responseBody = $responseBody
            ->setStatus(ResponseCodes::HTTP_OK)
            ->setData($data)
            ->setMessage('Todo: TokenOrNoToken');
        return $responseBody();
    }
}
