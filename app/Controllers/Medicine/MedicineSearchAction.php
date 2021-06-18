<?php
declare(strict_types=1);

namespace Willow\Controllers\Medicine;

use Willow\Controllers\SearchActionBase;
use Willow\Models\Medicine;

class MedicineSearchAction extends SearchActionBase
{
    /**
     * MedicineSearchAction constructor.
     * @param Medicine $model
     */
    public function __construct(Medicine $model) {
        $this->model = $model;
    }
}
