<?php
declare(strict_types=1);

namespace Willow\Controllers\MedHistory;

use Willow\Controllers\QueryValidatorBase;
use Willow\Models\MedHistory;

class MedHistoryQueryValidator extends QueryValidatorBase
{
    protected $modelFields = MedHistory::FIELDS;
}