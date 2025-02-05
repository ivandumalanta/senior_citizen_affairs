-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 04, 2025 at 04:40 AM
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
(22, 'OSCA-Siniloan: Elderly Week Celebration 2019', '2025-02-02', '<p>Senior citizens from various barangays of Siniloan attended the Elderly Week Celebration 2019. It was organized by the Head of OSCA-Siniloan (Mr. Noel L. Serrano) with MUSCA-Siniloan officials led by Mrs. Sonia L. Costelo. The event took place on October 5, 2019 at Municipal Town Plaza, Siniloan, Laguna. The elders enjoyed dancing and chatting with other seniors. Visitors from nearby towns also came to take part in the event. - ITASCo</p>', '../private/activity-img/img_679faca408dd8.jpg', '2025-02-02 17:34:28.038285', '2025-02-02 17:34:28.038285', NULL);

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
(1, 2134, 'e1dfc5124eff7d58d907fad4c161245d0af3d45b9212cae474b188cef443aa1d', '2025-01-31 14:32:25'),
(2, 2134, 'a18e5ebad3000cab68235729bb7092bbcc2cefe7b9bcb55f7a0b9bc4f5515aa5', '2025-01-31 14:33:06'),
(3, 2134, '08faf17a9356b7c617663dca2015d3c89b97ec8350c32b6069a85c2026d4fd79', '2025-01-31 14:33:28'),
(4, 2134, '422fd512b1c20784bc78e735269f28482bffcbf9776858f5070b62a2e0462461', '2025-01-31 14:44:57'),
(5, 2134, '10898fc8f96994211af2f70de760d4ceffbc7a473c0c70187e653a02970d834e', '2025-01-31 14:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `author` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_date` date NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(4, '', 'Training of OSCA Heads in Laguna and Heads Up on House Bill 10423', '2025-02-02', '<p>sfsdfsd</p>', '', 0, '2025-02-01 16:48:04', '2025-02-01 16:48:04', NULL),
(5, '', 'Newly-Formed Commission for Elders in the Philippines', '2025-02-02', '<p>sfsdfsd</p>', '', 0, '2025-02-01 16:52:56', '2025-02-01 16:52:56', NULL);

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
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `deleted_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`osca_id`, `email`, `last_name`, `first_name`, `middle_name`, `suffix`, `sex`, `birth_day`, `address`, `phone_number`, `oneByOne_id_path`, `status`, `member_status`, `classification`, `civil_status`, `blood_type`, `education`, `employment`, `religion`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2134, 'ivandumalanta@gmail.com', 'lachica', 'simon', 'hoere', 'jr', 'male', '1985-01-11', 'san jacinto', 9912398798, NULL, 'pending', 'Inactive', 'Pensioner', 'Married', 'A+', 'High School', 'Self Employed', 'Islam', '2025-01-26 14:28:57.012042', '2025-01-26 14:28:57.012042', NULL),
(3212, NULL, 'Anecito', 'Argie', 'Dumalanta', 'jr', 'male', '1988-03-17', 'san Jacinto', 9912398798, 'asd', 'pending', 'Inactive', 'Pensioner', 'Married', 'A-', 'College', 'Self Employed', 'Iglesia ni Cristo', '2025-01-26 13:43:03.202164', '2025-01-26 13:43:03.202164', NULL),
(3421, NULL, 'barrogga', 'eli', 'dumalanta', 'jr', 'male', '1985-01-16', 'san jacinto', 9912398798, NULL, 'pending', 'Inactive', 'Indigent', 'Seperated', 'B+', 'Vocational', 'Unemployed', 'Roman Catholic', '2025-01-26 13:55:52.146184', '2025-01-26 13:55:52.146184', NULL),
(12314123, NULL, 'dasda', 'dsfsdfd', NULL, '', 'FEMALE', '1992-09-07', 'asdas, Malasiqui, Pangasinan', 991231, 'private/documents/12314123/doc_6791886f6f458.jpg', 'approved', 'Active', 'Supported', 'Single', 'O+', 'College', 'Unemployed', 'Roman Catholic', '2025-01-23 00:08:15.461500', '2025-01-23 00:08:15.461500', NULL),
(23423423, NULL, 'asdasdas', 'fsdfsdf', 'dasdasd', '', 'MALE', '1991-08-17', 'asdsadsadsa, Malasiqui, Pangasinan', 99928423, 'private/documents/23423423/doc_6791b34f4e533.jpg', 'approved', 'Passed Away', 'Indigent', 'Divorced', 'O+', 'Elementary', 'Employed', 'Roman Catholic', '2025-01-23 03:11:11.322006', '2025-01-23 03:11:11.322006', NULL),
(234234234234, NULL, 'Innovhub', 'asdas', NULL, 'JR', 'Male', '1992-03-15', 'asdasdasd, Malasiqui, Pangasinan', 912312312, 'private/documents/234234234234/doc_67988d568be70.png', 'pending', NULL, 'Pensioner', 'Married', 'B+', 'College', 'Self Employed', 'Bible Baptist Church', '2025-01-28 07:55:02.573446', '2025-01-28 07:55:02.573446', NULL);

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
(12314123, 'private/signature/12314123/sig_6791886f6e703.jpg', '[\"private/documents/12314123/doc_6791886f6f458.jpg\"]'),
(23423423, 'private/signature/23423423/sig_6791b34f4e077.jpg', '[\"private/documents/23423423/doc_6791b34f4e533.jpg\"]'),
(234234234234, 'private/signature/234234234234/sig_67988d568bccc.png', '[\"private/documents/234234234234/doc_67988d568be70.png\"]');

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
-- Indexes for table `news`
--
ALTER TABLE `news`
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
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `email_verifications`
--
ALTER TABLE `email_verifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `email_verifications`
--
ALTER TABLE `email_verifications`
  ADD CONSTRAINT `email_verifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`osca_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD CONSTRAINT `user_documents_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`osca_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
