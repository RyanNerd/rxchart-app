<?php
declare(strict_types=1);

namespace Willow\Controllers\Pin;

use Willow\Controllers\WriteActionBase;
use Willow\Models\Pin;

class PinUpdateAction extends WriteActionBase
{
    /**
     * PinPostAction constructor.
     * @param Pin $model
     */
    public function __construct(Pin $model) {
        $this->model = $model;
    }
}
