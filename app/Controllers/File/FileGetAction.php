<?php
declare(strict_types=1);

namespace Willow\Controllers\File;

use Willow\Controllers\GetActionBase;
use Willow\Models\File;

class FileGetAction extends GetActionBase
{
    /**
     * FileGetAction constructor.
     * @param File $model
     */
    public function __construct(File $model) {
        $this->model = $model;
    }
}
