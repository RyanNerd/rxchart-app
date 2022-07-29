<?php
namespace Willow\Controllers\File;

use Carbon\Carbon;
use Exception;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UploadedFileInterface;
use SimpleXMLElement;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;
use Willow\Models\ClientRepresentation;
use Willow\Models\Resident;

/**
 * Handles the upload of HMIS Excel XML client report
 *
 * The uploaded file should be in this XML format:
 * <Worksheet ss:Name="DataSet1">
 *  <Table>
 *    <Row>
 *       <Cell><Data ss:Type="String">Organization</Data></Cell>
 *       <Cell><Data ss:Type="String">ProgramName</Data></Cell>
 *       <Cell><Data ss:Type="String">Name</Data></Cell>
 *       <Cell><Data ss:Type="String">SocSecNo</Data></Cell>
 *       <Cell><Data ss:Type="String">GenderDesc</Data></Cell>
 *       <Cell><Data ss:Type="String">GenderDescList</Data></Cell>
 *       <Cell><Data ss:Type="String">RaceDesc</Data></Cell>
 *       <Cell><Data ss:Type="String">RaceDescList</Data></Cell>
 *       <Cell><Data ss:Type="String">Age</Data></Cell>
 *       <Cell><Data ss:Type="String">EnrollDate</Data></Cell>
 *       <Cell><Data ss:Type="String">ExitDate</Data></Cell>
 *       <Cell><Data ss:Type="String">DaysEnrolled</Data></Cell>
 *       <Cell><Data ss:Type="String">LenthofStay</Data></Cell>
 *       <Cell><Data ss:Type="String">Enrolled</Data></Cell>
 *       <Cell><Data ss:Type="String">StillEnrolled</Data></Cell>
 *       <Cell><Data ss:Type="String">Exited</Data></Cell>
 *       <Cell><Data ss:Type="String">EnrollID</Data></Cell>
 *       <Cell><Data ss:Type="String">ProgramID</Data></Cell>
 *       <Cell><Data ss:Type="String">ClientID</Data></Cell>
 *       <Cell><Data ss:Type="String">ExitReason</Data></Cell>
 *       <Cell><Data ss:Type="String">ExitDestination</Data></Cell>
 *       <Cell><Data ss:Type="String">CaseID</Data></Cell>
 *    </Row>
 *   </Table>
 *  </Worksheet>
 */
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

        // Lots of parsing of the uploaded XML file from HMIS
        try {
            /**
             * @var $files UploadedFileInterface[]
             * @phpstan-ignore-next-line
             */
            $files = $parsedRequest['uploaded_files'];
            $file = $files['single_file'];

            // Empty array for all the HMIS clients to be gathered from the XML file
            $hmisClients = [];

            // Response data
            $updatedClients = [];
            $clientsNotFound = [];

            // Get the file contents
            $xmlData = $file->getStream()->getContents();

            // The uploaded file is an Excel file in XML format. Try to load the file contents into the SimpleXML object
            $excel = new SimpleXMLElement($xmlData);

            // See class docblock for assumed XML format details
            $rows = $excel->Worksheet->Table->Row;
            foreach ($rows as $row) {
                $hmisClients[] = [
                    'Name' => $row->Cell[2]->Data->__toString(),
                    'Age' => (int)$row->Cell[8]->Data->__toString(),
                    'EnrollId' => (int)$row->Cell[16]->Data->__toString(),
                    'HmisId' => (int)$row->Cell[18]->Data->__toString()
                ];
            }

            // What year is it?
            $thisYear = Carbon::now()->year;

            // Iterate through the parsed xml file looking up by name and age each client
            foreach ($hmisClients as $hmisClient) {
                $name = $hmisClient['Name'];
                $commaPosition = strpos($name, ',');
                $lastName = trim($commaPosition ? substr($name, 0, $commaPosition) : '');
                $firstName = trim($commaPosition ? substr($name, $commaPosition + 1) : '');
                $age = $hmisClient['Age'];

                // Remove the middle name from $firstName
                $spacePosition = strpos($firstName, ' ');
                $firstName = $spacePosition ? substr($firstName, 0, $spacePosition) : '';

                if (empty($lastName) || empty($firstName)) {
                    continue;
                }

                // clone the clientModel object
                $client = clone $this->clientModel;

                // We want only deleted records
                $client = $client::onlyTrashed();

                // Since the XML data does not have DOB and only Age we use some fuzzy logic to try and find matches
                $clients = $client
                    ->where('LastName', 'LIKE', "%{$lastName}%")
                    ->where('FirstName', 'LIKE', "%{$firstName}%")
                    ->whereBetween('DOB_YEAR', [($thisYear - $age) - 3, ($thisYear - $age) + 3]);

                // Perform the query
                $clients = $clients->get();

                $hmisId = $hmisClient['HmisId'];
                $enrollId = $hmisClient['EnrollId'];

                // Did we find any matches?
                if ($clients->count() > 0) {
                    /** @var Resident|ClientRepresentation $clientToUpdate */
                    foreach ($clients as $clientToUpdate) {
                        $shouldSave = false;
                        if ($clientToUpdate->EnrollmentId === null) {
                            $clientToUpdate->HMIS = $hmisId;
                            $clientToUpdate->EnrollmentId = $enrollId;
                            $shouldSave = true;
                        }

                        // If we should save then attempt to do so. Upon failure to save send the failed response
                        if ($shouldSave && !$clientToUpdate->save()) {
                            $responseBody = $responseBody
                                ->setData(null)
                                ->setStatus(ResponseCodes::HTTP_INTERNAL_SERVER_ERROR)
                                ->setMessage("Unable to save HMIS Client update. ID: " . $clientToUpdate->Id);
                            return $responseBody();
                        }

                        // Add the updated client as an array to our updatedClients array if it was updated
                        if ($shouldSave) {
                            $updatedClients[] = $clientToUpdate->toArray();
                        }
                    }
                } else {
                    $clientsNotFound[] = [
                        'FirstName' => $firstName,
                        'LastName' => $lastName,
                        'Age' => $age,
                        'HMIS' => $hmisId,
                        'EnrollmentId' => $enrollId
                    ];
                }
            }
        } catch (Exception $exception) {
            $responseBody = $responseBody
                ->setData(null)
                ->setStatus(ResponseCodes::HTTP_BAD_REQUEST)
                ->setMessage(['HMIS Import File Error', $exception->getMessage()]);
            return $responseBody();
        }

        $responseBody = $responseBody
            ->setData([
                'updatedClients' => $updatedClients,
                'clientsNotFound' => $clientsNotFound
            ])
            ->setStatus(ResponseCodes::HTTP_OK)
            ->setMessage('HMIS Import File Processed');
        return $responseBody();
    }
}
