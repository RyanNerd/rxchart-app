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
 * @mixin SoftDeletes
 * @property int $UserId
 */
abstract class ModelBase extends Model
{
    use SoftDeletes;

    /**
     * Array containing white list of fields for the model.
     */
    public const FIELDS = [];

    // Override the created_at and updated_at column names
    public const UPDATED_AT = 'Updated';
    public const CREATED_AT = 'Created';

    // Override the primary key name
    protected $primaryKey = 'Id';

    /**
     * Set to true if the search action is allowed to NOT have any where type clauses Where, WhereBetween, etc.
     *
     * @var bool
     */
    public bool $allowAll = false;

    /*
     * Return the name of the table for this model
     *
     * @return @string;
     */
    final public function getTableName(): string {
        return $this->table;
    }
}
