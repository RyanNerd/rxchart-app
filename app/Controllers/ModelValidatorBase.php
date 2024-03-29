<?php
declare(strict_types=1);

namespace Willow\Controllers;

use JetBrains\PhpStorm\ArrayShape;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use ReflectionClass;
use ReflectionException;
use Slim\Psr7\Request;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;
use Willow\Models\ApplyModelColumnAttribute;
use Willow\Models\ApplyModelRule;
use Willow\Models\ApplyOverride;

abstract class ModelValidatorBase
{
    #[ApplyOverride('Override this property with the class name of the model to validate.')]
    protected string $modelClass;

    /**
     * @var array|null
     */
    private static ?array $modelColumnAttributes = null;

    /**
     * @var ReflectionClass|null
     */
    private static ?ReflectionClass $modelReflectionClass =  null;

    /**
     * Use ApplyModelRule Attribute to get the rules to process for the model
     * @param Request $request
     * @param RequestHandler $handler
     * @return ResponseInterface
     * @throws ReflectionException|JsonException
     */
    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface {
        $modelRuleAttributes = self::getModelReflectionClass($this->modelClass)->getAttributes(ApplyModelRule::class);
        if (count($modelRuleAttributes) > 0) {
            /** @var ResponseBody $responseBody */
            $responseBody = $request->getAttribute('response_body');
            foreach ($modelRuleAttributes as $modelRuleAttribute) {
                $modelRule = $modelRuleAttribute->newInstance()->getModelRule();
                $modelRuleInstance = new $modelRule;
                $responseBody = $modelRuleInstance(($responseBody), self::getColumnAttributes($this->modelClass));
            }
            if ($responseBody->hasMissingRequiredOrInvalid()) {
                $responseBody = $responseBody->setStatus(ResponseCodes::HTTP_BAD_REQUEST)->setData(null);
                return $responseBody();
            }
        }
        return $handler->handle($request);
    }

    /**
     * If the static variable $modelReflectionClass is null then set it, otherwise return self::$modelReflectionClass
     * @param string $modelClass
     * @return ReflectionClass
     * @throws ReflectionException
     */
    public static function getModelReflectionClass(string $modelClass): ReflectionClass {
        if (self::$modelReflectionClass === null) {
            self::$modelReflectionClass = new ReflectionClass($modelClass);
        }
        return self::$modelReflectionClass;
    }

    /** @phpstan-ignore-next-line
     * @throws ReflectionException
     */
    #[ArrayShape(
        [
            'ColumnName' => [
                'ColumnName' => "string",
                'Type' => "string",
                'Length' => "int|null",
                'Flags' => "bool[]|null",
                'Default' => "null|string"
            ]
        ]
    )]
    /**
     * If self::$modelColumnAttributes is null the set it, otherwise return self::$modelColumnAttributes
     */
    public static function getColumnAttributes(string $modelClass): array {
        if (self::$modelColumnAttributes === null) {
            $columnAttributes = [];
            $reflectionModelColumnAttributes =
                self::getModelReflectionClass($modelClass)->getAttributes(ApplyModelColumnAttribute::class);
            foreach ($reflectionModelColumnAttributes as $modelColumnAttribute) {
                /** @var ApplyModelColumnAttribute $columnAttributeInstance */
                $columnAttributeInstance = $modelColumnAttribute->newInstance();
                $modelColumnAttribute = $columnAttributeInstance->getModelColumnAttribute();
                $columnAttributes[$modelColumnAttribute['ColumnName']] = $modelColumnAttribute;
            }
            self::$modelColumnAttributes = $columnAttributes;
        }
        return self::$modelColumnAttributes;
    }
}
