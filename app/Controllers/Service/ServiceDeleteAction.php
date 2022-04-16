<?php
declare(strict_types=1);

namespace Willow\Controllers\Service;

use Willow\Controllers\DeleteActionBase;
use Willow\Models\Service;

class ServiceDeleteAction extends DeleteActionBase
{
    /**
     * ServiceDeleteAction constructor.
     * @param Service $service
     */
    public function __construct(Service $service) {
        $this->model = $service;
    }
}
