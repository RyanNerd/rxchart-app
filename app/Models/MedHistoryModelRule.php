<?php
declare(strict_types=1);

namespace Willow\Models;

use Willow\Middleware\ResponseBody;

class MedHistoryModelRule
{
    /**
     * @param ResponseBody $responseBody
     * @param array<[
     *  'ColumnName'=>$v,
     *  'Type' => $v,
     *  'Length' => $v,
     *  'Flags' => $v',
     *  'Default' => $v]> $medHistoryColumnAttributes
     * @return ResponseBody
     */
    public function __invoke(ResponseBody $responseBody, array $medHistoryColumnAttributes): ResponseBody {
        $parsedRequest = $responseBody->getParsedRequest();
        foreach ($medHistoryColumnAttributes as $columnName => $fieldAttributes) {
            if (key_exists($columnName, $parsedRequest)) {
                $len = $fieldAttributes['Length'];
                if ($fieldAttributes['Type'] === 'string' && $len !== null) {
                    $value = $parsedRequest[$columnName];
                    if ($value !== null) {
                        if (strlen($value) > $len) {
                            $responseBody
                                ->registerParam(
                                    'invalid',
                                    $columnName,
                                    'string',
                                    "$columnName exceeded max length of $len"
                                );
                        }
                    }
                }
            }
        }
        return $responseBody;
    }
}
