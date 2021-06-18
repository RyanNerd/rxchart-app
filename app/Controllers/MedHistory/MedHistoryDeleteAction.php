<?php
declare(strict_types=1);

namespace Willow\Controllers\MedHistory;

use Willow\Controllers\DeleteActionBase;
use Willow\Models\MedHistory;
use Willow\Models\ModelBase;

class MedHistoryDeleteAction extends DeleteActionBase
{
    protected MedHistory|ModelBase $model;

    /**
     * Get the model via Dependency Injection and save it.
     * @param MedHistory $model
     */
    public function __construct(MedHistory $model) {
        $this->model = $model;
    }
}
