<?php
declare(strict_types=1);

namespace Willow\Controllers\Pillbox;

use Willow\Controllers\GetActionBase;
use Willow\Models\Pillbox;

class PillboxGetAction extends GetActionBase
{
    /**
     * PillboxGetAction constructor.
     * @param Pillbox $model
     */
    public function __construct(Pillbox $model) {
        $this->model = $model;
    }
}
