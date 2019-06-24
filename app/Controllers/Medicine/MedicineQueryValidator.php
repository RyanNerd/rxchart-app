<?php
declare(strict_types=1);

namespace Willow\Controllers\Medicine;

use Willow\Controllers\QueryValidatorBase;
use Willow\Models\Medicine;

class MedicineQueryValidator extends QueryValidatorBase
{
    protected $modelFields = Medicine::FIELDS;
}