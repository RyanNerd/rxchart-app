CREATE TABLE `ServiceLog` (
    `Id` int NOT NULL AUTO_INCREMENT,
    `UserId` int NOT NULL,
    `ResidentId` int NOT NULL,
    `ServiceId` int NOT NULL,
    `HmisId` varchar(15) NULL DEFAULT NULL,
    `Notes` varchar(150) NULL DEFAULT NULL,
    `Created` timestamp NULL DEFAULT NULL,
    `Updated` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`Id`),
    KEY `fk_ServiceLog_User` (`UserId`),
    KEY `fk_ServiceLog_Service` (`ServiceId`),
    KEY `fk_ServiceLog_Resident_idx` (`ResidentId`),
    CONSTRAINT `fk_ServiceLog_Service` FOREIGN KEY (`ServiceId`) REFERENCES `Service` (`Id`),
    CONSTRAINT `fk_ServiceLog_Resident` FOREIGN KEY (`ResidentId`) REFERENCES `Resident` (`Id`),
    CONSTRAINT `fk_ServiceLog_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;