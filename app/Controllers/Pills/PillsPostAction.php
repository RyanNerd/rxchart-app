<?php
declare(strict_types=1);

namespace Willow\Controllers\Pills;

use Willow\Controllers\WriteActionBase;
use Willow\Models\Pills;

class PillsPostAction extends WriteActionBase
{
    /**
     * @var Pills
     */
    protected $model;

    public function __construct(Pills $model)
    {
        $this->model = $model;
    }
}
