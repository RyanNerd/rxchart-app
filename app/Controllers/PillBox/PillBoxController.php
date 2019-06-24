<?php
declare(strict_types=1);

namespace Willow\Controllers\PillBox;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\IController;

class PillBoxController implements IController
{
    public function register(RouteCollectorProxyInterface $group): void
    {
        $group->get('/pillbox/query/{value}', PillBoxQueryAction::class)
            ->add(PillBoxQueryValidator::class);
        $group->get('/pillbox/{id}', PillBoxGetAction::class);
        $group->post('/pillbox', PillBoxPostAction::class)
            ->add(PillBoxWriteValidator::class);
        $group->patch('/pillbox', PillBoxPatchAction::class)
            ->add(PillBoxWriteValidator::class);
        $group->delete('/pillbox/{id}', PillBoxDeleteAction::class);
    }
}