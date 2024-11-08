-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2022 at 07:41 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `part_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'user-list', 'web', 'user', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(2, 'user-create', 'web', 'user', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(3, 'user-edit', 'web', 'user', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(4, 'user-delete', 'web', 'user', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(5, 'role-list', 'web', 'role', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(6, 'role-create', 'web', 'role', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(7, 'role-edit', 'web', 'role', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(8, 'role-delete', 'web', 'role', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(9, 'class-list', 'web', 'class', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(10, 'class-create', 'web', 'class', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(11, 'class-edit', 'web', 'class', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(12, 'class-delete', 'web', 'class', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(13, 'section-list', 'web', 'section', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(14, 'section-create', 'web', 'section', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(15, 'section-edit', 'web', 'section', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(16, 'section-delete', 'web', 'section', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(17, 'group-list', 'web', 'group', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(18, 'group-create', 'web', 'group', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(19, 'group-edit', 'web', 'group', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(20, 'group-delete', 'web', 'group', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(21, 'subject-list', 'web', 'subject', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(22, 'subject-create', 'web', 'subject', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(23, 'subject-edit', 'web', 'subject', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(24, 'subject-delete', 'web', 'subject', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(25, 'room-list', 'web', 'room', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(26, 'room-create', 'web', 'room', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(27, 'room-edit', 'web', 'room', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(28, 'room-delete', 'web', 'room', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(29, 'assignment-list', 'web', 'assignment', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(30, 'assignment-create', 'web', 'assignment', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(31, 'assignment-edit', 'web', 'assignment', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(32, 'assignment-delete', 'web', 'assignment', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(33, 'syllabus-list', 'web', 'syllabus', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(34, 'syllabus-create', 'web', 'syllabus', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(35, 'syllabus-edit', 'web', 'syllabus', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(36, 'syllabus-delete', 'web', 'syllabus', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(37, 'student-list', 'web', 'student', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(38, 'student-create', 'web', 'student', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(39, 'student-edit', 'web', 'student', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(40, 'student-delete', 'web', 'student', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(41, 'teacher-list', 'web', 'teacher', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(42, 'teacher-create', 'web', 'teacher', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(43, 'teacher-edit', 'web', 'teacher', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(44, 'teacher-delete', 'web', 'teacher', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(45, 'guardian-list', 'web', 'guardian', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(46, 'guardian-create', 'web', 'guardian', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(47, 'guardian-edit', 'web', 'guardian', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(48, 'guardian-delete', 'web', 'guardian', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(49, 'attendace-of-student-list', 'web', 'attendace-of-student', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(50, 'attendace-of-student-create', 'web', 'attendace-of-student', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(51, 'attendace-of-student-edit', 'web', 'attendace-of-student', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(52, 'attendace-of-student-delete', 'web', 'attendace-of-student', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(53, 'attendace-of-teacher-list', 'web', 'attendace-of-teacher', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(54, 'attendace-of-teacher-create', 'web', 'attendace-of-teacher', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(55, 'attendace-of-teacher-edit', 'web', 'attendace-of-teacher', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(56, 'attendace-of-teacher-delete', 'web', 'attendace-of-teacher', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(57, 'notice-list', 'web', 'notice', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(58, 'notice-create', 'web', 'notice', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(59, 'notice-edit', 'web', 'notice', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(60, 'notice-delete', 'web', 'notice', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(61, 'event-list', 'web', 'event', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(62, 'event-create', 'web', 'event', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(63, 'event-edit', 'web', 'event', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(64, 'event-delete', 'web', 'event', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(65, 'holiday-list', 'web', 'holiday', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(66, 'holiday-create', 'web', 'holiday', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(67, 'holiday-edit', 'web', 'holiday', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(68, 'holiday-delete', 'web', 'holiday', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(69, 'leave-category-list', 'web', 'leave-category', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(70, 'leave-category-create', 'web', 'leave-category', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(71, 'leave-category-edit', 'web', 'leave-category', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(72, 'leave-category-delete', 'web', 'leave-category', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(73, 'leave-assign-list', 'web', 'leave-assign', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(74, 'leave-assign-create', 'web', 'leave-assign', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(75, 'leave-assign-edit', 'web', 'leave-assign', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(76, 'leave-assign-delete', 'web', 'leave-assign', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(77, 'leave-apply-list', 'web', 'leave-apply', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(78, 'leave-apply-create', 'web', 'leave-apply', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(79, 'leave-apply-edit', 'web', 'leave-apply', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(80, 'leave-apply-delete', 'web', 'leave-apply', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(81, 'fees-type-list', 'web', 'fees-type', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(82, 'fees-type-create', 'web', 'fees-type', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(83, 'fees-type-edit', 'web', 'fees-type', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(84, 'fees-type-delete', 'web', 'fees-type', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(85, 'fees-assign-list', 'web', 'fees-assign', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(86, 'fees-assign-create', 'web', 'fees-assign', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(87, 'fees-assign-edit', 'web', 'fees-assign', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(88, 'fees-assign-delete', 'web', 'fees-assign', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(89, 'fees-assign-student-list', 'web', 'fees-assign-student', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(90, 'fees-assign-student-create', 'web', 'fees-assign-student', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(91, 'fees-assign-student-edit', 'web', 'fees-assign-student', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(92, 'fees-assign-student-delete', 'web', 'fees-assign-student', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(93, 'payment-of-student-list', 'web', 'payment-of-student', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(94, 'payment-of-student-create', 'web', 'payment-of-student', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(95, 'payment-of-student-edit', 'web', 'payment-of-student', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(96, 'payment-of-student-delete', 'web', 'payment-of-student', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(97, 'mail-list', 'web', 'mail/sMS', '2022-11-08 00:41:16', '2022-11-08 00:41:16'),
(98, 'sms-list', 'web', 'mail/sMS', '2022-11-08 00:41:16', '2022-11-08 00:41:16');
(99, 'admission-list', 'web', 'admission', '2022-11-08 00:41:16', '2022-11-08 00:41:16');
(100, 'admission-create', 'web', 'admission', '2022-11-08 00:41:16', '2022-11-08 00:41:16');
(101, 'admission-edit', 'web', 'admission', '2022-11-08 00:41:16', '2022-11-08 00:41:16');
(102, 'admission-delete', 'web', 'admission', '2022-11-08 00:41:16', '2022-11-08 00:41:16');
(103, 'admission-form-list', 'web', 'admission-form', '2022-11-08 00:41:16', '2022-11-08 00:41:16');
(104, 'admission-form-delete', 'web', 'admission-form', '2022-11-08 00:41:16', '2022-11-08 00:41:16');
(105, 'expense-list', 'web', 'expense', '2022-11-08 00:41:16', '2022-11-08 00:41:16');
(106, 'expense-create', 'web', 'expense', '2022-11-08 00:41:16', '2022-11-08 00:41:16');
(107, 'expense-edit', 'web', 'expense', '2022-11-08 00:41:16', '2022-11-08 00:41:16');
(108, 'expense-delete', 'web', 'expense', '2022-11-08 00:41:16', '2022-11-08 00:41:16');
(109, 'income-list', 'web', 'income', '2022-11-08 00:41:16', '2022-11-08 00:41:16');
(110, 'income-create', 'web', 'income', '2022-11-08 00:41:16', '2022-11-08 00:41:16');
(111, 'income-edit', 'web', 'income', '2022-11-08 00:41:16', '2022-11-08 00:41:16');
(112, 'income-delete', 'web', 'income', '2022-11-08 00:41:16', '2022-11-08 00:41:16');
(113, 'class-routine-list', 'web', 'class-routine', '2022-11-08 00:41:16', '2022-11-08 00:41:16');
(114, 'class-routine-create', 'web', 'class-routine', '2022-11-08 00:41:16', '2022-11-08 00:41:16');
(115, 'class-routine-edit', 'web', 'class-routine', '2022-11-08 00:41:16', '2022-11-08 00:41:16');
(116, 'class-routine-delete', 'web', 'class-routine', '2022-11-08 00:41:16', '2022-11-08 00:41:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
