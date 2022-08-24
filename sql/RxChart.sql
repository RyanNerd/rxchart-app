-- MySQL dump 10.13  Distrib 8.0.30, for Linux (x86_64)
--
-- Host: localhost    Database: RxChart
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `File`
--

DROP TABLE IF EXISTS `File`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `HmisUsers`
--

DROP TABLE IF EXISTS `HmisUsers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `HmisUsers` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `UserId` int NOT NULL,
  `HmisUserName` varchar(45) NOT NULL,
  `HmisUserId` varchar(6) NOT NULL,
  `Created` timestamp NULL DEFAULT NULL,
  `Updated` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_HmisUsers_User` (`UserId`),
  CONSTRAINT `fk_HmisUsers_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MedHistory`
--

DROP TABLE IF EXISTS `MedHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `MedHistory` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `ResidentId` int NOT NULL,
  `MedicineId` int NOT NULL,
  `PillboxItemId` int DEFAULT NULL,
  `UserId` int NOT NULL,
  `Notes` varchar(500) DEFAULT NULL,
  `In` tinyint DEFAULT NULL,
  `Out` tinyint DEFAULT NULL,
  `Created` timestamp NULL DEFAULT NULL,
  `Updated` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_MedHistory_Resident_idx` (`ResidentId`),
  KEY `fk_MedHistory_Medicine_idx` (`MedicineId`),
  KEY `fk_MedHistory_User` (`UserId`),
  KEY `fk_MedHistory_PillboxItem_idx` (`PillboxItemId`),
  CONSTRAINT `fk_MedHistory_Medicine` FOREIGN KEY (`MedicineId`) REFERENCES `Medicine` (`Id`),
  CONSTRAINT `fk_MedHistory_PillboxItem` FOREIGN KEY (`PillboxItemId`) REFERENCES `PillboxItem` (`Id`),
  CONSTRAINT `fk_MedHistory_Resident` FOREIGN KEY (`ResidentId`) REFERENCES `Resident` (`Id`),
  CONSTRAINT `fk_MedHistory_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Medicine`
--

DROP TABLE IF EXISTS `Medicine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Medicine` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `ResidentId` int DEFAULT NULL,
  `UserId` int NOT NULL,
  `Drug` varchar(100) NOT NULL,
  `OtherNames` varchar(100) DEFAULT NULL COMMENT 'Other names that the Drug may go by',
  `Strength` varchar(20) DEFAULT NULL,
  `Barcode` varchar(150) DEFAULT NULL,
  `Directions` varchar(300) DEFAULT NULL,
  `FillDateMonth` tinyint DEFAULT NULL,
  `FillDateDay` tinyint DEFAULT NULL,
  `FillDateYear` int DEFAULT NULL,
  `Notes` varchar(500) DEFAULT NULL,
  `Active` tinyint NOT NULL DEFAULT '1',
  `OTC` tinyint DEFAULT '0',
  `Created` timestamp NULL DEFAULT NULL,
  `Updated` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `Medicine_Barcode` (`Barcode`),
  KEY `fk_Medicine_Resident_idx` (`ResidentId`),
  KEY `fk_Medicine_User` (`UserId`),
  CONSTRAINT `fk_Medicine_Resident` FOREIGN KEY (`ResidentId`) REFERENCES `Resident` (`Id`),
  CONSTRAINT `fk_Medicine_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Pillbox`
--

DROP TABLE IF EXISTS `Pillbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Pillbox` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `UserId` int NOT NULL,
  `ResidentId` int NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Notes` varchar(300) DEFAULT NULL,
  `Created` timestamp NULL DEFAULT NULL,
  `Updated` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_Pillbox_User` (`UserId`),
  KEY `fk_Pillbox_Resident_idx` (`ResidentId`),
  CONSTRAINT `fk_Pillbox_Resident` FOREIGN KEY (`ResidentId`) REFERENCES `Resident` (`Id`),
  CONSTRAINT `fk_Pillbox_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PillboxItem`
--

