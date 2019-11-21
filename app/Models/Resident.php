<?php
declare(strict_types=1);

namespace Willow\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property integer $Id
 * @property string $LastName
 * @property string $FirstName
 * @property integer $DOB_YEAR
 * @property integer $DOB_MONTH
 * @property integer $DOB_DAY
 * @property \DateTime $Created
 * @property \DateTime $Updated
 * @property \DateTime $deleted_at
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
        'DOB_MONTH' => 'tinyint',
        'DOB_DAY' => 'tinyint',
        'Created' => 'datetime',
        'Updated' => 'datetime',
        'deleted_at' => 'datetiime'
    ];

    protected $table = 'Resident';

    public $allowAll = true;
}
