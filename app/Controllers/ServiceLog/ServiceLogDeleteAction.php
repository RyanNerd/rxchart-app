<?php
declare(strict_types=1);

namespace Willow\Controllers\ServiceLog;

use Willow\Controllers\DeleteActionBase;
use Willow\Models\ServiceLog;

class ServiceLogDeleteAction extends DeleteActionBase
{
    /**
     * ServiceLogDeleteAction constructor.
     * @param ServiceLog $serviceLog
     */
    public function __construct(ServiceLog $serviceLog) {
        $this->model = $serviceLog;
    }
}
