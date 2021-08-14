<?php
declare(strict_types=1);

namespace Willow\Controllers\PillboxItem;

use Willow\Controllers\GetActionBase;
use Willow\Models\PillboxItem;

class PillboxItemGetAction extends GetActionBase
{
    /**
     * @param PillboxItem $model
     */
    public function __construct(PillboxItem $model) {
        $this->model = $model;
    }
}
