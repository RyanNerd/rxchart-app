<?php
declare(strict_types=1);

namespace Willow\Controllers\Medicine;

use Willow\Controllers\WriteActionBase;
use Willow\Models\Medicine;
use Willow\Models\ModelBase;

class MedicinePostAction extends WriteActionBase
{
    protected ModelBase|Medicine $model;

    public function __construct(Medicine $model)
    {
        $this->model = $model;
    }
}
