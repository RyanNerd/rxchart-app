<?php
declare(strict_types=1);

namespace Willow\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property integer $Id
 * @property string $SubDomain
 * @property string $PasswordHash
 * @property string $API_KEY
 * @property \DateTime $Created
 * @property \DateTime $Updated
 * @property \DateTime $deleted_at
 *
 * @mixin Builder
 */
class User extends ModelBase
{
    public const FIELDS = [
        'Id' => 'integer',
        'SubDomain' => 'string',
        'PasswordHash' => '*string',
        'API_KEY' => 'string',
        'Created' => 'datetime',
        'Updated' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    protected $table = 'User';
}
