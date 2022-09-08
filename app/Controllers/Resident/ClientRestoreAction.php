<?php
declare(strict_types=1);

namespace Willow\Controllers\Resident;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;
use Willow\Models\Resident;

class ClientRestoreAction
{
    public function __construct(private Resident $client) {}

    /**
     * Handle Client Restore request
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(Request $request, Response $response, array $args): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');

        // Load the trashed (soft deleted) model with the given id (PK)
        $client = $this->client;
        $client = $client::onlyTrashed();
        $client = $client->find($args['id']);

        // Assume client is NOT FOUND
        $status = ResponseCodes::HTTP_NOT_FOUND;
        $data = null;

        // If the client record is found then restore the client
        if ($client !== null) {
            // Restore the deleted client
            if ($client->restore()) {
                $data = $client->refresh()->attributesToArray();
                $status = ResponseCodes::HTTP_OK;
            } else {
                $status = ResponseCodes::HTTP_INTERNAL_SERVER_ERROR;
                $responseBody = $responseBody->setMessage('Unable to restore client record: ' . $args['id']);
            }
        }

        // Set the status and data of the ResponseBody
        $responseBody = $responseBody
            ->setData($data)
            ->setStatus($status);

        // Return the response as JSON
        return $responseBody();
    }
}
