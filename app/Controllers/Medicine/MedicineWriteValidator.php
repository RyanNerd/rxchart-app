<?php
declare(strict_types=1);

namespace Willow\Controllers\Medicine;

use Respect\Validation\Validator as V;
use Willow\Controllers\WriteValidatorBase;
use Willow\Middleware\ResponseBody;
use Willow\Models\Medicine;

class MedicineWriteValidator extends WriteValidatorBase
{
    private const ALLOWED_CHARACTERS = [' ', "'", '#', '(', ')', '-', '*', '/', '_', '\\', '.'];

    /**
     * We override the processValidation placing our own validations for the given model
     *
     * @param ResponseBody $responseBody
     * @param array $parsedRequest
     */
    protected function processValidation(ResponseBody $responseBody, array $parsedRequest): void
    {
        // Iterate all the model fields
        foreach(Medicine::FIELDS as $field => $dataType) {
            // Is the model field NOT in the request?
            if (!V::key($field)->validate($parsedRequest)) {
                // Any dataType proceeded with an * are protected fields and can not be changed (e.g. password_hash)
                if ($dataType[0] === '*') {
                    continue;
                }

                // If the request is missing this field so register it as optional
                $responseBody->registerParam('optional', $field, $dataType);
            } else {
                // If Datatype is proceeded with an * it means the field is protected and can not be changed (e.g. password_hash)
                if ($dataType[1] === '*') {
                    $responseBody->registerParam('invalid', $field, null);
                }

                // Don't allow emoji or other "strange" characters -- this prevents SQL Errors
                if ($field === 'Drug') {
                    if (!V::alnum(implode(self::ALLOWED_CHARACTERS))->validate($parsedRequest['Drug'])) {
                        $responseBody->registerParam('invalid', $field, 'alpha-numeric. Value given: ' . $parsedRequest['Drug']);
                    }
                }
            }
        }
    }
}
