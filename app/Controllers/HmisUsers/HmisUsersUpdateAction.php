<?php
declare(strict_types=1);

namespace Willow\Controllers\HmisUsers;

use Willow\Controllers\WriteActionBase;
use Willow\Models\HmisUsers;

class HmisUsersUpdateAction extends WriteActionBase
{
    /**
     * HmisUsersUpdateAction constructor.
     * @param HmisUsers $model
     */
    public function __construct(HmisUsers $model) {
        $this->model = $model;
    }
}
