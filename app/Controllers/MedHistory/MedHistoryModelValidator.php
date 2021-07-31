<?php
declare(strict_types=1);

namespace Willow\Controllers\MedHistory;

use Willow\Controllers\ModelValidatorBase;
use Willow\Models\MedHistory;

class MedHistoryModelValidator extends ModelValidatorBase
{
    protected string $modelClass = MedHistory::class;
}
