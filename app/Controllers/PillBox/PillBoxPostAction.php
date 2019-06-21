<?php
declare(strict_types=1);

namespace Willow\Controllers\PillBox;

use Willow\Controllers\WriteActionBase;
use Willow\Models\PillBox;

class PillBoxPostAction extends WriteActionBase
{
    /**
     * @var PillBox
     */
    protected $model;

    public function __construct(PillBox $model)
    {
        $this->model = $model;
    }
}
