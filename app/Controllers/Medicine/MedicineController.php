<?php
declare(strict_types=1);

namespace Willow\Controllers\Medicine;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\IController;

class MedicineController implements IController
{
    public function register(RouteCollectorProxyInterface $group): void
    {
        $group->get('/medicine/query/{value}', MedicineQueryAction::class)
            ->add(MedicineQueryValidator::class);
        $group->post('/medicine/search', MedicineSearchAction::class)
            ->add(MedicineSearchValidator::class);
        $group->get('/medicine/{id}', MedicineGetAction::class);
        $group->post('/medicine', MedicinePostAction::class)
            ->add(MedicineWriteValidator::class);
        $group->patch('/medicine', MedicinePatchAction::class)
            ->add(MedicineWriteValidator::class);
        $group->delete('/medicine/{id}', MedicineDeleteAction::class);
    }
}