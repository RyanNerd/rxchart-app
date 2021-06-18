<?php
declare(strict_types=1);

namespace Willow\Controllers\PillboxItem;

use Willow\Controllers\SearchActionBase;
use Willow\Models\PillboxItem;

class PillboxItemSearchAction extends SearchActionBase
{
    /**
     * PillboxItemSearchAction constructor.
     * @param PillboxItem $model
     */
    public function __construct(PillboxItem $model) {
        $this->model = $model;
    }
}
