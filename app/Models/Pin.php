<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;

#[ApplyModelRule(ModelDefaultRules::class)]
#[ApplyModelColumnAttribute('Id', 'int', null, ['PK', 'NN', 'AI'])] // Medicine PK
#[ApplyModelColumnAttribute('ResidentId', 'int', null)]             // Resident FK
#[ApplyModelColumnAttribute('UserId', 'int', null, ['NN','CE'])]    // User FK
#[ApplyModelColumnAttribute('PinValue', 'string', 6)]               // The generated PIN
#[ApplyModelColumnAttribute('Image', 'string', null)]               // Image as a blob
#[ApplyModelColumnAttribute('Created', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('Updated', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('deleted_at', 'DateTime', null, ['CE'], 'NULL')]
/**
 * @property integer $Id            // Primary Key
 * @property string $ResidentId     // Resident FK
 * @property string $UserId         // User FK       // Username
 * @property string $PinValue       // The six character pin value
 * @property string $Image          // The image string (e.g. "data:image/png;base64...")
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 */
class Pin extends ModelBase
{
    protected $table = 'Pin';
}
