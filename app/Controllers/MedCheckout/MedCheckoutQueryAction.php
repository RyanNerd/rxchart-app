<?php
declare(strict_types=1);

namespace Willow\Controllers\MedCheckout;

use Willow\Controllers\QueryActionBase;
use Willow\Models\MedCheckout;

class MedCheckoutQueryAction extends QueryActionBase
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