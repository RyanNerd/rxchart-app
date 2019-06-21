<?php
declare(strict_types=1);

namespace Willow\Controllers\Resident;

use Willow\Controllers\GetActionBase;
use Willow\Models\Resident;

class ResidentGetAction extends GetActionBase
{
    /**
     * @var Resident
     */
    protected $model;

    /**
     * Get the model via Dependency Injection and save it as a property.
     *
     * @param Resident $model
     */
    public function __construct(Resident $model)
    {
        $this->model = $model;
    }
}