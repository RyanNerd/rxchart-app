<?php
declare(strict_types=1);

namespace Willow\Controllers\MedCheckout;

use Willow\Controllers\SearchActionBase;
use Willow\Models\MedCheckout;

class MedCheckoutSearchAction extends SearchActionBase
{
    protected $model;

    /**
     * MedCheckoutSearchAction constructor.
     * @param MedCheckout $model
     */
    public function __construct(MedCheckout $model)
    {
        $this->model = $model;
    }
}
