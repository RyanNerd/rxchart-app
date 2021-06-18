<?php
declare(strict_types=1);

namespace Willow\Controllers\Medicine;

use Willow\Controllers\IRules;
use Willow\Controllers\RulesBase;
use Willow\Middleware\ResponseBody;

class MedicineRules implements IRules
{
    public function __invoke(ResponseBody $responseBody, array $fields): ResponseBody {
        assert(count($fields) > 0);

        $parsedRequest = $responseBody->getParsedRequest();

        foreach ($fields as $field => $type) {
            $value = $parsedRequest[$field];
            if ($type === 'string') {
                if (RulesBase::checkEmoji($value)) {
                    $responseBody->registerParam('invalid', $field, 'string', "$field: Emoji characters not allowed");
                }
            }

            switch ($field) {
                case 'Drug':
                    if (RulesBase::checkNotEmpty($value)) {
                        $responseBody->registerParam('invalid', $field, 'string', 'Cannot be empty');
                    }
                    if (RulesBase::checkMax($value, 100)) {
                        $responseBody->registerParam('invalid', $field, 'string', 'Max Length must be 100');
                    }
                    break;
                case 'Strength':
                    if (RulesBase::checkMax($value, 20)) {
                        $responseBody->registerParam('invalid', $field, 'string', 'Max Length must be 20');
                    }
                    break;
                case 'Notes':
                    if (RulesBase::checkMax($value, 500)) {
                        $responseBody->registerParam('invalid', $field, 'string', 'Max Length must be 500');
                    }
                    break;
            }
        }
        return $responseBody;
    }
}
