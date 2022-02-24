<?php
declare(strict_types=1);

namespace Willow\Controllers\Document;

use Willow\Controllers\GetActionBase;
use Willow\Models\Document;

class DocumentGetAction extends GetActionBase
{
    /**
     * DocumentGetAction constructor.
     * @param Document $model
     */
    public function __construct(Document $model) {
        $this->model = $model;
    }
}
