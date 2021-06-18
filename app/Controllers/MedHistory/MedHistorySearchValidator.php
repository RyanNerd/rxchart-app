<?php
declare(strict_types=1);

namespace Willow\Controllers\MedHistory;

use Willow\Controllers\SearchValidatorBase;
use Willow\Models\MedHistory;

class MedHistorySearchValidator extends SearchValidatorBase
{
    /**
     * MedHistorySearchValidator constructor.
     * @param MedHistory $medHistory
     */
    public function __construct(MedHistory $medHistory) {
        $this->model = $medHistory;
    }
}
