<?php
declare(strict_types=1);

namespace Willow\Controllers\PasswordReset;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\ApiValidator;
use Willow\Controllers\IController;

class PasswordResetController implements IController
{
    public function register(RouteCollectorProxyInterface $group): void
    {
        $group->post('/password-reset', PasswordResetPostAction::class)
            ->add(PasswordResetPostValidator::class)
            ->add(ApiValidator::class);
    }
}
