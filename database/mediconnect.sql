-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2025 at 02:23 PM
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
(3, 11, 'Rapid Response Unit');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `hospital_id` int(11) DEFAULT NULL,
  `appointment_date` datetime DEFAULT NULL,
  `status` enum('Scheduled','Completed','Cancelled') DEFAULT 'Scheduled',
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `patient_id`, `doctor_id`, `hospital_id`, `appointment_date`, `status`, `notes`) VALUES
(1, 11, 14, 1, '2025-07-23 13:30:00', 'Scheduled', 'e'),
(2, 11, 8, 1, '2025-07-23 10:00:00', 'Scheduled', 'e');

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
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `user_id`, `specialty_id`, `hospital_id`, `is_verified`, `rating`, `reviews_count`, `bio`) VALUES
(8, 2, 1, 1, 0, NULL, NULL, 'Dr. Sarah Johnson is a board-certified cardiologist with over 12 years of experience in treating cardiovascular diseases. She completed her medical training at Harvard Medical School and residency at Massachusetts General Hospital.'),
(9, 3, 2, 2, 0, NULL, NULL, 'Dr. Michael Chen specializes in medical, surgical, and cosmetic dermatology. He has expertise in treating skin conditions like acne, eczema, psoriasis, and skin cancer.'),
(10, 4, 3, 3, 0, NULL, NULL, 'Dr. Emily Rodriguez is a neurologist with expertise in headache disorders, multiple sclerosis, and neurodegenerative diseases. She is dedicated to providing compassionate care for patients with complex neurological conditions.'),
(13, 7, 6, 7, 0, NULL, NULL, 'Dr. Robert Taylor is a psychiatrist specializing in mood disorders, anxiety, and PTSD. He takes a holistic approach to mental health, combining medication management with psychotherapy when appropriate.'),
(14, 5, 4, 1, 0, NULL, NULL, 'Dr. James Wilson is an orthopedic surgeon specializing in sports medicine, joint replacement, and trauma. With 20 years of experience, he has helped thousands of patients recover from orthopedic injuries and conditions.'),
(15, 6, 5, 6, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emergency_requests`
--

CREATE TABLE `emergency_requests` (
  `request_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` enum('Pending','In Progress','Canceled','Completed') DEFAULT 'Pending',
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `canceled_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_requests`
--

INSERT INTO `emergency_requests` (`request_id`, `patient_id`, `location`, `status`, `requested_at`, `canceled_at`, `completed_at`) VALUES
(3, 1, '{\"lat\":34.3948392,\"lng\":35.8431243}', 'Pending', '2025-07-15 05:01:50', NULL, NULL),
(4, 1, '{\"lat\":34.3950887,\"lng\":35.8427908}', 'Pending', '2025-07-15 08:44:47', NULL, NULL),
(5, 1, '{\"lat\":34.390016,\"lng\":35.8055936}', 'Pending', '2025-07-22 06:27:45', NULL, NULL),
(6, 1, '{\"lat\":34.390016,\"lng\":35.8055936}', 'Pending', '2025-07-22 06:47:08', NULL, NULL),
(7, 1, '{\"lat\":34.3950456,\"lng\":35.8429366}', 'Pending', '2025-07-22 07:16:10', NULL, NULL),
(8, 1, '{\"lat\":34.390016,\"lng\":35.8055936}', 'Pending', '2025-07-22 08:01:04', NULL, NULL),
(9, 1, '{\"lat\":34.390016,\"lng\":35.8055936}', 'Pending', '2025-07-22 08:15:15', NULL, NULL),
(10, 1, '{\"lat\":34.390016,\"lng\":35.8055936}', 'Pending', '2025-07-22 08:17:27', NULL, NULL),
(11, 1, '{\"lat\":34.390016,\"lng\":35.8055936}', 'Pending', '2025-07-22 09:54:50', NULL, NULL),
(12, 1, '{\"lat\":34.006,\"lng\":36.208}', 'Pending', '2025-07-22 10:11:28', NULL, NULL),
(13, 1, '{\"lat\":34.3946862,\"lng\":35.8430346}', 'Pending', '2025-07-22 13:40:43', NULL, NULL),
(14, 1, '{\"lat\":34.390016,\"lng\":35.8055936}', 'Canceled', '2025-07-22 14:43:17', '2025-07-22 17:52:40', NULL),
(15, 1, '{\"lat\":34.390016,\"lng\":35.8055936}', 'Pending', '2025-07-22 14:57:00', NULL, NULL),
(16, 1, '{\"lat\":34.390016,\"lng\":35.8055936}', 'Pending', '2025-07-22 15:01:04', NULL, NULL),
(17, 1, '{\"lat\":34.390016,\"lng\":35.8055936}', 'Pending', '2025-07-22 15:19:01', NULL, NULL),
(18, 1, '{\"lat\":34.390016,\"lng\":35.8055936}', 'Canceled', '2025-07-22 15:22:51', '2025-07-22 18:22:58', NULL),
(19, 1, '{\"lat\":34.390016,\"lng\":35.8055936}', 'Canceled', '2025-07-22 15:43:31', '2025-07-22 18:43:39', NULL),
(20, 1, '{\"lat\":34.390016,\"lng\":35.8055936}', 'Canceled', '2025-07-22 19:27:35', '2025-07-22 22:27:39', NULL),
(21, 1, '{\"lat\":34.390016,\"lng\":35.8055936}', 'Canceled', '2025-07-22 19:29:29', '2025-07-22 22:41:28', NULL),
(22, 1, '{\"lat\":33.8937913,\"lng\":35.5017767}', 'Completed', '2025-07-22 19:41:58', '2025-07-22 22:41:59', '2025-07-22 23:31:16'),
(23, 1, '{\"lat\":34.3949095,\"lng\":35.8431263}', 'Pending', '2025-07-22 21:14:49', NULL, NULL),
(24, 9, '{\"lat\":34.390016,\"lng\":35.8055936}', 'Pending', '2025-07-23 05:52:15', NULL, NULL),
(25, NULL, '{\"lat\":34.390016,\"lng\":35.8055936}', 'Pending', '2025-07-23 06:06:52', NULL, NULL),
(26, NULL, '{\"lat\":34.3867392,\"lng\":35.8187008}', 'Pending', '2025-07-23 07:04:38', NULL, NULL),
(27, NULL, '{\"lat\":33.8886,\"lng\":35.4955}', 'Pending', '2025-07-23 09:25:27', NULL, NULL),
(28, NULL, '{\"lat\":33.8886,\"lng\":35.4955}', 'Pending', '2025-07-23 09:33:29', NULL, NULL),
(29, NULL, '{\"lat\":34.390016,\"lng\":35.8055936}', 'Pending', '2025-07-23 09:35:46', NULL, NULL);

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
(4, 4, 1, '2025-07-15 08:44:47'),
(5, 5, 1, '2025-07-19 18:07:46');

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
(10, 9, '2005-10-22', 'Male'),
(11, 1, NULL, NULL);

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
  `profile_image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `first_name`, `last_name`, `city`, `address_line`, `profile_image`, `remember_token`) VALUES
