<?php
declare(strict_types=1);

namespace Willow\Controllers\MedHistory;

use Willow\Controllers\DeleteActionBase;
use Willow\Models\MedHistory;

class MedHistoryDeleteAction extends DeleteActionBase
{
    /**
     * MedHistoryDeleteAction constructor.
     * @param MedHistory $model
     */
    public function __construct(MedHistory $model) {
        $this->model = $model;
    }
}
