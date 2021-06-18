<?php
declare(strict_types=1);

namespace Willow\Controllers\PillboxItem;

use Willow\Controllers\GetActionBase;
use Willow\Models\ModelBase;
use Willow\Models\Pillbox;

class PillboxItemGetAction extends GetActionBase
{
    /**
     * Get the model via Dependency Injection and save it as a property.
     * @param ModelBase|Pillbox $model
     */
    public function __construct(Protected ModelBase|Pillbox $model) {
    }
}
