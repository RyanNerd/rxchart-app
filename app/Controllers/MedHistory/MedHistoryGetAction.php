<?php
declare(strict_types=1);

namespace Willow\Controllers\MedHistory;

use Willow\Controllers\GetActionBase;
use Willow\Models\MedHistory;

class MedHistoryGetAction extends GetActionBase
{
    /**
     * MedHistoryGetAction constructor.
     * @param MedHistory $model
     */
    public function __construct(MedHistory $model) {
        $this->model = $model;
    }
}
