<?php
declare(strict_types=1);

namespace Willow\Controllers\MedHistory;

use Willow\Controllers\GetActionBase;
use Willow\Models\MedHistory;

class MedHistoryGetAction extends GetActionBase
{
    /**
     * @var MedHistory
     */
    protected $model;

    /**
     * Get the model via Dependency Injection and save it as a property.
     *
     * @param MedHistory $model
     */
    public function __construct(MedHistory $model)
    {
        $this->model = $model;
    }
}