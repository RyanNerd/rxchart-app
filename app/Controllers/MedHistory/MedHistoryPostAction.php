<?php
declare(strict_types=1);

namespace Willow\Controllers\MedHistory;

use Willow\Controllers\WriteActionBase;
use Willow\Models\MedHistory;

class MedHistoryPostAction extends WriteActionBase
{
    /**
     * @var MedHistory
     */
    protected $model;

    public function __construct(MedHistory $model)
    {
        $this->model = $model;
    }
}
