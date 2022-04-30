<?php
declare(strict_types=1);

namespace Willow\Controllers\Resident;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use ReflectionException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;
use Willow\Models\Resident;

class ClientRestoreAction {
    public function __construct(private Resident $client) {}

    /**
     * @throws ReflectionException
     * @throws JsonException
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        $body = $responseBody->getParsedRequest();
        $id = $body['id'];
        $client = $this->client::onlyTrashed();
        $client = $client->where('Id', '=', $id)->get();

        // If the record is not found then 404 error, otherwise status is 200.
        if (count($client) === 0) {
            $responseBody = $responseBody
                ->setData(null)
                ->setStatus(ResponseCodes::HTTP_NOT_FOUND);
        } else {
            if ($client->first()->restore()) {
                $responseBody = $responseBody
                    ->setData($client->first()->attributesToArray())
                    ->setStatus(ResponseCodes::HTTP_OK);
            } else {
                $responseBody = $responseBody
                    ->setData(null)
                    ->setStatus(ResponseCodes::HTTP_INTERNAL_SERVER_ERROR)
                    ->setMessage('Unable to restore client: ' . $id);
            }
        }
        return $responseBody();
    }
}
