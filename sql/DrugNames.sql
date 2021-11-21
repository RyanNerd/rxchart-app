CREATE TABLE `DrugNames` (
    `Id` int NOT NULL AUTO_INCREMENT COMMENT 'List of common drug names',
    `Drug` varchar(100) NOT NULL,
    `OTC` tinyint NOT NULL DEFAULT '0',
    `Created` timestamp NULL DEFAULT NULL,
    `Updated` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`Id`),
    UNIQUE KEY `DrugNames_UNIQUE` (`Drug`,`OTC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
