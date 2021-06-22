<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;

#[ApplyModelColumnAttribute('Id', 'int', null, ['PK', 'NN', 'AI'])]
#[ApplyModelColumnAttribute('Organization', 'string', 100, ['NN'])]
#[ApplyModelColumnAttribute('UserName', 'string', 30, ['NN'])]
#[ApplyModelColumnAttribute('PasswordHash', 'string', 300, ['NN', 'HIDDEN'])]
#[ApplyModelColumnAttribute('API_KEY', 'string', 100, ['NN'])]
#[ApplyModelColumnAttribute('Created', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('Updated', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('deleted_at', 'DateTime', null, ['CE'], 'NULL')]
/**
 * @property integer $Id            // Primary Key
 * @property string $Organization   // Organization name
 * @property string $UserName       // Username
 * @property string $PasswordHash   // The super secret password hash
 * @property string $API_KEY        // The API key
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 */
class User extends ModelBase
{
    protected $hidden = ['PasswordHash'];

    protected $table = 'User';
}
