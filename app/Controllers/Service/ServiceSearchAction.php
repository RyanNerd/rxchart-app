<?php
declare(strict_types=1);

namespace Willow\Controllers\Service;

use Willow\Controllers\SearchActionBase;
use Willow\Models\Service;

class ServiceSearchAction extends SearchActionBase
{
    /**
     * ServiceSearchAction constructor.
     * @param Service $service
     */
    public function __construct(Service $service) {
        $this->model = $service;
    }
}
