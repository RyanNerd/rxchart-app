<?php
declare(strict_types=1);

namespace Willow\Controllers\File;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;
use Willow\Models\File;
use Willow\Models\FileRepresentation;

class FileDownloadAction
{
    /**
     * FileGetAction constructor.
     * @param File $file
     */
    public function __construct(private File $file) {
    }

    /**
     * Handle 'file/download' request
     * @see https://dev.to/nauleyco/how-to-download-a-csv-file-with-slim-4-21a7
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return ResponseInterface
     * @throws JsonException
     */
    public function __invoke(Request $request, Response $response, array $args): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');


        /**
         * Load the File Model with the given id (PK)
         * @var File|FileRepresentation|null $fileModel
         */
        $fileModel = $this->file->makeVisible('Image')->find($args['id']);

        // If the record is not found then 404 error, otherwise status is 200.
        if ($fileModel === null) {
            $responseBody = $responseBody
                ->setData(null)
                ->setStatus(ResponseCodes::HTTP_NOT_FOUND);
            return $responseBody();
        }

        return $response
            ->withHeader('Content-Type', 'application/octet-stream')
            ->withHeader('Content-Disposition', 'attachment; filename="' . $fileModel->FileName . '"')
            ->withAddedHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->withHeader('Cache-Control', 'post-check=0, pre-check=0')
            ->withHeader('Pragma', 'no-cache')
            ->withBody((new StreamFactory())->createStream($fileModel->Image));
    }
}
