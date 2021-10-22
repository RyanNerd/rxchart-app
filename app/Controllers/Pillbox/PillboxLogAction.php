<?php
declare(strict_types=1);

namespace Willow\Controllers\Pillbox;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Models\MedHistory;
use Willow\Models\Medicine;
use Willow\Models\PillboxItem;

class PillboxLogAction
{
    public function __construct(
        private PillboxItem $pillboxItem,
        private MedHistory $medHistory,
        private Medicine $medicine
    ) {
    }

    /**
     * For a given PillboxId log all the pills in the Pillbox as taken
     * @param Request $request
     * @param Response $response
     * @return ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        $body = $responseBody->getParsedRequest();
        $pillboxId = $body['pillbox_id'];   // Pillbox PK

        /**
         * @var PillboxItem[] $pillboxItems
         * Get a collection of PillboxItems for the given pillboxId
         */
        $pillboxItems = $this->pillboxItem->where('PillboxId', '=', $pillboxId)->get();
        $drugLog = [];
        // Are there PillboxItem records?
        if ($pillboxItems !== null) {
            // Iterate through each PillboxItem
            foreach ($pillboxItems as $pillboxItem) {
                $quantity = $pillboxItem->Quantity;
                // We only log items with a positive quantity
                if ($quantity > 0) {
                    $medicineId = $pillboxItem->MedicineId;
                    $id = $pillboxItem->Id;
                    // Look up the related Medicine record, proceed with processing only if found.
                    $medicineModel = $this->medicine->find($medicineId);
                    if ($medicineModel) {
                        // We only log active medications
                        if ($medicineModel->Active) {
                            $medHistoryModel = clone $this->medHistory;
                            $medHistoryModel->PillboxItemId = $id;
                            $medHistoryModel->ResidentId = $pillboxItem->ResidentId;
                            $medHistoryModel->MedicineId = $medicineId;
                            $medHistoryModel->Notes = (string)$quantity;

                            // If the drug was logged successfully then add the model to the $drugLog array,
                            // otherwise return an error response
                            if ($medHistoryModel->save()) {
                                $drugLog[] = $medHistoryModel->toArray();
                            } else {
                                $responseBody = $responseBody->setData(null);
                                $responseBody = $responseBody->setStatus(ResponseBody::HTTP_INTERNAL_SERVER_ERROR);
                                $responseBody =
                                    $responseBody->
                                    setMessage(
                                        "Pillbox MedHistory insert failure. PillboxId: $pillboxId PillboxItemId: $id"
                                    );
                                return $responseBody();
                            }
                        }
                    }
                }
            }
        }

        // All drugs logged are sent back as a response (empty array is a valid response).
        $responseBody = $responseBody->setData($drugLog);
        $responseBody = $responseBody->setStatus(ResponseBody::HTTP_OK);
        return $responseBody();
    }
}
