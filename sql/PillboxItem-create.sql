CREATE TABLE `PillboxItem` (
    `Id` int NOT NULL AUTO_INCREMENT,
    `UserId` int NOT NULL,
    `PillboxId` int NOT NULL,
    `ResidentId` int not NULL,
    `Quantity` tinyint NOT NULL DEFAULT 1,
    `Created` timestamp NULL DEFAULT NULL,
    `Updated` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`Id`),
    KEY `fk_PillboxItem_User` (`UserId`),
    KEY `fk_PillboxItem_Pillbox_idx` (`PillboxId`),
    KEY `fk_PillboxItem_Resident_idx` (`ResidentId`),
    CONSTRAINT `fk_PillboxItem_Pillbox` FOREIGN KEY (`PillboxId`) REFERENCES `Pillbox` (`Id`),
    CONSTRAINT `fk_PillboxItem_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`),
    CONSTRAINT `fk_PillboxItem_Resident` FOREIGN KEY (`ResidentId`) REFERENCES `Resident` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
