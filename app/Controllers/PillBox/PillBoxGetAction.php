<?php
declare(strict_types=1);

namespace Willow\Controllers\PillBox;

use Willow\Controllers\GetActionBase;
use Willow\Models\PillBox;

class PillBoxGetAction extends GetActionBase
{
    /**
     * @var PillBox
     */
    protected $model;

    /**
     * Get the model via Dependency Injection and save it as a property.
     *
     * @param PillBox $model
     */
    public function __construct(PillBox $model)
    {
        $this->model = $model;
    }
}