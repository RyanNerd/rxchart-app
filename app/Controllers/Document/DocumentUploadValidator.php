<?php
declare(strict_types=1);

namespace Willow\Controllers\Document;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Request;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;
use JsonException;
use Respect\Validation\Validator as V;

class DocumentUploadValidator
{
    /**
     * @param Request $request
     * @param RequestHandler $handler
     * @return ResponseInterface
     * @throws JsonException
     */
    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        $parsedRequest = $responseBody->getParsedRequest();

        /**
         * @var $files UploadedFileInterface[]
         * @phpstan-ignore-next-line
         */
        $files = $parsedRequest['uploaded_files'] ?? [];

        // Only 1 file allowed to be uploaded
        if (count($files) !== 1) {
            $responseBody->registerParam('required', 'uploaded_files', 'array', 'There must be only one uploaded file');
        }

        // File is hard coded as 'single_file'
        $file = $files['single_file'] ?? null;

        // The single_file array element label is required
        if ($file === null) {
            $responseBody->registerParam('required', 'single_file', 'file', 'File must be labeled as single_file');
        }

        // File size must be under 100MB
        if ($file && $file->getSize() > 104_857_600) {
            $responseBody->registerParam('invalid', 'single_file', 'file', 'File size exceeds maximum allowed');
        }

        // client_id is required and must be an integer
        $clientId = $parsedRequest['client_id'] ?? null;
        if (!V::notEmpty()->validate($clientId)) {
            $responseBody->registerParam('required', 'client_id', 'integer', 'client_id is empty or invalid');
        } else {
            if (!V::intType()->intVal()->validate($clientId)) {
                $responseBody->registerParam('invalid', 'client_id', 'integer');
            }
        }

        // If there are any invalid or missing required then send bad request response
        if ($responseBody->hasMissingRequiredOrInvalid()) {
            $responseBody = $responseBody->setData(null)->setStatus(ResponseCodes::HTTP_BAD_REQUEST);
            return $responseBody();
        }

        return $handler->handle($request);
    }
}
