<?php
declare(strict_types=1);

namespace Willow\Controllers\Document;

use Willow\Controllers\WriteActionBase;
use Willow\Models\Document;

class DocumentUpdateAction extends WriteActionBase
{
    /**
     * DocumentUpdateAction constructor.
     * @param Document $model
     */
    public function __construct(Document $model) {
        $this->model = $model;
    }
}
