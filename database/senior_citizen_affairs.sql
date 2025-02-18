-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 18, 2025 at 08:27 PM
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
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_date` date NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `deleted_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `title`, `activity_date`, `content`, `image_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(19, 'Tulong para sa Evacuees ng Bulkang Taal', '2025-01-23', '<p><strong>The Importance of Work-Life Balance</strong></p>\r\n<p>In today\'s fast-paced world, achieving work-life balance is more important than ever. Many professionals struggle to juggle career demands with personal life, leading to stress and burnout. Maintaining a healthy balance ensures improved productivity, better mental health, and stronger relationships.</p>\r\n<p>Setting clear boundaries between work and personal time is crucial. Prioritizing tasks, taking regular breaks, and engaging in hobbies can help maintain overall well-being. Employers also play a role by promoting flexible schedules and encouraging employees to take time off when needed.</p>\r\n<p>Spending quality time with family, exercising, and practicing mindfulness can significantly improve work efficiency and overall happiness. Small changes, like avoiding work emails after office hours or dedicating weekends to personal interests, can make a big difference.</p>\r\n<p>In the end, balancing work and life is essential for long-term success and fulfillment. A well-balanced life leads to greater happiness, motivation, and overall satisfaction.</p>', '../private/news-img/img_679b2c4c44a47.png', '2025-01-30 07:37:48.281862', '2025-01-30 07:37:48.281862', NULL),
(20, 'Giving Award to Centenarian', '2025-01-31', '<p>fgdfgdfgdfg</p>', '../private/news-img/img_679c59eaeb48b.png', '2025-01-31 05:04:42.964359', '2025-01-31 05:04:42.964359', NULL),
(21, 'Libreng Gupit para sa mga Senior Citizens', '2025-01-16', '<p>dfgdgdfg</p>', '../private/news-img/img_679c5a9b28c6f.png', '2025-01-31 05:07:39.167652', '2025-01-31 05:07:39.167652', NULL),
(22, 'OSCA-Siniloan: Elderly Week Celebration 2019', '2025-02-02', '<p>Senior citizens from various barangays of Siniloan attended the Elderly Week Celebration 2019. It was organized by the Head of OSCA-Siniloan (Mr. Noel L. Serrano) with MUSCA-Siniloan officials led by Mrs. Sonia L. Costelo. The event took place on October 5, 2019 at Municipal Town Plaza, Siniloan, Laguna. The elders enjoyed dancing and chatting with other seniors. Visitors from nearby towns also came to take part in the event. - ITASCo.</p>', '../private/activity-img/img_679faca408dd8.jpg', '2025-02-02 17:34:28.038285', '2025-02-02 17:34:28.038285', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_credentials`
--

CREATE TABLE `admin_credentials` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_credentials`
--

INSERT INTO `admin_credentials` (`id`, `username`, `password`, `name`) VALUES
(2, 'admin', '$2y$10$Qn1aay6sMUfCYnP71Xvx2.4iAdN2k9xX9SG8fibTbtDMK3FmOvj3q', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `email_verifications`
--

CREATE TABLE `email_verifications` (
  `id` int NOT NULL,
  `user_id` bigint NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_verifications`
--

