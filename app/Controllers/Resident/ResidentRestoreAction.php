<?php
declare(strict_types=1);

namespace Willow\Controllers\Resident;

use Willow\Controllers\RestoreActionBase;
use Willow\Models\Resident;

class ResidentRestoreAction extends RestoreActionBase
{
    /**
     * @var Resident
     */
    protected $model;

    /**
     * ResidentRestoreAction constructor.
     * @param Resident $resident
     */
    public function __construct(Resident $resident)
    {
        $this->model = $resident;
    }
}
