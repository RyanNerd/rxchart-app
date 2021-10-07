<?php
declare(strict_types=1);

namespace Willow\Controllers\Pillbox;

use Willow\Controllers\ModelValidatorBase;
use Willow\Models\Pillbox;

class PillboxModelValidator extends ModelValidatorBase
{
    protected string $modelClass = Pillbox::class;
}
