<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;

class PinRepresentation
{
    public int $Id;                 // Primary Keypublic string $ResidentId;
    public int $ResidentId;         // Resident FK
    public string $UserId;          // User FK
    public string $PinValue;        // The six character pin value
    public string $Image;           // The image string (e.g. "data:image/png;base64...")
    public DateTime $Created;
    public DateTime $Updated;
    public DateTime $deleted_at;
}
