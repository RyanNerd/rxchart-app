<?php
declare(strict_types=1);

namespace Willow\Controllers\Pillbox;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\ApiValidator;
use Willow\Controllers\IController;

class PillboxController implements IController
{
    /**
     * Register routes and actions
     * @param RouteCollectorProxyInterface $group
     */
    final public function register(RouteCollectorProxyInterface $group): void {
        $group->post('/pillbox/search', PillboxSearchAction::class)
            ->add(PillboxSearchValidator::class)
            ->add(ApiValidator::class);
        $group->get('/pillbox/{id}', PillboxGetAction::class)
            ->add(ApiValidator::class);
        $group->post('/pillbox', PillboxPostAction::class)
            ->add(PillboxWriteValidator::class)
            ->add(ApiValidator::class);
        $group->patch('/pillbox', PillboxPatchAction::class)
            ->add(PillboxWriteValidator::class)
            ->add(ApiValidator::class);
        $group->delete('/pillbox/{id}', PillboxDeleteAction::class)
            ->add(ApiValidator::class);
    }
}
