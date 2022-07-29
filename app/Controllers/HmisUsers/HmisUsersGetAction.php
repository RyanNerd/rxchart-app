<?php
declare(strict_types=1);

namespace Willow\Controllers\HmisUsers;

use Willow\Controllers\GetActionBase;
use Willow\Models\HmisUsers;

class HmisUsersGetAction extends GetActionBase
{
    /**
     * HmisUsersGetAction constructor.
     * @param HmisUsers $model
     */
    public function __construct(HmisUsers $model) {
        $this->model = $model;
    }
}
