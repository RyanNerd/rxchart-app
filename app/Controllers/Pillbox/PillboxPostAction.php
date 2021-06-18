<?php
declare(strict_types=1);

namespace Willow\Controllers\Pillbox;

use Willow\Controllers\WriteActionBase;
use Willow\Models\Pillbox;

class PillboxPostAction extends WriteActionBase
{
    /**
     * PillboxPostAction constructor.
     * @param Pillbox $model
     */
    public function __construct(Pillbox $model) {
        $this->model = $model;
    }
}
