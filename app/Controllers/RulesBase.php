<?php
declare(strict_types=1);

namespace Willow\Controllers;

use Respect\Validation\Validator as V;

abstract class RulesBase
{
    /**
     * @param string $value
     * @param int $maxLen
     * @return bool Return true if failed validation.
     */
    final public static function checkMax(string $value, int $maxLen): bool {
        return V::notEmpty()->validate($value) && !V::max($maxLen)->validate(strlen($value));
    }

    /**
     * @param string $value
     * @return bool Return false if failed validation.
     */
    final static function checkEmoji(string $value): bool {
        return V::notEmpty()->validate($value) && !V::notEmoji()->validate($value);
    }

    /**
     * @param mixed $value
     * @return bool Return false if failed validation
     */
    final static function checkNotEmpty(mixed $value): bool {
        return !V::notEmpty()->validate($value);
    }

//    // Iterate all the model fields
//foreach ($fields as $field => $dataType) {
//$protectedField = $dataType[0] === '*';
//    // Is the model field NOT in the request?
//if (!V::key($field)->validate($parsedRequest)) {
//    // Any dataType proceeded with an * are protected fields and can not be changed (e.g. password_hash)
//if ($protectedField) {
//continue;
//}
//
//// If the request is missing this field register it as optional
//$responseBody->registerParam('optional', $field, $dataType);
//} else {
//    // If Datatype is proceeded with an * it means the field is protected and can not be changed (e.g. password_hash)
//    if ($protectedField) {
//        $responseBody->registerParam('invalid', $field, null);
//    }
//}
//}
}
