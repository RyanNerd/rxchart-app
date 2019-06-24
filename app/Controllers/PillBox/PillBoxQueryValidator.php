<?php
declare(strict_types=1);

namespace Willow\Controllers\PillBox;

use Willow\Controllers\QueryValidatorBase;
use Willow\Models\PillBox;

class PillBoxQueryValidator extends QueryValidatorBase
{
    protected $modelFields = PillBox::FIELDS;
}