-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 06, 2025 at 06:29 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_page_edits`
--

CREATE TABLE `about_page_edits` (
  `id` int(11) UNSIGNED NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `section` varchar(50) NOT NULL,
  `old_content` text NOT NULL,
  `new_content` text NOT NULL,
  `edit_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_page_edits`
--

INSERT INTO `about_page_edits` (`id`, `admin_email`, `section`, `old_content`, `new_content`, `edit_date`) VALUES
(1, 'ryleepamintuan@gmail.com', 'mission', 'To provide superior transport service to Metro Manila and Mindoro Province commuters.', 'To provide superior transport service to Metro Manila and Mindoro Province commuters', '2025-09-06 04:21:45'),
(2, 'ryleepamintuan@gmail.com', 'history', 'Photo taken on October 16, 1993. Napat Transit (now Dimple Star Transport) NVR-963 (fleet No 800) going to Alabang and jeepneys under the Light Rail Line in Taft Ave near United Nations Avenue, Ermita, Manila, Philippines. Year 2004 of May changes has been made, Napat Transit became Dimple Star Transport.', 'Photo taken on October 16, 1993. Napat Transit (now Dimple Star Transport) NVR-963 (fleet No 800) going to Alabang and jeepneys under the Light Rail Line in Taft Ave near United Nations Avenue, Ermita, Manila, Philippines. Year 2004 of May changes has been made, Napat Transit became Dimple Star Transporter.', '2025-09-06 04:22:08'),
(3, 'ryleepamintuan@gmail.com', 'history', 'Photo taken on October 16, 1993. Napat Transit (now Dimple Star Transport) NVR-963 (fleet No 800) going to Alabang and jeepneys under the Light Rail Line in Taft Ave near United Nations Avenue, Ermita, Manila, Philippines. Year 2004 of May changes has been made, Napat Transit became Dimple Star Transport.', 'Photo taken on October 16, 1993. Napat Transit (now Dimple Star Transport) NVR-963 (fleet No 800) going to Alabang and jeepneys under the Light Rail Line in Taft Ave near United Nations Avenue, Ermita, Manila, Philippines. Year 2004 of May changes has been made, Napat Transit became Dimple Star Transport.', '2025-09-06 04:25:09');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) UNSIGNED NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `salt` varchar(3) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `fname`, `lname`, `email`, `salt`, `password`, `role`, `reg_date`) VALUES
(1, 'Rylee', 'Pamintuan', 'ryleepamintuan@gmail.com', '7cf', '7e4f953d5eee8357717190bb4e579fecb3266707054b7f3a43c4ca6d127a3b3e', 'admin', '2025-09-06 04:09:14'),
(2, 'Miguel', 'Pamintuan', 'miguelpamintuan@gmail.com', '64a', '14b3d2675f7b129a29e3298b4dcc8ca42bb737645a61676a6c777fb221b88360', 'user', '2025-09-06 04:28:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_page_edits`
--
ALTER TABLE `about_page_edits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_email` (`admin_email`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_page_edits`
--
ALTER TABLE `about_page_edits`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `about_page_edits`
--
ALTER TABLE `about_page_edits`
  ADD CONSTRAINT `about_page_edits_ibfk_1` FOREIGN KEY (`admin_email`) REFERENCES `members` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
