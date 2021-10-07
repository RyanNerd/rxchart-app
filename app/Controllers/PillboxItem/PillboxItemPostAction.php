<?php
declare(strict_types=1);

namespace Willow\Controllers\PillboxItem;

use Willow\Controllers\WriteActionBase;
use Willow\Models\PillboxItem;

class PillboxItemPostAction extends WriteActionBase
{
    /**
     * @param PillboxItem $model
     */
    public function __construct(PillboxItem $model) {
        $this->model = $model;
    }
}
