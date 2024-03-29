<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;

#[ApplyModelRule(ModelDefaultRules::class)]
#[ApplyModelColumnAttribute('Id', 'int', null, ['PK', 'NN', 'AI'])] // Medicine PK
#[ApplyModelColumnAttribute('ResidentId', 'int', null)]             // Resident FK
#[ApplyModelColumnAttribute('UserId', 'int', null, ['NN','CE'])]    // User FK
#[ApplyModelColumnAttribute('FileName', 'string', 65, ['NN'])]      // The file name including extention
#[ApplyModelColumnAttribute('MediaType', 'string', 65)]             // The mime type
#[ApplyModelColumnAttribute('Size', 'int', null)]                   // The size of the file in bytes
#[ApplyModelColumnAttribute('Description', 'string', 65)]           // A description of the file
#[ApplyModelColumnAttribute('Image', 'string', null, ['HIDDEN'])]   // File image as a blob
#[ApplyModelColumnAttribute('Created', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('Updated', 'DateTime', null, ['CE'], 'NULL')]
#[ApplyModelColumnAttribute('deleted_at', 'DateTime', null, ['CE'], 'NULL')]
/**
 * @property int $Id            // Primary Key
 * @property int $ResidentId     // Resident FK
 * @property int $UserId         // User FK
 * @property string $FileName       // The file name including the extention
 * @property string $MediaType      // The mime type
 * @property int $Size          // Size of the file in bytes
 * @property string $Description    // A description of the file
 * @property string $Image          // File image as a blob
 * @property DateTime $Created
 * @property DateTime $Updated
 * @property DateTime $deleted_at
 */
class File extends ModelBase
{
    protected $hidden = ['Image'];

    protected $table = 'File';

    /**
     * Override Description field to null if empty string
     * @param string|null $value
     */
    final public function setDescriptionAttribute(?string $value): void {
        if (empty($value)) {
            $this->attributes['Description'] = null;
        } else {
            $this->attributes['Description'] = $value;
        }
    }
}

