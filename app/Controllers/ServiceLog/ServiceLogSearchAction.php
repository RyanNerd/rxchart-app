<?php
declare(strict_types=1);

namespace Willow\Controllers\ServiceLog;

use Willow\Controllers\SearchActionBase;
use Willow\Models\ServiceLog;

class ServiceLogSearchAction extends SearchActionBase
{
    /**
     * ServiceLogSearchAction constructor.
     * @param ServiceLog $serviceLog
     */
    public function __construct(ServiceLog $serviceLog) {
        $this->model = $serviceLog;
    }
}
