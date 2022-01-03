<?php
declare(strict_types=1);

namespace Willow\Controllers\Pin;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\IController;

class PinController implements IController
{
    /**
     * Register routes and actions
     * @param RouteCollectorProxyInterface $group
     */
    final public function register(RouteCollectorProxyInterface $group): void {
        $group->post('/pin/search', PinSearchAction::class)
            ->add(PinSearchValidator::class);

        $group->post('/pin', PinUpdateAction::class)
            ->add(PinModelValidator::class);

        $group->get('/pin/{id}', PinGetAction::class);

        $group->delete('/pin/{id}', PinDeleteAction::class);

        $group->post('/pin/authenticate', PinAuthenticateAction::class)
            ->add(PinAuthenticateValidator::class);

        $group->post('/pin/generate', PinGenerateAction::class);
    }
}
