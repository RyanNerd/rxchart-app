CREATE TABLE `Pin` (
    `Id` int NOT NULL AUTO_INCREMENT,
    `ResidentId` int NOT NULL,
    `UserId` int NOT NULL,
    `PinValue` char(6) NOT NULL,
    `Image` longblob,
    `Created` timestamp NULL DEFAULT NULL,
    `Updated` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`Id`),
    KEY `fk_Pin_User` (`UserId`),
    KEY `fk_Pin_Resident` (`ResidentId`),
    CONSTRAINT `fk_Pin_Resident` FOREIGN KEY (`ResidentId`) REFERENCES `Resident` (`Id`),
    CONSTRAINT `fk_Pin_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
