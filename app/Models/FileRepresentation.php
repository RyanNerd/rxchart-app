<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;

class FileRepresentation
{
    public int $Id;                     // Primary Key
    public int $ResidentId;             // Resident FK
    public int $UserId;                 // User FK
    public string $FileName;            // The file name from upload
    public string|null $MediaType;      // The mime type
    public int|null $Size;              // Size of the file in bytes
    public string|null $Description;    // Description of the file
    public string|null $Image;          // The file image (content) as a blob
    public DateTime $Created;
    public DateTime $Updated;
    public DateTime $deleted_at;
}
