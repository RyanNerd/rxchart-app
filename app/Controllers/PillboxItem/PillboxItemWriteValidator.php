<?php
declare(strict_types=1);

namespace Willow\Controllers\PillboxItem;

use Willow\Controllers\WriteValidatorBase;
use Willow\Models\PillboxItem;

class PillboxItemWriteValidator extends WriteValidatorBase
{
    /**
     * @inheritdoc
     */
    protected const MODEL_FIELDS = PillboxItem::FIELDS;
}
