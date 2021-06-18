<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property integer $Id
 * @property string $Organization
 * @property string $UserName
 * @property string $PasswordHash
 * @property string $API_KEY
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 *
 * @mixin Builder
 */
class User extends ModelBase
{
    /**
     * {@inheritdoc}
     */
    public const FIELDS = [
        'Id' => 'integer',
        'Organization' => 'string',
        'UserName' => 'string',
        'PasswordHash' => '*string',
        'API_KEY' => 'string',
        'Created' => 'datetime',
        'Updated' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    protected $hidden = ['PasswordHash'];

    protected $table = 'User';
}
