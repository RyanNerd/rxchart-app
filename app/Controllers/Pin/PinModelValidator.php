<?php
declare(strict_types=1);

namespace Willow\Controllers\Pin;

use Willow\Controllers\ModelValidatorBase;
use Willow\Models\Pin;

class PinModelValidator extends ModelValidatorBase
{
    protected string $modelClass = Pin::class;
}
