<?php
declare(strict_types=1);

namespace Willow\Models;

use Willow\Middleware\ResponseBody;

class ModelDefaultRule
{
    private const WHITE_LIST = ['id', 'api_key'];
    /**
     * @param ResponseBody $responseBody
     * @param array $modelColumnAttributes
     * @return ResponseBody
     */
    public function __invoke(ResponseBody $responseBody, array $modelColumnAttributes): ResponseBody {
        // Check all the keys of the parsed request against the Model column names.
        $outLiars = array_diff_key($responseBody->getParsedRequest(), $modelColumnAttributes);
        if (count($outLiars) > 0) {
            // For each requested parameter (key)
            foreach ($outLiars as $oLiar => $v) {
                // Is the key in the WHITE_LIST? If not register that the requested parameter/key is invalid.
                if (!in_array($oLiar, self::WHITE_LIST)) {
                    $responseBody->registerParam('invalid', $oLiar, null, "Unrecognized parameter: $oLiar");
                }
            }
        }
        return $responseBody;
    }
}
