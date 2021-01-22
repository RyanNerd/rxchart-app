<?php
declare(strict_types=1);

namespace Willow\Controllers\MedHistory;

use Willow\Controllers\GetActionBase;
use Willow\Models\MedHistory;
use Willow\Models\ModelBase;

class MedHistoryGetAction extends GetActionBase
{
    /** @var ModelBase|MedHistory  */
    protected ModelBase $model;

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
