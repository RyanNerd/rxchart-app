<?php
declare(strict_types=1);

namespace Willow\Controllers\HmisUsers;

use Willow\Controllers\DeleteActionBase;
use Willow\Models\HmisUsers;

class HmisUsersDeleteAction extends DeleteActionBase
{
    /**
     * HmisUsersDeleteAction constructor.
     * @param HmisUsers $model
     */
    public function __construct(HmisUsers $model) {
        $this->model = $model;
    }
}
