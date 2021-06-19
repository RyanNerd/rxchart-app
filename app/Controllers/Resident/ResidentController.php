<?php
declare(strict_types=1);

namespace Willow\Controllers\Resident;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\IController;

class ResidentController implements IController
{
    /**
     * Register routes and actions
     * @param RouteCollectorProxyInterface $group
     */
    final public function register(RouteCollectorProxyInterface $group): void {
        $group->post('/resident/search', ResidentSearchAction::class)
            ->add(ResidentSearchValidator::class);

        $group->post('/resident', ResidentPostAction::class)
            ->add(ResidentWriteValidator::class);

        $group->get('/resident/{id}', ResidentGetAction::class);

        $group->delete('/resident/{id}', ResidentDeleteAction::class);
    }
}
