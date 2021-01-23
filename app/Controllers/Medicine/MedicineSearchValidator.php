<?php
declare(strict_types=1);

namespace Willow\Controllers\Medicine;

use Willow\Controllers\SearchValidatorBase;
use Willow\Models\Medicine;
use Willow\Models\ModelBase;

class MedicineSearchValidator extends SearchValidatorBase
{
    protected ModelBase|Medicine $model;

    /**
     * MedicineSearchValidator constructor.
     * @param Medicine $medicine
     */
    public function __construct(Medicine $medicine)
    {
        $this->model = $medicine;
    }
}
