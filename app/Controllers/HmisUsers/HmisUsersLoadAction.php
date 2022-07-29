<?php
declare(strict_types=1);

namespace Willow\Controllers\HmisUsers;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;
use Willow\Models\HmisUsers;

class HmisUsersLoadAction
{
    public function __construct(private HmisUsers $hmisUsers) {}

    /**
     * Handle load all records request
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return ResponseInterface
     * @throws JsonException
     */
    public function __invoke(Request $request, Response $response, array $args): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');

        // Load all records
        $hmisUsers = $this->hmisUsers->orderBy('HmisUserName')->get();

        // If the record is not found then 404 error, otherwise status is 200.
        if ($hmisUsers->count() === 0) {
            $data = null;
            $status = ResponseCodes::HTTP_NOT_FOUND;
        } else {
            $data = $hmisUsers->toArray();
            $status = ResponseCodes::HTTP_OK;
        }

        // Set the status and data of the ResponseBody
        $responseBody = $responseBody
            ->setData($data)
            ->setStatus($status);

        // Return the response as JSON
        return $responseBody();
    }
}
