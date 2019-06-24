<?php
declare(strict_types=1);

namespace Willow\Controllers\Pills;

use Willow\Controllers\QueryValidatorBase;
use Willow\Models\Pills;

class PillsQueryValidator extends QueryValidatorBase
{
    protected $modelFields = Pills::FIELDS;
}