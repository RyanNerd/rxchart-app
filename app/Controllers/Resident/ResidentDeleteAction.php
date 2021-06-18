<?php
declare(strict_types=1);

namespace Willow\Controllers\Resident;

use Willow\Controllers\DeleteActionBase;
use Willow\Models\ModelBase;
use Willow\Models\Resident;

class ResidentDeleteAction extends DeleteActionBase
{
    protected ModelBase|Resident $model;

    /**
     * Get the model via Dependency Injection and save it.
     * @param Resident $model
     */
    public function __construct(Resident $model) {
        $this->model = $model;
    }
}
