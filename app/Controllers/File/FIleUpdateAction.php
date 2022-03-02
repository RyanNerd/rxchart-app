<?php
declare(strict_types=1);

namespace Willow\Controllers\File;

use Willow\Controllers\WriteActionBase;
use Willow\Models\File;

class FIleUpdateAction extends WriteActionBase
{
    /**
     * FIleUpdateAction constructor.
     * @param File $model
     */
    public function __construct(File $model) {
        $this->model = $model;
    }
}
