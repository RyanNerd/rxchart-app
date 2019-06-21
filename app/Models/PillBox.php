<?php
declare(strict_types=1);

namespace Willow\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property integer $Id
 * @property integer $ResidentId
 * @property string $BoxName
 *
 * @mixin Builder
 */
class PillBox extends ModelBase
{
    public const FIELDS = [
        'Id' => 'integer',
        'ResidentId' => 'integer',
        'BoxName' => 'string',

    ];

    protected $table = 'PillBox';
}
