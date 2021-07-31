<?php
declare(strict_types=1);

namespace Willow\Models;

use Willow\Middleware\ResponseBody;

class MedicineModelRule
{
    /**
     * @param ResponseBody $responseBody
     * @param array
     * @return ResponseBody
     */
    public function __invoke(ResponseBody $responseBody, array $medicineColumnAttributes): ResponseBody {
        $parsedRequest = $responseBody->getParsedRequest();

        // If the request is a pillbox check that other parameters have valid values
        if (key_exists('Pillbox', $parsedRequest)) {
            // If the MedicineId request parameter exists it MUST be null.
            if (key_exists('MedicineId', $parsedRequest)) {
                $medicineId =  $parsedRequest['MedicineId'];
                if ($medicineId !== null) {
                    $responseBody
                        ->registerParam(
                            'invalid',
                            'MedicineId',
                            'int',
                            "Pillbox records cannot reference themselves. MedicineId must be null, $medicineId given"
                        );
                }
            }
        }
        return $responseBody;
    }
}
