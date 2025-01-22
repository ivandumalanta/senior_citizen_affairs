-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jan 22, 2025 at 08:08 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.10

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
-- Table structure for table `admin_credentials`
--

CREATE TABLE `admin_credentials` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_credentials`
--

INSERT INTO `admin_credentials` (`id`, `username`, `password`, `name`) VALUES
(2, 'sca.admin@gmail.com', '$2y$10$Qn1aay6sMUfCYnP71Xvx2.4iAdN2k9xX9SG8fibTbtDMK3FmOvj3q', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `osca_id` bigint NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suffix` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_day` date NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` bigint NOT NULL,
  `oneByOne_id_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `deleted_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`osca_id`, `last_name`, `first_name`, `middle_name`, `suffix`, `sex`, `birth_day`, `address`, `phone_number`, `oneByOne_id_path`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4234, 'dfsdf', 'sfsdf', 'ssdfdsf', '', 'MALE', '1993-06-14', 'dasdsad, Malasiqui, Pangasinan', 12321312, 'private/OneByOne_ID/4234/img_6790c789e8800.png', 'pending', '2025-01-22 10:25:13.953115', '2025-01-22 10:25:13.953115', NULL),
(34342, 'Dumalanta', 'Ivan Christian', NULL, '', 'MALE', '1955-09-15', 'asdasd, Malasiqui, Pangasinan', 12321312, 'private/OneByOne_ID/34342/img_67909cac72e67.png', 'pending', '2025-01-22 07:22:20.471023', '2025-01-22 07:22:20.471023', NULL),
(43534, 'sdfsd', 'sfsfsdf', NULL, '', 'MALE', '1962-06-13', 'sdfsdfsd, Malasiqui, Pangasinan', 23423432, 'private/OneByOne_ID/43534/img_6790c6c5e0139.png', 'pending', '2025-01-22 10:21:57.918657', '2025-01-22 10:21:57.918657', NULL),
(123123, 'sdaasd', 'asdasd', NULL, '', 'MALE', '1999-11-16', 'asdasdasd, Malasiqui, Pangasinan', 234234, 'private/OneByOne_ID/123123/img_6790c932ddb90.png', 'pending', '2025-01-22 10:32:18.908835', '2025-01-22 10:32:18.908835', NULL),
(2221212, 'dasdasdasd', 'asdsd', 'adasdd', '', 'MALE', '1962-09-13', 'nilombot, Malasiqui, Pangasinan', 23423423, 'private/OneByOne_ID/2221212/img_67906cd9c56ed.jpg', 'pending', '2025-01-22 03:58:17.810682', '2025-01-22 03:58:17.810682', NULL),
(2323423, 'dsfsdf', 'sdfsdf', NULL, '', 'MALE', '1962-10-13', 'asdsadsad, Malasiqui, Pangasinan', 993292131, 'private/OneByOne_ID/2323423/img_6790bbd9c6f23.png', 'pending', '2025-01-22 09:35:21.815661', '2025-01-22 09:35:21.815661', NULL),
(4543534, 'sdfs', 'sdfsd', NULL, '', 'MALE', '1999-10-16', 'sdasdas, Malasiqui, Pangasinan', 243234, 'private/documents/4543534/doc_6790ca899f460.png', 'pending', '2025-01-22 10:38:01.652705', '2025-01-22 10:38:01.652705', NULL),
(234324324, 'sdfsdf', 'sdfsfds', NULL, '', 'MALE', '1999-10-17', 'rwrwer, Malasiqui, Pangasinan', 23423423, 'private/documents/234324324/doc_6790ccc5bc58a.png', 'pending', '2025-01-22 10:47:33.771868', '2025-01-22 10:47:33.771868', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_documents`
--

CREATE TABLE `user_documents` (
  `id` bigint NOT NULL,
  `signature_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `documents_path` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_documents`
--

INSERT INTO `user_documents` (`id`, `signature_id`, `documents_path`) VALUES
(4234, 'private/signature/4234/sig_6790c789e8a2b.png', NULL),
(4543534, 'private/signature/4543534/sig_6790ca899f15b.png', '[\"private/documents/4543534/doc_6790ca899f251.png\", \"private/documents/4543534/doc_6790ca899f316.png\", \"private/documents/4543534/doc_6790ca899f460.png\"]'),
(234324324, 'private/signature/234324324/sig_6790ccc5bc1f7.png', '[\"private/documents/234324324/doc_6790ccc5bc493.png\", \"private/documents/234324324/doc_6790ccc5bc58a.png\"]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
