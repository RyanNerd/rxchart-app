<?php
declare(strict_types=1);

namespace Willow\Controllers\Service;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;
use Willow\Models\ServiceLog;

class ServiceLogsAction
{
    public function __construct(private ServiceLog $serviceLog) {}

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
        $parsedRequest = $responseBody->getParsedRequest();
        $serviceId = $parsedRequest['id'];

        // Get all ServiceLog records for the given service Id
        $serviceLogs = $this->serviceLog->where('ServiceId', '=', $serviceId)->get();

        // If the record is not found then 404 error, otherwise status is 200.
        if ($serviceLogs->count() === 0) {
            $data = null;
            $status = ResponseCodes::HTTP_NOT_FOUND;
        } else {
            $data = $serviceLogs->toArray();
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