INSERT INTO `email_verifications` (`id`, `user_id`, `token`, `expires_at`) VALUES
(7, 234234234237, 'e6a4edd9b97ed7a683cbbba6ac9c36c4de7d9aacd743d7772f8e3c3a59eda311', '2025-02-18 16:23:25'),
(8, 234234234237, '6b13436b10976dd3e69eb4a742f5e1db207aca33ea0bf2243fb7cd15c1ed76dc', '2025-02-18 16:40:29'),
(9, 234234234237, '218c06048865f0c707a34532b3f36047b69d0349da3d04342c1662b4fbef5f01', '2025-02-18 16:47:05'),
(10, 234234234237, 'f397e041344e72c0d6b2f434182ee9a8ef81daa0ffb2be9b5331ace1f64f699d', '2025-02-18 16:47:19'),
(11, 234234234237, 'b16c82503bdba9de829e6c6b0ead539a8d816350b0cb14eed4bb3e9ead9d102e', '2025-02-18 16:51:20'),
(13, 234234234237, '57a9be92827a7c3bbefbcc197e12d5ebab24c14b9068376b9f03291ee9a65067', '2025-02-18 16:55:43'),
(14, 234234234237, '45a8c0e0ca9110c6a024ae0afab01f63d32ada32203f9b72f9048d393cbb8d63', '2025-02-18 17:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `request_type` enum('Walk-in','Document Submission') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `start`, `end`, `request_type`, `status`, `created_at`) VALUES
(26, 'document submission', '2025-02-19 08:00:00', '2025-02-19 09:00:00', 'Walk-in', 'pending', '2025-02-18 20:00:17');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `sender_id` bigint NOT NULL,
  `receiver_id` bigint NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `timestamp`) VALUES
(1, 2, 234234234235, 'sdadadas', '2025-02-08 18:05:21'),
(2, 2, 234234234235, 'asdasda', '2025-02-08 18:10:42'),
(3, 2, 234234234235, 'sdsfdfsd', '2025-02-08 18:17:39'),
(4, 2, 234234234237, 'hi', '2025-02-09 06:43:04'),
(5, 234234234237, 2, 'sadasdas', '2025-02-09 06:53:23'),
(6, 234234234237, 2, 'hi admin', '2025-02-11 17:20:03'),
(7, 234234234237, 2, 'asda', '2025-02-11 18:02:21'),
(8, 234234234239, 2, 'hi', '2025-02-17 19:50:39');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `author` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_date` date NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `headline` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `author`, `title`, `news_date`, `content`, `image_path`, `headline`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ivannnn', 'Salceda eyes separate PhilHealth insurance fund for seniors', '2025-02-02', '<p>At haha a glance House Committee on Ways and Means Chairman Albay 2nd district Rep. Joey Salceda says he is exploring the prospect of a separate insurance fund under the Philippine Health Insurance Corp. (PhilHealth) to address the healthcare financing gap of senior citizens.</p>', '../private/news-img/news_679e4cf5dafb7.jpg', 1, '2025-02-01 16:33:57', '2025-02-01 16:33:57', NULL),
(2, '', 'BMH President Visits Cebu City to Discuss PWD and Senior Citizen Programs', '2025-02-02', '<p>Cebu City – On the afternoon of July 23, 2024, at 3:15 PM, Mr. Denis Reyes and his wife Cherry met with Mayor Raymond Garcia of Cebu City to discuss programs for Persons with Disabilities (PWDs) and senior citizens. The meeting was a brief yet significant discussion on enhancing the city\'s initiatives for these important community groups. During the meeting, Mr. Reyes expressed his sincere gratitude to Dr. Alice Utlang, Cebu City Veterinarian, for her instrumental role in facilitating the discussion. He acknowledged Dr. Utlang\'s efforts in organizing the meeting, which enabled productive conversations on how to improve services for PWDs and senior citizens in Cebu City. Mayor Garcia emphasized the city\'s commitment to enhancing the lives of PWDs and senior citizens, stressing the importance of community collaboration in achieving these objectives. The visit by Mr. and Mrs. Reyes highlighted the active engagement and advocacy within the community to ensure that these programs receive the necessary attention and resources. This meeting represents another step forward in Cebu City\'s dedication to fostering inclusive and supportive environments for all residents, showcasing the power of collaboration between city officials and community members. || Idohna Sigue</p>', '', 0, '2025-02-01 16:44:34', '2025-02-01 16:44:34', NULL),
(3, '', 'Gov\'t asks for \'small sacrifice\' from senior citizens', '2025-02-02', '<p>sfsdfsd</p>', '', 0, '2025-02-01 16:45:03', '2025-02-01 16:45:03', NULL),
(4, '', 'Training of OSCA Heads in Laguna and Heads Up on House Bill 10423', '2025-02-02', '<p>sfsdfsd</p>', '', 0, '2025-02-01 16:48:04', '2025-02-01 16:48:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `otp_verification`
--

CREATE TABLE `otp_verification` (
  `id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otp_verification`
--

INSERT INTO `otp_verification` (`id`, `email`, `otp`, `created_at`, `expires_at`) VALUES
(4, 'ivandumalanta@gmail.com', '404694', '2025-02-11 19:51:14', '2025-02-13 12:06:14');

-- --------------------------------------------------------

--
-- Table structure for table `reset_tokens`
--

CREATE TABLE `reset_tokens` (
  `id` int NOT NULL,
  `user_id` bigint NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reset_tokens`
