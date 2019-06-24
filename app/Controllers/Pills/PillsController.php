<?php
declare(strict_types=1);

namespace Willow\Controllers\Pills;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\IController;

class PillsController implements IController
{
    public function register(RouteCollectorProxyInterface $group): void
    {
        $group->get('/pills/query/{value}', PillsQueryAction::class)
            ->add(PillsQueryValidator::class);
        $group->get('/pills/{id}', PillsGetAction::class);
        $group->post('/pills', PillsPostAction::class)
            ->add(PillsWriteValidator::class);
        $group->patch('/pills', PillsPatchAction::class)
            ->add(PillsWriteValidator::class);
        $group->delete('/pills/{id}', PillsDeleteAction::class);
    }
}