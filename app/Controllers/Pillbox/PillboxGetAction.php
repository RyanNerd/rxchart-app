<?php
declare(strict_types=1);

namespace Willow\Controllers\Pillbox;

use Willow\Controllers\GetActionBase;
use Willow\Models\ModelBase;
use Willow\Models\Pillbox;

class PillboxGetAction extends GetActionBase
{
    /**
     * Get the model via Dependency Injection and save it as a property.
     * @param Pillbox $model
     */
    public function __construct(Protected Pillbox $model) {
    }
}
