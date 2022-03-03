<?php
declare(strict_types=1);

namespace Willow\Controllers\File;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;
use Willow\Models\File;

class FileLoadAction
{
    /**
     * FileLoadAction - helper action to quickly rehydrate just the File records for a client
     * @param File $file File model
     */
    public function __construct(private File $file) {
    }

    /**
     * Handle Load Request by returning all File records for a given client_id
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return ResponseInterface
     * @throws JsonException
     */
    public function __invoke(Request $request, Response $response, array $args): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');

        // Load all models for the given client_id
        $file = $this->file->clone();
        $documents = $file
            ->where('ResidentId', '=', $args['client_id'])
            ->orderBy('Updated', 'desc')
            ->get(['Id', 'ResidentId', 'FileName','MediaType', 'Size', 'Created', 'Updated']);

        // If the record is not found then 404 error, otherwise status is 200.
        if ($documents !== null && count($documents) > 0) {
            $data = $documents->toArray();
            $status = ResponseCodes::HTTP_OK;
        } else {
            $data = null;
            $status = ResponseCodes::HTTP_NOT_FOUND;
        }

        // Set the status and data of the ResponseBody
        $responseBody = $responseBody
            ->setData($data)
            ->setStatus($status);

        // Return the response as JSON
        return $responseBody();
    }
}
