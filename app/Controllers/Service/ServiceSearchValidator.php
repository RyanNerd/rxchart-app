<?php
declare(strict_types=1);

namespace Willow\Controllers\Service;

use Willow\Controllers\SearchValidatorBase;
use Willow\Models\Pillbox;
use Willow\Models\Service;

class ServiceSearchValidator extends SearchValidatorBase
{
    /**
     * SearchSearchValidator constructor.
     * @param Service $service
     */
    public function __construct(Service $service) {
        $this->model = $service;
    }
}
