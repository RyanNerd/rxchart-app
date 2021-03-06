<?php
declare(strict_types=1);

namespace Willow\Controllers\MedHistory;

use Willow\Controllers\SearchValidatorBase;
use Willow\Models\MedHistory;
use Willow\Models\ModelBase;

class MedHistorySearchValidator extends SearchValidatorBase
{
    protected ModelBase|MedHistory $model;

    /**
     * MedHistorySearchValidator constructor.
     * @param MedHistory $medHistory
     */
    public function __construct(MedHistory $medHistory)
    {
        $this->model = $medHistory;
    }
}
