<?php
declare(strict_types=1);

namespace Willow\Controllers\MedCheckout;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\IController;

class MedCheckoutController implements IController
{
    public function register(RouteCollectorProxyInterface $group): void
    {
        $group->get('/medcheckout/query/{value}', MedCheckoutQueryAction::class)
            ->add(MedCheckoutQueryValidator::class);
        $group->get('/medcheckout/{id}', MedCheckoutGetAction::class);
        $group->post('/medcheckout', MedCheckoutPostAction::class)
            ->add(MedCheckoutWriteValidator::class);
        $group->patch('/medcheckout', MedCheckoutPatchAction::class)
            ->add(MedCheckoutWriteValidator::class);
        $group->delete('/medcheckout/{id}', MedCheckoutDeleteAction::class);
    }
}