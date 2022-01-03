<?php
declare(strict_types=1);

namespace Willow\Controllers\Pin;

use Willow\Controllers\DeleteActionBase;
use Willow\Models\Pin;

class PinDeleteAction extends DeleteActionBase
{
    /**
     * PinDeleteAction constructor.
     * @param Pin $model
     */
    public function __construct(Pin $model) {
        $this->model = $model;
    }
}
