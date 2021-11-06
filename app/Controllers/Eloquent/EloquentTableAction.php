<?php
/** @noinspection PhpMultipleClassDeclarationsInspection */
declare(strict_types=1);

namespace Willow\Controllers\Eloquent;

use Doctrine\DBAL\Exception;
use Illuminate\Database\Capsule\Manager as Eloquent;
use Illuminate\Database\Connection;
use Illuminate\Database\Query\Builder;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Willow\Middleware\ResponseBody;

/**
 * Class EloquentTableAction
 * @mixin Builder
 */
class EloquentTableAction
{
    public function __construct(private Eloquent $eloquent) {
    }

    /**
     * @throws JsonException
     * @throws Exception
     */
    public function __invoke(Request $request, Response $response, array $args): ResponseInterface {
        /** @var Builder | Connection | Eloquent $eloquent */
        $eloquent = $this->eloquent;

        $tableList = $eloquent::schema()->getConnection()->getDoctrineSchemaManager()->listTableNames();

        /** @var ResponseBody $responseBody */
        $responseBody = $request->getAttribute('response_body');
        $parsedRequest = $responseBody->getParsedRequest();
        $table = $parsedRequest['table'];

        if (!in_array($table, $tableList, true)) {
            $responseBody = $responseBody->setStatus(404)->setData(null)->setMessage("$table not found");
            return $responseBody();
        }

        $id = $parsedRequest['id'];
        $result = $eloquent->select("SELECT * FROM $table WHERE Id = ?", [$id]);

        if (count($result) > 0) {
            $responseBody = $responseBody->setStatus(200)->setData($result);
        } else {
            $responseBody = $responseBody->setStatus(404)->setMessage("Record $id not found in $table");
        }

        return $responseBody();
    }
}