--

INSERT INTO `reset_tokens` (`id`, `user_id`, `token`, `expires_at`, `created_at`) VALUES
(6, 234234234237, '6d11a88b37e820056a03188c9ccc08eb2852568bd9087fb9dd59a6cd6034a298', '2025-02-13 02:31:24', '2025-02-12 17:31:24'),
(8, 234234234237, '303ccf41a5bf2470b959bf9b870efddbe74251ea2aa1356097efdf589b7dd980', '2025-02-13 02:32:48', '2025-02-12 17:32:48'),
(9, 234234234237, 'ab5c3141772f3a3d69c10986610bd04ff9f8db2e60fbac5c41e20988bb45bc14', '2025-02-13 02:41:42', '2025-02-12 17:41:42'),
(10, 234234234237, '5b7b9e163473ba07ccc7bf652874915376b52dd6ebbf32e7174eb07502e195ea', '2025-02-13 02:44:15', '2025-02-12 17:44:15'),
(11, 234234234237, 'fdf4db035e86334704c049b24c8200e2bc27a1e4d82b80582d79bd5bd0b6a233', '2025-02-13 02:48:41', '2025-02-12 17:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `osca_id` bigint NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suffix` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_day` date NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` bigint NOT NULL,
  `oneByOne_id_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `member_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `classification` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `civil_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `blood_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `education` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employment` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `deleted_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`osca_id`, `email`, `last_name`, `first_name`, `middle_name`, `suffix`, `sex`, `birth_day`, `address`, `phone_number`, `oneByOne_id_path`, `status`, `member_status`, `classification`, `civil_status`, `blood_type`, `education`, `employment`, `religion`, `username`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(234234234235, NULL, 'de vera', 'maria sheena viah', 'dumalanta', '', 'Female', '1930-10-07', 'dumapot, Malasiqui, Pangasinan', 9912398598, 'private/documents/234234234235/doc_67a7720e7b1c3.png', 'approved', NULL, 'Supported', 'Separated', 'B+', 'College', 'Employed', 'Islam', 'oneentis', '123123123', '2025-02-08 15:02:38.507749', '2025-02-08 15:02:38.507749', NULL),
(234234234236, 'mermae@gmail.com', 'roldan', 'mermae', 'de vera', '', 'Female', '1930-03-03', 'awai san jacinto pangasinan, Malasiqui, Pangasinan', 9912398598, 'private/documents/234234234236/doc_67a77fdb1f3b2.png', 'approved', NULL, 'Pensioner', 'Married', 'O+', 'Vocational', 'Self Employed', 'Roman Catholic', 'Mermae', '12441244@@', '2025-02-08 16:01:31.132658', '2025-02-08 16:01:31.132658', NULL),
(234234234237, 'dumalantaichristian@gmail.com', 'zamora', 'zia', NULL, '', 'Female', '1930-02-11', 'dumapot, Malasiqui, Pangasinan', 9912398797, 'private/documents/234234234237/doc_67a78475f1e1d.png', 'approved', NULL, 'Pensioner', 'Married', 'B+', 'College', 'Self Employed', 'Seventh-day Adventist', 'ziazamora', 'qwerty123', '2025-02-08 16:21:09.993978', '2025-02-08 16:21:09.993978', NULL),
(234234234238, 'ivandsdsanta@gmail.com', 'fdsf', 'fsfsfsdfs', 'sdsdfsd', 'SR', 'Male', '1963-12-12', 'asdsad, Malasiqui, Pangasinan', 132132132131, 'private/OneByOne_ID/234234234238/img_67b172d0be03a.jpg', 'declined', NULL, 'Pensioner', 'Divorced', 'O+', 'Elementary', 'Employed', 'Roman Catholic', 'ivan', 'qwerty', '2025-02-16 05:08:32.783801', '2025-02-16 05:08:32.783801', NULL),
(234234234239, 'dumalaqwetian@gmail.com', 'dasda', 'adsad', 'asdsad', 'JR', 'Male', '1990-08-17', 'aweq, Malasiqui, Pangasinan', 1312, 'private/OneByOne_ID/234234234239/img_67b379c92f313.jpg', 'approved', NULL, 'Supported', 'Divorced', 'O+', 'Elementary', 'Employed', 'Roman Catholic', 'admin', 'qwe', '2025-02-17 18:02:49.197846', '2025-02-17 18:02:49.197846', NULL),
(234234234241, 'ivandumalanta@gmail.com', 'adasda', 'asdasd', NULL, '', 'Male', '1960-04-08', 'asdas, Malasiqui, Pangasinan', 1123123, 'private/OneByOne_ID/234234234241/img_67b3926e8ea28.jpg', 'approved', NULL, 'Indigent', 'Separated', 'O+', 'Elementary', 'Employed', 'Roman Catholic', 'admin', 'qwe', '2025-02-17 19:47:58.590395', '2025-02-17 19:47:58.590395', NULL);

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
(234234234235, 'private/signature/234234234235/sig_67a7720e783e2.png', '[\"private/documents/234234234235/doc_67a7720e78e86.png\", \"private/documents/234234234235/doc_67a7720e79574.png\", \"private/documents/234234234235/doc_67a7720e7a122.png\", \"private/documents/234234234235/doc_67a7720e7b1c3.png\"]'),
(234234234236, 'private/signature/234234234236/sig_67a77fdb1540c.png', '[\"private/documents/234234234236/doc_67a77fdb1ecc2.png\", \"private/documents/234234234236/doc_67a77fdb1f3b2.png\"]'),
(234234234237, 'private/signature/234234234237/sig_67a78475ef613.png', '[\"private/documents/234234234237/doc_67a78475f0057.png\", \"private/documents/234234234237/doc_67a78475f060a.png\", \"private/documents/234234234237/doc_67a78475f1e1d.png\"]'),
(234234234238, 'private/signature/234234234238/sig_67b172d0be663.jpg', '[\"private/documents/234234234238/doc_67b172d0bed79.jpg\"]'),
(234234234239, 'private/signature/234234234239/sig_67b379c92f877.jpg', '[\"private/documents/234234234239/doc_67b379c92fef1.jpg\"]'),
(234234234241, 'private/signature/234234234241/sig_67b3926e8f2b7.jpg', '[\"private/documents/234234234241/doc_67b3926e8f7dc.jpg\"]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_verifications`
--
ALTER TABLE `email_verifications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_verification`
--
ALTER TABLE `otp_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset_tokens`
--
ALTER TABLE `reset_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `email_verifications`
--
ALTER TABLE `email_verifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `otp_verification`
--
ALTER TABLE `otp_verification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reset_tokens`
--
ALTER TABLE `reset_tokens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `email_verifications`
--
ALTER TABLE `email_verifications`
  ADD CONSTRAINT `email_verifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`osca_id`) ON DELETE CASCADE;

--
-- Constraints for table `reset_tokens`
--
ALTER TABLE `reset_tokens`
  ADD CONSTRAINT `reset_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`osca_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD CONSTRAINT `user_documents_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`osca_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
