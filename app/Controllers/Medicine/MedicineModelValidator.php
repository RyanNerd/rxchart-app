<?php
declare(strict_types=1);

namespace Willow\Controllers\Medicine;

use Willow\Controllers\ModelValidatorBase;
use Willow\Models\Medicine;

class MedicineModelValidator extends ModelValidatorBase
{
    protected string $modelClass = Medicine::class;
}
