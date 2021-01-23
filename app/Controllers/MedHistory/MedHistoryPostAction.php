<?php
declare(strict_types=1);

namespace Willow\Controllers\MedHistory;

use Willow\Controllers\WriteActionBase;
use Willow\Models\MedHistory;
use Willow\Models\ModelBase;

class MedHistoryPostAction extends WriteActionBase
{
    protected ModelBase|MedHistory $model;

    public function __construct(MedHistory $model)
    {
        $this->model = $model;
    }
}
