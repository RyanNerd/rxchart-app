<?php
declare(strict_types=1);

namespace Willow\Controllers\ServiceLog;

use Willow\Controllers\WriteActionBase;
use Willow\Models\ServiceLog;

class ServiceLogUpdateAction extends WriteActionBase
{
    /**
     * ServiceUpdateAction constructor.
     * @param ServiceLog $service
     */
    public function __construct(ServiceLog $serviceLog) {
        $this->model = $serviceLog;
    }
}
