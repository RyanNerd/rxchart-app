<?php
declare(strict_types=1);

namespace Willow\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property \DateTime $Created
 * @property boolean $DOB_DAY
 * @property boolean $DOB_MONTH
 * @property integer $DOB_YEAR
 * @property string $FirstName
 * @property integer $Id
 * @property string $LastName
 * @property boolean $Status
 * @property \DateTime $Updated
 *
 * @mixin Builder
 */
class Resident extends ModelBase
{
    public const FIELDS = [
        'Created' => 'datetime',
        'DOB_DAY' => 'boolean',
        'DOB_MONTH' => 'boolean',
        'DOB_YEAR' => 'integer',
        'FirstName' => 'string',
        'Id' => 'integer',
        'LastName' => 'string',
        'Status' => 'boolean',
        'Updated' => 'datetime',

    ];

    protected $table = 'Resident';
}
