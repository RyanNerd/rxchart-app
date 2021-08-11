CREATE TABLE `RxChart`.`Pillbox` (
     `Id` INT NOT NULL AUTO_INCREMENT,
     `UserId` int NOT NULL,
     `ResidentId` int NOT NULL,
     `Name` VARCHAR(45) NOT NULL,
     `Notes` VARCHAR(300) NULL,
     `Created` TIMESTAMP NULL DEFAULT NULL,
     `Updated` TIMESTAMP NULL DEFAULT NULL,
     `deleted_at` TIMESTAMP NULL DEFAULT NULL,
     PRIMARY KEY (`Id`),
     KEY `fk_Pillbox_User` (`UserId`),
     KEY `fk_Pillbox_Resident_idx` (`ResidentId`),
     CONSTRAINT `fk_Pillbox_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`),
     CONSTRAINT `fk_Pillbox_Resident` FOREIGN KEY (`ResidentId`) REFERENCES `Resident` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
