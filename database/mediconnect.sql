-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2025 at 09:10 PM
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
  `profile_image` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `user_id`, `specialty_id`, `hospital_id`, `is_verified`, `rating`, `reviews_count`, `profile_image`, `bio`) VALUES
(1, 1, 1, 1, 1, 4.9, 124, 'dr_sarah_johnson.jpg', 'Dr. Sarah Johnson is a board-certified cardiologist with over 12 years of experience in treating cardiovascular diseases. She completed her medical training at Harvard Medical School and residency at Massachusetts General Hospital.'),
(2, 2, 2, 2, 1, 4.7, 98, 'dr_michael_chen.jpg', 'Dr. Michael Chen specializes in medical, surgical, and cosmetic dermatology. He has expertise in treating skin conditions like acne, eczema, psoriasis, and skin cancer.'),
(3, 3, 3, 3, 1, 4.8, 156, 'dr_emily_rodriguez.jpg', 'Dr. Emily Rodriguez is a neurologist with expertise in headache disorders, multiple sclerosis, and neurodegenerative diseases. She is dedicated to providing compassionate care for patients with complex neurological conditions.'),
(4, 4, 4, 4, 1, 4.6, 87, 'dr_james_wilson.jpg', 'Dr. James Wilson is an orthopedic surgeon specializing in sports medicine, joint replacement, and trauma. With 20 years of experience, he has helped thousands of patients recover from orthopedic injuries and conditions.'),
(5, 5, 5, 5, 1, 4.9, 142, 'dr_lisa_kim.jpg', 'Dr. Lisa Kim is a dedicated pediatrician who provides comprehensive healthcare for children from birth through adolescence. She is known for her gentle approach and ability to connect with young patients.'),
(6, 6, 6, 6, 1, 4.8, 73, 'dr_robert_taylor.jpg', 'Dr. Robert Taylor is a psychiatrist specializing in mood disorders, anxiety, and PTSD. He takes a holistic approach to mental health, combining medication management with psychotherapy when appropriate.');

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
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`hospital_id`, `name`, `address`, `contact`, `available_beds`, `rating`, `reviews_count`, `emergency_services`, `profile_image`) VALUES
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
  `address_line` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `first_name`, `last_name`, `city`, `address_line`) VALUES
(1, 'sarah.johnson@gmail.com', 'sarahjohson@123', 'Sarah', 'Johnson', 'Tripoli', 'Hay Al Ramlet'),
(2, 'michael.chen@example.com', 'password2', 'Michael', 'Chen', 'New York', '123 Skin St'),
(3, 'emily.rodriguez@example.com', 'password3', 'Emily', 'Rodriguez', 'Los Angeles', '456 Neuro Rd'),
(4, 'james.wilson@example.com', 'password4', 'James', 'Wilson', 'Chicago', '789 Ortho Ave'),
(5, 'lisa.kim@example.com', 'password5', 'Lisa', 'Kim', 'Houston', '321 Pediatric Blvd'),
(6, 'robert.taylor@example.com', 'password6', 'Robert', 'Taylor', 'Phoenix', '654 Mental Way');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `specialty_id` (`specialty_id`),
  ADD KEY `hospital_id` (`hospital_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `specialties`
--
ALTER TABLE `specialties`
  MODIFY `specialty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
