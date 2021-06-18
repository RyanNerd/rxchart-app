<?php
declare(strict_types=1);

namespace Willow\Controllers\Resident;

use Willow\Controllers\DeleteActionBase;
use Willow\Models\Resident;

class ResidentDeleteAction extends DeleteActionBase
{
    /**
     * ResidentDeleteAction constructor.
     * @param Resident $model
     */
    public function __construct(Resident $model) {
        $this->model = $model;
    }
}
