<?php
declare(strict_types=1);

namespace Willow\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ModelBase
 *
 * @mixin Builder
 */
abstract class ModelBase extends Model
{
    use SoftDeletes;

    public const FIELDS = [];

    // Override the created_at and updated_at column names
    const UPDATED_AT = 'Updated';
    const CREATED_AT = 'Created';

    // Override the primary key name
    protected $primaryKey = 'Id';

    /**
     * Return the name of the primary key column (usually but not always "id")
     *
     * @return string
     */
    public function getPrimaryKey(): string
    {
        return $this->primaryKey;
    }

    public function getTableName(): string
    {
        return $this->table;
    }
}