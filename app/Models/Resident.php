<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ApplyModelColumnAttribute('Id', 'int', null, ['PK', 'NN', 'AI'])]
#[ApplyModelColumnAttribute('UserId', 'int', null, ['NN', 'CE'])]
#[ApplyModelColumnAttribute('LastName', 'string', null, ['NN'])]
#[ApplyModelColumnAttribute('FirstName', 'string', null, ['NN'])]
#[ApplyModelColumnAttribute('Nickname', 'string')]
#[ApplyModelColumnAttribute('DOB_YEAR', 'int')]
#[ApplyModelColumnAttribute('DOB_MONTH', 'int')]
#[ApplyModelColumnAttribute('DOB_DAY', 'int')]
#[ApplyModelColumnAttribute('Notes', 'string')]
#[ApplyModelColumnAttribute('HMIS', 'int', null)]
#[ApplyModelColumnAttribute('EnrollmentId', 'int', null)]
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
 * @property integer $DOB_DAY       // Client's birthday
 * @property ?string $Notes         // Details about the client
 * @property ?integer $HMIS         // HMIS number
 * @property ?integer $EnrollmentId // EnrollmentId in HMIS for services
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 * @mixin SoftDeletes
 */
class Resident extends ModelBase
{
    protected $table = 'Resident';

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

    /**
     * Override HMIS to null if empty string
     * @param string|null $value
     */
    final public function setHMISAttribute(?string $value): void {
        if (empty($value)) {
            $this->attributes['HMIS'] = null;
        } else {
            $this->attributes['HMIS'] = (int)$value;
        }
    }

    /**
     * Override EnrollmentId to null if empty string
     * @param string|null $value
     */
    final public function setEnrollmentIdAttribute(?string $value): void {
        if (empty($value)) {
            $this->attributes['EnrollmentId'] = null;
        } else {
            $this->attributes['EnrollmentId'] = (int)$value;
        }
    }
}
