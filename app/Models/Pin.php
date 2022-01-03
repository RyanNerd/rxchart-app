<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;

#[ApplyModelRule(ModelDefaultRules::class)]
#[ApplyModelColumnAttribute('Id', 'int', null, ['PK', 'NN', 'AI'])] // Medicine PK
#[ApplyModelColumnAttribute('ResidentId', 'int', null)]             // Resident FK
#[ApplyModelColumnAttribute('UserId', 'int', null, ['NN','CE'])]    // User FK
#[ApplyModelColumnAttribute('PinValue', 'string', 6)]               // The generated PIN
#[ApplyModelColumnAttribute('Image', 'string', 6000)]               // Image as a blob
#[ApplyModelColumnAttribute('Created', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('Updated', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('deleted_at', 'DateTime', null, ['CE'], 'NULL')]
/**
 * @property integer  $Id           // Pin PK
 * @property integer  $ResidentId   // Resident FK
 * @property integer  $UserId       // User FK
 * @property string   $PinValue     // Generated pin value
 * @property string   $Image        // The image string (e.g. data:image/png;base64
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 */
class Pin extends ModelBase
{
    protected $table = 'Pin';
}
