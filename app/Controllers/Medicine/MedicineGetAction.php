<?php
declare(strict_types=1);

namespace Willow\Controllers\Medicine;

use Willow\Controllers\GetActionBase;
use Willow\Models\Medicine;
use Willow\Models\ModelBase;

class MedicineGetAction extends GetActionBase
{
    /** @var ModelBase|Medicine  */
    protected ModelBase $model;

    /**
     * Get the model via Dependency Injection and save it as a property.
     *
     * @param Medicine $model
     */
    public function __construct(Medicine $model)
    {
        $this->model = $model;
    }
}
