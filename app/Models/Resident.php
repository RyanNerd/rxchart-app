<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property integer $Id
 * @property string $LastName
 * @property string $FirstName
 * @property integer $DOB_YEAR
 * @property integer $DOB_MONTH
 * @property integer $DOB_DAY
 * @property string $Notes
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 *
 * @mixin Builder
 */
class Resident extends ModelBase
{
    public const FIELDS = [
        'Id' => 'integer',
        'UserId' => 'integer',
        'LastName' => 'string',
        'FirstName' => 'string',
        'DOB_YEAR' => 'integer',
        'DOB_MONTH' => 'tinyint',
        'DOB_DAY' => 'tinyint',
        'Notes' => 'string',
        'Created' => 'datetime',
        'Updated' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    protected $table = 'Resident';

    public bool $allowAll = true;

    /**
     * Override Notes to null if empty string
     * @param string|null $value
     */
    public function setNotesAttribute(?string $value)
    {
        if (empty($value)) {
            $this->attributes['Notes'] = null;
        } else {
            $this->attributes['Notes'] = $value;
        }
    }
}
