<?php
declare(strict_types=1);

namespace Willow\Models;

use DateTime;

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
 */
class ClientRepresentation {
    public int $Id;                 // PK
    public int $UserId;             // User FK
    public string $LastName;        // Client's last name
    public string $FirstName;       // Client's first name
    public string $Nickname;        // Client's nickname
    public int $DOB_YEAR;           // Client's birth year
    public int $DOB_MONTH;          // Client's birth month
    public int $DOB_DAY;            // Client's birthday
    public ?string $Notes;          // Details about the client
    public ?int $HMIS;              // HMIS number
    public ?int $EnrollmentId;      // EnrollmentId in HMIS for services
    public DateTime $Created;
    public DateTime $Updated;
    public DateTime $deleted_at;
}