(1, 'omarnajjar10.on@gmail.com', '$2y$10$eBYOqBRK7AsWXFBi3is4s.NYnZaMn2CCIodTta5amT22YYqBQyxDa', 'Omar', 'Najjar', 'Tripoli', 'Sea Road, El Mina', '/mediconnect/uploads/profile_images/profile_1_1752840783.jpg', '9857d6cddfba0b172ee8ee6217d181e331b4aa4d7d7cf38914e531abd86b23bf'),
(2, 'sarahjohnson@gmail.com', '$2y$10$diymDRPP0peTXa.U.LdMYu5nZU3x2vxJFAxJaXfwQL0LUjuCm6rfi', 'Sarah', 'Johnson', 'Tripoli', 'Hay Al Ramlet', '/mediconnect/uploads/profile_images/profile_2_1752871634.webp', NULL),
(3, 'michaelchen@gmail.com', '$2y$10$mkXvDnpFC6ke5ojUMjOdhem2MXM9hlzt7.R0h4HU3diUSftR8PYse', 'Michael', 'Chen', 'New York', '123 Skin Street', '/mediconnect/uploads/profile_images/profile_3_1752914804.webp', NULL),
(4, 'emilyrodriguez@gmail.com', '$2y$10$lX3ffT/LbQZW8jvSG59ceOCCYVGrir6ePRvb3eFfMWtho.IIiKw/G', 'Emily', 'Rodriguez', 'Los Angeles', '456 Neuro', '/mediconnect/uploads/profile_images/profile_4_1752914885.webp', NULL),
(5, 'jameswilson@gmail.com', '$2y$10$3Ji/tJwDwkolqSuDAV7Dre33V3oGelJthsnms4P7fwaYYmK/DVu96', 'James', 'Wilson', 'Chicago', '789 Ortho', '/mediconnect/uploads/profile_images/profile_5_1752914927.webp', NULL),
(6, 'lisakim@gmail.com', '$2y$10$6rkQR42WGSYZZVSh.n2sauFYW/OJJsOlie.XELzs6a.DaDtmk3ceq', 'Lisa', 'Kim', 'Houston', '321 Pediatric', '/mediconnect/uploads/profile_images/profile_6_1752914982.webp', NULL),
(7, 'roberttaylor@gmail.com', '$2y$10$wY10L4rEwSJHVvJGCF5eFO0sYl7rU1keaikUGKE22AdbMTeAxcmqW', 'Robert', 'Taylor', 'Phoenix', '654 Mental Way', '/mediconnect/uploads/profile_images/profile_7_1752915038.webp', NULL),
(8, 'eliofaddoul@gmail.com', '$2y$10$EOL6qR0E7KYOVE/VFBytzOhufMU41AUc0H13.Vmk6M8TNU.N2ZkJG', 'Elio', 'Faddoul', 'Tripoli', 'Dahr El Ein, Al Koura', '\\mediconnect\\uploads\\profile_images\\profile_8_1752924513.jpg', NULL),
(9, 'omarnajjar@gmail.com', '$2y$10$bx0qygpNThR0wxup09U6ruMuRcMBAa7lOEqvfRI7UBVp9j4c9US..', 'Omar', 'Najjar', 'Mina', 'AL se3a, Mina', '/mediconnect/uploads/profile_images/profile_9_1753212136.jpg', NULL),
(11, 'tonyhanna@gmail.com', '$2y$10$erSrsOrXOJK0duZ3GhDuPehY6Gh9TiDAtgWh0QHCMjH9yKE14JKha', 'Tony', 'Hanna', 'Kfaraakka', 'kfaraakka', NULL, NULL);

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
(1, 1, 1),
(3, 2, 3),
(4, 3, 3),
(5, 4, 3),
(8, 7, 3),
(9, 5, 3),
(11, 8, 1),
(12, 6, 3),
(18, 9, 4),
(20, 11, 6);

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
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `hospital_id` (`hospital_id`);

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
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `emergency_requests`
--
ALTER TABLE `emergency_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `emergency_responses`
--
ALTER TABLE `emergency_responses`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ambulance_locations`
--
ALTER TABLE `ambulance_locations`
  ADD CONSTRAINT `ambulance_locations_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `ambulance_teams` (`team_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ambulance_teams`
--
ALTER TABLE `ambulance_teams`
  ADD CONSTRAINT `ambulance_teams_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
