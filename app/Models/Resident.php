<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;

#[ApplyModelColumnAttribute('Id', 'int', null, ['PK', 'NN', 'AI'])]
#[ApplyModelColumnAttribute('UserId', 'int', null, ['NN', 'CE'])]
#[ApplyModelColumnAttribute('LastName', 'string', null, ['NN'])]
#[ApplyModelColumnAttribute('FirstName', 'string', null, ['NN'])]
#[ApplyModelColumnAttribute('Nickname', 'string')]
#[ApplyModelColumnAttribute('DOB_YEAR', 'int')]
#[ApplyModelColumnAttribute('DOB_MONTH', 'int')]
#[ApplyModelColumnAttribute('DOB_DAY', 'int')]
#[ApplyModelColumnAttribute('Notes', 'string')]
#[ApplyModelColumnAttribute('Created', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('Updated', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('deleted_at', 'DateTime', null, ['CE'], 'NULL')]
/**
 * @property integer $Id            // PK
 * @property integer $UserId        // User FK
 * @property string $LastName       // Client's last name
 * @property string $FirstName      // Client's first name
 * @property string $Nickname       // Client's nickname
 * @property integer $DOB_YEAR      // Client's birth year
 * @property integer $DOB_MONTH     // Client's birth month
 * @property integer $DOB_DAY       // Client's birth day
 * @property string $Notes          // Details about the client
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 */
class Resident extends ModelBase
{
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
