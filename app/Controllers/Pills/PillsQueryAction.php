<?php
declare(strict_types=1);

namespace Willow\Controllers\Pills;

use Willow\Controllers\QueryActionBase;
use Willow\Models\Pills;

class PillsQueryAction extends QueryActionBase
{
    /**
     * @var Pills
     */
    protected $model;

    /**
     * Get the model via Dependency Injection and save it as a property.
     *
     * @param Pills $model
     */
    public function __construct(Pills $model)
    {
        $this->model = $model;
    }
}