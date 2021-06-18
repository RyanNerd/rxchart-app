<?php
declare(strict_types=1);

namespace Willow\Controllers\PillboxItem;

use Willow\Controllers\DeleteActionBase;
use Willow\Models\ModelBase;
use Willow\Models\PillboxItem;

class PillboxItemDeleteAction extends DeleteActionBase
{
    protected ModelBase|PillboxItem $model;

    /**
     * Get the model via Dependency Injection and save it.
     * @param ModelBase|PillboxItem $model
     */
    public function __construct(PillboxItem $model) {
        $this->model = $model;
    }
}
