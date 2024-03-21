-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2024 at 10:34 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admins`
--

CREATE TABLE `tbl_admins` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `status` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_admins`
--

INSERT INTO `tbl_admins` (`id`, `name`, `username`, `password`, `email`, `phone`, `address`, `photo`, `status`) VALUES
(1, 'Asif Ahmed Rafi', 'admin', 'admin', 'rafiahmed221@gmail.com', '01534982412', 'Dhaka, Bangladesh', 'upload/1705944651.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_books`
--

CREATE TABLE `tbl_books` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `books_name` varchar(50) NOT NULL,
  `books_image` varchar(5000) NOT NULL,
  `books_author_name` varchar(50) NOT NULL,
  `books_publication_name` varchar(50) NOT NULL,
  `books_purchase_date` date NOT NULL,
  `books_price` varchar(10) NOT NULL,
  `books_quantity` varchar(20) NOT NULL,
  `books_availability` varchar(20) NOT NULL,
  `librarian_username` varchar(20) NOT NULL,
  `isbn_no` varchar(50) DEFAULT NULL,
  `added_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_books`
--

INSERT INTO `tbl_books` (`id`, `category_id`, `books_name`, `books_image`, `books_author_name`, `books_publication_name`, `books_purchase_date`, `books_price`, `books_quantity`, `books_availability`, `librarian_username`, `isbn_no`, `added_by`) VALUES
(1, 1, 'Theoretical Numerical Analysis', 'books-image/5ebaa3080bb0327177a67d697223498a41GxQsLNarL._SX328_BO1,204,203,200_.jpg', 'Kendall Atkinson', 'Dover Publications', '2015-03-19', '420', '43', '43', 'admin', '978-3-16-148410-1', ''),
(2, 2, 'Health Informatics', 'books-image/9749fdc83fefbcc9cf3a55b16c7a353041SZngIJfuL._SX389_BO1,204,203,200_.jpg', 'Nancy Staggers', 'Elsevier Mosby', '2012-03-19', '480', '11', '11', 'admin', '978-3-16-148410-2', ''),
(3, 3, 'Digital Image Processing', 'books-image/f5546d1614746fed61c4162163d81a59196018.jpg', 'Rafael C. Gonzalez', 'Prentice Hall', '2020-03-19', '500', '22', '22', 'admin', '978-3-16-148410-3', ''),
(6, 1, 'Artificial Intelligence', 'books-image/17385102edb4831bab1b8b0577389d5e0133001989.jpg', ' Peter Norvig', 'Dover Publications', '2025-03-19', '420', '30', '30', 'admin', '978-3-16-148410-4', ''),
(7, 3, 'Parallel and Distributed Processing', 'books-image/1554233254.jpg', 'Jose Rolim', 'Elsevier Science', '2024-03-02', '350', '14', '14', 'admin', '978-3-16-148410-5', ''),
(8, 2, 'The Guest Book: A Novel', 'books-image/1568430614.jpg', 'test', 'test', '2010-05-19', '200', '10', '10', 'admin', '978-3-16-148410-6', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `category_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Finance', 1, '2024-03-02 02:15:56', '2024-03-02 02:12:33'),
(2, 'English', 1, '2024-03-02 02:16:01', '2024-03-02 02:12:43'),
(5, 'Banking', 1, '2024-03-02 02:40:07', '2024-03-02 02:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_files`
--

CREATE TABLE `tbl_files` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_files`
--

INSERT INTO `tbl_files` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, 'backup/backup_2024-03-14_02-04-26.sql', '2024-03-14 07:04:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fines`
--

CREATE TABLE `tbl_fines` (
  `id` int(11) NOT NULL,
  `issues_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `books_id` int(11) NOT NULL,
  `fine` float(16,2) NOT NULL,
  `over_due_day` int(11) NOT NULL DEFAULT 0,
  `interest_per_day` float(16,2) NOT NULL COMMENT 'it will be persent %',
  `total_interest` float(16,2) NOT NULL DEFAULT 0.00,
  `total_fine` float(16,2) NOT NULL,
  `pay_date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_fines`
--

INSERT INTO `tbl_fines` (`id`, `issues_id`, `user_id`, `books_id`, `fine`, `over_due_day`, `interest_per_day`, `total_interest`, `total_fine`, `pay_date`, `status`, `created_at`) VALUES
(1, 0, 67, 2, 30.00, 0, 10.00, 0.00, 58.46, '2024-02-28 00:00:00', 1, '2024-02-29 02:35:59'),
(2, 0, 71, 3, 30.00, 0, 10.00, 0.00, 137.85, '2024-03-08 00:00:00', 1, '2024-03-08 20:21:44'),
(3, 0, 71, 3, 30.00, 0, 10.00, 0.00, 151.63, '2024-03-20 00:00:00', 1, '2024-03-09 21:49:26'),
(4, 0, 71, 8, 30.00, 0, 10.00, 0.00, 33.00, '2024-03-20 00:00:00', 1, '2024-03-09 22:06:21'),
(5, 37, 71, 6, 30.00, 2, 10.00, 0.00, 36.30, '2024-03-20 00:00:00', 1, '2024-03-13 23:15:30'),
(6, 38, 71, 6, 30.00, 2, 10.00, 0.00, 36.30, '2024-03-13 00:00:00', 1, '2024-03-13 23:19:51'),
(7, 39, 71, 7, 30.00, 12, 10.00, 64.15, 94.15, '2024-03-13 00:00:00', 1, '2024-03-13 23:44:18'),
(8, 41, 72, 2, 30.00, 1, 10.00, 3.00, 33.00, '2024-03-14 00:00:00', 1, '2024-03-14 07:36:26'),
(9, 40, 72, 3, 30.00, 2, 10.00, 6.30, 36.30, '2024-03-14 00:00:00', 1, '2024-03-14 07:36:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_issues`
--

CREATE TABLE `tbl_issues` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `books_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `issued_date` datetime NOT NULL DEFAULT current_timestamp(),
  `return_date` datetime DEFAULT NULL,
  `issued_by` int(11) NOT NULL,
  `issued_utype` varchar(55) NOT NULL,
  `actual_return_date` datetime DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_issues`
--

INSERT INTO `tbl_issues` (`id`, `user_id`, `books_id`, `request_id`, `issued_date`, `return_date`, `issued_by`, `issued_utype`, `actual_return_date`, `is_read`) VALUES
(33, 67, 2, 1, '2024-02-29 01:41:43', '2024-03-28 00:00:00', 2, 'admin', '2024-02-28 00:00:00', 1),
(34, 71, 3, 11, '2024-03-08 11:30:52', '2024-04-06 00:00:00', 71, '', '2024-03-08 00:00:00', 1),
(35, 71, 3, 12, '2024-03-09 21:49:15', '2024-04-07 00:00:00', 71, 'admin', '2024-03-09 00:00:00', 1),
(36, 71, 8, 13, '2024-02-09 22:04:20', '2024-03-07 00:00:00', 0, '', '2024-03-09 00:00:00', 1),
(37, 71, 6, 14, '2024-02-13 23:14:13', '2024-03-12 00:00:00', 71, '', '2024-03-13 00:00:00', 1),
(38, 71, 6, 15, '2024-02-12 23:18:59', '2024-03-11 00:00:00', 71, '', '2024-03-13 00:00:00', 1),
(39, 71, 7, 16, '2024-02-01 23:41:57', '2024-03-01 00:00:00', 71, '', '2024-03-13 00:00:00', 1),
(40, 72, 3, 19, '2024-02-14 07:32:09', '2024-03-12 00:00:00', 72, 'admin', '2024-03-14 00:00:00', 1),
(41, 72, 2, 18, '2024-02-11 07:32:16', '2024-03-13 00:00:00', 72, 'admin', '2024-03-14 00:00:00', 1),
(42, 72, 1, 17, '2024-03-14 07:32:23', '2024-04-12 00:00:00', 72, 'admin', '2024-03-14 00:00:00', 1),
(43, 67, 1, 6, '2024-03-21 03:00:59', '2024-04-18 00:00:00', 72, 'admin', '2024-03-20 00:00:00', 0),
(44, 67, 1, 5, '2024-03-21 03:01:06', '2024-04-18 00:00:00', 72, 'admin', '2024-03-20 00:00:00', 0),
(45, 67, 1, 4, '2024-03-21 03:01:10', '2024-04-18 00:00:00', 72, 'admin', '2024-03-20 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_librarians`
--

CREATE TABLE `tbl_librarians` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `idno` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `utype` varchar(25) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `status` varchar(7) NOT NULL,
  `vkey` varchar(250) NOT NULL,
  `verified` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_librarians`
--

INSERT INTO `tbl_librarians` (`id`, `name`, `username`, `password`, `email`, `phone`, `idno`, `address`, `utype`, `photo`, `status`, `vkey`, `verified`) VALUES
(1, 'Tanem Rahman', 'tanemrahman', 'e10adc3949ba59abbe56e057f20f883e', 'tanemrah18@gmail.com', '01759724415', '0001', '', 'librarian', 'upload/avatar.jpg', 'yes', 'ffef358ed8efe528597b9e2d60e7698d', 'yes'),
(6, 'Arif Ahmmad', 'arifahmmad', 'e10adc3949ba59abbe56e057f20f883e', 'arif.ahmmad.dip@gmail.com', '01911422712', '0002', '', 'librarian', 'upload/avatar.jpg', 'yes', 'd4107f795ee7b459011239ec1b53d3f0', 'yes'),
(7, 'Prince Joseph', 'princejoseph', '1156c0b83a0028664956fd02b85ee57a', 'vovovaj682@irnini.com', '01715818220', '0003', '', 'librarian', 'upload/avatar.jpg', 'yes', '5a75a0adcc98bd1bf6bc80e8ac5f8fd4', 'yes');

--
-- Triggers `tbl_librarians`
--
DELIMITER $$
CREATE TRIGGER `tg_gen_id_no` BEFORE INSERT ON `tbl_librarians` FOR EACH ROW BEGIN
	DECLARE v_reg_no VARCHAR(100);
  DECLARE v_last_reg_no BIGINT(20);
   
   SELECT idno INTO v_last_reg_no FROM tbl_librarians ORDER BY id DESC LIMIT 1;
	 SET v_reg_no = LPAD((v_last_reg_no + 1), 4, '0');

   SET new.idno = v_reg_no;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE `tbl_messages` (
  `id` int(11) NOT NULL,
  `susername` varchar(50) NOT NULL,
  `rusername` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `msg` varchar(300) NOT NULL,
  `read1` varchar(10) NOT NULL,
  `time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`id`, `susername`, `rusername`, `title`, `msg`, `read1`, `time`) VALUES
(18, 'princejoseph', 'dibboroy', 'hi', 'hi', 'y', '2024-03-14 07:25:08am');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requests`
--

CREATE TABLE `tbl_requests` (
  `id` int(11) NOT NULL,
  `books_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `utype` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending,1=approved,2=cancel',
  `is_read` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Unread, 1=Admin Read, 2=User Read',
  `approved_by` int(11) DEFAULT NULL,
  `approved_utype` varchar(55) DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `cancel_by` int(11) DEFAULT NULL,
  `cancel_utype` varchar(55) DEFAULT NULL,
  `cancel_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_requests`
--

INSERT INTO `tbl_requests` (`id`, `books_id`, `user_id`, `utype`, `status`, `is_read`, `approved_by`, `approved_utype`, `approved_at`, `cancel_by`, `cancel_utype`, `cancel_at`, `created_at`, `updated_at`) VALUES
(1, 2, 67, 'user', 1, 2, 2, 'admin', '2024-02-28 00:00:00', NULL, NULL, NULL, '2024-02-28 22:59:52', NULL),
(2, 1, 67, 'user', 1, 2, NULL, NULL, NULL, 2, 'admin', '2024-03-01 00:00:00', '2024-03-01 00:34:30', '2024-03-01 00:00:00'),
(3, 8, 67, 'user', 2, 2, NULL, NULL, NULL, 2, 'admin', '2024-03-01 00:00:00', '2024-03-01 01:03:26', '2024-03-01 00:00:00'),
(4, 1, 67, 'user', 1, 2, 72, 'admin', '2024-03-20 00:00:00', NULL, NULL, NULL, '2024-03-01 16:47:25', '2024-03-20 00:00:00'),
(5, 1, 67, 'user', 1, 2, 72, 'admin', '2024-03-20 00:00:00', NULL, NULL, NULL, '2024-03-01 16:50:41', '2024-03-20 00:00:00'),
(6, 1, 67, 'user', 1, 2, 72, 'admin', '2024-03-20 00:00:00', NULL, NULL, NULL, '2024-03-01 16:50:50', '2024-03-20 00:00:00'),
(7, 1, 0, '', 0, 2, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-03 04:29:07', NULL),
(8, 2, 0, '', 0, 2, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-03 04:29:10', NULL),
(9, 1, 0, '', 0, 2, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-04 02:17:49', NULL),
(10, 6, 0, '', 0, 2, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-06 22:52:29', NULL),
(11, 3, 71, 'user', 1, 2, 71, '', '2024-03-08 00:00:00', NULL, NULL, NULL, '2024-03-08 10:50:08', '2024-03-08 00:00:00'),
(12, 3, 71, 'user', 1, 2, 71, 'admin', '2024-03-09 00:00:00', NULL, NULL, NULL, '2024-03-09 21:44:05', '2024-03-09 00:00:00'),
(13, 8, 71, 'user', 1, 2, 0, '', '2024-03-09 00:00:00', NULL, NULL, NULL, '2024-03-09 22:03:16', '2024-03-09 00:00:00'),
(14, 6, 71, 'user', 1, 2, 71, '', '2024-03-13 00:00:00', NULL, NULL, NULL, '2024-03-13 23:05:23', '2024-03-13 00:00:00'),
(15, 6, 71, 'user', 1, 2, 71, '', '2024-03-13 00:00:00', NULL, NULL, NULL, '2024-03-13 23:18:48', '2024-03-13 00:00:00'),
(16, 7, 71, 'user', 1, 1, 71, '', '2024-03-13 00:00:00', NULL, NULL, NULL, '2024-03-13 23:41:44', '2024-03-13 00:00:00'),
(17, 1, 72, 'user', 1, 2, 72, 'admin', '2024-03-14 00:00:00', NULL, NULL, NULL, '2024-03-14 07:31:04', '2024-03-14 00:00:00'),
(18, 2, 72, 'user', 1, 2, 72, 'admin', '2024-03-14 00:00:00', NULL, NULL, NULL, '2024-03-14 07:31:08', '2024-03-14 00:00:00'),
(19, 3, 72, 'user', 1, 2, 72, 'admin', '2024-03-14 00:00:00', NULL, NULL, NULL, '2024-03-14 07:31:11', '2024-03-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher_issues`
--

CREATE TABLE `tbl_teacher_issues` (
  `id` int(11) NOT NULL,
  `utype` varchar(20) NOT NULL,
  `idno` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lecturer` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `booksname` varchar(50) NOT NULL,
  `booksissuedate` varchar(20) NOT NULL,
  `booksreturndate` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `regno` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `utype` varchar(7) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `status` varchar(7) NOT NULL,
  `vkey` varchar(250) NOT NULL,
  `verified` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `username`, `password`, `email`, `phone`, `regno`, `address`, `utype`, `photo`, `status`, `vkey`, `verified`) VALUES
(67, 'Tanem Rahman', 'tanemrahman4', 'e10adc3949ba59abbe56e057f20f883e', 'tanem4axiz@gmail.com', '01759724413', '0001', '', 'user', 'upload/avatar.jpg', 'yes', 'e825213d29be8651e3ab7d1943eb0f36', 'yes'),
(71, 'Arif Ahmmad', 'arifahmmad4', 'e10adc3949ba59abbe56e057f20f883e', 'arif.ahmmad.dip@gmail.com', '01911422712', '0002', '', 'user', 'upload/avatar.jpg', 'yes', 'b6a7a68132584f56183bca17928ed446', 'yes'),
(72, 'Dibbo Roy', 'dibboroy', '8139daafb5477e3e47466d70ef973fba', 'kitol21819@azduan.com', '01715818210', '0003', '', 'user', 'upload/avatar.jpg', 'yes', '3b547b302478f7fb89912a3744e6b3af', 'yes');

--
-- Triggers `tbl_users`
--
DELIMITER $$
CREATE TRIGGER `tg_auto_reg_no` BEFORE INSERT ON `tbl_users` FOR EACH ROW BEGIN
	DECLARE v_reg_no VARCHAR(100);
  DECLARE v_last_reg_no BIGINT(20);
   
   SELECT regno INTO v_last_reg_no FROM tbl_users ORDER BY id DESC LIMIT 1;
	 set v_reg_no = LPAD((v_last_reg_no + 1), 4, '0');

   SET new.regno = v_reg_no;
 END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_books`
--
ALTER TABLE `tbl_books`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_files`
--
ALTER TABLE `tbl_files`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_fines`
--
ALTER TABLE `tbl_fines`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_issues`
--
ALTER TABLE `tbl_issues`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_librarians`
--
ALTER TABLE `tbl_librarians`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_requests`
--
ALTER TABLE `tbl_requests`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_teacher_issues`
--
ALTER TABLE `tbl_teacher_issues`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_books`
--
ALTER TABLE `tbl_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_files`
--
ALTER TABLE `tbl_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_fines`
--
ALTER TABLE `tbl_fines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_issues`
--
ALTER TABLE `tbl_issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_librarians`
--
ALTER TABLE `tbl_librarians`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_requests`
--
ALTER TABLE `tbl_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_teacher_issues`
--
ALTER TABLE `tbl_teacher_issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
