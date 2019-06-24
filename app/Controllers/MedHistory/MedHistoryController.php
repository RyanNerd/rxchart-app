<?php
declare(strict_types=1);

namespace Willow\Controllers\MedHistory;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\IController;

class MedHistoryController implements IController
{
    public function register(RouteCollectorProxyInterface $group): void
    {
        $group->get('/medhistory/query/{value}', MedHistoryQueryAction::class)
            ->add(MedHistoryQueryValidator::class);
        $group->get('/medhistory/{id}', MedHistoryGetAction::class);
        $group->post('/medhistory', MedHistoryPostAction::class)
            ->add(MedHistoryWriteValidator::class);
        $group->patch('/medhistory', MedHistoryPatchAction::class)
            ->add(MedHistoryWriteValidator::class);
        $group->delete('/medhistory/{id}', MedHistoryDeleteAction::class);
    }
}