CREATE TABLE `Service` (
    `Id` int NOT NULL AUTO_INCREMENT,
    `UserId` int NOT NULL,
    `HmisId` varchar(15) DEFAULT NULL,
    `ServiceName` varchar(100) NOT NULL,
    `AllowMultiple` tinyint NOT NULL DEFAULT '0',
    `Created` timestamp NULL DEFAULT NULL,
    `Updated` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`Id`),
    KEY `fk_Service_User` (`UserId`),
    CONSTRAINT `fk_Service_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
