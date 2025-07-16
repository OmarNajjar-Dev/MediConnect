-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2025 at 08:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mediconnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `ambulance_locations`
--

CREATE TABLE `ambulance_locations` (
  `team_id` int(11) NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ambulance_locations`
--

INSERT INTO `ambulance_locations` (`team_id`, `latitude`, `longitude`, `updated_at`) VALUES
(1, 34.39400000, 35.84300000, '2025-07-15 04:41:46');

-- --------------------------------------------------------

--
-- Table structure for table `ambulance_teams`
--

CREATE TABLE `ambulance_teams` (
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `team_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ambulance_teams`
--

INSERT INTO `ambulance_teams` (`team_id`, `user_id`, `team_name`) VALUES
(1, 1, 'Test Ambulance Team'),
(4, 12, 'Omar\'s Team');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `specialty_id` int(11) DEFAULT NULL,
  `hospital_id` int(11) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `rating` decimal(2,1) DEFAULT NULL,
  `reviews_count` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `user_id`, `specialty_id`, `hospital_id`, `is_verified`, `rating`, `reviews_count`, `image_url`, `bio`) VALUES
(1, 1, 1, 1, 1, 4.9, 124, 'https://randomuser.me/api/portraits/women/45.jpg', 'Dr. Sarah Johnson is a board-certified cardiologist with over 12 years of experience in treating cardiovascular diseases. She completed her medical training at Harvard Medical School and residency at Massachusetts General Hospital.'),
(2, 2, 2, 2, 1, 4.7, 98, 'https://randomuser.me/api/portraits/men/32.jpg', 'Dr. Michael Chen specializes in medical, surgical, and cosmetic dermatology. He has expertise in treating skin conditions like acne, eczema, psoriasis, and skin cancer.'),
(3, 3, 3, 3, 1, 4.8, 156, 'https://randomuser.me/api/portraits/women/63.jpg', 'Dr. Emily Rodriguez is a neurologist with expertise in headache disorders, multiple sclerosis, and neurodegenerative diseases. She is dedicated to providing compassionate care for patients with complex neurological conditions.'),
(4, 4, 4, 4, 1, 4.6, 87, 'https://randomuser.me/api/portraits/men/46.jpg', 'Dr. James Wilson is an orthopedic surgeon specializing in sports medicine, joint replacement, and trauma. With 20 years of experience, he has helped thousands of patients recover from orthopedic injuries and conditions.'),
(5, 5, 5, 5, 1, 4.9, 142, 'https://randomuser.me/api/portraits/women/69.jpg', 'Dr. Lisa Kim is a dedicated pediatrician who provides comprehensive healthcare for children from birth through adolescence. She is known for her gentle approach and ability to connect with young patients.'),
(6, 6, 6, 6, 1, 4.8, 73, 'https://randomuser.me/api/portraits/men/79.jpg', 'Dr. Robert Taylor is a psychiatrist specializing in mood disorders, anxiety, and PTSD. He takes a holistic approach to mental health, combining medication management with psychotherapy when appropriate.');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_requests`
--

CREATE TABLE `emergency_requests` (
  `request_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` enum('Pending','In Transit','Resolved') DEFAULT 'Pending',
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_requests`
--

INSERT INTO `emergency_requests` (`request_id`, `patient_id`, `location`, `status`, `requested_at`) VALUES
(3, 1, '{\"lat\":34.3948392,\"lng\":35.8431243}', 'Pending', '2025-07-15 05:01:50'),
(4, 1, '{\"lat\":34.3950887,\"lng\":35.8427908}', 'Pending', '2025-07-15 08:44:47');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_responses`
--

CREATE TABLE `emergency_responses` (
  `response_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `dispatched_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_responses`
--

INSERT INTO `emergency_responses` (`response_id`, `request_id`, `team_id`, `dispatched_at`) VALUES
(3, 3, 1, '2025-07-15 05:01:50'),
(4, 4, 1, '2025-07-15 08:44:47');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `hospital_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `available_beds` int(11) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `reviews_count` int(11) DEFAULT NULL,
  `emergency_services` tinyint(1) DEFAULT 0,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`hospital_id`, `name`, `address`, `contact`, `available_beds`, `rating`, `reviews_count`, `emergency_services`, `image_url`) VALUES
(1, 'Central Medical Center', '123 Medical Blvd, Central City', '+1 (555) 123-4567', 15, 4.8, 356, 1, 'https:images.unsplash.com/photo-1586773860418-d37222d8fce3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'),
(2, 'Westside Hospital', '456 Healthcare Ave, West District', '+1 (555) 987-6543', 8, 4.6, 283, 1, 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'),
(3, 'Metropolitan Medical Center', '789 Wellness St, Downtown', '+1 (555) 246-8135', 23, 4.9, 412, 1, 'https://images.unsplash.com/photo-1487958449943-2429e8be8625?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'),
(4, 'Harmony Health Institute', '456 Care Avenue, Midtown', '+1 (555) 789-6543', 7, 4.7, 289, 0, 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'),
(5, 'Sunrise Health Hospital', '321 Sunrise Blvd, East End', '+1 (555) 789-1234', 16, 4.7, 298, 1, 'https://images.unsplash.com/photo-1459767129954-1b1c1f9b9ace?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'),
(6, 'Children\'s Health Center', '890 Pediatric Way, Family District', '+1 (555) 456-7890', 18, 4.9, 278, 1, 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'),
(7, 'Behavioral Health Institute', '432 Mental Wellness Blvd, Serenity Hills', '+1 (555) 789-0123', 25, 4.6, 189, 0, 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_specialties`
--

CREATE TABLE `hospital_specialties` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `specialty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospital_specialties`
--

INSERT INTO `hospital_specialties` (`id`, `hospital_id`, `specialty_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 4),
(4, 1, 7),
(8, 2, 2),
(5, 2, 5),
(7, 2, 8),
(6, 2, 9),
(9, 3, 1),
(10, 3, 10),
(11, 3, 11),
(12, 3, 12),
(13, 4, 2),
(14, 4, 13),
(15, 4, 14),
(16, 4, 15),
(19, 5, 2),
(18, 5, 3),
(17, 5, 4),
(21, 5, 5),
(20, 6, 7),
(22, 6, 16),
(23, 6, 17),
(24, 6, 18),
(25, 7, 6),
(26, 7, 19),
(27, 7, 20),
(28, 7, 21);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `user_id`, `birthdate`, `gender`) VALUES
(2, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(6, 'Ambulance Team'),
(3, 'Doctor'),
(2, 'Hospital Admin'),
(4, 'Patient'),
(5, 'Staff'),
(1, 'Super Admin');

-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

CREATE TABLE `specialties` (
  `specialty_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `label_for_doctor` varchar(100) DEFAULT NULL,
  `label_for_hospital` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialties`
--

INSERT INTO `specialties` (`specialty_id`, `name`, `label_for_doctor`, `label_for_hospital`) VALUES
(1, 'Cardiology', 'Cardiologist', 'Cardiology'),
(2, 'Dermatology', 'Dermatologist', 'Dermatology'),
(3, 'Neurology', 'Neurologist', 'Neurology'),
(4, 'Orthopedics', 'Orthopedist', 'Orthopedics'),
(5, 'Pediatrics', 'Pediatrician', 'Pediatrics'),
(6, 'Psychiatry', 'Psychiatrist', 'Psychiatry'),
(7, 'Oncology', 'Oncologist', 'Oncology'),
(8, 'General Surgery', 'Surgeon', 'General Surgery'),
(9, 'Obstetrics', 'Obstetrician', 'Obstetrics'),
(10, 'Gastroenterology', 'Gastroenterologist', 'Gastroenterology'),
(11, 'Pulmonology', 'Pulmonologist', 'Pulmonology'),
(12, 'Urology', 'Urologist', 'Urology'),
(13, 'Endocrinology', 'Endocrinologist', 'Endocrinology'),
(14, 'Nephrology', 'Nephrologist', 'Nephrology'),
(15, 'Rheumatology', 'Rheumatologist', 'Rheumatology'),
(16, 'Neonatology', 'Neonatologist', 'Neonatology'),
(17, 'Pediatric Surgery', 'Pediatric Surgeon', 'Pediatric Surgery'),
(18, 'Child Psychology', 'Child Psychologist', 'Child Psychology'),
(19, 'Psychology', 'Psychologist', 'Psychology'),
(20, 'Addiction Treatment', 'Addiction Specialist', 'Addiction Treatment'),
(21, 'Crisis Intervention', 'Crisis Counselor', 'Crisis Intervention');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address_line` varchar(255) NOT NULL,
  `remember_token` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `first_name`, `last_name`, `city`, `address_line`, `remember_token`) VALUES
(1, 'sarah.johnson@gmail.com', 'sarahjohson@123', 'Sarah', 'Johnson', 'Tripoli', 'Hay Al Ramlet', NULL),
(2, 'michael.chen@example.com', 'password2', 'Michael', 'Chen', 'New York', '123 Skin St', NULL),
(3, 'emily.rodriguez@example.com', 'password3', 'Emily', 'Rodriguez', 'Los Angeles', '456 Neuro Rd', NULL),
(4, 'james.wilson@example.com', 'password4', 'James', 'Wilson', 'Chicago', '789 Ortho Ave', NULL),
(5, 'lisa.kim@example.com', 'password5', 'Lisa', 'Kim', 'Houston', '321 Pediatric Blvd', NULL),
(6, 'robert.taylor@example.com', 'password6', 'Robert', 'Taylor', 'Phoenix', '654 Mental Way', NULL),
(7, 'superadmin@gmail.com', '$2y$10$GKpi6ZUEK9yWc1BDSlkPO.Fkg47UqISpJ1Pd0zh1OkVQTERTknajW', 'Omar', 'Najjar', 'الميناء', 'شارع رشيد كرامة, الميناء, قضاء طرابلس, محافظة الشمال, 1301, لبنان', NULL),
(8, 'admin@gmail.com', '$2y$10$F1MJOk0q1/ltcHd0fuG6B.HXnwwi9fcVGM6.ja/A3mu.MyIgmaA4a', 'Omar', 'Najjar', 'بيروت', 'الشيخ توفيق خالد, السراي, زقاق البلاط, بيروت, محافظة بيروت, 2033 9105, لبنان', NULL),
(9, 'doctor@gmail.com', '$2y$10$NsJqi3QqXBVCTfYRbMRUCuyreOK9mpg8SnzOT95xnK55X/hqwpgBa', 'Omar', 'Najjar', 'بيروت', 'الشيخ توفيق خالد, السراي, زقاق البلاط, بيروت, محافظة بيروت, 2033 9105, لبنان', NULL),
(10, 'patient@gmail.com', '$2y$10$Qifkqh6GZ6XLYH3NwgGywuR.9SVWmWKwPXQ9CvOFjdubIRA1jj6E2', 'Omar', 'Najjar', 'بيروت', 'الشيخ توفيق خالد, السراي, زقاق البلاط, بيروت, محافظة بيروت, 2033 9105, لبنان', NULL),
(11, 'staff@gmail.com', '$2y$10$pk9KfO83/mctcEJtilUrgu1GYDSyu64SUuMGWXbz5LIBsPpizxLEK', 'Omar', 'Najjar', 'بيروت', 'الشيخ توفيق خالد, السراي, زقاق البلاط, بيروت, محافظة بيروت, 2033 9105, لبنان', NULL),
(12, 'ambulance@gmail.com', '$2y$10$0Ei.NdhOtnMEOjHlq/GxUelqrnqVZydjTRHdc0aia62DTdiUacSkO', 'Omar', 'Najjar', 'Beirut', 'Cheikh Toufic Khaled, Serail, Zuqaq Al Blat, Beirut, Beirut Governorate, 2033 9105, Lebanon', NULL),
(13, 'omarnajjar10.on@gmail.com', '$2y$10$Rj89O5hV8PLPMQRX.HQmRegrbt/0yrB/b1i1xQyrpbajTYnGNwbba', 'Omar', 'Najjar', 'Beirut', 'Cheikh Toufic Khaled, Serail, Zuqaq Al Blat, Beirut, Beirut Governorate, 2033 9105, Lebanon', '36f89072ca2dc3e06db4b89b41c2dfdd4ed4cf5ac63f88a5400fae1e64987039');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_role_id`, `user_id`, `role_id`) VALUES
(64, 7, 1),
(65, 8, 2),
(66, 9, 3),
(67, 10, 4),
(68, 11, 5),
(71, 12, 6),
(72, 13, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ambulance_locations`
--
ALTER TABLE `ambulance_locations`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `ambulance_teams`
--
ALTER TABLE `ambulance_teams`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `specialty_id` (`specialty_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `emergency_requests`
--
ALTER TABLE `emergency_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `emergency_responses`
--
ALTER TABLE `emergency_responses`
  ADD PRIMARY KEY (`response_id`),
  ADD KEY `request_id` (`request_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`hospital_id`);

--
-- Indexes for table `hospital_specialties`
--
ALTER TABLE `hospital_specialties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hospital_id` (`hospital_id`,`specialty_id`),
  ADD KEY `specialty_id` (`specialty_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`specialty_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_role_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ambulance_teams`
--
ALTER TABLE `ambulance_teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `emergency_requests`
--
ALTER TABLE `emergency_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emergency_responses`
--
ALTER TABLE `emergency_responses`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hospital_specialties`
--
ALTER TABLE `hospital_specialties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `specialties`
--
ALTER TABLE `specialties`
  MODIFY `specialty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ambulance_locations`
--
ALTER TABLE `ambulance_locations`
  ADD CONSTRAINT `ambulance_locations_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `ambulance_teams` (`team_id`) ON DELETE CASCADE;

--
-- Constraints for table `ambulance_teams`
--
ALTER TABLE `ambulance_teams`
  ADD CONSTRAINT `ambulance_teams_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctors_ibfk_2` FOREIGN KEY (`specialty_id`) REFERENCES `specialties` (`specialty_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctors_ibfk_3` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hospital_specialties`
--
ALTER TABLE `hospital_specialties`
  ADD CONSTRAINT `hospital_specialties_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hospital_specialties_ibfk_2` FOREIGN KEY (`specialty_id`) REFERENCES `specialties` (`specialty_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
