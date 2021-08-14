<?php
declare(strict_types=1);

namespace Willow\Controllers\Pillbox;

use Willow\Controllers\SearchValidatorBase;
use Willow\Models\Pillbox;

class PillboxSearchValidator extends SearchValidatorBase
{
    /**
     * PillboxSearchValidator constructor.
     * @param Pillbox $model
     */
    public function __construct(Pillbox $model) {
        $this->model = $model;
    }
}
