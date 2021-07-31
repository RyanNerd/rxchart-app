<?php
declare(strict_types=1);

namespace Willow\Models;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS|Attribute::IS_REPEATABLE)]
class ApplyModelRule
{
    /**
     * ApplyModelRule constructor.
     * @param string $rule
     */
    public function __construct(private string $rule) {
    }

    /**
     * Return the the modelRule
     * @return string
     */
    final public function getModelRule(): string {
        return $this->rule;
    }
}
