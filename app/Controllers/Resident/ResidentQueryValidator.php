<?php
declare(strict_types=1);

namespace Willow\Controllers\Resident;

use Willow\Controllers\QueryValidatorBase;
use Willow\Models\Resident;

class ResidentQueryValidator extends QueryValidatorBase
{
    protected $modelFields = Resident::FIELDS;
}