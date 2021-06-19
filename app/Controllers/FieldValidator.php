<?php
declare(strict_types=1);

namespace Willow\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Request;

// Replacement for Rules
// WIP
class FieldValidator
{
    private static ?string $tableName = 'Medicine';

    public function __invoke(Request $request, RequestHandlerInterface $handler): ResponseInterface {
        foreach (self::$tableName::FIELDS as $column => $value) {
            if (is_array($value)) {
                foreach ($value as $rule => $args) {
                    if (!RulesBase::$rule($column, ...$args)) {
                        die();
                    }
                }
            }
        }
        return $handler->handle($request);
    }

    public static function setTableName(string $tableName): void {
        self::$tableName = $tableName;
    }
}
