<?php
declare(strict_types=1);

namespace Willow\Controllers\Pillbox;

use Willow\Controllers\DeleteActionBase;
use Willow\Models\ModelBase;
use Willow\Models\Pillbox;

class PillboxDeleteAction extends DeleteActionBase
{
    protected ModelBase|Pillbox $model;

    /**
     * Get the model via Dependency Injection and save it.
     * @param Pillbox $model
     */
    public function __construct(Pillbox $model) {
        $this->model = $model;
    }
}
