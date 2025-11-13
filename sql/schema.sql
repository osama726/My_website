-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2025 at 04:39 AM
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
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `phone`, `subject`, `message`, `is_read`, `created_at`) VALUES
(14, 'Osama Gamal', 'abdelrehem@mm.com', '01098154424', 'empty', 'ياارااااب', 0, '2025-11-07 01:05:17'),
(15, 'Osama Gamal', 'oosamaaggamall@gmail.com', '01098154424', 'test', 'Are you okay?', 1, '2025-11-07 01:05:55');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `github_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `image`, `link`, `github_link`, `created_at`) VALUES
(7, 'Blog Website', 'A small blog site that allows creating, editing and deleting comments using Laravel.', 'blog.png', '', NULL, '2025-11-04 03:50:35'),
(8, 'Personal page project', 'I started using html & css only after I learned everything related to them and added how to deal with different screens.', 'personal.png', 'https://osamaa.rf.gd/index.html?i=1#home', 'https://github.com/osama726/My_website', '2025-11-04 03:51:23'),
(9, 'Pharma Friend', 'A medical website that provides patients with access to everything they need in the medical field on the back-end using PHP & MySQL.', 'pharma.png', 'https://pharmafriend.gt.tc/pharma_friend/front/home_page.php?i=1', 'https://github.com/osama726/Pharma-friend', '2025-11-04 03:52:04'),
(14, 'Contact Form with PHP & PHPMailer', 'A simple but complete contact form built with PHP and PHPMailer for backend email handling.\r\nIncludes jQuery validation and a responsive Bootstrap UI. Hosted online for live demo.', '1762287289_contact (2).jpg', 'https://contact.free.nf/index.php?i=1', 'https://github.com/osama726/My_website', '2025-11-04 20:14:49');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `bio_text` text DEFAULT NULL,
  `cv_link` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `years_of_experience` int(11) DEFAULT 0,
  `current_job_status` varchar(50) DEFAULT 'Freelancer',
  `is_available_for_work` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `full_name`, `bio_text`, `cv_link`, `profile_image`, `years_of_experience`, `current_job_status`, `is_available_for_work`) VALUES
(1, 'Osama Gamal', 'I\'m Osama, a fresh graduate from Delta Academy, majoring in Computer Science and Management Information Systems. I develop websites using PHP and Laravel, Mysql. I have worked on various projects, including a personal website and a medical website offering medical services to patients.', 'cv-1762668480.pdf', 'profile-1762659881.jpg', 1, 'Open to Work', 1);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `icon`, `created_at`) VALUES
(1, 'Laravel', 'fa-brands fa-laravel', '2025-11-03 01:01:49'),
(3, 'php', 'fa-brands fa-php', '2025-10-29 02:28:37'),
(4, 'Git', 'bi bi-git', '2025-10-29 02:29:47'),
(6, 'MySQL', 'bi bi-database', '2025-11-03 00:56:17'),
(7, 'CSS', 'fa-brands fa-css3', '2025-11-03 00:57:03'),
(8, 'Bootstrap', 'bi bi-bootstrap', '2025-11-03 00:59:06'),
(9, 'Html', 'fa-brands fa-html5', '2025-11-03 01:00:41'),
(11, 'Js', 'bi bi-javascript', '2025-11-10 08:00:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `created_at`, `role`) VALUES
(1, 'Osama Gamal', 'oosamaaggamall@gmail.com', '$2y$10$17VxB/oTnpMf1g5chAyg6eKZGUt6Sf7TDfuP9IEdXLFZ3Fl9KysFi', 1098154424, '2025-10-29 16:20:29', 'admin'),
(12, 'mohamed', 'mohamed@gmail.com', '$2y$10$FIvUzB3Xantc2zHj/Eyw1..Y.pDXdR7dqRRXov.QuKMj8UrEU05cW', 1024878453, '2025-10-30 01:56:52', 'user'),
(13, 'ahmed', 'ahmed@gmail.com', '$2y$10$NtjUTYOZPMl9HYDEzZIIPuosIX3/KGcRL2eFCN6XgqqmE7kGgg7DO', 1010101010, '2025-11-02 01:53:05', 'user'),
(15, 'adel', 'adel@gmail.com', '$2y$10$C9fwCvE/QRLsscmDgYAVvOVGKaWtXrmhM1QOLMXKb1yR2fa4Hg4ai', 123456978, '2025-11-02 01:59:52', 'user'),
(16, 'eman', 'eman@gmail.com', '$2y$10$lqHk6xfs3X9PrqdA0BYmX.womzwNTC0Lxy3vgu4CY0pPaPIO5aOqi', 103184864, '2025-11-02 02:03:15', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
