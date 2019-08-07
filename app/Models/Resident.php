<?php
declare(strict_types=1);

namespace Willow\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property integer $Id
 * @property string $LastName
 * @property string $FirstName
 * @property integer $DOB_YEAR
 * @property boolean $DOB_MONTH
 * @property boolean $DOB_DAY
 * @property boolean $Status
 * @property \DateTime $Created
 * @property \DateTime $Updated
 *
 * @mixin Builder
 */
class Resident extends ModelBase
{
    public const FIELDS = [
        'Id' => 'integer',
        'LastName' => 'string',
        'FirstName' => 'string',
        'DOB_YEAR' => 'integer',
        'DOB_MONTH' => 'boolean',
        'DOB_DAY' => 'boolean',
        'Status' => 'boolean',
        'Created' => 'datetime',
        'Updated' => 'datetime',
    ];

    protected $table = 'Resident';
}
