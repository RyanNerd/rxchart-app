CREATE TABLE `File` (
    `Id` int NOT NULL AUTO_INCREMENT,
    `ResidentId` int NOT NULL,
    `UserId` int NOT NULL,
    `FileName` varchar(65) NOT NULL,
    `MediaType` varchar(65) DEFAULT NULL,
    `Size` int DEFAULT NULL,
    `Description` varchar(100) DEFAULT NULL,
    `Image` longblob,
    `Created` timestamp NULL DEFAULT NULL,
    `Updated` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`Id`),
    KEY `fk_File_User_idx` (`UserId`),
    KEY `fk_File_Resident_idx` (`ResidentId`),
    CONSTRAINT `fk_File_Resident` FOREIGN KEY (`ResidentId`) REFERENCES `Resident` (`Id`),
    CONSTRAINT `fk_File_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
