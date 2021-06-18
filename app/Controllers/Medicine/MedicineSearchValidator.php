<?php
declare(strict_types=1);

namespace Willow\Controllers\Medicine;

use Willow\Controllers\SearchValidatorBase;
use Willow\Models\Medicine;

class MedicineSearchValidator extends SearchValidatorBase
{
    /**
     * MedicineSearchValidator constructor.
     * @param Medicine $medicine
     */
    public function __construct(Medicine $medicine) {
        $this->model = $medicine;
    }
}
