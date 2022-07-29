<?php
declare(strict_types=1);

namespace Willow\Controllers\HmisUsers;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\IController;

class HmisUsersController implements IController
{
    /**
     * Register routes and actions
     * @param RouteCollectorProxyInterface $group
     */
    final public function register(RouteCollectorProxyInterface $group): void {
        $group->post('/hmis-users', HmisUsersUpdateAction::class)
            ->add(HmisUsersModelValidator::class);

        $group->get('/hmis-users/{id}', HmisUsersGetAction::class);

        $group->get('/hmis-users-load', HmisUsersLoadAction::class);

        $group->delete('/hmis-users/{id}', HmisUsersDeleteAction::class);
    }
}
