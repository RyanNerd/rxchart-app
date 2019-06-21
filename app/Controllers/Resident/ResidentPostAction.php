<?php
declare(strict_types=1);

namespace Willow\Controllers\Resident;

use Willow\Controllers\WriteActionBase;
use Willow\Models\Resident;

class ResidentPostAction extends WriteActionBase
{
    /**
     * @var Resident
     */
    protected $model;

    public function __construct(Resident $model)
    {
        $this->model = $model;
    }
}
