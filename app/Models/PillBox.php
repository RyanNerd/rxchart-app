<?php
declare(strict_types=1);

namespace Willow\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property string $BoxName
 * @property integer $Id
 * @property integer $ResidentId
 *
 * @mixin Builder
 */
class PillBox extends ModelBase
{
    public const FIELDS = [
        'BoxName' => 'string',
        'Id' => 'integer',
        'ResidentId' => 'integer',

    ];

    protected $table = 'PillBox';
}
