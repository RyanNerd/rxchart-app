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
     * @param string|null $value
     * @return bool Return false if failed validation.
     */
    final static function checkEmoji(?string $value): bool {
        return V::notEmpty()->validate($value) && !V::notEmoji()->validate($value);
    }

    /**
     * @param mixed $value
     * @return bool Return false if failed validation
     */
    final static function checkNotEmpty(mixed $value): bool {
        return !V::notEmpty()->validate($value);
    }
}
