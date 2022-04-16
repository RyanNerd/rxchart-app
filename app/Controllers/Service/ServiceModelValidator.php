<?php
declare(strict_types=1);

namespace Willow\Controllers\Service;

use Willow\Controllers\ModelValidatorBase;
use Willow\Models\Service;

class ServiceModelValidator extends ModelValidatorBase
{
    protected string $modelClass = Service::class;
}
