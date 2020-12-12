<?php
declare(strict_types=1);

namespace Willow\Controllers\MedCheckout;

use Willow\Controllers\GetActionBase;
use Willow\Models\MedCheckout;

class MedCheckoutGetAction extends GetActionBase
{
    /**
     * @var MedCheckout
     */
    protected $model;

    /**
     * Get the model via Dependency Injection and save it as a property.
     *
     * @param MedCheckout $model
     */
    public function __construct(MedCheckout $model)
    {
        $this->model = $model;
    }
}