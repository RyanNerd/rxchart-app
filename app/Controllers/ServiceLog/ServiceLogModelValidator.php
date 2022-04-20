<?php
declare(strict_types=1);

namespace Willow\Controllers\ServiceLog;

use Willow\Controllers\ModelValidatorBase;
use Willow\Models\ServiceLog;

class ServiceLogModelValidator extends ModelValidatorBase
{
    protected string $modelClass = ServiceLog::class;
}
