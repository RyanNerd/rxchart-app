<?php
declare(strict_types=1);

namespace Willow\Controllers\PillboxItem;

use Willow\Controllers\DeleteActionBase;
use Willow\Models\PillboxItem;

class PillboxItemDeleteAction extends DeleteActionBase
{
    /**
     * PillboxItemDeleteAction constructor.
     * @param PillboxItem $model
     */
    public function __construct(PillboxItem $model) {
        $this->model = $model;
    }
}
