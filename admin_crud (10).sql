-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2023 at 07:00 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `beauro_list`
--

CREATE TABLE `beauro_list` (
  `personnel_id` int(11) NOT NULL,
  `person` varchar(225) NOT NULL,
  `full_name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `position` varchar(30) NOT NULL,
  `date_and_time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bfp_duty`
--

CREATE TABLE `bfp_duty` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_no` int(11) NOT NULL,
  `position` varchar(100) NOT NULL,
  `date_and_time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bfp_duty`
--

INSERT INTO `bfp_duty` (`user_id`, `full_name`, `email`, `address`, `contact_no`, `position`, `date_and_time`) VALUES
(3, 'Venancio Baybayan', 'baybayan@gmail.com', 'Linmansangan, Binalonan', 947653824, 'Researcher', '0000-00-00'),
(4, 'Rhodz Isaiah', 'isaiah@gmail.com', 'californa', 2147483647, 'Bangads', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `bfp_list`
--

CREATE TABLE `bfp_list` (
  `user_id` int(10) NOT NULL,
  `person` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `position` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bfp_list`
--

INSERT INTO `bfp_list` (`user_id`, `person`, `name`, `email`, `address`, `contact_no`, `position`) VALUES
(1, 'ADMIN', 'FO1 Kathreena Poma B. Asuncion', 'Asuncion@gmail.com', 'La Union', '90749765257', 'Personnel');

-- --------------------------------------------------------

--
-- Table structure for table `certificate_tbl`
--

CREATE TABLE `certificate_tbl` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `contact_no` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `certificate_type` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `recieved_by` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incidents_report`
--

CREATE TABLE `incidents_report` (
  `user_id` int(11) NOT NULL,
  `person` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `report_date_time` varchar(30) NOT NULL,
  `incident` varchar(30) NOT NULL,
  `location` varchar(30) NOT NULL,
  `dispatched_teams` varchar(30) DEFAULT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incidents_report`
--

INSERT INTO `incidents_report` (`user_id`, `person`, `name`, `report_date_time`, `incident`, `location`, `dispatched_teams`, `status`) VALUES
(1, 'ADMIN', 'FO3 Ruar', 'Sep 17,2023- 12:50', 'Building Fire ', 'Brgy Dumayat', 'BFP-PNP', 'Active'),
(2, 'ADMIN', 'Danica Mae Ruar', '17/09/2023 - 01:01', 'Grass Fire', ' Brgy Dumayat', 'Fire Fighters F-1001', 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `list_of_respondent_types`
--

CREATE TABLE `list_of_respondent_types` (
  `user_id` int(11) NOT NULL,
  `person` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `date_created` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `list_of_respondent_types`
--

INSERT INTO `list_of_respondent_types` (`user_id`, `person`, `name`, `date_created`, `status`) VALUES
(1, 'Admin', 'Binalonan Ambulance', '2023/08/17', 'Active'),
(3, 'Admin', 'Fire Fighters', '2023/08/17', 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `manage_user`
--

CREATE TABLE `manage_user` (
  `user_id` int(10) NOT NULL,
  `person` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `position` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manage_user`
--

INSERT INTO `manage_user` (`user_id`, `person`, `name`, `email`, `address`, `contact_no`, `position`) VALUES
(2, 'Admin', 'Bryll Cosning', 'Bryll@gmail.com', 'Vacante', '09307984981', 'Researcher');

-- --------------------------------------------------------

--
-- Table structure for table `personnel_tbl`
--

CREATE TABLE `personnel_tbl` (
  `user_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact_no` int(11) NOT NULL,
  `date_and_time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personnel_tbl`
--

INSERT INTO `personnel_tbl` (`user_id`, `name`, `middle_name`, `last_name`, `address`, `email`, `contact_no`, `date_and_time`) VALUES
(1, 'Mark', 'Louie', 'Soriano', 'Binalonan', 'soriano@gmail.com', 930798498, '29/11/2023 - 11:27'),
(2, 'Rhods ', 'T', 'Ruar', 'Binalonan, Pangasinan', 'rhods@gmail.com', 123456789, '');

-- --------------------------------------------------------

--
-- Table structure for table `philippine_list`
--

CREATE TABLE `philippine_list` (
  `user_id` int(11) NOT NULL,
  `person` varchar(225) NOT NULL,
  `full_name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `position` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pnp_duty`
--

CREATE TABLE `pnp_duty` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_no` int(11) NOT NULL,
  `position` varchar(100) NOT NULL,
  `date_and_time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pnp_duty`
--

INSERT INTO `pnp_duty` (`user_id`, `full_name`, `email`, `address`, `contact_no`, `position`, `date_and_time`) VALUES
(1, 'Michelle Dee', 'dee@gmail.com', 'Makati City', 2147483647, 'Miss U Philippines', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pnp_list`
--

CREATE TABLE `pnp_list` (
  `user_id` int(10) NOT NULL,
  `person` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `position` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pnp_list`
--

INSERT INTO `pnp_list` (`user_id`, `person`, `name`, `email`, `address`, `contact_no`, `position`) VALUES
(1, 'Danica', 'Danica Mae Ruar', 'nica@gmail.com', 'Dumayats', '9038973421', 'PROGRAMMER');

-- --------------------------------------------------------

--
-- Table structure for table `registered_users`
--

CREATE TABLE `registered_users` (
  `user_id` int(11) NOT NULL,
  `person` varchar(225) NOT NULL,
  `full_name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `position` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registered_users`
--

INSERT INTO `registered_users` (`user_id`, `person`, `full_name`, `email`, `contact_no`, `position`) VALUES
(1, 'Admin', 'Danica Mae Ruar', 'danica@gmail.com', '0967493729', 'Programmer'),
(2, 'Admin', 'Alejandra Ville Espiritu', 'Alejandra@gmail.com', '09997306825', 'Programmer'),
(3, 'Admin', 'Venancio Baybayan', 'Vence@gmail.com', '09997306825', 'Programmer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `personnel_id` int(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `personnel_id`, `password`, `full_name`) VALUES
(1, 21954, '$2y$10$eSfWg9DY9MUPQPNhCEvMpu8sFnUUTFLmNMOSi0MCw.kqLmY3SRHgq', 'Danica Mae Ruar'),
(2, 21956, '$2y$10$B51IoK3XlIgNSZRmMV3qSOtEQ6k8cdEwMcoM/cwSZDD1LbUao2JhK', 'Ariana '),
(3, 100984, '$2y$10$mo4uqe8Q4r/0pNOxTKxVfu95SjsE9kd2ZrGWSeIWxeiHiQbbxlmvq', 'Cazzni ruar'),
(4, 100986, '$2y$10$C82/VpjNXkHqNsrfUIR2oOaMfGAh124B38SsXj7Q8aFWmvz5HrF6G', 'Cazzni ruar');

-- --------------------------------------------------------

--
-- Table structure for table `test_user`
--

CREATE TABLE `test_user` (
  `user_id` int(11) NOT NULL,
  `person` varchar(30) NOT NULL,
  `date_created` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_user`
--

INSERT INTO `test_user` (`user_id`, `person`, `date_created`, `name`, `status`) VALUES
(1, 'Chief', '2023-08-17 00:00:00.000000', 'Danica Mae Ruar', 'Done'),
(2, 'Chief', '2023-08-17 00:00:00.000000', 'Danica Mae Ruar', 'Done'),
(3, 'Chief', '2023-08-17 00:00:00.000000', 'Margaux', 'Active'),
(4, 'Admin', '2023/07/02', 'Danica Mae Ruar', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatars/1.png?v=1649834664', NULL, 1, '2021-01-20 14:02:37', '2022-04-13 15:24:24'),
(3, 'John', 'Smith', 'jsmith', '1254737c076cf867dc53d60a0364f38e', 'uploads/avatars/3.png?v=1650527149', NULL, 2, '2022-04-21 15:45:49', '2022-04-21 15:46:23');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `username`, `password`, `full_name`) VALUES
(1, 'danicamaeruar7@gmail.com', '$2y$10$yairfvDmOXJy9nLV6jfxluXT5V5pUKEEFbRhx9Rr4W.tys13uhbK6', 'DanProg'),
(2, 'dani@gmail.com', 'admin123', 'dani dani'),
(3, 'Administrator', 'cazzni', 'administrator'),
(4, 'flora@gmail.com', '$2y$10$CmKK6356ucR.ytbfnAzTq.tG7oDDpxFXpLPJpMjKY3jl972pnDSe6', 'Flora Kent'),
(5, 'ruar@gmail.com', '$2y$10$ooNZajjhOZjTMOmuTVV/uudGt3jY63HJL3tkAJtSK0I3PwM0XtFDe', 'Danica Mae Ruar'),
(6, 'han@gmail.com', 'gone', 'han han');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beauro_list`
--
ALTER TABLE `beauro_list`
  ADD PRIMARY KEY (`personnel_id`);

--
-- Indexes for table `bfp_duty`
--
ALTER TABLE `bfp_duty`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `bfp_list`
--
ALTER TABLE `bfp_list`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `certificate_tbl`
--
ALTER TABLE `certificate_tbl`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `incidents_report`
--
ALTER TABLE `incidents_report`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `list_of_respondent_types`
--
ALTER TABLE `list_of_respondent_types`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `manage_user`
--
ALTER TABLE `manage_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `personnel_tbl`
--
ALTER TABLE `personnel_tbl`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `philippine_list`
--
ALTER TABLE `philippine_list`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `pnp_duty`
--
ALTER TABLE `pnp_duty`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `pnp_list`
--
ALTER TABLE `pnp_list`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `registered_users`
--
ALTER TABLE `registered_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `personnel_id` (`personnel_id`);

--
-- Indexes for table `test_user`
--
ALTER TABLE `test_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beauro_list`
--
ALTER TABLE `beauro_list`
  MODIFY `personnel_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bfp_duty`
--
ALTER TABLE `bfp_duty`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bfp_list`
--
ALTER TABLE `bfp_list`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `certificate_tbl`
--
ALTER TABLE `certificate_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incidents_report`
--
ALTER TABLE `incidents_report`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `list_of_respondent_types`
--
ALTER TABLE `list_of_respondent_types`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manage_user`
--
ALTER TABLE `manage_user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personnel_tbl`
--
ALTER TABLE `personnel_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `philippine_list`
--
ALTER TABLE `philippine_list`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pnp_duty`
--
ALTER TABLE `pnp_duty`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pnp_list`
--
ALTER TABLE `pnp_list`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registered_users`
--
ALTER TABLE `registered_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `test_user`
--
ALTER TABLE `test_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
