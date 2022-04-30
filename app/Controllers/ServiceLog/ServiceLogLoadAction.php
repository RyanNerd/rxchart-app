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
        $clientId = $parsedRequest['id'];

        // Load all records or if the query parameter today=yes then just load records for today
        $services = $this->serviceLog->where('ResidentId', '=', $clientId);
        if (array_key_exists('today', $args) && $args['today'] === 'yes') {
            $services = $services->where('Updated', '=', Carbon::now());
        }
        if (array_key_exists('include_recorded', $args) && $args['include_recorded'] === 'yes') {
            $services = $services->WhereNotNull('Recorded');
        } else {
            $services = $services->WhereNull('Recorded');
        }
        $services = $services->get();

        // If the record is not found then 404 error, otherwise status is 200.
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
