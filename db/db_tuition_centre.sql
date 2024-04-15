-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2017 at 12:27 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tuition_centre`
--

-- --------------------------------------------------------

--
-- Table structure for table `ts_admin_login`
--

CREATE TABLE `ts_admin_login` (
  `id` int(2) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `company` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `mob_no` varchar(15) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `pswd` varchar(50) NOT NULL,
  `status` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_admin_login`
--

INSERT INTO `ts_admin_login` (`id`, `first_name`, `last_name`, `company`, `user_name`, `mob_no`, `email_id`, `pswd`, `status`) VALUES
(1, 'admin', 'admin', '', 'admin.admin', '123456565667', 'support@telco-soft.in', '12345', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ts_attendance`
--

CREATE TABLE `ts_attendance` (
  `id` int(10) NOT NULL,
  `registration_no` varchar(20) NOT NULL,
  `student_name` varchar(200) NOT NULL,
  `class_id` int(8) NOT NULL,
  `batch_id` varchar(100) NOT NULL,
  `subject_name` varchar(200) NOT NULL,
  `present` int(5) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_attendance`
--

INSERT INTO `ts_attendance` (`id`, `registration_no`, `student_name`, `class_id`, `batch_id`, `subject_name`, `present`, `date`) VALUES
(83, '201508100000', 'Pankaj Kumar', 4, '7', 'English', 1, '2016-12-06'),
(84, '201611100001', 'ram kumar', 13, '25,26,27', 'English', 1, '2016-12-06'),
(85, '201611100002', 'ram kumar', 10, '19', 'English', 1, '2016-12-06'),
(86, '201612100005', 'ram ppp', 11, '20,21', 'English', 1, '2016-12-06'),
(87, '201611100001', 'ram kumar', 13, '25,26,27', 'physics', 0, '2016-12-06'),
(88, '201508100000', 'Pankaj Kumar', 4, '7', 'English', 2, '2016-12-06'),
(89, '201611100001', 'ram kumar', 13, '25,26,27', 'English', 2, '2016-12-06'),
(90, '201611100002', 'ram kumar', 10, '19', 'English', 2, '2016-12-06'),
(91, '201612100005', 'ram ppp', 11, '20,21', 'English', 2, '2016-12-06'),
(92, '201508100000', 'Pankaj Kumar', 4, '7', 'English', 2, '2016-12-06'),
(93, '201611100001', 'ram kumar', 13, '25,26,27', 'physics', 0, '2016-12-08'),
(94, '201611100002', 'ram kumar', 10, '19', 'English', 1, '2016-12-08'),
(95, '201508100000', 'Pankaj Kumar', 4, '7', 'English', 0, '2017-01-24'),
(96, '201611100001', 'ram kumar', 13, '25,26,27', 'English', 0, '2017-01-24'),
(97, '201508100000', 'Pankaj Kumar', 4, '7', 'English', 0, '2017-01-24'),
(98, '201508100000', 'Pankaj Kumar', 4, '7', 'English', 0, '2017-01-24'),
(99, '201508100000', 'Pankaj Kumar', 4, '7', 'English', 2, '2017-01-24'),
(100, '201508100000', 'Pankaj Kumar', 4, '7', 'English', 0, '2017-01-24'),
(101, '201508100000', 'Pankaj Kumar', 4, '7', 'English', 1, '2017-01-25'),
(102, '201611100001', 'ram kumar', 13, '25,26,27', 'English', 0, '2017-03-14'),
(103, '201703100010', 'ram kumar', 10, '19', 'English', 0, '2017-03-14'),
(104, '201703100011', 'ram ppp', 12, '22', 'English', 0, '2017-03-14'),
(105, '201611100001', 'ram kumar', 13, '25,26,27', 'English', 2, '2017-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `ts_batch`
--

CREATE TABLE `ts_batch` (
  `id` int(10) NOT NULL,
  `class_id` int(8) NOT NULL,
  `batch_name` varchar(200) NOT NULL,
  `fee` int(8) NOT NULL,
  `batch_type` varchar(200) NOT NULL,
  `batch_time` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_batch`
--

INSERT INTO `ts_batch` (`id`, `class_id`, `batch_name`, `fee`, `batch_type`, `batch_time`, `status`) VALUES
(2, 3, 'Math', 500, 'Daily', '8:00AM', 'Activeted'),
(5, 3, 'Hindi', 500, 'Daily', '9:00AM', 'Activeted'),
(6, 4, 'Math', 500, 'Daily', '8:00AM', 'Activeted'),
(7, 4, 'English', 500, 'Daily', '9:00AM', 'Activeted'),
(8, 5, 'Math', 500, 'Daily', '8:00AM', 'Activeted'),
(9, 5, 'English', 500, 'Daily', '9:00AM', 'Activeted'),
(10, 6, 'Math', 500, 'Daily', '8:00AM', 'Activeted'),
(11, 6, 'English', 500, 'Daily', '9:00AM', 'Activeted'),
(12, 7, 'Math', 500, 'Daily', '8:00AM', 'Activeted'),
(13, 7, 'English', 500, 'Daily', '9:00AM', 'Activeted'),
(14, 8, 'Math', 700, 'Daily', '8:00AM', 'Activeted'),
(15, 8, 'English', 700, 'Daily', '9:00AM', 'Activeted'),
(16, 9, 'Math', 700, 'Daily', '8:00AM', 'Activeted'),
(17, 9, 'English', 700, 'Daily', '9:00AM', 'Activeted'),
(18, 10, 'Math', 700, 'Daily', '8:00AM', 'Activeted'),
(19, 10, 'English', 700, 'Daily', '9:00AM', 'Activeted'),
(20, 11, 'Math', 1000, 'Daily', '8:00AM', 'Activeted'),
(21, 11, 'English', 1000, 'Daily', '9:00AM', 'Activeted'),
(22, 12, 'Math', 1000, 'Daily', '8:00AM', 'Activeted'),
(23, 12, 'English', 1000, 'Daily', '9:00AM', 'Activeted'),
(24, 13, 'Math', 1500, 'MWF', '8:00AM', 'Activeted'),
(25, 13, 'English', 1500, 'TTS', '8:00AM', 'Activeted'),
(26, 13, 'physics', 1500, 'MWF', '9:00AM', 'Activeted'),
(27, 13, 'Chemistry', 1500, 'TTS', '9:00AM', 'Activeted'),
(28, 14, 'Math', 1500, 'MWF', '8:00AM', 'Activeted'),
(29, 14, 'English', 1500, 'TTS', '8:00AM', 'Activeted'),
(30, 14, 'physics', 1500, 'MWF', '9:00AM', 'Activeted'),
(31, 14, 'Chemistry', 1500, 'TTS', '9:00AM', 'Activeted');

-- --------------------------------------------------------

--
-- Table structure for table `ts_class`
--

CREATE TABLE `ts_class` (
  `id` int(10) NOT NULL,
  `class` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_class`
--

INSERT INTO `ts_class` (`id`, `class`) VALUES
(3, 'first'),
(4, 'second'),
(5, 'third'),
(6, 'fourth'),
(7, 'fifth'),
(8, 'sixth'),
(9, 'seventh'),
(10, 'eighth'),
(11, 'nineth'),
(12, 'tenth'),
(13, 'eleventh'),
(14, 'twelveth');

-- --------------------------------------------------------

--
-- Table structure for table `ts_fee`
--

CREATE TABLE `ts_fee` (
  `id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `registration_no` varchar(20) NOT NULL,
  `paid_fee` int(8) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_fee`
--

INSERT INTO `ts_fee` (`id`, `student_id`, `registration_no`, `paid_fee`, `date`) VALUES
(5, 1, '201508100000', 100, '2016-11-29'),
(6, 2, '201611100001', 500, '2016-11-29'),
(7, 1, '201508100000', 200, '2016-11-29'),
(8, 1, '201508100000', 50, '2016-11-29'),
(9, 2, '201611100001', 500, '2016-11-29'),
(10, 3, '201611100002', 200, '2016-11-30'),
(11, 2, '201611100001', 500, '2016-12-03'),
(12, 2, '201611100001', 500, '2016-12-03'),
(13, 8, '201612100005', 500, '2016-12-05'),
(14, 1, '201508100000', 1000, '2017-01-24'),
(15, 2, '201611100001', 100, '2017-01-24');

-- --------------------------------------------------------

--
-- Table structure for table `ts_home_setting`
--

CREATE TABLE `ts_home_setting` (
  `id` int(2) NOT NULL,
  `scheduled_downtime_msg` text NOT NULL,
  `scheduled_downtime_add` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `project_title` varchar(50) NOT NULL,
  `footer_content` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_home_setting`
--

INSERT INTO `ts_home_setting` (`id`, `scheduled_downtime_msg`, `scheduled_downtime_add`, `image`, `project_title`, `footer_content`, `date`) VALUES
(1, '', '', '1480664066images.jpg', 'Tuition Centre', 'Powered by  caretel infotech limited', '2016-07-29'),
(0, '', '', '1472897869logo.png', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `ts_mailcontent`
--

CREATE TABLE `ts_mailcontent` (
  `id` int(10) NOT NULL,
  `mail_type` varchar(100) NOT NULL,
  `mail_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_mailcontent`
--

INSERT INTO `ts_mailcontent` (`id`, `mail_type`, `mail_content`) VALUES
(1, 'add new student', 'Dear <student name>, Your Registration no: <registration no>, DOB: <dob>'),
(2, 'not present', 'Not present in the class, student name:<student name>, registration no:<registration no>, class name: <class name>, subject: <subject name>'),
(3, 'off by teacher', 'Off By teacher, class name:<class name> ,subject:<subject name>'),
(4, 'fee not paid', 'Your remaining fee <remaining fee>, class name:<class name>, student name:<student name>, Registration No:<registration no>');

-- --------------------------------------------------------

--
-- Table structure for table `ts_marks`
--

CREATE TABLE `ts_marks` (
  `id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `registration_no` varchar(20) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `total_marks` int(8) NOT NULL,
  `obtained_marks` float(8,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_marks`
--

INSERT INTO `ts_marks` (`id`, `student_id`, `registration_no`, `subject`, `total_marks`, `obtained_marks`, `date`) VALUES
(1, 1, '201508100000', 'Math', 100, 65.50, '2016-11-29'),
(2, 2, '201611100001', 'English', 100, 78.50, '2016-11-29'),
(3, 2, '201611100001', 'hindi', 600, 450.00, '2016-11-29'),
(4, 2, '201611100001', 'Math', 200, 155.00, '2016-12-03'),
(5, 8, '201612100005', 'Hindi', 200, 180.00, '2016-12-03'),
(6, 8, '201612100005', 'English', 100, 80.00, '2016-12-05'),
(7, 1, '201508100000', 'English', 100, 40.00, '2016-12-05'),
(8, 3, '201611100002', 'Chemistry', 30, 22.00, '2016-12-05'),
(9, 1, '201508100000', 'Math', 100, 0.00, '2016-12-07');

-- --------------------------------------------------------

--
-- Table structure for table `ts_student`
--

CREATE TABLE `ts_student` (
  `id` int(10) NOT NULL,
  `registration_no` varchar(20) NOT NULL,
  `student_name` varchar(250) NOT NULL,
  `dob` date NOT NULL,
  `class_id` int(8) NOT NULL,
  `batch_id` varchar(100) NOT NULL,
  `father_name` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `reg_date` date NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_student`
--

INSERT INTO `ts_student` (`id`, `registration_no`, `student_name`, `dob`, `class_id`, `batch_id`, `father_name`, `address`, `mobile_no`, `reg_date`, `status`) VALUES
(1, '201508100000', 'Pankaj Kumar', '2015-08-04', 4, '7', 'test', 'phase-1', '9953046368', '2016-11-02', 'Activeted'),
(2, '201611100001', 'ram kumar', '2016-11-10', 13, '25,26,27', 'test', 'mayur vihar', '9953046368', '2016-12-05', 'Activeted'),
(3, '201611100002', 'ram kumar', '2016-11-11', 10, '19', 'test', 'mayur vihar', '995345666', '2016-11-02', 'Activeted'),
(8, '201612100005', 'ram ppp', '2016-12-01', 11, '20,21', 'test', 'Address', '88988999', '2016-12-05', 'Activeted'),
(9, '201612100004', 'gaurav', '2008-12-11', 14, '29,30', 'abc', 'mayur vihar', '995345666', '2016-12-06', 'Activeted'),
(10, '201701100005', 'gaurav111', '2002-01-10', 5, '8', 'test', 'mayur vihar', '88988999', '2017-01-24', 'Activeted'),
(11, '201701100006', 'gaurav', '2017-01-17', 6, '10,11', 'ram', 'Address', '9953046368', '2017-01-24', 'Activeted'),
(12, '201701100007', 'ram kumar', '2017-01-04', 13, '24,25,26', 'ram', 'mv phase 133', '9953046368', '2017-01-24', 'Activeted'),
(17, '201701100008', 'ram kumar', '2017-01-11', 4, '6', 'test333', 'mv phase 1', '99534566633', '2017-01-28', 'Activeted'),
(18, '201703100009', 'ram ppp', '2018-03-14', 12, '22', 'pankaj mishra', 'mv phase 133', '9953046368', '2017-03-14', 'Activeted'),
(19, '201703100010', 'ram kumar', '2017-03-08', 10, '19', 'ram', 'mv phase 133', '9953046368', '2017-03-14', 'Activeted'),
(20, '201703100011', 'ram ppp', '2017-03-15', 12, '22', 'Brajesh Mishra', 'mv phase 133', '9953046368', '2017-03-14', 'Activeted'),
(21, '201703100012', 'Pankaj Kumar', '2017-03-15', 12, '22', 'prakash gha', 'mv phase 133', '9953046368', '2017-03-14', 'Activeted'),
(22, '201703100013', 'ttttttt', '2017-03-01', 8, '14', 'arun', 'mv phase 133', '995345666', '2017-03-30', 'Activeted'),
(23, '201704100014', 'ram kumar', '2016-04-06', 14, '28', 'CP singh', 'mv phase 133', '9953046368', '2017-04-08', 'Activeted'),
(24, '201704100015', 'ram kumar', '2017-04-12', 14, '29', 'CP singh', 'mv phase 1', '9953046368', '2017-04-08', 'Activeted');

-- --------------------------------------------------------

--
-- Table structure for table `ts_user_login`
--

CREATE TABLE `ts_user_login` (
  `id` int(3) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `mob_no` varchar(15) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `department` varchar(30) NOT NULL,
  `dp_group` varchar(30) NOT NULL,
  `role` varchar(20) NOT NULL,
  `status` int(2) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_user_login`
--

INSERT INTO `ts_user_login` (`id`, `first_name`, `last_name`, `full_name`, `user_name`, `pwd`, `mob_no`, `email_id`, `department`, `dp_group`, `role`, `status`, `date`) VALUES
(1, 'vibhav', 'kumar', 'vibhav kumar', 'vibhav.kumar', '123456', '9953046368', 'vibhavkumar2013@gmail.com', '2', '3', '3', 1, '2016-08-26'),
(3, 'gaurav', 'gautam', 'gaurav gautam', 'gaurav.gautam', '56324444', '9953046368', 'gaurav.gautam@gmail.com', '2', '2', '3', 1, '2016-08-22'),
(5, 'sushil', 'kumar', 'sushil kumar', 'sushil.kumar', 'jhhh767', '766767', 'sushilkumar22@gmail.com', '', '', '1', 1, '2016-07-17'),
(7, 'mukesh', 'kumar', 'mukesh kumar', 'mukesh.kumar', '6576868', '7777798', 'mukeshsds@gmail.com', '2', '3', '3', 1, '2016-07-18'),
(9, 'sushil', 'kumar', 'sushil kumar', 'sushil.kumar', '23456', '9943435465', 'sushilk@gmail.com', '', '', '1', 1, '2016-08-05'),
(10, 'anil', 'kappal', 'anil kappal', 'anil.kappal', '123456', '9953046368', 'anilk@gmail.com', '2', '', '2', 1, '2016-10-22'),
(11, 'sandeep', 'singh', 'sandeep singh', 'sandeep.singh', '765766', '6567576', 'sandee@caretel.com', '2', '3', '3', 1, '2016-07-22'),
(14, 'ramkumar', 'singh', 'ramkumar singh', 'ramkumar.singh', '12345', '9953046368', 'ram@gmail.com', '2', '3', '3', 1, '2016-07-30'),
(16, 'gaurav', 'gautam', 'gaurav gautam', 'gaurav.gautam', '56324444', '54645445', 'gaurav.gautam@gmail.com', '2', '2', '3', 1, '2016-08-01'),
(17, 'anil', 'kappal', 'anil kappal', 'anil.kappal', 'nimish@123', '9953046368', 'ramkmca6@gmail.com', '', '', '1', 1, '2016-10-22'),
(20, 'ram', 'kumar', 'ram kumar', 'ram.kumar', '123456', '9953046368', 'ram.kumar@caretelindia.com', '2', '3', '3', 1, '2016-08-26'),
(21, 'ankit', 'garg', 'ankit garg', 'ankit.garg', 'ankit@123', '9654060881', 'test@gmail.com', '', '', '', 2, '2016-11-05');

-- --------------------------------------------------------

--
-- Table structure for table `ts_user_role`
--

CREATE TABLE `ts_user_role` (
  `role_id` int(2) NOT NULL,
  `role_cat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ts_user_role`
--

INSERT INTO `ts_user_role` (`role_id`, `role_cat`) VALUES
(1, 'Head'),
(2, 'Supervisor'),
(3, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ts_admin_login`
--
ALTER TABLE `ts_admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_attendance`
--
ALTER TABLE `ts_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_batch`
--
ALTER TABLE `ts_batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_class`
--
ALTER TABLE `ts_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_fee`
--
ALTER TABLE `ts_fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_mailcontent`
--
ALTER TABLE `ts_mailcontent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_marks`
--
ALTER TABLE `ts_marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_student`
--
ALTER TABLE `ts_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_user_login`
--
ALTER TABLE `ts_user_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_user_role`
--
ALTER TABLE `ts_user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ts_admin_login`
--
ALTER TABLE `ts_admin_login`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ts_attendance`
--
ALTER TABLE `ts_attendance`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT for table `ts_batch`
--
ALTER TABLE `ts_batch`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `ts_class`
--
ALTER TABLE `ts_class`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `ts_fee`
--
ALTER TABLE `ts_fee`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `ts_mailcontent`
--
ALTER TABLE `ts_mailcontent`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ts_marks`
--
ALTER TABLE `ts_marks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ts_student`
--
ALTER TABLE `ts_student`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `ts_user_login`
--
ALTER TABLE `ts_user_login`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `ts_user_role`
--
ALTER TABLE `ts_user_role`
  MODIFY `role_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
