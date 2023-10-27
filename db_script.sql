-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 27, 2023 at 05:05 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `LMSFINAL`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `author` varchar(100) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `borrow_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `description`, `author`, `publisher`, `price`, `cover`, `category`, `created_by`, `created_date`, `updated_by`, `updated_date`, `status`, `borrow_count`) VALUES
(1, 'វិញ្ញាសារជីវិត', '', 'Samrech', 'Huy Samrech', '10', '20231024192239.jpg', 'Mystery', 3, '2023-10-24 19:22:39', NULL, NULL, 1, 1),
(2, 'ដំណើរស្វែងរកខ្លួនឯង', '', 'Huy Samrech', 'Huy Samrech', '15', '20231024192434.jpg', 'Mystery', 3, '2023-10-24 19:24:34', NULL, NULL, 1, 0),
(3, 'អំណាន ជាអំណាច', '', 'Huy Samrech', 'Huy Samrech', '8', '20231024192535.jpg', 'Mystery', 3, '2023-10-24 19:25:35', NULL, NULL, 1, 0),
(4, 'អំណាចកម្ម', '', 'Huy Samrech', 'Huy Samrech', '10', '20231024192602.jpg', 'Mystery', 3, '2023-10-24 19:26:02', NULL, NULL, 1, 1),
(5, '1001ថ្ងៃ', '', 'Huy Samrech', 'Huy Samrech', '15', '20231024192636.jpg', 'Mystery', 3, '2023-10-24 19:26:36', NULL, NULL, 1, 1),
(6, 'ផ្តើមពីក្តីសុបិន', '', 'Huy Samrech', 'Huy Samrech', '10', '20231024192734.jpg', 'Mystery', 3, '2023-10-24 19:27:34', NULL, NULL, 1, 0),
(7, 'ដើរចេញពីអតីតកាល', '', 'Huy Panha', 'Huy Panha', '11', '20231024192820.jpg', 'Mystery', 3, '2023-10-24 19:28:20', NULL, NULL, 1, 0),
(8, 'ខ្យល់ដង្ហើម', '', 'Huy Panha', 'Huy Panha', '14', '20231024192857.jpg', 'Mystery', 3, '2023-10-24 19:28:57', NULL, NULL, 1, 1),
(9, 'ខ្យល់ដង្ហើម', '', 'Huy Panha', 'Huy Panha', '14', '20231024192857.jpg', 'Mystery', 3, '2023-10-24 19:28:57', 3, '2023-10-24 19:29:23', 1, 0),
(10, 'កាពីទែនជីវិត', '', 'Om Chanpiseth', 'Om Chanpiseth', '16', '20231024193005.png', 'Mystery', 3, '2023-10-24 19:30:05', NULL, NULL, 1, 0),
(11, 'ស្នាមកាំបិត', '', 'Om Chanpiseth', 'Om Chanpiseth', '15', '20231024193120.png', 'Mystery', 3, '2023-10-24 19:31:20', NULL, NULL, 1, 0),
(12, 'ថ្ងៃថ្មីនៅតែមាន', 'ថ្ងៃថ្មីនៅតែមាន', 'Om Chanpiseth', 'Om Chanpiseth', '11', '20231024193159.png', 'Mystery', 3, '2023-10-24 19:31:59', NULL, NULL, 1, 0),
(13, 'ឥន្រ្ទរាជ', '', 'Huy Panha', 'Huy Panha', '15', '20231024193250.png', 'Science', 3, '2023-10-24 19:32:50', NULL, NULL, 1, 1),
(14, 'ន​ភាល័យ', '', 'Huy Panha', 'Huy Panha', '15', '20231024193323.png', 'Fiction', 3, '2023-10-24 19:33:23', NULL, NULL, 1, 1),
(15, 'កាពីទែនជីវិត', '', 'Huy Panha', 'Huy Panha', '15', '20231024193414.png', 'Travel', 3, '2023-10-24 19:34:14', NULL, NULL, 1, 3),
(16, 'ដំណើរ', 'ដំណើរ', 'Om Chanpiseth', 'Om Chanpiseth', '20', '20231024193510.png', 'Travel', 3, '2023-10-24 19:35:10', NULL, NULL, 1, 1),
(17, 'ទស្សនៈផ្តាច់ផ្លូវក្រោយ', 'ទស្សនៈផ្តាច់ផ្លូវក្រោយ', 'Huy Samrech', 'Huy Samrech', '14', '20231024193613.png', 'Non-fiction', 3, '2023-10-24 19:36:13', NULL, NULL, 1, 1),
(18, 'និស្ស័យ', 'និស្ស័យ', 'Huy Samrech', 'Huy Samrech', '18', '20231024193654.png', 'Reference Books', 3, '2023-10-24 19:36:54', NULL, NULL, 1, 0),
(19, 'នភាល័យ', 'នភាល័យ', 'PHAL NYPHIRON', 'PHAL NYPHIRON', '15', '20231024193750.png', 'Technology', 3, '2023-10-24 19:37:50', 1, '2023-10-25 18:22:05', 1, 0),
(20, 'ទម្រាំដឹងខ្លួនថាត្រូវការអ្វី', 'ទម្រាំដឹងខ្លួនថាត្រូវការអ្វី', 'Huy Samrech', 'Huy Samrech', '15', '20231024193920.jpg', 'Anthologies', 3, '2023-10-24 19:39:20', NULL, NULL, 1, 1),
(21, 'ប្រតិតិនទស្សនៈ ៣៦៥ថ្ងៃ', 'ប្រតិតិនទស្សនៈ ៣៦៥ថ្ងៃ', 'Huy Samrech', 'Huy Samrech', '15', '20231024194012.jpg', 'Anthologies', 3, '2023-10-24 19:40:12', 1, '2023-10-26 18:49:45', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `id` int(10) UNSIGNED NOT NULL,
  `book_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `qty` int(11) NOT NULL,
  `fine_amount` decimal(10,0) NOT NULL,
  `due_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `returned` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`id`, `book_id`, `stu_id`, `amount`, `qty`, `fine_amount`, `due_date`, `created_by`, `created_date`, `updated_by`, `updated_date`, `status`, `returned`) VALUES
(1, 15, 1, '15', 1, '20', '2023-10-31 23:59:59', 3, '2023-10-24 19:44:29', NULL, NULL, 1, 0),
(2, 16, 1, '20', 1, '30', '2023-10-31 23:59:59', 3, '2023-10-24 19:45:32', NULL, NULL, 1, 0),
(3, 15, 2, '15', 1, '30', '2023-10-31 23:59:59', 3, '2023-10-24 19:46:38', NULL, NULL, 1, 0),
(4, 1, 7, '10', 1, '50', '2023-10-31 23:59:59', 3, '2023-10-24 19:48:36', NULL, NULL, 1, 0),
(5, 5, 1, '15', 1, '30', '2023-10-30 23:59:59', 3, '2023-10-24 19:49:31', NULL, NULL, 1, 0),
(6, 14, 1, '15', 1, '20', '2023-10-25 23:59:59', 3, '2023-10-24 19:50:12', NULL, NULL, 1, 0),
(7, 15, 8, '15', 1, '10', '2023-10-25 23:59:59', 3, '2023-10-24 19:51:02', NULL, NULL, 1, 0),
(8, 4, 2, '10', 1, '30', '2023-10-24 23:59:59', 3, '2023-10-24 19:51:25', NULL, NULL, 1, 0),
(9, 17, 7, '14', 1, '11', '2023-10-25 23:59:59', 1, '2023-10-24 22:59:57', 1, '2023-10-26 18:51:36', 1, 1),
(10, 13, 19, '15', 1, '9', '2023-10-25 23:59:59', 1, '2023-10-24 23:00:12', NULL, NULL, 1, 0),
(11, 8, 18, '14', 1, '5', '2023-10-25 23:59:59', 1, '2023-10-24 23:00:29', NULL, NULL, 1, 0),
(12, 20, 7, '15', 1, '5463', '2023-10-01 23:59:59', 1, '2023-10-25 18:17:26', NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `title`, `status`) VALUES
(1, 'Admin', 1),
(2, 'Librarian', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: male, 1: female',
  `contact` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `is_black_list` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stu_id`, `first_name`, `last_name`, `gender`, `contact`, `dob`, `address`, `is_black_list`, `created_by`, `created_date`, `updated_by`, `updated_date`, `status`) VALUES
