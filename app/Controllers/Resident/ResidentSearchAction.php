<?php
declare(strict_types=1);

namespace Willow\Controllers\Resident;

use Willow\Controllers\SearchActionBase;
use Willow\Models\Resident;
use Willow\Models\ModelBase;

class ResidentSearchAction extends SearchActionBase
{
    protected ModelBase|Resident $model;

    /**
     * ResidentSearchAction constructor.
     * @param Resident $model
     */
    public function __construct(Resident $model)
    {
        $this->model = $model;
    }
}
