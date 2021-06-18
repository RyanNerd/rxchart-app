<?php
declare(strict_types=1);

namespace Willow\Controllers\Pillbox;

use Willow\Controllers\SearchValidatorBase;
use Willow\Models\ModelBase;
use Willow\Models\Pillbox;

class PillboxSearchValidator extends SearchValidatorBase
{
    /**
     * PillboxSearchValidator constructor.
     * @param ModelBase|Pillbox $model
     */
    public function __construct(protected ModelBase|Pillbox $model) {
    }
}
