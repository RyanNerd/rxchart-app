<?php
declare(strict_types=1);

namespace Willow\Controllers\PillboxItem;

use Willow\Controllers\SearchValidatorBase;
use Willow\Models\PillboxItem;

class PillboxItemSearchValidator extends SearchValidatorBase
{
    /**
     * PillboxItemSearchValidator constructor.
     * @param PillboxItem $model
     */
    public function __construct(PillboxItem $model) {
        $this->model = $model;
    }
}