DROP TABLE IF EXISTS `PillboxItem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PillboxItem` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `UserId` int NOT NULL,
  `PillboxId` int NOT NULL,
  `ResidentId` int NOT NULL,
  `MedicineId` int NOT NULL,
  `Quantity` tinyint NOT NULL DEFAULT '1',
  `Created` timestamp NULL DEFAULT NULL,
  `Updated` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `unique_PillboxItem_Medicine_Pillbox_idx` (`PillboxId`,`MedicineId`) COMMENT 'Disallow duplicate medicine records for the same Pillbox',
  KEY `fk_PillboxItem_User` (`UserId`),
  KEY `fk_PillboxItem_Pillbox_idx` (`PillboxId`),
  KEY `fk_PillboxItem_Resident_idx` (`ResidentId`),
  KEY `fk_PillboxItem_Medicine_idx` (`MedicineId`),
  CONSTRAINT `fk_PillboxItem_Medicine` FOREIGN KEY (`MedicineId`) REFERENCES `Medicine` (`Id`),
  CONSTRAINT `fk_PillboxItem_Pillbox` FOREIGN KEY (`PillboxId`) REFERENCES `Pillbox` (`Id`),
  CONSTRAINT `fk_PillboxItem_Resident` FOREIGN KEY (`ResidentId`) REFERENCES `Resident` (`Id`),
  CONSTRAINT `fk_PillboxItem_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Pin`
--

DROP TABLE IF EXISTS `Pin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
  UNIQUE KEY `unique_pin` (`ResidentId`,`UserId`,`PinValue`),
  KEY `fk_Pin_User` (`UserId`),
  KEY `fk_Pin_Resident` (`ResidentId`),
  CONSTRAINT `fk_Pin_Resident` FOREIGN KEY (`ResidentId`) REFERENCES `Resident` (`Id`),
  CONSTRAINT `fk_Pin_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Resident`
--

DROP TABLE IF EXISTS `Resident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Resident` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `UserId` int NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `Nickname` varchar(50) DEFAULT NULL,
  `DOB_YEAR` int DEFAULT NULL,
  `DOB_MONTH` tinyint DEFAULT NULL,
  `DOB_DAY` tinyint DEFAULT NULL,
  `Notes` varchar(500) DEFAULT NULL,
  `HMIS` int DEFAULT NULL,
  `EnrollmentId` int DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `Created` timestamp NULL DEFAULT NULL,
  `Updated` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `Resident_Id_IDX` (`Id`) USING BTREE,
  UNIQUE KEY `unique_Resident` (`UserId`,`LastName`,`FirstName`,`DOB_YEAR`,`DOB_MONTH`,`DOB_DAY`),
  KEY `fk_Resident_User` (`UserId`),
  CONSTRAINT `fk_Resident_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Service`
--

DROP TABLE IF EXISTS `Service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Service` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `UserId` int NOT NULL,
  `HmisId` int DEFAULT NULL,
  `ServiceName` varchar(100) NOT NULL,
  `Created` timestamp NULL DEFAULT NULL,
  `Updated` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `HmisId_UNIQUE` (`HmisId`),
  KEY `fk_Service_User` (`UserId`),
  CONSTRAINT `fk_Service_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ServiceLog`
--

DROP TABLE IF EXISTS `ServiceLog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ServiceLog` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `UserId` int NOT NULL,
  `ResidentId` int NOT NULL,
  `ServiceId` int NOT NULL,
  `HmisId` varchar(15) DEFAULT NULL,
  `DateOfService` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UnitOfMeasure` char(1) NOT NULL DEFAULT 'C',
  `Units` int NOT NULL DEFAULT '1',
  `UnitValue` double(10,2) NOT NULL DEFAULT '1.00',
  `Recorded` timestamp NULL DEFAULT NULL,
  `Created` timestamp NULL DEFAULT NULL,
  `Updated` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_ServiceLog_User` (`UserId`),
  KEY `fk_ServiceLog_Service` (`ServiceId`),
  KEY `fk_ServiceLog_Resident_idx` (`ResidentId`),
  KEY `idx_ServiceLog_Date_Of_Service` (`DateOfService`),
  CONSTRAINT `fk_ServiceLog_Resident` FOREIGN KEY (`ResidentId`) REFERENCES `Resident` (`Id`),
  CONSTRAINT `fk_ServiceLog_Service` FOREIGN KEY (`ServiceId`) REFERENCES `Service` (`Id`),
  CONSTRAINT `fk_ServiceLog_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `User` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Organization` varchar(100) DEFAULT NULL,
  `PasswordHash` varchar(300) NOT NULL,
  `API_KEY` varchar(100) NOT NULL,
  `Created` timestamp NULL DEFAULT NULL,
  `Updated` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `UserName` varchar(30) DEFAULT NULL,
  UNIQUE KEY `User_Id_IDX` (`Id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-04  1:15:24
