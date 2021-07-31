<?php
declare(strict_types=1);

namespace Willow\Controllers\Medicine;

use Willow\Controllers\DeleteActionBase;
use Willow\Models\Medicine;

class MedicineDeleteAction extends DeleteActionBase
{
    /**
     * MedicineDeleteAction constructor.
     * @param Medicine $model
     */
    public function __construct(Medicine $model) {
        $this->model = $model;
    }
}
