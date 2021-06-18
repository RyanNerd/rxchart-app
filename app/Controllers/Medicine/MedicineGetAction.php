<?php
declare(strict_types=1);

namespace Willow\Controllers\Medicine;

use Willow\Controllers\GetActionBase;
use Willow\Models\Medicine;

class MedicineGetAction extends GetActionBase
{
    /**
     * MedicineGetAction constructor.
     * @param Medicine $model
     */
    public function __construct(Medicine $model) {
        $this->model = $model;
    }
}
