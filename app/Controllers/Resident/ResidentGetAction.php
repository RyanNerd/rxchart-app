<?php
declare(strict_types=1);

namespace Willow\Controllers\Resident;

use Willow\Controllers\GetActionBase;
use Willow\Models\Resident;

class ResidentGetAction extends GetActionBase
{
    /**
     * ResidentGetAction constructor.
     * @param Resident $model
     */
    public function __construct(Resident $model) {
        $this->model = $model;
    }
}
