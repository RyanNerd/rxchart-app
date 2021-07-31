<?php
declare(strict_types=1);

namespace Willow\Controllers\Medicine;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\IController;

class MedicineController implements IController
{
    /**
     * Register routes and actions
     * @param RouteCollectorProxyInterface $group
     */
    final public function register(RouteCollectorProxyInterface $group): void {
        $group->post('/medicine/search', MedicineSearchAction::class)
            ->add(MedicineSearchValidator::class);

        $group->post('/medicine', MedicinePostAction::class)
            ->add(MedicineModelValidator::class);

        $group->get('/medicine/{id}', MedicineGetAction::class);

        $group->delete('/medicine/{id}', MedicineDeleteAction::class);
    }
}
