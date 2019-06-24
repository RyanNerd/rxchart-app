<?php
declare(strict_types=1);

namespace Willow\Controllers\Medicine;

use Willow\Controllers\QueryActionBase;
use Willow\Models\Medicine;

class MedicineQueryAction extends QueryActionBase
{
    /**
     * @var Medicine
     */
    protected $model;

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