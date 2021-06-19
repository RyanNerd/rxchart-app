<?php
declare(strict_types=1);

namespace Willow\Controllers\PillboxItem;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\ApiValidator;
use Willow\Controllers\IController;

class PillboxItemController implements IController
{
    /**
     * Register routes and actions
     * @param RouteCollectorProxyInterface $group
     */
    final public function register(RouteCollectorProxyInterface $group): void {
        $group->post('/pillbox-item/search', PillboxItemSearchAction::class)
            ->add(PillboxItemSearchValidator::class)
            ->add(ApiValidator::class);
        $group->get('/pillbox-item/{id}', PillboxItemGetAction::class)
            ->add(ApiValidator::class);
        $group->post('/pillbox-item', PillboxItemPostAction::class)
            ->add(PillboxItemWriteValidator::class)
            ->add(ApiValidator::class);
        $group->delete('/pillbox-item/{id}', PillboxItemDeleteAction::class)
            ->add(ApiValidator::class);
    }
}
