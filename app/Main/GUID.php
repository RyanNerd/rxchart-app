<?php
declare(strict_types=1);

// phpcs:ignoreFile -- Helper function that is indeed mostly code

namespace Willow\Main;

use Exception;

/**
 * Class GUID
 * @see http://www.inanzzz.com/index.php/post/vjqh/generating-a-rfc-4211-compliant-valid-uuid-or-guid-string-with-php
 */
class GUID
{
    /**
     * @throws Exception
     */
    final public static function v4(): string {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            random_int(0, 0xffff),
            random_int(0, 0xffff),
            // 16 bits for "time_mid"
            random_int(0, 0xffff),
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            random_int(0, 0x0fff) | 0x4000,
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            random_int(0, 0x3fff) | 0x8000,
            // 48 bits for "node"
            random_int(0, 0xffff),
            random_int(0, 0xffff),
            random_int(0, 0xffff)
        );
    }
}
