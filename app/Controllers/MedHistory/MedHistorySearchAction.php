<?php
declare(strict_types=1);

namespace Willow\Controllers\MedHistory;

use Willow\Controllers\SearchActionBase;
use Willow\Models\MedHistory;

class MedHistorySearchAction extends SearchActionBase
{
    /**
     * MedHistorySearchAction constructor.
     * @param MedHistory $model
     */
    public function __construct(MedHistory $model) {
        $this->model = $model;
    }
}
