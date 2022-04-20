<?php
declare(strict_types=1);

namespace Willow\Controllers\ServiceLog;

use Willow\Controllers\SearchValidatorBase;
use Willow\Models\ServiceLog;

class ServiceLogSearchValidator extends SearchValidatorBase
{
    /**
     * SearchLogSearchValidator constructor.
     * @param ServiceLog $serviceLog
     */
    public function __construct(ServiceLog $serviceLog) {
        $this->model = $serviceLog;
    }
}
