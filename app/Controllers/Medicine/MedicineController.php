<?php
declare(strict_types=1);

namespace Willow\Controllers\Medicine;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\ApiValidator;
use Willow\Controllers\IController;

class MedicineController implements IController
{
    public function register(RouteCollectorProxyInterface $group): void
    {
        $group->post('/medicine/search', MedicineSearchAction::class)
            ->add(MedicineSearchValidator::class)
            ->add(ApiValidator::class);
        $group->get('/medicine/{id}', MedicineGetAction::class)
            ->add(ApiValidator::class);
        $group->post('/medicine', MedicinePostAction::class)
            ->add(MedicineWriteValidator::class)
            ->add(ApiValidator::class);
        $group->patch('/medicine', MedicinePatchAction::class)
            ->add(MedicineWriteValidator::class)
            ->add(ApiValidator::class);
        $group->delete('/medicine/{id}', MedicineDeleteAction::class)
            ->add(ApiValidator::class);
    }
}
