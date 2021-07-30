<?php
declare(strict_types=1);

namespace Willow\Controllers\Eloquent;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\IController;

class EloquentController implements IController
{
    /**
     * Register routes and actions
     * @param RouteCollectorProxyInterface $group
     */
    final public function register(RouteCollectorProxyInterface $group): void {
        $group->get('/eloquent/{table}/{id}', EloquentTableAction::class);
    }
}
