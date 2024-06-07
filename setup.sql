SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `hospital`;
USE `hospital`;

DROP TABLE IF EXISTS `admin_table`;
CREATE TABLE IF NOT EXISTS `admin_table` (
  `adminID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`adminID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `appointmentID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `patientID` BIGINT(20) UNSIGNED NOT NULL,
  `doctorID` BIGINT(20) UNSIGNED NOT NULL,
  `date` DATE NOT NULL,
  `time` TIME DEFAULT NULL,
  PRIMARY KEY (`appointmentID`),
  KEY `patientID` (`patientID`),
  KEY `doctorID` (`doctorID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `bills`;
CREATE TABLE IF NOT EXISTS `bills` (
  `billID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `patientID` BIGINT(20) UNSIGNED NOT NULL,
  `basic_amount` DOUBLE NOT NULL,
  `amount_assured` DOUBLE NOT NULL,
  `date` DATE NOT NULL,
  PRIMARY KEY (`billID`),
  KEY `patientID` (`patientID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `diagnosis`;
CREATE TABLE IF NOT EXISTS `diagnosis` (
  `diagnosisID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `patientID` BIGINT(20) UNSIGNED NOT NULL,
  `symptoms` TEXT NOT NULL,
  `diagnosis` VARCHAR(225) NOT NULL,
  `date` DATE NOT NULL,
  PRIMARY KEY (`diagnosisID`),
  KEY `patientID` (`patientID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `doctorID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `subspecialty` VARCHAR(50) NOT NULL,
  `gender` ENUM('Female','Male','Other') NOT NULL,
  `phone` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`doctorID`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `medicine`;
CREATE TABLE IF NOT EXISTS `medicine` (
  `medicineID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `stock` INT(225) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`medicineID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `patientID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `age` INT(3) UNSIGNED NOT NULL,
  `gender` ENUM('Female','Male','Other') NOT NULL,
  `phone` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`patientID`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `prescription`;
CREATE TABLE IF NOT EXISTS `prescription` (
  `prescriptionID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `patientID` BIGINT(20) UNSIGNED NOT NULL,
  `medicineID` BIGINT(20) UNSIGNED NOT NULL,
  `dosage` VARCHAR(225) NOT NULL,
  `date` DATE NOT NULL,
  PRIMARY KEY (`prescriptionID`),
  KEY `medicineID` (`medicineID`),
  KEY `patientID` (`patientID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `testID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `patientID` BIGINT(20) UNSIGNED NOT NULL,
  `type_of_test` BIGINT(20) UNSIGNED NOT NULL,
  `results` TEXT DEFAULT NULL,
  `date` DATE NOT NULL,
  PRIMARY KEY (`testID`),
  KEY `patientID` (`patientID`),
  KEY `type_of_test` (`type_of_test`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `type_of_test`;
CREATE TABLE IF NOT EXISTS `type_of_test` (
  `typeID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_of_test` VARCHAR(225) NOT NULL,
  PRIMARY KEY (`typeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`doctorID`) REFERENCES `doctor` (`doctorID`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`) ON DELETE CASCADE;

ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_2` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`) ON DELETE CASCADE;

ALTER TABLE `diagnosis`
  ADD CONSTRAINT `diagnosis_ibfk_2` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`) ON DELETE CASCADE;

ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`medicineID`) REFERENCES `medicine` (`medicineID`)ON DELETE CASCADE,
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`) ON DELETE CASCADE;

ALTER TABLE `test`
  ADD CONSTRAINT `test_ibfk_1` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`) ON DELETE CASCADE,
  ADD CONSTRAINT `test_ibfk_2` FOREIGN KEY (`type_of_test`) REFERENCES `type_of_test` (`typeID`) ON DELETE CASCADE;

COMMIT;
