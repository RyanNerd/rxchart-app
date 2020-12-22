<?php
declare(strict_types=1);

namespace Willow\Controllers\MedCheckout;

use Willow\Controllers\SearchValidatorBase;
use Willow\Models\MedCheckout;

class MedCheckoutSearchValidator extends SearchValidatorBase
{
    protected $model;

    /**
     * MedHistorySearchValidator constructor.
     * @param MedCheckout $medHistory
     */
    public function __construct(MedCheckout $medHistory)
    {
        $this->model = $medHistory;
    }
}