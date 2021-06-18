<?php
declare(strict_types=1);

namespace Willow\Controllers\MedHistory;

use Willow\Controllers\WriteValidatorBase;
use Willow\Models\MedHistory;

class MedHistoryWriteValidator extends WriteValidatorBase
{
    /**
     * @inheritdoc
     */
    protected const MODEL_FIELDS = MedHistory::FIELDS;
}
