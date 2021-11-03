<?php
declare(strict_types=1);

namespace Willow\Models;

use Willow\Middleware\ResponseBody;

class MedHistoryModelRule
{
    /**
     * @param ResponseBody $responseBody
     * @param array $medHistoryColumnAttributes
     * @return ResponseBody
     */
    public function __invoke(ResponseBody $responseBody, array $medHistoryColumnAttributes): ResponseBody {
        $parsedRequest = $responseBody->getParsedRequest();

        // Check that the In request parameter if it exists isn't negative
        if (array_key_exists('In', $parsedRequest)) {
            $value = $parsedRequest['In'];
            if ($value < 0) {
                $responseBody->registerParam('invalid', 'In', 'int', "Invalid value of $value given");
            }
        }

        // Check that the Out request parameter if it exists isn't negative
        if (array_key_exists('Out', $parsedRequest)) {
            $value = $parsedRequest['Out'];
            if ($value < 0) {
                $responseBody->registerParam('invalid', 'Out', 'int', "Invalid value of $value given");
            }
        }
        return $responseBody;
    }
}
