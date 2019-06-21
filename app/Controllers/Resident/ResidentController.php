<?php
declare(strict_types=1);

namespace Willow\Controllers\Resident;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\IController;

class ResidentController implements IController
{
    public function register(RouteCollectorProxyInterface $group): void
    {
        $group->get('/resident/{id}', ResidentGetAction::class);
        $group->post('/resident', ResidentPostAction::class)
            ->add(ResidentWriteValidator::class);
        $group->patch('/resident', ResidentPatchAction::class)
            ->add(ResidentWriteValidator::class);
        $group->delete('/resident/{id}', ResidentDeleteAction::class);
    }
}