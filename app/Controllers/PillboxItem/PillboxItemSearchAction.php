<?php
declare(strict_types=1);

namespace Willow\Controllers\PillboxItem;

use Willow\Controllers\SearchActionBase;
use Willow\Models\ModelBase;
use Willow\Models\Pillbox;


class PillboxItemSearchAction extends SearchActionBase
{
    /**
     * PillboxItemSearchAction constructor.
     * @param ModelBase|Pillbox $model
     */
    public function __construct(protected ModelBase|Pillbox $model) {
    }
}
