-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2017 at 06:37 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `temper`
--

-- --------------------------------------------------------

--
-- Table structure for table `tec_activities`
--

CREATE TABLE `tec_activities` (
  `id` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `actions` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tec_activities`
--

INSERT INTO `tec_activities` (`id`, `ip`, `user_id`, `actions`, `date_created`) VALUES
(1, '127.0.0.1', 1, 'New account creation', '2017-10-11 23:34:08'),
(2, '127.0.0.1', 1, 'Account Activation', '2017-10-12 06:23:35'),
(3, '127.0.0.1', 2, 'New account creation', '2017-10-12 07:42:44'),
(4, '127.0.0.1', 1, 'Profile information completed', '2017-10-12 09:19:55'),
(5, '127.0.0.1', 1, 'Job interested completed', '2017-10-12 11:42:52'),
(6, '127.0.0.1', 1, 'Job experienced completed', '2017-10-12 12:33:56'),
(7, '127.0.0.1', 1, 'Job freelanced completed', '2017-10-12 13:33:22'),
(8, '127.0.0.1', 1, 'app_lang.approval_finish', '2017-10-12 13:34:45');

-- --------------------------------------------------------

--
-- Table structure for table `tec_groups`
--

CREATE TABLE `tec_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tec_groups`
--

INSERT INTO `tec_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'user', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tec_job_experience`
--

CREATE TABLE `tec_job_experience` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `relevant_experience` int(2) NOT NULL,
  `experience` varchar(250) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tec_job_experience`
--

INSERT INTO `tec_job_experience` (`id`, `user_id`, `relevant_experience`, `experience`, `date_created`) VALUES
(1, 1, 1, 'I developed accounting solution for probitysoftware, farm management software and cooperative software.', '2017-10-12 12:33:56');

-- --------------------------------------------------------

--
-- Table structure for table `tec_job_interests`
--

CREATE TABLE `tec_job_interests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `specialization_id` int(11) NOT NULL,
  `jobs` varchar(500) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tec_job_interests`
--

INSERT INTO `tec_job_interests` (`id`, `user_id`, `specialization_id`, `jobs`, `date_created`) VALUES
(1, 1, 16, 'Software Developement, Web Development', '2017-10-12 11:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `tec_login_attempts`
--

CREATE TABLE `tec_login_attempts` (
  `id` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tec_login_attempts`
--

INSERT INTO `tec_login_attempts` (`id`, `ip`, `email`, `date_created`) VALUES
(1, '127.0.0.1', 'samprog@gmail.com', '2017-10-12 07:02:44'),
(2, '127.0.0.1', 'samprog@gmail.com', '2017-10-12 07:03:25'),
(3, '127.0.0.1', 'samprog4u@gmail.com', '2017-10-12 07:03:43');

-- --------------------------------------------------------

--
-- Table structure for table `tec_portfolio`
--

CREATE TABLE `tec_portfolio` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `freelancer` int(2) NOT NULL,
  `portfolio_url` varchar(500) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tec_portfolio`
--

INSERT INTO `tec_portfolio` (`id`, `user_id`, `freelancer`, `portfolio_url`, `date_created`) VALUES
(1, 1, 1, 'https://probitybooks.com, https://probityfarms.com and http://probitycoop.com', '2017-10-12 13:33:22');

-- --------------------------------------------------------

--
-- Table structure for table `tec_stages`
--

CREATE TABLE `tec_stages` (
  `id` int(11) NOT NULL,
  `stages` int(2) NOT NULL,
  `description` varchar(100) NOT NULL,
  `percent` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tec_stages`
--

INSERT INTO `tec_stages` (`id`, `stages`, `description`, `percent`) VALUES
(1, 1, 'create account', 0),
(2, 2, 'activate account', 20),
(3, 3, 'provide profile information', 40),
(4, 4, 'what jobs are you interested in?', 50),
(5, 5, 'do you have relevant experience in these jobs?', 70),
(6, 6, 'are you freelancer?', 90),
(7, 7, 'waiting for approval', 99),
(8, 8, 'approval', 100);

-- --------------------------------------------------------

--
-- Table structure for table `tec_tracks`
--

CREATE TABLE `tec_tracks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tec_tracks`
--

INSERT INTO `tec_tracks` (`id`, `user_id`, `stage_id`, `date_created`) VALUES
(1, 1, 7, '2017-10-11 23:34:08'),
(2, 2, 1, '2017-10-12 07:42:44');

-- --------------------------------------------------------

--
-- Table structure for table `tec_users`
--

CREATE TABLE `tec_users` (
  `id` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `last_login_ip` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `activation_code` varchar(151) NOT NULL,
  `activation_code_expire` int(2) NOT NULL,
  `status` int(2) NOT NULL,
  `group_id` int(2) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tec_users`
--

INSERT INTO `tec_users` (`id`, `ip`, `last_login_ip`, `email`, `password`, `lastname`, `firstname`, `activation_code`, `activation_code_expire`, `status`, `group_id`, `date_created`) VALUES
(1, '127.0.0.1', '127.0.0.1', 'samprog4u@gmail.com', '$2y$10$sK8K4LS4VkaQTcL3DdWAp.IqlJmqC1z9msfVxLyHn6yfprj6sEI8e', 'Oloruntoba', 'Samson', 'wcJtMHW4Mye7G9pCdiyE8MdsaIQDTNIl7zc45jkNj4qJEvGv1prOCFkvUC2qYJ7hkC94PbcAIRGh9zy3AjhlbAC9uGueOb23chZi8ymtIx3clIb2d6a075ec877b1b7d02282fbcb9a087df4af497', 0, 7, 2, '2017-10-11 23:34:08'),
(2, '127.0.0.1', NULL, 'tosprog4real@gmail.com', '$2y$10$irCqP89L34rcFkYVSPpBP.8J5cGNuutgNxDIpI54trb1.a0rZdVBm', 'Oloruntoba', 'Tosin', 'EiClGRoSUCc9BB2DZGDDzWvtOHaya1jhjlmLYqNVzEK3k92SZ4ZzdQai3eUPBJVKAwwpNeIxoHrtvm3pL3BiFgz1dAJJhxAnbKlHiIDWsQi8I32b69a6843d50dfd15d10613914d7794fa9766f57', 1, 1, 2, '2017-10-12 07:42:44'),
(3, '127.0.0.1', '127.0.0.1', 'admin@temper.com', '$2y$10$irCqP89L34rcFkYVSPpBP.8J5cGNuutgNxDIpI54trb1.a0rZdVBm', 'Admin', 'Admin', '', 0, 1, 1, '2017-10-12 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tec_user_logins`
--

CREATE TABLE `tec_user_logins` (
  `id` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tec_user_logins`
--

INSERT INTO `tec_user_logins` (`id`, `ip`, `user_id`, `date_created`) VALUES
(1, '127.0.0.1', 3, '2017-10-12 13:46:29'),
(2, '127.0.0.1', 3, '2017-10-12 13:46:47'),
(3, '127.0.0.1', 3, '2017-10-12 13:47:22'),
(4, '127.0.0.1', 3, '2017-10-12 13:48:53'),
(5, '127.0.0.1', 3, '2017-10-12 13:49:24'),
(6, '127.0.0.1', 3, '2017-10-12 13:53:53'),
(7, '127.0.0.1', 3, '2017-10-12 13:54:20'),
(8, '127.0.0.1', 3, '2017-10-12 13:56:31'),
(9, '127.0.0.1', 3, '2017-10-12 14:04:32'),
(10, '127.0.0.1', 3, '2017-10-12 14:06:05'),
(11, '127.0.0.1', 3, '2017-10-12 14:16:07');

-- --------------------------------------------------------

--
-- Table structure for table `tec_user_profiles`
--

CREATE TABLE `tec_user_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `zip_code` varchar(5) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state` varchar(20) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tec_user_profiles`
--

INSERT INTO `tec_user_profiles` (`id`, `user_id`, `phone_no`, `gender`, `zip_code`, `dob`, `country_id`, `state`, `date_created`) VALUES
(1, 1, '08133372368', 'male', '+234', '2017-10-12', 1, 'Kwara', '2017-10-12 09:19:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tec_activities`
--
ALTER TABLE `tec_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_groups`
--
ALTER TABLE `tec_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_job_experience`
--
ALTER TABLE `tec_job_experience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_job_interests`
--
ALTER TABLE `tec_job_interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_login_attempts`
--
ALTER TABLE `tec_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_portfolio`
--
ALTER TABLE `tec_portfolio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_stages`
--
ALTER TABLE `tec_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_tracks`
--
ALTER TABLE `tec_tracks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_users`
--
ALTER TABLE `tec_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_user_logins`
--
ALTER TABLE `tec_user_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tec_user_profiles`
--
ALTER TABLE `tec_user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tec_activities`
--
ALTER TABLE `tec_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tec_groups`
--
ALTER TABLE `tec_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tec_job_experience`
--
ALTER TABLE `tec_job_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tec_job_interests`
--
ALTER TABLE `tec_job_interests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tec_login_attempts`
--
ALTER TABLE `tec_login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tec_portfolio`
--
ALTER TABLE `tec_portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tec_stages`
--
ALTER TABLE `tec_stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tec_tracks`
--
ALTER TABLE `tec_tracks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tec_users`
--
ALTER TABLE `tec_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tec_user_logins`
--
ALTER TABLE `tec_user_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tec_user_profiles`
--
ALTER TABLE `tec_user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;