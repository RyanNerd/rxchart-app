<?php
declare(strict_types=1);

namespace Willow\Controllers\Medicine;

use Willow\Controllers\SearchActionBase;
use Willow\Models\Medicine;
use Willow\Models\ModelBase;


class MedicineSearchAction extends SearchActionBase
{
    protected ModelBase|Medicine $model;

    /**
     * MedicineSearchAction constructor.
     * @param Medicine $model
     */
    public function __construct(Medicine $model)
    {
        $this->model = $model;
    }
}
