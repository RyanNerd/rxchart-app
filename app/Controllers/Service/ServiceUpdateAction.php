<?php
declare(strict_types=1);

namespace Willow\Controllers\Service;

use Willow\Controllers\WriteActionBase;
use Willow\Models\Service;

class ServiceUpdateAction extends WriteActionBase
{
    /**
     * ServiceUpdateAction constructor.
     * @param Service $service
     */
    public function __construct(Service $service) {
        $this->model = $service;
    }
}
