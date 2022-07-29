<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;

#[ApplyModelRule(ModelDefaultRules::class)]
#[ApplyModelColumnAttribute('Id', 'int', null, ['PK', 'NN', 'AI'])] // Medicine PK
#[ApplyModelColumnAttribute('UserId', 'int', null, ['NN','CE'])]    // User FK
#[ApplyModelColumnAttribute('HmisUserName', 'string', 45)]          // The user's name in HMIS
#[ApplyModelColumnAttribute('HmisUserId', 'string', 6)]             // The userId in HMIS
#[ApplyModelColumnAttribute('Created', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('Updated', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('deleted_at', 'DateTime', null, ['CE'], 'NULL')]
/**
 * @property integer $Id            // Primary Key
 * @property string $UserId         // User FK
 * @property string $HmisUserName   // The HMIS user's name
 * @property string $HmisUserId     // The userId in HMIS
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 */
class HmisUsers extends ModelBase
{
    protected $table = 'HmisUsers';
}
