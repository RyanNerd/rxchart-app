<?php
declare(strict_types=1);

namespace Willow\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use ReflectionClass;
use Slim\Psr7\Request;
use Willow\Middleware\ResponseBody;
use Willow\Middleware\ResponseCodes;
use Willow\Models\ApplyModelColumnAttribute;
use Willow\Models\ApplyModelRule;

#[Validator('todo: Move the static ModelColumnAttributes into the Validator Attribute class')]
abstract class ModelValidatorBase
{
    /**
     * @override Override this property with the class name of the model to process.
     * @var string
     */
    protected string $modelClass;

    /**
     * Use ApplyModelRule Attribute to get the rules to process for the model
     * @param Request $request
     * @param RequestHandler $handler
     * @return ResponseInterface
     * @throws \ReflectionException
     */
    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface {
        $reflectionClass = new ReflectionClass($this->modelClass);
        $modelRuleAttributes = $reflectionClass->getAttributes(ApplyModelRule::class);
        if (count($modelRuleAttributes) > 0) {
            /** @var ResponseBody $responseBody */
            $responseBody = $request->getAttribute('response_body');

            /** @var  ['ColumnName']['ColumnName' => $v, 'Type' => $v, 'Length' => $v, 'Flags' => [$v], 'Default' => $v] $columnAttributes */
            $columnAttributes = [];
            $reflectionModelColumnAttributes = $reflectionClass->getAttributes(ApplyModelColumnAttribute::class);
            foreach ($reflectionModelColumnAttributes as $modelColumnAttribute) {
                /** @var ApplyModelColumnAttribute $columnAttributeInstance */
                $columnAttributeInstance = $modelColumnAttribute->newInstance();
                $modelColumnAttribute = $columnAttributeInstance->getModelColumnAttribute();
                $columnAttributes[$modelColumnAttribute['ColumnName']] = $modelColumnAttribute;
            }

            foreach ($modelRuleAttributes as $modelRuleAttribute) {
                $modelRule = $modelRuleAttribute->newInstance()->getModelRule();
                $modelRuleInstance = new $modelRule;
                $responseBody = $modelRuleInstance(($responseBody), $columnAttributes);
            }
            if ($responseBody->hasMissingRequiredOrInvalid()) {
                $responseBody = $responseBody->setStatus(ResponseCodes::HTTP_BAD_REQUEST)->setData(null);
                return $responseBody();
            }
        }
        return $handler->handle($request);
    }
}
