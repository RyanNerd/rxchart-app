<?php
declare(strict_types=1);

namespace Willow\Controllers\MedHistory;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\ApiValidator;
use Willow\Controllers\IController;

class MedHistoryController implements IController
{
    /**
     * Register routes and actions
     * @param RouteCollectorProxyInterface $group
     */
    public function register(RouteCollectorProxyInterface $group): void
    {
        $group->post('/medhistory/search', MedHistorySearchAction::class)
            ->add(MedHistorySearchValidator::class)
            ->add(ApiValidator::class);
        $group->get('/medhistory/{id}', MedHistoryGetAction::class)
            ->add(ApiValidator::class);
        $group->post('/medhistory', MedHistoryPostAction::class)
            ->add(MedHistoryWriteValidator::class)
            ->add(ApiValidator::class);
        $group->patch('/medhistory', MedHistoryPatchAction::class)
            ->add(MedHistoryWriteValidator::class)
            ->add(ApiValidator::class);
        $group->delete('/medhistory/{id}', MedHistoryDeleteAction::class)
            ->add(ApiValidator::class);
    }
}
