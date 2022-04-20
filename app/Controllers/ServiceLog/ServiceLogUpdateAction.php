<?php
declare(strict_types=1);

namespace Willow\Controllers\ServiceLog;

use Willow\Controllers\WriteActionBase;
use Willow\Models\ServiceLog;

class ServiceLogUpdateAction extends WriteActionBase
{
    /**
     * ServiceLogUpdateAction constructor.
     * @param ServiceLog $serviceLog
     */
    public function __construct(ServiceLog $serviceLog) {
        $this->model = $serviceLog;
    }
}
