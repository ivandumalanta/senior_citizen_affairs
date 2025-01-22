-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 22, 2025 at 04:04 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `senior_citizen_affairs`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `osca_id` bigint NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suffix` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_day` date NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` bigint NOT NULL,
  `oneByOne_id_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `deleted_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`osca_id`, `last_name`, `first_name`, `middle_name`, `suffix`, `sex`, `birth_day`, `address`, `phone_number`, `oneByOne_id_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2221212, 'dasdasdasd', 'asdsd', 'adasdd', '', 'MALE', '1962-09-13', 'nilombot, Malasiqui, Pangasinan', 23423423, 'private/OneByOne_ID/2221212/img_67906cd9c56ed.jpg', '2025-01-22 03:58:17.810682', '2025-01-22 03:58:17.810682', NULL),
(12314123, 'dasda', 'sadas', 'dfsdfsd', 'I', 'FEMALE', '1963-02-16', 'asdas, Malasiqui, Pangasinan', 9909999, 'private/OneByOne_ID/12314123/img_67906e1731029.jpg', '2025-01-22 04:03:35.202240', '2025-01-22 04:03:35.202240', NULL),
(23432423, 'dsfsdf', 'sdfsdfsdf', 'sfsdfsd', 'JR', 'MALE', '1960-02-14', 'sdfsdlkflsdf, Malasiqui, Pangasinan', 999349343, NULL, '2025-01-22 02:51:58.835030', '2025-01-22 02:51:58.835030', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_documents`
--

CREATE TABLE `user_documents` (
  `id` bigint NOT NULL,
  `barangay_cert` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_cert` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_valid_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `second_valid_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`osca_id`);

--
-- Indexes for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD CONSTRAINT `user_documents_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`osca_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
