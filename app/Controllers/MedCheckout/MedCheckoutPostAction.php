<?php
declare(strict_types=1);

namespace Willow\Controllers\MedCheckout;

use Willow\Controllers\WriteActionBase;
use Willow\Models\MedCheckout;

class MedCheckoutPostAction extends WriteActionBase
{
    /**
     * @var MedCheckout
     */
    protected $model;

    public function __construct(MedCheckout $model)
    {
        $this->model = $model;
    }
}
