<?php
declare(strict_types=1);

namespace Willow\Controllers\Resident;

use Willow\Controllers\SearchValidatorBase;
use Willow\Models\Resident;
use Willow\Models\ModelBase;

class ResidentSearchValidator extends SearchValidatorBase
{
    protected ModelBase|Resident $model;

    /**
     * ResidentSearchValidator constructor.
     * @param Resident $resident
     */
    public function __construct(Resident $resident)
    {
        $this->model = $resident;
    }
}
