<?php
declare(strict_types=1);

namespace Willow\Controllers\Resident;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\IController;

class ResidentController implements IController
{
    public function register(RouteCollectorProxyInterface $group): void
    {
        $group->get('/resident/query/{value}', ResidentQueryAction::class)
            ->add(ResidentQueryValidator::class);
        $group->post('/resident/search', ResidentSearchAction::class)
            ->add(ResidentSearchValidator::class);
        $group->get('/resident/{id}', ResidentGetAction::class);
        $group->post('/resident', ResidentPostAction::class)
            ->add(ResidentWriteValidator::class);
        $group->patch('/resident', ResidentPatchAction::class)
            ->add(ResidentWriteValidator::class);
        $group->delete('/resident/{id}', ResidentDeleteAction::class);
        $group->post('/resident/restore', ResidentRestoreAction::class)
            ->add(ResidentRestoreValidator::class);
    }
}