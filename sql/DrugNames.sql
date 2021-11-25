CREATE TABLE `DrugNames` (
    `Id` int NOT NULL AUTO_INCREMENT COMMENT 'List of common drug names',
    `UserId` int NOT NULL,
    `Drug` varchar(100) NOT NULL,
    `Created` timestamp NULL DEFAULT NULL,
    `Updated` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`Id`),
    KEY `fk_DrugNames_User` (`UserId`),
    UNIQUE KEY `DrugNames_UNIQUE` (`Drug`),
    CONSTRAINT `fk_DrugNames_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
