<?php
declare(strict_types=1);

namespace Willow\Controllers\PillboxItem;

use Willow\Controllers\SearchValidatorBase;
use Willow\Models\ModelBase;
use Willow\Models\Pillbox;

class PillboxItemSearchValidator extends SearchValidatorBase
{
    /**
     * PillboxSearchValidator constructor.
     * @param ModelBase|Pillbox $model
     */
    public function __construct(protected ModelBase|Pillbox $model) {
    }
}
