<?php
declare(strict_types=1);

namespace Willow\Controllers\Medicine;

use Willow\Controllers\WriteActionBase;
use Willow\Models\Medicine;

class MedicinePostAction extends WriteActionBase
{
    /**
     * MedicinePostAction constructor.
     * @param Medicine $model
     */
    public function __construct(Medicine $model) {
        $this->model = $model;
    }
}
