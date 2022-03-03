<?php
declare(strict_types=1);

namespace Willow\Controllers\Resident;

use Carbon\Carbon;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;
use Willow\Models\File;
use Willow\Models\MedHistory;
use Willow\Models\Medicine;
use Willow\Models\Pillbox;
use Willow\Models\PillboxItem;
use Willow\Models\Resident;

class ClientLoadAction
{
    public function __construct(
        private File        $file,
        private MedHistory  $medHistory,
        private Medicine    $medicine,
        private Pillbox     $pillbox,
        private PillboxItem $pillboxItem,
        private Resident    $client
    ) {
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args Only one 'id' which is the PK of the client/Resident
     * @return ResponseInterface
     * @throws JsonException
     */
    public function __invoke(Request $request, Response $response, array $args): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        $clientId = $args['id'];

        // Find the Client (Resident model) with the given id (PK)
        $client = $this->client->find($clientId);
        // If the record is not found then 404 error, otherwise status is 200.
        if ($client === null) {
            $data = null;
            $status = ResponseCodes::HTTP_NOT_FOUND;
        } else {
            $status = ResponseCodes::HTTP_OK;
            $data = [
                'clientInfo' => $client->attributesToArray(),
                'fileList' => $this->file
                    ->where('ResidentId', '=', $clientId)
                    ->orderBy('Updated', 'desc')
                    ->get(['Id', 'ResidentId', 'FileName', 'Description', 'MediaType', 'Size', 'Created', 'Updated'])
                    ->toArray(),
                'medicineList' => $this->medicine
                    ->where('ResidentId', '=', $clientId)
                    ->orderBy('Drug', 'asc')
                    ->get()
                    ->toArray(),
                'drugLogList' => $this->medHistory
                    ->where('ResidentId', '=', $clientId)
                    ->whereDate('Updated', '>=', Carbon::now()->subDays(5))
                    ->orderBy('Updated', 'desc')
                    ->get()
                    ->toArray(),
                'pillboxList' => $this->pillbox
                    ->where('ResidentId', '=', $clientId)
                    ->orderBy('Name', 'asc')
                    ->get()
                    ->toArray(),
                'pillboxItemList' => $this->pillboxItem
                    ->where('ResidentId', '=', $clientId)
                    ->get()
                    ->toArray()
            ];
        }

        // Set the status and data of the ResponseBody
        $responseBody = $responseBody
            ->setData($data)
            ->setStatus($status);

        // Return the response as JSON
        return $responseBody();
    }
}
