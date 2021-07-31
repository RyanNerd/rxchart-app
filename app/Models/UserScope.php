<?php
declare(strict_types=1);

namespace Willow\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class UserScope implements Scope
{
    private static ?int $userId = null;

    /**
     * Apply the userId filter to all models except the User model
     * @param  Builder  $builder
     * @param  Model  $model
     * @return void
     */
    final public function apply(Builder $builder, Model $model): void {
        if (self::$userId !== null && $model->getTable() !== 'User') {
            $builder->where('UserId', '=', static::$userId);
        }
    }

    /**
     * Set the userId
     * @param int $userId
     */
    final public static function setUserId(int $userId): void {
        self::$userId = $userId;
    }

    final public static function getUserId(): ?int {
        return self::$userId;
    }
}
