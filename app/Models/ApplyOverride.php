<?php
declare(strict_types=1);

namespace Willow\Models;

use Attribute;

#[Attribute(Attribute::TARGET_ALL|Attribute::IS_REPEATABLE)]
class ApplyOverride
{
    public function __construct(string $comment) {
    }
}
