<?php
declare(strict_types=1);

namespace Willow\Controllers\ServiceLog;

use Carbon\Carbon;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;
use Willow\Models\ServiceLog;

class ServiceLogLoadAction
{
    public function __construct(private ServiceLog $serviceLog) {}

    /**
     * Handle loading ServiceLog records with some optional filters
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
        $clientId = $parsedRequest['id'] ?? null;

        $services = $this->serviceLog;

        // Load all records or if the query parameter dos exists then just load records for the date specified by dos
        if ($clientId !== null) {
            $services = $services->where('ResidentId', '=', $clientId);
        }

        if (array_key_exists('dos', $parsedRequest)) {
            $dateOfService = Carbon::parse($parsedRequest['dos']);
            if ($dateOfService->isCurrentDay()) {
                $services = $services->whereDate('DateOfService', '=', Carbon::today());
            } else {
                $services = $services->whereDate('DateOfService', '=', $dateOfService);
            }
        }

        if (array_key_exists('include_recorded', $parsedRequest) && $parsedRequest['include_recorded'] === 'yes') {
            $services = $services->WhereNotNull('Recorded');
        } else {
            $services = $services->WhereNull('Recorded');
        }

        $services = $services->get();

        // If no record is found then 404 error, otherwise status is 200.
        if ($services->count() === 0) {
            $data = null;
            $status = ResponseCodes::HTTP_NOT_FOUND;
        } else {
            $data = $services->toArray();
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
