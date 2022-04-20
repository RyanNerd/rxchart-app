<?php
declare(strict_types=1);

namespace Willow\Controllers\ServiceLog;

use Willow\Controllers\GetActionBase;
use Willow\Models\ServiceLog;

class ServiceLogReadAction extends GetActionBase
{
    /**
     * ServiceLogReadAction constructor
     * @param ServiceLog $serviceLog
     */
    public function __construct(ServiceLog $serviceLog) {
        $this->model = $serviceLog;
    }
}
