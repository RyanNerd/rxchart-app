CREATE TABLE `Document` (
    `Id` int NOT NULL AUTO_INCREMENT,
    `ResidentId` int NOT NULL,
    `UserId` int NOT NULL,
    `FileName` varchar(65) NOT NULL,
    `MediaType` varchar(65) NULL DEFAULT NULL,
    `Size` int NULL DEFAULT NULL,
    `Description` varchar(100) NULL DEFAULT NULL,
    `Image` longblob,
    `Created` timestamp NULL DEFAULT NULL,
    `Updated` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`Id`),
    KEY `fk_Document_User` (`UserId`),
    KEY `fk_Document_Resident` (`ResidentId`),
    CONSTRAINT `fk_Document_Resident` FOREIGN KEY (`ResidentId`) REFERENCES `Resident` (`Id`),
    CONSTRAINT `fk_Document_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
