<?php
declare(strict_types=1);

namespace Willow\Controllers\Service;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\IController;

class ServiceController implements IController
{
    /**
     * Register routes and actions
     * @param RouteCollectorProxyInterface $group
     */
    final public function register(RouteCollectorProxyInterface $group): void {
        $group->get('/service/{id}', ServiceGetAction::class);

        $group->get('/service-load', ServiceLoadAction::class);

        $group->post('/service', ServiceUpdateAction::class)
            ->add(ServiceModelValidator::class);

        $group->delete('/service/{id}', ServiceDeleteAction::class);

        $group->post('/service/search', ServiceSearchAction::class)
            ->add(ServiceSearchValidator::class);
    }
}
