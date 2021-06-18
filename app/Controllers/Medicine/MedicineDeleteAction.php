<?php
declare(strict_types=1);

namespace Willow\Controllers\Medicine;

use Willow\Controllers\DeleteActionBase;
use Willow\Models\Medicine;
use Willow\Models\ModelBase;

class MedicineDeleteAction extends DeleteActionBase
{
    protected Medicine|ModelBase $model;

    /**
     * Get the model via Dependency Injection and save it.
     * @param Medicine $model
     */
    public function __construct(Medicine $model) {
        $this->model = $model;
    }
}
