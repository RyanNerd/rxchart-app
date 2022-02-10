<?php
declare(strict_types=1);

namespace Willow\Controllers\Pin;

use Willow\Controllers\SearchValidatorBase;
use Willow\Models\Pin;

class PinSearchValidator extends SearchValidatorBase
{
    /**
     * PinSearchValidator constructor.
     * @param Pin $model
     */
    public function __construct(Pin $model) {
        $this->model = $model;
    }
}
