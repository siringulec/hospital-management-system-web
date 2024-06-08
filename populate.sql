SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

USE `hospital`;

-- Insert initial admin user
INSERT INTO `admin_table` (`username`, `password`) VALUES
('adminini', '$2y$10$h00FgPf2ZMFBw0fXFXUKVuz/l4rzM4PyWTvBDGRk2dweSY1rygfn2');

-- Insert data into patient first to avoid foreign key issues
INSERT INTO `patient` (`patientID`, `username`, `password`, `name`, `age`, `gender`, `phone`) VALUES
(1, 'sirin', '$2y$10$tWrWjaw.W6UC7XrGoWvzrO5C/Ut18br.NVWCZcsoG2SdX6XBwsn42', 'Sirin Gulec', 40, 'Male', '+90 (407) 631-1700'),
(2, 'dina', '$2y$10$mHLkjG8axjOKToc935DEBucMwZX6BmeypC0MBXluRi38gROHMuEz2', 'Dina Dienta', 50, 'Other', '+90 (281) 266-8191'),
(3, 'adelina', '$2y$10$IlEUghx60ilZVvUG8LiFt.HhiMxTSVTSvY6vvun8RSzGuTQZGRwZK', 'Adelina Nairn', 41, 'Female', '+90 (906) 048-8489');

-- Insert data into doctor
INSERT INTO `doctor` (`doctorID`, `username`, `password`, `name`, `subspecialty`, `gender`, `phone`) VALUES
(1, 'mgiordano', '$2y$10$8ogulo4x4rExq3ApxlANPe4zhVW1vPCfAaAKfwJovuk.rIB6.VkKy', 'Michael Joseph Giordano', 'Neurological Surgeon', 'Other', '+90 (955) 178-8903'),
(2, 'lavhs', '$2y$10$8ogulo4x4rExq3ApxlANPe4zhVW1vPCfAaAKfwJovuk.rIB6.VkKy', 'Lee Ann Van Houten-Sauter', 'Family Doctor', 'Female', '+90 (595) 996-1448'),
(3, 'ghp', '$2y$10$8ogulo4x4rExq3ApxlANPe4zhVW1vPCfAaAKfwJovuk.rIB6.VkKy%', 'Glenn Howard Perelson', 'Cardiologist', 'Male', '+90 (806) 251-2945');

-- Insert data into type_of_test first as it is referenced by test table
INSERT INTO `type_of_test` (`typeID`, `type_of_test`) VALUES
(1, 'X-ray'),
(2, 'Concussion Test'),
(3, 'MR'),
(4, 'Ultrasound'),
(5, 'Allergy Blood'),
(6, 'Heart Disease Risk Assessment'),
(7, 'Vitamin D'),
(8, 'Yeast Infection'),
(9, 'Hemoglobin'),
(10, 'Glucose in Urine'),
(11, 'Calcium in Blood'),
(12, 'Blood Glucose'),
(13, 'Appendicitis Tests'),
(14, 'Pregnancy Test'),
(15, 'Sleep Study'),
(16, 'TSH');

-- Insert data into appointments
INSERT INTO `appointments` (`appointmentID`, `patientID`, `doctorID`, `date`, `time`) VALUES
(1, 1, 1, '2023-01-02', '14:45:00'),
(2, 3, 2, '2022-11-09', '09:00:00'),
(3, 2, 3, '2023-04-23', '13:15:00');

-- Insert data into diagnosis
INSERT INTO `diagnosis` (`diagnosisID`, `patientID`, `symptoms`, `diagnosis`, `date`) VALUES
(1, 1, '- bad breath\n- eye twitching\n- memory loss\n- drooling \n- headache ', 'Vein Head', '2024-08-01'),
(2, 2, '- a fever\n- a rash\n- mouth sores\n- temporary blindness \n- leg pain', 'Hell Cramps', '2024-08-01'),
(3, 3, '- cloudy urine\n- inattention\n- confusion\n- ankle pain \n- vomiting', 'Terrifying Heart', '2024-08-01');

-- Insert data into medicine
INSERT INTO `medicine` (`medicineID`, `name`, `stock`) VALUES
(1, 'Metformin', 65),
(2, 'Bactepan', 23),
(3, 'Lysotrope Ethozoxane', 14),
(4, 'Magvital', 25),
(5, 'Mepronase', 34),
(6, 'Amlofase', 75),
(7, 'Cafestar', 32),
(8, 'Betacetam', 95),
(9, 'Tercoxacin', 89),
(10, 'Infudipine', 45),
(11, 'Beclostone Cereclotide', 12),
(12, 'Dextrosomax Albendamide', 56),
(13, 'Atracupenem Olazoxane', 74),
(14, 'Tetrasomax Baratensin', 87);

-- Insert data into prescription
INSERT INTO `prescription` (`prescriptionID`, `patientID`, `medicineID`, `dosage`, `date`) VALUES
(1, 3, 3, '750mg', '2024-11-14'),
(2, 1, 10, '500mg', '2024-08-08'),
(3, 2, 1, '500mg', '2024-08-08'),
(4, 3, 12, '1000mg', '2024-08-08');

-- Insert data into test
INSERT INTO `test` (`testID`, `patientID`, `type_of_test`, `results`, `date`) VALUES
(1, 1, 1, '101,01', '2024-08-02'),
(2, 2, 5, '5,5', '2024-08-02'),
(3, 3, 9, '10,9', '2024-08-02'),
(4, 3, 9, '3,9', '2024-08-02');

COMMIT;
