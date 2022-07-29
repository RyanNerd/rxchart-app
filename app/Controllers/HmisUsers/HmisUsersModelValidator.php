<?php
declare(strict_types=1);

namespace Willow\Controllers\HmisUsers;

use Willow\Controllers\ModelValidatorBase;
use Willow\Models\HmisUsers;

class HmisUsersModelValidator extends ModelValidatorBase
{
    protected string $modelClass = HmisUsers::class;
}
