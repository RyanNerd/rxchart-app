<?php
declare(strict_types=1);

namespace Willow\Controllers\Resident;

use Willow\Controllers\WriteActionBase;
use Willow\Models\Resident;
use Willow\Models\ModelBase;

class ResidentPostAction extends WriteActionBase
{
    /**
     * @var Resident | ModelBase
     */
    protected ModelBase $model;

    public function __construct(Resident $model)
    {
        $this->model = $model;
    }
}
