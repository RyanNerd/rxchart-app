<?php
declare(strict_types=1);

namespace Willow\Controllers\Pillbox;

use Willow\Controllers\DeleteActionBase;
use Willow\Models\Pillbox;

class PillboxDeleteAction extends DeleteActionBase
{
    /**
     * PillboxDeleteAction constructor.
     * @param Pillbox $model
     */
    public function __construct(Pillbox $model) {
        $this->model = $model;
    }
}
