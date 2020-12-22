CREATE TABLE `MedCheckout` (
                               `Id` int NOT NULL AUTO_INCREMENT,
                               `UserId` int NOT NULL,
                               `MedicineId` int NOT NULL,
                               `Out` tinyint DEFAULT NULL,
                               `In` tinyint DEFAULT NULL,
                               `Notes` varchar(500) NULL DEFAULT NULL,
                               `Created` timestamp NULL DEFAULT NULL,
                               `Updated` timestamp NULL DEFAULT NULL,
                               `deleted_at` timestamp NULL DEFAULT NULL,
                               PRIMARY KEY (`Id`),
                               KEY `fk_MedCheckout_User_idx` (`UserId`),
                               CONSTRAINT `fk_MedCheckout_Medicine` FOREIGN KEY (`Id`) REFERENCES `Medicine` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
                               CONSTRAINT `fk_MedCheckout_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