(1, 'Huy', 'Panha', 0, 'panhahuy70gmail.com', '2023-10-09', 'Phnom Penh', 0, 1, '2023-10-08 21:52:05', NULL, NULL, 1),
(2, 'Om', 'Chanpiseth', 1, '0712229529', '1111-11-11', 'Phnom Phenh', 1, 1, '2023-10-08 22:06:35', 3, '2023-10-24 20:04:23', 1),
(3, 'New', 'Student', 0, 'S', '2023-09-01', 'A', 0, 1, '2023-10-08 22:12:46', NULL, NULL, 0),
(4, 'New', 'Student2', 0, 'c', '2023-10-10', 'a', 0, 1, '2023-10-08 22:42:47', NULL, NULL, 0),
(5, 'New', 'Student3', 1, 'c', '2023-10-08', 'a', 1, 1, '2023-10-08 22:43:49', 1, '2023-10-12 00:30:13', 0),
(6, 'New Update', 'Student 4', 1, 'contact', '2023-10-01', 'addr', 0, 1, '2023-10-08 22:44:32', 1, '2023-10-12 23:46:18', 0),
(7, 'Phal', 'Nyphiron', 1, '0713456789', '2023-10-08', 'Phnom Phenh', 0, 1, '2023-10-08 22:44:41', 3, '2023-10-24 20:04:27', 1),
(8, 'Huy', 'Samrech', 0, '0712229529', '2023-10-02', 'Phnom Phenh', 0, 1, '2023-10-09 22:10:41', 3, '2023-10-24 20:04:19', 1),
(9, 'Hoy', 'Narak', 0, '0147896325', '2023-10-04', 'Phnom Phenh', 0, 3, '2023-10-24 20:00:42', NULL, NULL, 1),
(10, 'Net', 'Net', 0, '0157421445', '2023-10-11', 'Phnom Phenh', 0, 3, '2023-10-24 20:01:42', 3, '2023-10-24 20:09:09', 1),
(11, 'Sok', 'Sreynit', 0, '0123654455', '2023-06-04', 'Phnom Phenh', 0, 3, '2023-10-24 20:06:36', NULL, NULL, 1),
(12, 'Horn', 'Danit', 1, '0147896523', '2022-12-13', 'Phnom Phenh', 1, 3, '2023-10-24 20:07:12', 1, '2023-10-25 18:15:43', 1),
(13, 'Sea', 'Kimhak', 1, '0966837884', '2022-09-04', 'Phnom Phenh', 0, 3, '2023-10-24 20:08:14', NULL, NULL, 1),
(14, 'Leang', 'Lyhorng', 1, '02554989', '2022-05-04', 'Phnom Phenh', 0, 3, '2023-10-24 20:08:56', NULL, NULL, 1),
(15, 'Kim', 'Eang', 1, '0248423212', '2022-03-01', 'Phnom Phenh', 0, 3, '2023-10-24 20:09:59', NULL, NULL, 1),
(16, 'Pov', 'Puthika', 1, '0545651321', '2021-12-11', 'Phnom Phenh', 0, 3, '2023-10-24 20:11:15', NULL, NULL, 1),
(17, 'Pov', 'Puthika', 1, '0545651321', '2021-12-11', 'Phnom Phenh', 0, 3, '2023-10-24 20:11:15', NULL, NULL, 1),
(18, 'Hour', 'Seam Mey', 1, '054875612', '2021-12-11', 'Kompongcham', 0, 3, '2023-10-24 20:12:32', NULL, NULL, 1),
(19, 'Heang ', 'Sreynich', 1, '015498985', '2021-12-11', 'Phnom Phenh', 0, 3, '2023-10-24 20:13:22', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `gender` tinyint(4) NOT NULL COMMENT '0: male, 1: female',
  `email` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `profile_img` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `ver_code` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `pass`, `gender`, `email`, `role_id`, `phone`, `address`, `profile_img`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`, `ver_code`) VALUES
(1, 'Huy Panha', '$2y$10$OYOrSX1wBUrePIbxjl9GouykBHl.xfGHyojh9aqjCoTpRphTU8A1K', 0, 'panhahuy70@gmail.com', 1, '093681313', 'Phnom Penh', '20231024195726.jpg', 1, 1, '2023-10-07 00:00:00', 1, '2023-10-25 18:19:08', '227913'),
(2, 'Om Chhroch', '$2y$10$RpIx7mU9wJjwxF6pzYtMMeIdQCCFtLz8MZm6tlyPJuVbIIcs3ZpQe', 1, 'omchhrocch@lms.com', 2, '012341234', 'Phnom Phenh', '20231024195343.jpg', 1, 1, '2023-10-21 14:38:31', 3, '2023-10-24 19:56:49', NULL),
(3, 'Huy Samrech', '$2y$10$0mbuxnHOB9hOJ5pkQEfYk.JlXlowrHf97HGyPuioc.kccrJ.cM8ta', 0, 'samrech@lms.com', 1, '02352345', 'Phnom Phenh', '20231024191846.jpg', 1, 1, '2023-10-24 19:15:22', 3, '2023-10-24 19:56:43', NULL),
(4, 'Phal Nyphiron', '$2y$10$Q2tkgi0JSatx2abD56qrn.WYz5KdKqRnmLiThIFIKTPdhVVE8wvde', 0, 'nyphiron@gmail.com', 2, '01234567989', 'Phnom Phenh', '20231024195527.jpg', 1, 3, '2023-10-24 19:55:27', NULL, NULL, NULL),
(5, 'Seng Chengchai', '$2y$10$P6lhi91nCQjn3yvjVgCukOanpsRNFiVcLFHQIHpqOsKNkWwYhEe02', 0, 'chengchai@gmail.com', 2, '01234567987', 'Phnom Phenh', '20231024195628.jpg', 1, 3, '2023-10-24 19:56:28', NULL, NULL, NULL),
(6, 'Nuon Likung', '$2y$10$HJS/JTOmP.o7JyqxRY1zEOi92ZleKBC6JKheCXBvOZxGRKyEb25Hi', 0, 'likung@gmail.com', 2, '0715555896', 'Phnom Phenh', '20231024195847.jpg', 1, 3, '2023-10-24 19:58:47', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stu_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
