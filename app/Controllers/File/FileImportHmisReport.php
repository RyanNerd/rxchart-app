<?php
namespace Willow\Controllers\File;

use Carbon\Carbon;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UploadedFileInterface;
use SimpleXMLElement;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;
use Willow\Models\Resident;

class FileImportHmisReport
{
    public function __construct(private Resident $clientModel) {
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


        // todo: try...catch
        $hmisClients = [];
        $excel = new SimpleXMLElement(file_get_contents($file));
        $rows = $excel->Worksheet->Table->Row;
        foreach ($rows as $row) {
            $hmisClients[] = [
                'Name' => $row->Cell[2]->Data->__toString(),
                'Age' => (int)$row->Cell[8]->Data->__toString(),
                'EnrollId' => (int)$row->Cell[16]->Data->__toString(),
                'HmisId' => (int)$row->Cell[18]->Data->__toString()
            ];
        }

        $thisYear = Carbon::now()->year;
        // Iterate through the parsed xml file looking up by name and age each client and updating the HmisId and EntrollId
        foreach ($hmisClients as $hmisClient) {
            $name = $hmisClient['Name'];
            $commaPosition = strpos($name, ',');
            $lastName = trim($commaPosition ? substr($name, 0,$commaPosition - 1) : '');
            $firstName = trim($commaPosition ? substr($name, $commaPosition +1) : '');
            $age = $hmisClient['Age'];
            $client = clone $this->clientModel;
            $clients = $client
                ->where('LastName', '=', $lastName)
                ->where('FirstName', '=', $firstName)
                ->whereBetween('DOB_YEAR', [$thisYear - $age - 1, $thisYear - $age + 1])
                ->get();

            $hmisId = $hmisClient['HmisId'];
            $enrollId = $hmisClient['EnrollId'];

            // Did we find any matches?
            if ($clients->count() > 0) {
                /** @var Resident $clientToUpdate */
                foreach ($clients as $clientToUpdate) {
                    $shouldSave = false;
                    if ($clientToUpdate->HMIS === null) {
                        $clientToUpdate->HMIS = $hmisId;
                        $clientToUpdate->EnrollmentId = $enrollId;
                        $shouldSave = true;
                    } else {
                        // Only update the enrollmentId if the $enrollId from the xml import is greater
                        if ($enrollId > (int)$clientToUpdate->EnrollmentId) {
                            $clientToUpdate->EnrollmentId = $enrollId;
                            $shouldSave = true;
                        }
                    }

                    if ($shouldSave) {
                        $clientToUpdate->save();
                    }
                }
            }
        }

        // TODO: What to send back?
        $responseBody = $responseBody
            ->setData(null)
            ->setStatus(ResponseCodes::HTTP_OK)
            ->setMessage('HMIS Import File Processed');
        return $responseBody();
    }
}
