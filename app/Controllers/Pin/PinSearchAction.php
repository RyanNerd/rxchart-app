<?php
declare(strict_types=1);

namespace Willow\Controllers\Pin;

use Willow\Controllers\SearchActionBase;
use Willow\Models\Pin;

class PinSearchAction extends SearchActionBase
{
    /**
     * @param Pin $model
     */
    public function __construct(Pin $model) {
        $this->model = $model;
    }
}
