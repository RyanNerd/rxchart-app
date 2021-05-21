<?php
declare(strict_types=1);

namespace Willow\Controllers\Medicine;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Models\Medicine;

class MedicineDeleteAction
{
    protected Medicine $model;

    /**
     * Get the model via Dependency Injection and save it.
     *
     * @param Medicine $model
     */
    public function __construct(Medicine $model)
    {
        $this->model = $model;
    }

    /**
     * Handle DELETE request
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(Request $request, Response $response, array $args): ResponseInterface
    {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');

        $model = $this->model;

        // Destroy the model given the id.
        if ($model->destroy($args['id']) === 1) {
            $status = ResponseBody::HTTP_OK;
        } else {
            $status = ResponseBody::HTTP_NOT_FOUND;
        }

        // Set the status and data of the ResponseBody
        $responseBody = $responseBody
            ->setData(null)
            ->setStatus($status);

        // Return the response as JSON
        return $responseBody();
    }
}
