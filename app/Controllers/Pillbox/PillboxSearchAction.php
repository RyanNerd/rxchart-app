<?php
declare(strict_types=1);

namespace Willow\Controllers\Pillbox;

use Willow\Controllers\SearchActionBase;
use Willow\Models\ModelBase;
use Willow\Models\Pillbox;


class PillboxSearchAction extends SearchActionBase
{
    /**
     * PillboxItemSearchAction constructor.
     * @param ModelBase|Pillbox $model
     */
    public function __construct(protected ModelBase|Pillbox $model) {
    }
}
