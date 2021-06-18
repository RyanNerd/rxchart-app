<?php
declare(strict_types=1);

namespace Willow\Controllers\Pillbox;

use Willow\Controllers\SearchActionBase;
use Willow\Models\Pillbox;

class PillboxSearchAction extends SearchActionBase
{
    /**
     * PillboxSearchAction constructor.
     * @param Pillbox $model
     */
    public function __construct(Pillbox $model) {
        $this->model = $model;
    }
}
