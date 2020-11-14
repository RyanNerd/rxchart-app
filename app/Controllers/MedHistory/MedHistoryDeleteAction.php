<?php
declare(strict_types=1);

namespace Willow\Controllers\MedHistory;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Models\ModelBase;
use Willow\Models\MedHistory;

class MedHistoryDeleteAction
{
    /**
     * @var MedHistory
     */
    protected $model;

    /**
     * Get the model via Dependency Injection and save it.
     *
     * @param MedHistory $model
     */
    public function __construct(MedHistory $model)
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
            $status = 200;
        } else {
            $status = 404;
        }

        // Set the status and data of the ResponseBody
        $responseBody = $responseBody
            ->setData(null)
            ->setStatus($status);

        // Return the response as JSON
        return $responseBody();
    }
}