<?php
namespace Willow\Controllers\Document;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UploadedFileInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;
use Willow\Models\Document;

class DocumentUploadAction
{
    public function __construct(private Document $document) {
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return ResponseInterface
     * @throws JsonException
     */
    public function __invoke(Request $request, Response $response): ResponseInterface {
        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');

        $parsedRequest = $responseBody->getParsedRequest();

        /**
         * @var $files UploadedFileInterface[]
         * @phpstan-ignore-next-line
         */
        $files = $parsedRequest['uploaded_files'];

        $file = $files['single_file'];
        $clientId = $parsedRequest['client_id'];

        $document = clone $this->document;
        $document->ResidentId = $clientId;
        $document->Size = $file->getSize();
        $document->FileName = $file->getClientFilename() ?? 'unknown';
        $document->MediaType = $file->getClientMediaType();
        $document->Image = $file->getStream()->getContents();
        if ($document->save()) {
            $responseBody = $responseBody->setData(
                [
                    'Id' => $document->Id,
                    'Size' => $document->Size,
                    'FileName' => $document->FileName,
                    'Type' => $document->MediaType
                ]
            )->setStatus(ResponseCodes::HTTP_OK);
            return $responseBody();
        }

        $responseBody = $responseBody
            ->setData(null)
            ->setStatus(ResponseCodes::HTTP_INTERNAL_SERVER_ERROR)
            ->setMessage('Unable to save file');
        return $responseBody();
    }
}
