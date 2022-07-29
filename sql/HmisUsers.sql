CREATE TABLE `HmisUsers` (
    `Id` int NOT NULL AUTO_INCREMENT,
    `UserId` int NOT NULL,
    `HmisUserName` varchar(45) NOT NULL,
    `HmisUserId` varchar(6) NOT NULL,
    `Created` timestamp NULL DEFAULT NULL,
    `Updated` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`Id`),
    KEY `fk_HmisUsers_User` (`UserId`),
    CONSTRAINT `fk_HmisUsers_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
