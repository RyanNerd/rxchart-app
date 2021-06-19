<?php
declare(strict_types=1);

namespace Willow\Controllers\MedHistory;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\IController;

class MedHistoryController implements IController
{
    /**
     * Register routes and actions
     * @param RouteCollectorProxyInterface $group
     */
    final public function register(RouteCollectorProxyInterface $group): void {
        $group->post('/medhistory/search', MedHistorySearchAction::class)
            ->add(MedHistorySearchValidator::class);

        $group->post('/medhistory', MedHistoryPostAction::class)
            ->add(MedHistoryWriteValidator::class);

        $group->get('/medhistory/{id}', MedHistoryGetAction::class);


        $group->delete('/medhistory/{id}', MedHistoryDeleteAction::class);
    }
}
