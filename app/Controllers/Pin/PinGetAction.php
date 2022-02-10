<?php
declare(strict_types=1);

namespace Willow\Controllers\Pin;

use Willow\Controllers\GetActionBase;
use Willow\Models\Pin;

class PinGetAction extends GetActionBase
{
    /**
     * PinGetAction constructor.
     * @param Pin $model
     */
    public function __construct(Pin $model) {
        $this->model = $model;
    }
}
