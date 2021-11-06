<?php
/** @noinspection PhpMultipleClassDeclarationsInspection */
declare(strict_types=1);

namespace Willow\Controllers\Resident;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use ReflectionException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Controllers\WriteActionBase;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;
use Willow\Models\Resident;

class ResidentPostAction extends WriteActionBase
{
    /**
     * ResidentPostAction constructor.
     * @param Resident $model
     */
    public function __construct(Resident $model) {
        $this->model = $model;
    }

    /**
     * We override this checking for trashed clients to restore or to prevent duplicates
     * @param Request $request
     * @param Response $response
     * @return ResponseInterface
     * @throws JsonException|ReflectionException
     */
    public function __invoke(Request $request, Response $response): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        $residentModel = clone $this->model::withTrashed();

        // Get the request body
        $parsedBody = $responseBody->getParsedRequest();

        // Get the id/Id from the request
        $id = $parsedBody['Id'] ?? null;

        // Force UserScope and look for existing records including trashed records
        /** @noinspection NullPointerExceptionInspection */
        $residentModel = $residentModel
            ->where('FirstName', '=', $parsedBody['FirstName'])
            ->where('LastName', '=', $parsedBody['LastName'])
            ->where('DOB_YEAR', '=', $parsedBody['DOB_YEAR'])
            ->where('DOB_MONTH', '=', $parsedBody['DOB_MONTH'])
            ->where('DOB_DAY', '=', $parsedBody['DOB_DAY'])
            ->where('Id', '<>', $id)
            ->first();

        // Did we get any results (dupes)?
        if ($residentModel !== null) {
            // Are we adding a new record?
            // Is the client deactivated (trashed)?
            // Undelete the record
            if (($id === null) && $residentModel->trashed() && $residentModel->restore()) {
                // Return the response as the restored record.
                $responseBody = $responseBody
                    ->setData($residentModel->attributesToArray())
                    ->setStatus(ResponseCodes::HTTP_OK);
                return $responseBody();
            }

            // Prevent inserting duplicate clients
            $responseBody = $responseBody
                ->setData(null)
                ->setStatus(ResponseCodes::HTTP_CONFLICT)
                ->setMessage('Duplicates not allowed')
                ->setMessage('Resident.Id ' . $id . ' and ' . $residentModel->Id . ' are the same person');
            return $responseBody();
        }

        // No dupes detected so carry on, nothing to see here.
        return parent::__invoke($request, $response);
    }
}
