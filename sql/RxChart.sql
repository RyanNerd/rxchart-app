CREATE DATABASE  IF NOT EXISTS `RxChart` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `RxChart`;
-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: localhost    Database: RxChart
-- ------------------------------------------------------
-- Server version	8.0.18

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
-- Table structure for table `MedHistory`
--

DROP TABLE IF EXISTS `MedHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `MedHistory` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ResidentId` int(11) NOT NULL,
  `MedicineId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Notes` varchar(500) DEFAULT NULL,
  `Created` timestamp NULL DEFAULT NULL,
  `Updated` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_MedHistory_Resident_idx` (`ResidentId`),
  KEY `fk_MedHistory_Medicine_idx` (`MedicineId`),
  KEY `fk_MedHistory_User` (`UserId`),
  CONSTRAINT `fk_MedHistory_Medicine` FOREIGN KEY (`MedicineId`) REFERENCES `Medicine` (`Id`),
  CONSTRAINT `fk_MedHistory_Resident` FOREIGN KEY (`ResidentId`) REFERENCES `Resident` (`Id`),
  CONSTRAINT `fk_MedHistory_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Medicine`
--

DROP TABLE IF EXISTS `Medicine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Medicine` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ResidentId` int(11) DEFAULT NULL,
  `UserId` int(11) NOT NULL,
  `Drug` varchar(100) NOT NULL,
  `Strength` varchar(20) DEFAULT NULL,
  `Barcode` varchar(150) DEFAULT NULL,
  `Directions` varchar(300) DEFAULT NULL,
  `FillDateMonth` tinyint(4) DEFAULT NULL,
  `FillDateDay` tinyint(4) DEFAULT NULL,
  `FillDateYear` int(11) DEFAULT NULL,
  `Notes` varchar(500) DEFAULT NULL,
  `OTC` tinyint(4) DEFAULT '0',
  `Created` timestamp NULL DEFAULT NULL,
  `Updated` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `Medicine_Barcode` (`Barcode`),
  KEY `fk_Medicine_Resident_idx` (`ResidentId`),
  KEY `fk_Medicine_User` (`UserId`),
  CONSTRAINT `fk_Medicine_Resident` FOREIGN KEY (`ResidentId`) REFERENCES `Resident` (`Id`),
  CONSTRAINT `fk_Medicine_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Resident`
--

DROP TABLE IF EXISTS `Resident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Resident` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `DOB_YEAR` int(11) DEFAULT NULL,
  `DOB_MONTH` tinyint(4) DEFAULT NULL,
  `DOB_DAY` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `Created` timestamp NULL DEFAULT NULL,
  `Updated` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `Resident_Id_IDX` (`Id`) USING BTREE,
  KEY `fk_Resident_User` (`UserId`),
  CONSTRAINT `fk_Resident_User` FOREIGN KEY (`UserId`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `User` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Organization` varchar(100) DEFAULT NULL,
  `PasswordHash` varchar(300) NOT NULL,
  `API_KEY` varchar(100) NOT NULL,
  `Created` timestamp NULL DEFAULT NULL,
  `Updated` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `UserName` varchar(30) DEFAULT NULL,
  UNIQUE KEY `User_Id_IDX` (`Id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-23  1:55:22
