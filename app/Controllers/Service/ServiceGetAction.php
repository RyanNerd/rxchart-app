<?php
declare(strict_types=1);

namespace Willow\Controllers\Service;

use Willow\Controllers\GetActionBase;
use Willow\Models\Service;

class ServiceGetAction extends GetActionBase
{
    /**
     * ServiceGetAction constructor.
     * @param Service $model
     */
    public function __construct(Service $model) {
        $this->model = $model;
    }
}
