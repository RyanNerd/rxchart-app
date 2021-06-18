<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;

/**
 * @property integer $Id
 * @property integer $UserId
 * @property string $LastName
 * @property string $FirstName
 * @property string $Nickname
 * @property integer $DOB_YEAR
 * @property integer $DOB_MONTH
 * @property integer $DOB_DAY
 * @property string $Notes
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 */
class Resident extends ModelBase
{
    /**
     * {@inheritdoc}
     */
    public const FIELDS = [
        'Id' => 'integer',
        'UserId' => 'integer',
        'LastName' => 'string',
        'FirstName' => 'string',
        'Nickname' => 'string',
        'DOB_YEAR' => 'integer',
        'DOB_MONTH' => 'tinyint',
        'DOB_DAY' => 'tinyint',
        'Notes' => 'string',
        'Created' => 'datetime',
        'Updated' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    protected $table = 'Resident';

    /**
     * {@inheritdoc}
     */
    public bool $allowAll = true;

    /**
     * Override Notes to null if empty string
     * @param string|null $value
     */
    final public function setNotesAttribute(?string $value): void {
        if (empty($value)) {
            $this->attributes['Notes'] = null;
        } else {
            $this->attributes['Notes'] = $value;
        }
    }

    /**
     * Override Nickname to null if empty string
     * @param string|null $value
     */
    final public function setNicknameAttribute(?string $value): void {
        if (empty($value)) {
            $this->attributes['Nickname'] = null;
        } else {
            $this->attributes['Nickname'] = $value;
        }
    }
}
