<?php
declare(strict_types=1);

namespace Willow\Models;

use Attribute;

#[Attribute(Attribute::IS_REPEATABLE|Attribute::TARGET_CLASS)]
class ApplyModelColumnAttribute
{
    private const VALID_FLAGS = [
        'PK',
        'NN',
        'UQ',
        'BIN',
        'UN',
        'ZF',
        'AI',
        'G',
        null
    ];

    /**
     * ApplyModelColumnAttribute constructor.
     * @param string $columnName
     * @param string $datatype
     * @param int|null $length
     * @param bool[]|null $flags
     * @param string|null $default
     */
    public function __construct(
        private string $columnName,
        private string $datatype,
        private ?int $length = null,
        private ?array $flags = null,
        private ?string $default = null
    ) {
        assert(in_array($this->flags, self::VALID_FLAGS), 'Invalid ModelColumnAttribute.flags');
    }

    final public function getModelColumnAttribute(): array {
        return [
            'ColumnName' => $this->columnName,
            'Type' => $this->datatype,
            'Length' => $this->length,
            'Flags' => $this->flags,
            'Default' => $this->default
        ];
    }
}
