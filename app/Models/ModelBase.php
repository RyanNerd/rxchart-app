<?php
declare(strict_types=1);

namespace Willow\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

/**
 * Class ModelBase
 * @mixin Builder
 */
abstract class ModelBase extends Model
{
    use SoftDeletes;

    // Override the created_at and updated_at column names
    public const UPDATED_AT = 'Updated';
    public const CREATED_AT = 'Created';

    // Override the primary key name
    protected $primaryKey = 'Id';

    /**
     * Set to true if the search action is allowed to NOT have any where type clauses Where, WhereBetween, etc.
     * @var bool
     */
    public bool $allowAll = false;

    protected static function booted(): void {
        // Scope all models to the authenticated UserId
        static::addGlobalScope(new UserScope());

        // Save the authenticated UserId value to the model
        static::saving(function ($model) {
            $model->UserId = UserScope::getUserId();
        });
    }
}
