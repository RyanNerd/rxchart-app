<?php
declare(strict_types=1);

namespace Willow\Controllers\PillBox;

use Willow\Controllers\QueryActionBase;
use Willow\Models\PillBox;

class PillBoxQueryAction extends QueryActionBase
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