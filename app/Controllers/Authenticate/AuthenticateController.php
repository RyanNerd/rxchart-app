<?php
declare(strict_types=1);

namespace Willow\Controllers\Authenticate;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\IController;

class AuthenticateController implements IController
{
    /**
     * Register routes and actions
     * @param RouteCollectorProxyInterface $group
     */
    final public function register(RouteCollectorProxyInterface $group): void {
        $group->post('/authenticate', AuthenticatePostAction::class)
            ->add(AuthenticatePostValidator::class);
    }
}
