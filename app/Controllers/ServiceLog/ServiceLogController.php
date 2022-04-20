<?php
declare(strict_types=1);

namespace Willow\Controllers\ServiceLog;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\IController;

class ServiceLogController implements IController
{
    /**
     * Register routes and actions
     * @param RouteCollectorProxyInterface $group
     */
    final public function register(RouteCollectorProxyInterface $group): void {
        $group->get('/service-log/{id}', ServiceLogReadAction::class);

        $group->get('/service-log/load', ServiceLogLoadAction::class);

        $group->post('/service-log', ServiceLogUpdateAction::class)
            ->add(ServiceLogModelValidator::class);

        $group->delete('/service-log/{id}', ServiceLogDeleteAction::class);

        $group->post('/service-log/search', ServiceLogSearchAction::class)
            ->add(ServiceLogSearchValidator::class);
    }
}
