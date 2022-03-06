<?php
declare(strict_types=1);

namespace Willow\Controllers\File;

use Willow\Controllers\DeleteActionBase;
use Willow\Models\File;

class FileDeleteAction extends DeleteActionBase
{
    /**
     * FileDeleteAction constructor
     * @param File $model
     */
    public function __construct(File $model) {
        $this->model = $model;
    }
}
