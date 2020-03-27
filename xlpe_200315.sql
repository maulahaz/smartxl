-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2020 at 11:45 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xlpe`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `fill_calendar` (IN `str_date` DATE, IN `end_date` DATE)  BEGIN
	DECLARE crt_date DATE;
    SET crt_date = str_date;
    WHILE crt_date <= end_date DO
    	INSERT INTO tbl_calendar VALUES(crt_date);
        SET crt_date = ADDDATE(crt_date, INTERVAL 1 DAY);
    END WHILE;    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('nfr40ackvbb0n1jafdpsuca3d5p01s3v', '::1', 1584235171, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343233343930303b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('jrstotuns6sljtstckkansnbaskkjd28', '::1', 1584235256, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343233353235363b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('jl5mrgm6op0bt0e7td6gc52bkjo94m86', '::1', 1584235801, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343233353539313b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('u9p08asp4bk6qm92o8ana8iqjk07k8hg', '::1', 1584236488, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343233363231303b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('c5ou640b8vi05il8u8mti08u95keng7l', '::1', 1584236678, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343233363532383b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('t450e62rpndgp69bkek17mann074fgoa', '::1', 1584240848, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343234303834383b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('s1eknbqeqe5d5cgirab6ot2l2fb509u9', '::1', 1584241822, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343234313533393b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('oinj2tu5ma3q68velvr5gtlvcgst1jlc', '::1', 1584242140, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343234313839313b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('cagv4pvvmunkof8454f374b2hlofj7qd', '::1', 1584242327, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343234323235343b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('gg09ht6nfbrvu7v2lbfkk7l0rq5ad529', '::1', 1584243306, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343234333135383b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('rlh7qqf58mu7vja1hm4j2uaqti8a67c4', '::1', 1584244447, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343234343434373b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('mhp382mbh527t3144ccct1rr9mc5kep9', '::1', 1584244447, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343234343434373b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('5klrbau4bdv7c9tg545dnmv16aufisuf', '::1', 1584244447, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343234343434373b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('kun08r3qv9qdbkuai7j17dios32ehu99', '::1', 1584244701, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343234343434373b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('u2pp3pblfbcqfbi6ppcam8v3jj9ev4rs', '::1', 1584246336, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343234363230313b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('osa0b4g4q32tt7fmnla331muhromrggm', '::1', 1584247056, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343234363835363b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('61k0b61q9m25enu9trrunk9nforbc3g9', '::1', 1584247486, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343234373239323b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('64qeo7253qa00aih1nnprsc439thcd9b', '::1', 1584248200, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343234373930303b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('huj83ujal2gstbcn05all7spvboqj78p', '::1', 1584248216, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343234383230333b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('rb30brkvnj41sn9v3fmk6gksp3cvf07c', '::1', 1584256413, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343235363131393b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('sf8qpmnktq53hkijs2g3hgfp1116hv6j', '::1', 1584257465, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343235373335303b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('fduk1gmhg2b3t35kaekb3n8a0mhn6g34', '::1', 1584258000, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343235383030303b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('cpomrfjrvtmva63r2ruocshfkk1qiruv', '::1', 1584258341, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343235383334313b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b),
('fhiec0c61jtuglbjhg555f80a1ie7p6n', '::1', 1584258836, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538343235383634383b785f69734c6f67676564696e7c623a313b785f75737249447c733a353a2261646d696e223b785f7573725374617475737c733a313a2231223b785f7573724c6576656c7c733a313a2235223b757365725f69647c733a353a2261646d696e223b757365725f617574687c733a313a2235223b);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `uid` int(11) NOT NULL,
  `Usr_id` varchar(20) NOT NULL,
  `Usr_pwd` varchar(100) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Nickname` varchar(10) NOT NULL,
  `Position` varchar(50) NOT NULL,
  `Usr_level` varchar(5) NOT NULL,
  `Usr_status` int(1) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `Phone1` varchar(20) NOT NULL,
  `Phone2` varchar(20) NOT NULL,
  `Phone_ext` varchar(20) NOT NULL,
  `Phone_emg` varchar(50) NOT NULL,
  `Update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`uid`, `Usr_id`, `Usr_pwd`, `Name`, `Nickname`, `Position`, `Usr_level`, `Usr_status`, `Email`, `Photo`, `Phone1`, `Phone2`, `Phone_ext`, `Phone_emg`, `Update_at`) VALUES
(1, 'brw00096', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Ramachandran Lokaiah', 'Rama', 'XLPE-Operation Mgr', '4', 1, 'ramachandran.lokaiah@borouge.com', 'uploads/account/man-user.png', '505627360', '', '785225', '+919789054667 and +9', '2019-09-17 17:32:00'),
(2, 'brw00158', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Mohamed Hanifa M Ali', 'Ali', 'Shift Controller', '2', 1, 'mohamed.hanifa@borouge.com', 'uploads/account/man-user.png', '505467091', '28762392', '', '', '2019-09-17 17:32:00'),
(3, 'brw00463', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Kulaifikh Naser Al Hajri', '', 'LDPE-Operation Mgr', '4', 1, 'kulaifikh.alhajri@borouge.com', 'uploads/account/man-user.png', '504469050', '', '85222', '', '2019-09-17 17:32:00'),
(4, 'brw00693', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Ahmed Tareq Yousif Al Ansari', 'Ansari', 'Shift Controller', '2', 1, 'ahmed.alansari@borouge.com', 'uploads/account/man-user.png', '505119991', '505119991', '', '501666772', '2019-09-17 17:32:00'),
(5, 'brw00764', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Joseph Roy Diwa', '', 'Day Team Controller', '2', 1, 'joseph.diwa@borouge.com', 'uploads/account/man-user.png', '507803745', '', '85288', '', '2019-09-17 17:32:00'),
(6, 'brw00983', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Salem Rashed Alnaqbi', '', 'Shift Controller', '2', 1, 'Salem.alnaqabi@borouge.com', 'uploads/account/man-user.png', '507185511', '', '', '', '2019-09-17 17:32:00'),
(7, 'brw02036', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Ahmed Belal Mohamed', '', 'Day Operator', '1', 0, 'Ahmed.Mohamed@borouge.com', 'uploads/account/man-user.png', '507064666', '', '85154', '', '2019-09-17 17:32:00'),
(8, 'brw02067', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Paritosh Haldar', '', 'Process Trainer', '2', 1, 'paritosh.haldar@borouge.com', 'uploads/account/man-user.png', '566123729', '', '85244', '', '2019-09-17 17:32:00'),
(9, 'brw02098', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Soni Yusup Komar Suriadji', '', 'Shift Controller', '2', 1, 'soni.suriadji@borouge.com', 'uploads/account/man-user.png', '561975841', '567342774', '', '622678457605', '2019-09-17 17:32:00'),
(10, 'brw02125', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Ismail Bin B Mohamed', '', 'Shift Controller', '2', 1, 'ismail.mohamed@borouge.com', 'uploads/account/man-user.png', '562369685', '', '', '', '2019-09-17 17:32:00'),
(11, 'brw02162', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Kalpeshkumar K Dadhania', '', 'Operator', '1', 1, 'kalpeshkumar.dadhania@borouge.com', 'uploads/account/man-user.png', '567734210', '', '', '919662545562', '2019-09-17 17:32:00'),
(12, 'brw02199', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Semar Abdul Khader Syed', '', 'Office Administrator', '1', 0, 'semar.syed@borouge.com', 'uploads/account/man-user.png', '504120450', '', '85190', '', '2019-09-17 17:32:00'),
(13, 'brw02206', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Kalpesh Pagariya', '', 'Eng Prod', '3', 1, 'kalpesh.pagariya@borouge.com', 'uploads/account/man-user.png', '567942743', '', '', '', '2019-09-17 17:32:00'),
(14, 'brw02239', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Nuraine Binti Iberahim', '', 'Process Control Eng  ', '3', 1, 'nuraine.iberahim@borouge.com', 'uploads/account/man-user.png', '508259048', '562685582', '', '60123887922', '2019-09-17 17:32:00'),
(15, 'brw02245', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Shibu Karunakaran', '', 'Eng Prod', '3', 1, 'shibu.karunakaran@borouge.com', 'uploads/account/man-user.png', '561330529', '', '', '', '2019-09-17 17:32:00'),
(16, 'brw02248', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Abhilash Vadakkedath S', '', 'Shift Controller', '2', 1, 'abhilash.sivasankarannair@borouge.com', 'uploads/account/man-user.png', '501216960', '28768725', '', '918592912081', '2019-09-17 17:32:00'),
(17, 'brw02256', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Gopalkumar Krishnalal Vyas', '', 'Operator', '1', 1, 'gopalkumar.krishnalalvyas@borouge.com', 'uploads/account/man-user.png', '562898117', '', '', 'IND-00919427950343', '2019-09-17 17:32:00'),
(18, 'brw02307', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Ralph Navarro Diaz', '', 'Operator', '1', 1, 'ralph.diaz@borouge.com', 'uploads/account/man-user.png', '562681584', '28768145', '', '639228012056', '2019-09-17 17:32:00'),
(19, 'brw02308', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Zenrio Ryan Borbon', '', 'Operator', '1', 1, 'zenrio.borbon@borouge.com', 'uploads/account/man-user.png', '562681560', '', '', '639192836358', '2019-09-17 17:32:00'),
(20, 'brw02316', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Manuel Nunez Manzano', '', 'Operator', '1', 0, 'manuel.manzano@borouge.com', 'uploads/account/man-user.png', '502290130', '', '', '', '2019-09-17 17:32:00'),
(21, 'brw02334', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Abdulla Salem Al Ameri', '', 'Operator', '1', 1, 'abdulla.alameri2@borouge.com', 'uploads/account/man-user.png', '507749947', '', '', '', '2019-09-17 17:32:00'),
(22, 'brw02335', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Musleh Saleh Al Sayari', '', 'Operator', '1', 0, 'musleh.alsayari@borouge.com', 'uploads/account/man-user.png', '501175524', '', '', '', '2019-09-17 17:32:00'),
(23, 'brw02336', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Ahmed Fayez Al Wahedi', '', 'Operator', '1', 1, 'ahmed.alwahedi@borouge.com', 'uploads/account/man-user.png', '503172007', '', '', '', '2019-09-17 17:32:00'),
(24, 'brw02356', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Robert John Shingare', '', 'HSE Coordinator', '2', 0, 'robert.shingare@borouge.com', 'uploads/account/man-user.png', '562681576', '', '85192', '', '2019-09-17 17:32:00'),
(25, 'brw02366', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Maulana Hazmi', 'Hazmi', 'Operator', '1', 1, 'maulana.hazmi@borouge.com', 'uploads/account/man-user.png', '562681844', '', '', '', '2019-09-17 17:32:00'),
(26, 'brw02371', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Samir Kumar Patel ', '', 'Operator', '1', 1, 'samirkumar.patel@borouge.com', 'uploads/account/man-user.png', '562681841', '28768197', '', '918128817577', '2019-09-17 17:32:00'),
(27, 'brw02380', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Bjorn Villaflor Fernandez', '', 'Operator', '1', 1, 'bjorn.fernandez@borouge.com', 'uploads/account/man-user.png', '566913092', '', '', '', '2019-09-17 17:32:00'),
(28, 'brw02386', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Ronald Sevilla Torrico', '', 'Operator', '1', 1, 'ronald.torrico@borouge.com', 'uploads/account/man-user.png', '566914291', '', '', '', '2019-09-17 17:32:00'),
(29, 'brw02390', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Syed Ahmed', '', 'Operator', '1', 1, 'syed.mohamed@borouge.com', 'uploads/account/man-user.png', '507904711', '', '', '', '2019-09-17 17:32:00'),
(30, 'brw02396', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Antil Kiritbhai Patel', '', 'Operator', '1', 1, 'antil.patel@borouge.com', 'uploads/account/man-user.png', '566901296', '28768124', '', '0091 9979891029', '2019-09-17 17:32:00'),
(31, 'brw02399', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Paresh Laxman Savaliya', '', 'Operator', '1', 1, 'paresh.savaliya@borouge.com', 'uploads/account/man-user.png', '566901289', '', '', '919979294600', '2019-09-17 17:32:00'),
(32, 'brw02405', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Dave Singayen Germo', '', 'Operator', '1', 1, 'dave.germo@borouge.com', 'uploads/account/man-user.png', '566901296', '28764030', '', '639103575403', '2019-09-17 17:32:00'),
(33, 'brw02412', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Muardi Bn Sumpono', '', 'Operator', '1', 1, 'muardi.pawirodiharjo@borouge.com', 'uploads/account/man-user.png', '563483577', '', '', '628121351947', '2019-09-17 17:32:00'),
(34, 'brw02430', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'MihirKumar Dinesh Patel', '', 'Operator', '1', 1, 'mihirkumar.patel@borouge.com', 'uploads/account/man-user.png', '563198863', '28768064', '', 'IND-00919724007614', '2019-09-17 17:32:00'),
(35, 'brw02448', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Mohd. Kamal Bin Jais', '', 'Operator', '1', 1, 'mohd.jais@borouge.com', 'uploads/account/man-user.png', '562127365', '', '', '60127433233', '2019-09-17 17:32:00'),
(36, 'brw02470', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Laurence delos Reyes', '', 'Operator', '1', 1, 'laurence.reyes@borouge.com', 'uploads/account/man-user.png', '563198349', '563198349', '', '639275139876', '2019-09-17 17:32:00'),
(37, 'brw02474', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Ahmad Hasan Ali Chitra', '', 'Operator', '1', 1, 'ahmad.chitra@borouge.com', 'uploads/account/man-user.png', '562127365', '28768068', '', '6287871241909', '2019-09-17 17:32:00'),
(38, 'brw02496', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Constantin Negreci', '', 'Day Operator', '1', 0, 'constantin.negreci@borouge.com', 'uploads/account/man-user.png', '503199305', '', '85152', '', '2019-09-17 17:32:00'),
(39, 'brw02771', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Hasmukhkumar Z Patel', '', 'Operator', '1', 1, 'hasmukhkumar.patel@borouge.com', 'uploads/account/man-user.png', '507068394', '507068394', '', '919998004757', '2019-09-17 17:32:00'),
(40, 'brw02829', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Ali Salem Ali Al Hosani', '', 'Operator (U/D)', '1', 0, 'ali.alhosani3@borouge.com', 'uploads/account/man-user.png', '507614771', '', '', '', '2019-09-17 17:32:00'),
(41, 'brw03053', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Abdulla M Al Hammadi', '', 'Operator (U/D)', '1', 0, 'Abdulla.AlHammadi5@borouge.com', 'uploads/account/man-user.png', '0', '', '', '', '2019-09-17 17:32:00'),
(42, 'brw03194', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Khaled A M S Alkouri', '', 'Operator (U/D)', '1', 0, 'Khaled.AlKouri@borouge.com', 'uploads/account/man-user.png', '522396807', '', '', '', '2019-09-17 17:32:00'),
(43, 'brw03198', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Mohamed Arif Alameri', '', 'Operator (U/D)', '1', 0, 'Mohamed.AlAmeri5@borouge.com', 'uploads/account/man-user.png', '502633313', '', '', '', '2019-09-17 17:32:00'),
(44, 'brw10001', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Tareq Al Azri', '', 'Operator', '1', 1, '', 'uploads/account/man-user.png', '0', '', '', '', '2019-09-17 17:32:00'),
(45, 'brw10001', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Hamad Al Shamsi', '', 'Operator', '1', 1, '', 'uploads/account/man-user.png', '0', '0501861617-Father', '', '0507038580 new mob.', '2019-09-17 17:32:00'),
(46, 'brw10001', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Abdullah Alfazari', '', 'Eng Prod (U/D)', '3', 1, '', 'uploads/account/man-user.png', '501709180', '', '', '', '2019-09-17 17:32:00'),
(47, 'brw10001', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Fahad Almsalami', '', 'Operator', '1', 1, '', 'uploads/account/man-user.png', '0', '0506607090-Uncle', '', '', '2019-09-17 17:32:00'),
(48, 'brw10001', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Mohd. Jaib Bin Ismail', '', 'Operator', '1', 0, '', 'uploads/account/man-user.png', '0', '', '', '60167607574', '2019-09-17 17:32:00'),
(49, 'brw10001', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Ali Al Menhali', '', 'Operator', '1', 1, '', 'uploads/account/man-user.png', '0', '', '', '', '2019-09-17 17:32:00'),
(50, 'brw10001', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Nasir Al Hosani', '', 'Operator', '1', 1, '', 'uploads/account/man-user.png', '506772672', '506281808', '', '', '2019-09-17 17:32:00'),
(51, 'brw10001', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Mohamed Al Kalbani', '', 'Operator', '1', 1, '', 'uploads/account/man-user.png', '0', '509992109', '', '', '2019-09-17 17:32:00'),
(52, 'brw10001', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Mohamed Al Katheeri', '', 'Operator', '1', 1, '', 'uploads/account/man-user.png', '0', '0528006033-Father', '', '501128204', '2019-09-17 17:32:00'),
(53, 'brw90000', '$2y$11$Ksv25ONnhIKY18E/.3bptuagIT5p2MoVZMngtZ9ZB7br17DTesCCW', 'Admin of XLPE', 'admin', 'Web Administrator', '5', 1, 'admin@xlpe.com', 'uploads/account/man-user.png', '555555555', '2888888', '88888', '88888', '2019-09-17 17:32:00'),
(54, 'brw90236', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Marc Theo De Vleeschhauwer', '', 'XLPE-Operation Mgr', '4', 0, 'marc.vleeschhauwer@borouge.com', 'uploads/account/man-user.png', '566136321', '', '', '32475755889', '2019-09-17 17:32:00'),
(55, 'brw90248', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Paul Vinken', '', 'SU Lead Eng', '4', 0, 'paul.vinken@borouge.com', 'uploads/account/man-user.png', '566106360', '', '', '', '2019-09-17 17:32:00'),
(56, 'brw90251', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Jan Sacker', '', 'SU Specialist', '4', 0, 'jan.sacker@borouge.com', 'uploads/account/man-user.png', '502421784', '', '', '', '2019-09-17 17:32:00'),
(57, 'brw90266', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Paulus Berg', '', 'Lead Eng- OpEX', '4', 0, 'paulus.berg@borouge.com', 'uploads/account/man-user.png', '561553086', '', '85233', '', '2019-09-17 17:32:00'),
(58, 'brw90286', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Asa Bjork', '', 'SU Specialist', '3', 0, 'asa.bjork@borouge.com', 'uploads/account/man-user.png', '562072275', '', '', '', '2019-09-17 17:32:00'),
(59, 'brw90287', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Roland Lucien Martha Poppe', '', 'SU Specialist', '4', 0, 'roland.poppe@borouge.com', 'uploads/account/man-user.png', '562078456', '', '', '', '2019-09-17 17:32:00'),
(60, 'brw90314', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Erik Joseph M Stoffijn', '', 'SU Specialist', '3', 0, 'erik.stoffijn@borouge.com', 'uploads/account/man-user.png', '562890780', '', '', '', '2019-09-17 17:32:00'),
(61, 'brw90331', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Dirk Maria G Breugelmans', '', 'SU Panel Operator', '2', 0, 'dirk.breugelmans2@borouge.com', 'uploads/account/man-user.png', '561963500', '', '', '', '2019-09-17 17:32:00'),
(62, 'brw90332', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Bo Linus Broberg', '', 'SU Panel Operator', '2', 0, 'bo.broberg@borouge.com', 'uploads/account/man-user.png', '562127397', '', '', '', '2019-09-17 17:32:00'),
(63, 'brw90335', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Emil Christer Ekelund', '', 'SU Panel Operator', '2', 0, 'emil.ekelund2@borouge.com', 'uploads/account/man-user.png', '562127387', '', '', '', '2019-09-17 17:32:00'),
(64, 'brw90374', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'Gauthier Hanquet', '', 'VP, Specialty Polymers', '4', 0, 'Gauthier.Hanquet@borouge.com', 'uploads/account/man-user.png', '567280436', '', '74421', '', '2019-09-17 17:32:00'),
(65, 'test', '$2y$11$pNKouY67pnmOn.pxqRm4nuM0WDWl2SfqjmsVmqEgju5UrFKP1aIAG', 'User Test', '', 'User Tester', '4', 1, '', 'uploads/account/man-user.png', '0', '', '', '', '2019-09-17 17:32:00'),
(66, 'user', 'user', '', '', '', '', 0, '', '', '', '', '', '', '2020-02-07 04:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bypass`
--

CREATE TABLE `tbl_bypass` (
  `uid` int(11) NOT NULL,
  `byp_type` int(11) NOT NULL,
  `byp_no` int(11) NOT NULL,
  `area_unit` varchar(50) NOT NULL,
  `byp_date` int(11) NOT NULL,
  `byp_tag` varchar(100) NOT NULL,
  `inlock_affected` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `list_action` text NOT NULL,
  `method` varchar(255) NOT NULL,
  `byp_location` varchar(50) NOT NULL,
  `effects` varchar(255) NOT NULL,
  `is_mitig1` int(11) NOT NULL,
  `is_mitig2` int(11) NOT NULL,
  `is_mitig3` int(11) NOT NULL,
  `is_mitig4` int(11) NOT NULL,
  `is_mitig5` int(11) NOT NULL,
  `prepared_by` varchar(50) NOT NULL,
  `prepare_date` int(11) NOT NULL,
  `close_by` varchar(50) NOT NULL,
  `close_date` int(11) NOT NULL,
  `action_what1` text NOT NULL,
  `action_who1` varchar(50) NOT NULL,
  `action_what2` text NOT NULL,
  `action_who2` varchar(50) NOT NULL,
  `action_what3` text NOT NULL,
  `action_who3` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bypass`
--

INSERT INTO `tbl_bypass` (`uid`, `byp_type`, `byp_no`, `area_unit`, `byp_date`, `byp_tag`, `inlock_affected`, `reason`, `list_action`, `method`, `byp_location`, `effects`, `is_mitig1`, `is_mitig2`, `is_mitig3`, `is_mitig4`, `is_mitig5`, `prepared_by`, `prepare_date`, `close_by`, `close_date`, `action_what1`, `action_who1`, `action_what2`, `action_who2`, `action_what3`, `action_who3`) VALUES
(1, 1, 232, '3/46', 1550385977, '46-PDI-2343', 'S-1522, I-2261', 'PM Job', '-', 'LFCP', '', '', 0, 0, 0, 0, 0, '', 0, 'brw00158', 0, '', '', '', '', '', ''),
(2, 3, 243, '2/46', 1550403977, 'PI-3422', 'S-7785, S-0001', 'Stroke test purpose', '-', 'DCS, ESD', '', '', 0, 0, 0, 0, 0, '', 0, '', 0, '', '', '', '', '', ''),
(3, 1, 245, '2/46', 1549087200, '46-PDI-2213', 'S-2122', 'Test for performance', '-', 'LFCP', '', '', 0, 0, 0, 0, 0, '', 0, 'brw02125', 0, '', '', '', '', '', ''),
(7, 2, 247, '', 1549096500, '46TI1222', 'I33221', 'PM Job yg ke 2', 'sdgfsd', '', '', '', 0, 0, 0, 0, 0, '', 0, '', 0, '', '', '', '', '', ''),
(11, 3, 325, '', 1551333600, 'TI-3321', 'I-9907', 'New Device, to prevent trip', 'none', '', '', '', 0, 0, 0, 0, 0, '', 0, '', 0, '', '', '', '', '', ''),
(12, 3, 326, '', 1551577333, 'TI-3321', 'I-9907', 'New Device, to prevent trip', 'none', '', '', '', 0, 0, 0, 0, 0, '', 0, '', 0, '', '', '', '', '', ''),
(13, 1, 327, '46/2', 1551603600, '46TI1222', 'I-0228, S-0200', 'PM Job yg ke 2', 'Put jumper on the cable', 'Software', 'DCS', 'None', 0, 0, 0, 0, 0, 'brw02125', 1551668400, '', 0, 'Doing this', 'DCS', 'What Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae esse adipisci culpa quaerat natus a ipsum libero, eius What Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae esse adipisci culpa quaerat natus a ipsum libero, eius.', 'DCS', 'Comment is enaugh', 'Supv'),
(14, 2, 328, '', 1551765600, '46-TI-0011', 'S-0091A', 'Mis reading frequently', 'None', '', '', '', 0, 0, 0, 0, 0, '', 0, '', 0, '', '', '', '', '', ''),
(15, 2, 329, '46/1', 1551765600, '46-PI-9090', 'I-0011, S-9011A', 'Error reading during winter', 'extra Safety valve has been installed', 'Value forcing', 'DCS, PLC', 'None', 0, 0, 0, 0, 0, 'brw02122', 1552366800, '', 0, 'Monitoring this when that is occured', 'DCS', 'Inform other dept when that is happen', 'Supv', '', ''),
(16, 2, 330, '46/3', 1551789300, 'TI-330', 'I-330', 'Broken items', '-', 'Software', 'DCS', 'none', 0, 0, 0, 0, 0, 'brw09100', 1551783600, '12-Mar-2019 13:00', 0, 'Doing this', 'DCS', '', '', '', ''),
(17, 1, 331, '3/46', 1555004580, 'AI-1010', 'I-0232', 'Maintenance', 'None', 'Value forcing', 'DCS', 'None', 0, 0, 0, 0, 0, 'brw02122', 1548115200, 'brw0290', 1551358800, 'Nonen', 'None', '', '', '', ''),
(18, 1, 332, '3/46', 1555004797, 'AI-1010', 'I-0232', 'Maintenance', 'None', 'Value forcing', 'DCS', 'None', 0, 0, 0, 0, 0, '', 0, '', 0, 'Nonen', 'None', '', '', '', ''),
(19, 2, 333, '2', 1566122460, 'TI-2045', 'I-2000', 'Instr. problem', '-', 'Force value', 'DCS', '-', 0, 0, 0, 0, 0, 'Mihir', 18, '', 0, 'Monitor TI', 'DCS', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_calendar`
--

CREATE TABLE `tbl_calendar` (
  `Datefield` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_calendar`
--

INSERT INTO `tbl_calendar` (`Datefield`) VALUES
('2019-01-01'),
('2019-01-02'),
('2019-01-03'),
('2019-01-04'),
('2019-01-05'),
('2019-01-06'),
('2019-01-07'),
('2019-01-08'),
('2019-01-09'),
('2019-01-10'),
('2019-01-11'),
('2019-01-12'),
('2019-01-13'),
('2019-01-14'),
('2019-01-15'),
('2019-01-16'),
('2019-01-17'),
('2019-01-18'),
('2019-01-19'),
('2019-01-20'),
('2019-01-21'),
('2019-01-22'),
('2019-01-23'),
('2019-01-24'),
('2019-01-25'),
('2019-01-26'),
('2019-01-27'),
('2019-01-28'),
('2019-01-29'),
('2019-01-30'),
('2019-01-31'),
('2019-02-01'),
('2019-02-02'),
('2019-02-03'),
('2019-02-04'),
('2019-02-05'),
('2019-02-06'),
('2019-02-07'),
('2019-02-08'),
('2019-02-09'),
('2019-02-10'),
('2019-02-11'),
('2019-02-12'),
('2019-02-13'),
('2019-02-14'),
('2019-02-15'),
('2019-02-16'),
('2019-02-17'),
('2019-02-18'),
('2019-02-19'),
('2019-02-20'),
('2019-02-21'),
('2019-02-22'),
('2019-02-23'),
('2019-02-24'),
('2019-02-25'),
('2019-02-26'),
('2019-02-27'),
('2019-02-28'),
('2019-03-01'),
('2019-03-02'),
('2019-03-03'),
('2019-03-04'),
('2019-03-05'),
('2019-03-06'),
('2019-03-07'),
('2019-03-08'),
('2019-03-09'),
('2019-03-10'),
('2019-03-11'),
('2019-03-12'),
('2019-03-13'),
('2019-03-14'),
('2019-03-15'),
('2019-03-16'),
('2019-03-17'),
('2019-03-18'),
('2019-03-19'),
('2019-03-20'),
('2019-03-21'),
('2019-03-22'),
('2019-03-23'),
('2019-03-24'),
('2019-03-25'),
('2019-03-26'),
('2019-03-27'),
('2019-03-28'),
('2019-03-29'),
('2019-03-30'),
('2019-03-31'),
('2019-04-01'),
('2019-04-02'),
('2019-04-03'),
('2019-04-04'),
('2019-04-05'),
('2019-04-06'),
('2019-04-07'),
('2019-04-08'),
('2019-04-09'),
('2019-04-10'),
('2019-04-11'),
('2019-04-12'),
('2019-04-13'),
('2019-04-14'),
('2019-04-15'),
('2019-04-16'),
('2019-04-17'),
('2019-04-18'),
('2019-04-19'),
('2019-04-20'),
('2019-04-21'),
('2019-04-22'),
('2019-04-23'),
('2019-04-24'),
('2019-04-25'),
('2019-04-26'),
('2019-04-27'),
('2019-04-28'),
('2019-04-29'),
('2019-04-30'),
('2019-05-01'),
('2019-05-02'),
('2019-05-03'),
('2019-05-04'),
('2019-05-05'),
('2019-05-06'),
('2019-05-07'),
('2019-05-08'),
('2019-05-09'),
('2019-05-10'),
('2019-05-11'),
('2019-05-12'),
('2019-05-13'),
('2019-05-14'),
('2019-05-15'),
('2019-05-16'),
('2019-05-17'),
('2019-05-18'),
('2019-05-19'),
('2019-05-20'),
('2019-05-21'),
('2019-05-22'),
('2019-05-23'),
('2019-05-24'),
('2019-05-25'),
('2019-05-26'),
('2019-05-27'),
('2019-05-28'),
('2019-05-29'),
('2019-05-30'),
('2019-05-31'),
('2019-06-01'),
('2019-06-02'),
('2019-06-03'),
('2019-06-04'),
('2019-06-05'),
('2019-06-06'),
('2019-06-07'),
('2019-06-08'),
('2019-06-09'),
('2019-06-10'),
('2019-06-11'),
('2019-06-12'),
('2019-06-13'),
('2019-06-14'),
('2019-06-15'),
('2019-06-16'),
('2019-06-17'),
('2019-06-18'),
('2019-06-19'),
('2019-06-20'),
('2019-06-21'),
('2019-06-22'),
('2019-06-23'),
('2019-06-24'),
('2019-06-25'),
('2019-06-26'),
('2019-06-27'),
('2019-06-28'),
('2019-06-29'),
('2019-06-30'),
('2019-07-01'),
('2019-07-02'),
('2019-07-03'),
('2019-07-04'),
('2019-07-05'),
('2019-07-06'),
('2019-07-07'),
('2019-07-08'),
('2019-07-09'),
('2019-07-10'),
('2019-07-11'),
('2019-07-12'),
('2019-07-13'),
('2019-07-14'),
('2019-07-15'),
('2019-07-16'),
('2019-07-17'),
('2019-07-18'),
('2019-07-19'),
('2019-07-20'),
('2019-07-21'),
('2019-07-22'),
('2019-07-23'),
('2019-07-24'),
('2019-07-25'),
('2019-07-26'),
('2019-07-27'),
('2019-07-28'),
('2019-07-29'),
('2019-07-30'),
('2019-07-31'),
('2019-08-01'),
('2019-08-02'),
('2019-08-03'),
('2019-08-04'),
('2019-08-05'),
('2019-08-06'),
('2019-08-07'),
('2019-08-08'),
('2019-08-09'),
('2019-08-10'),
('2019-08-11'),
('2019-08-12'),
('2019-08-13'),
('2019-08-14'),
('2019-08-15'),
('2019-08-16'),
('2019-08-17'),
('2019-08-18'),
('2019-08-19'),
('2019-08-20'),
('2019-08-21'),
('2019-08-22'),
('2019-08-23'),
('2019-08-24'),
('2019-08-25'),
('2019-08-26'),
('2019-08-27'),
('2019-08-28'),
('2019-08-29'),
('2019-08-30'),
('2019-08-31'),
('2019-09-01'),
('2019-09-02'),
('2019-09-03'),
('2019-09-04'),
('2019-09-05'),
('2019-09-06'),
('2019-09-07'),
('2019-09-08'),
('2019-09-09'),
('2019-09-10'),
('2019-09-11'),
('2019-09-12'),
('2019-09-13'),
('2019-09-14'),
('2019-09-15'),
('2019-09-16'),
('2019-09-17'),
('2019-09-18'),
('2019-09-19'),
('2019-09-20'),
('2019-09-21'),
('2019-09-22'),
('2019-09-23'),
('2019-09-24'),
('2019-09-25'),
('2019-09-26'),
('2019-09-27'),
('2019-09-28'),
('2019-09-29'),
('2019-09-30'),
('2019-10-01'),
('2019-10-02'),
('2019-10-03'),
('2019-10-04'),
('2019-10-05'),
('2019-10-06'),
('2019-10-07'),
('2019-10-08'),
('2019-10-09'),
('2019-10-10'),
('2019-10-11'),
('2019-10-12'),
('2019-10-13'),
('2019-10-14'),
('2019-10-15'),
('2019-10-16'),
('2019-10-17'),
('2019-10-18'),
('2019-10-19'),
('2019-10-20'),
('2019-10-21'),
('2019-10-22'),
('2019-10-23'),
('2019-10-24'),
('2019-10-25'),
('2019-10-26'),
('2019-10-27'),
('2019-10-28'),
('2019-10-29'),
('2019-10-30'),
('2019-10-31'),
('2019-11-01'),
('2019-11-02'),
('2019-11-03'),
('2019-11-04'),
('2019-11-05'),
('2019-11-06'),
('2019-11-07'),
('2019-11-08'),
('2019-11-09'),
('2019-11-10'),
('2019-11-11'),
('2019-11-12'),
('2019-11-13'),
('2019-11-14'),
('2019-11-15'),
('2019-11-16'),
('2019-11-17'),
('2019-11-18'),
('2019-11-19'),
('2019-11-20'),
('2019-11-21'),
('2019-11-22'),
('2019-11-23'),
('2019-11-24'),
('2019-11-25'),
('2019-11-26'),
('2019-11-27'),
('2019-11-28'),
('2019-11-29'),
('2019-11-30'),
('2019-12-01'),
('2019-12-02'),
('2019-12-03'),
('2019-12-04'),
('2019-12-05'),
('2019-12-06'),
('2019-12-07'),
('2019-12-08'),
('2019-12-09'),
('2019-12-10'),
('2019-12-11'),
('2019-12-12'),
('2019-12-13'),
('2019-12-14'),
('2019-12-15'),
('2019-12-16'),
('2019-12-17'),
('2019-12-18'),
('2019-12-19'),
('2019-12-20'),
('2019-12-21'),
('2019-12-22'),
('2019-12-23'),
('2019-12-24'),
('2019-12-25'),
('2019-12-26'),
('2019-12-27'),
('2019-12-28'),
('2019-12-29'),
('2019-12-30'),
('2019-12-31'),
('2020-01-01'),
('2020-01-02'),
('2020-01-03'),
('2020-01-04'),
('2020-01-05'),
('2020-01-06'),
('2020-01-07'),
('2020-01-08'),
('2020-01-09'),
('2020-01-10'),
('2020-01-11'),
('2020-01-12'),
('2020-01-13'),
('2020-01-14'),
('2020-01-15'),
('2020-01-16'),
('2020-01-17'),
('2020-01-18'),
('2020-01-19'),
('2020-01-20'),
('2020-01-21'),
('2020-01-22'),
('2020-01-23'),
('2020-01-24'),
('2020-01-25'),
('2020-01-26'),
('2020-01-27'),
('2020-01-28'),
('2020-01-29'),
('2020-01-30'),
('2020-01-31'),
('2020-02-01'),
('2020-02-02'),
('2020-02-03'),
('2020-02-04'),
('2020-02-05'),
('2020-02-06'),
('2020-02-07'),
('2020-02-08'),
('2020-02-09'),
('2020-02-10'),
('2020-02-11'),
('2020-02-12'),
('2020-02-13'),
('2020-02-14'),
('2020-02-15'),
('2020-02-16'),
('2020-02-17'),
('2020-02-18'),
('2020-02-19'),
('2020-02-20'),
('2020-02-21'),
('2020-02-22'),
('2020-02-23'),
('2020-02-24'),
('2020-02-25'),
('2020-02-26'),
('2020-02-27'),
('2020-02-28'),
('2020-02-29'),
('2020-03-01'),
('2020-03-02'),
('2020-03-03'),
('2020-03-04'),
('2020-03-05'),
('2020-03-06'),
('2020-03-07'),
('2020-03-08'),
('2020-03-09'),
('2020-03-10'),
('2020-03-11'),
('2020-03-12'),
('2020-03-13'),
('2020-03-14'),
('2020-03-15'),
('2020-03-16'),
('2020-03-17'),
('2020-03-18'),
('2020-03-19'),
('2020-03-20'),
('2020-03-21'),
('2020-03-22'),
('2020-03-23'),
('2020-03-24'),
('2020-03-25'),
('2020-03-26'),
('2020-03-27'),
('2020-03-28'),
('2020-03-29'),
('2020-03-30'),
('2020-03-31'),
('2020-04-01'),
('2020-04-02'),
('2020-04-03'),
('2020-04-04'),
('2020-04-05'),
('2020-04-06'),
('2020-04-07'),
('2020-04-08'),
('2020-04-09'),
('2020-04-10'),
('2020-04-11'),
('2020-04-12'),
('2020-04-13'),
('2020-04-14'),
('2020-04-15'),
('2020-04-16'),
('2020-04-17'),
('2020-04-18'),
('2020-04-19'),
('2020-04-20'),
('2020-04-21'),
('2020-04-22'),
('2020-04-23'),
('2020-04-24'),
('2020-04-25'),
('2020-04-26'),
('2020-04-27'),
('2020-04-28'),
('2020-04-29'),
('2020-04-30'),
('2020-05-01'),
('2020-05-02'),
('2020-05-03'),
('2020-05-04'),
('2020-05-05'),
('2020-05-06'),
('2020-05-07'),
('2020-05-08'),
('2020-05-09'),
('2020-05-10'),
('2020-05-11'),
('2020-05-12'),
('2020-05-13'),
('2020-05-14'),
('2020-05-15'),
('2020-05-16'),
('2020-05-17'),
('2020-05-18'),
('2020-05-19'),
('2020-05-20'),
('2020-05-21'),
('2020-05-22'),
('2020-05-23'),
('2020-05-24'),
('2020-05-25'),
('2020-05-26'),
('2020-05-27'),
('2020-05-28'),
('2020-05-29'),
('2020-05-30'),
('2020-05-31'),
('2020-06-01'),
('2020-06-02'),
('2020-06-03'),
('2020-06-04'),
('2020-06-05'),
('2020-06-06'),
('2020-06-07'),
('2020-06-08'),
('2020-06-09'),
('2020-06-10'),
('2020-06-11'),
('2020-06-12'),
('2020-06-13'),
('2020-06-14'),
('2020-06-15'),
('2020-06-16'),
('2020-06-17'),
('2020-06-18'),
('2020-06-19'),
('2020-06-20'),
('2020-06-21'),
('2020-06-22'),
('2020-06-23'),
('2020-06-24'),
('2020-06-25'),
('2020-06-26'),
('2020-06-27'),
('2020-06-28'),
('2020-06-29'),
('2020-06-30'),
('2020-07-01'),
('2020-07-02'),
('2020-07-03'),
('2020-07-04'),
('2020-07-05'),
('2020-07-06'),
('2020-07-07'),
('2020-07-08'),
('2020-07-09'),
('2020-07-10'),
('2020-07-11'),
('2020-07-12'),
('2020-07-13'),
('2020-07-14'),
('2020-07-15'),
('2020-07-16'),
('2020-07-17'),
('2020-07-18'),
('2020-07-19'),
('2020-07-20'),
('2020-07-21'),
('2020-07-22'),
('2020-07-23'),
('2020-07-24'),
('2020-07-25'),
('2020-07-26'),
('2020-07-27'),
('2020-07-28'),
('2020-07-29'),
('2020-07-30'),
('2020-07-31'),
('2020-08-01'),
('2020-08-02'),
('2020-08-03'),
('2020-08-04'),
('2020-08-05'),
('2020-08-06'),
('2020-08-07'),
('2020-08-08'),
('2020-08-09'),
('2020-08-10'),
('2020-08-11'),
('2020-08-12'),
('2020-08-13'),
('2020-08-14'),
('2020-08-15'),
('2020-08-16'),
('2020-08-17'),
('2020-08-18'),
('2020-08-19'),
('2020-08-20'),
('2020-08-21'),
('2020-08-22'),
('2020-08-23'),
('2020-08-24'),
('2020-08-25'),
('2020-08-26'),
('2020-08-27'),
('2020-08-28'),
('2020-08-29'),
('2020-08-30'),
('2020-08-31'),
('2020-09-01'),
('2020-09-02'),
('2020-09-03'),
('2020-09-04'),
('2020-09-05'),
('2020-09-06'),
('2020-09-07'),
('2020-09-08'),
('2020-09-09'),
('2020-09-10'),
('2020-09-11'),
('2020-09-12'),
('2020-09-13'),
('2020-09-14'),
('2020-09-15'),
('2020-09-16'),
('2020-09-17'),
('2020-09-18'),
('2020-09-19'),
('2020-09-20'),
('2020-09-21'),
('2020-09-22'),
('2020-09-23'),
('2020-09-24'),
('2020-09-25'),
('2020-09-26'),
('2020-09-27'),
('2020-09-28'),
('2020-09-29'),
('2020-09-30'),
('2020-10-01'),
('2020-10-02'),
('2020-10-03'),
('2020-10-04'),
('2020-10-05'),
('2020-10-06'),
('2020-10-07'),
('2020-10-08'),
('2020-10-09'),
('2020-10-10'),
('2020-10-11'),
('2020-10-12'),
('2020-10-13'),
('2020-10-14'),
('2020-10-15'),
('2020-10-16'),
('2020-10-17'),
('2020-10-18'),
('2020-10-19'),
('2020-10-20'),
('2020-10-21'),
('2020-10-22'),
('2020-10-23'),
('2020-10-24'),
('2020-10-25'),
('2020-10-26'),
('2020-10-27'),
('2020-10-28'),
('2020-10-29'),
('2020-10-30'),
('2020-10-31'),
('2020-11-01'),
('2020-11-02'),
('2020-11-03'),
('2020-11-04'),
('2020-11-05'),
('2020-11-06'),
('2020-11-07'),
('2020-11-08'),
('2020-11-09'),
('2020-11-10'),
('2020-11-11'),
('2020-11-12'),
('2020-11-13'),
('2020-11-14'),
('2020-11-15'),
('2020-11-16'),
('2020-11-17'),
('2020-11-18'),
('2020-11-19'),
('2020-11-20'),
('2020-11-21'),
('2020-11-22'),
('2020-11-23'),
('2020-11-24'),
('2020-11-25'),
('2020-11-26'),
('2020-11-27'),
('2020-11-28'),
('2020-11-29'),
('2020-11-30'),
('2020-12-01'),
('2020-12-02'),
('2020-12-03'),
('2020-12-04'),
('2020-12-05'),
('2020-12-06'),
('2020-12-07'),
('2020-12-08'),
('2020-12-09'),
('2020-12-10'),
('2020-12-11'),
('2020-12-12'),
('2020-12-13'),
('2020-12-14'),
('2020-12-15'),
('2020-12-16'),
('2020-12-17'),
('2020-12-18'),
('2020-12-19'),
('2020-12-20'),
('2020-12-21'),
('2020-12-22'),
('2020-12-23'),
('2020-12-24'),
('2020-12-25'),
('2020-12-26'),
('2020-12-27'),
('2020-12-28'),
('2020-12-29'),
('2020-12-30'),
('2020-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cdo`
--

CREATE TABLE `tbl_cdo` (
  `uid` int(11) UNSIGNED NOT NULL,
  `Usr_id` varchar(20) NOT NULL,
  `Type` varchar(30) NOT NULL,
  `Datetime_frm` int(11) UNSIGNED NOT NULL,
  `Datetime_to` int(11) UNSIGNED NOT NULL,
  `Reason` varchar(255) NOT NULL,
  `Note` text NOT NULL,
  `Datefield` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cdo`
--

INSERT INTO `tbl_cdo` (`uid`, `Usr_id`, `Type`, `Datetime_frm`, `Datetime_to`, `Reason`, `Note`, `Datefield`) VALUES
(1, 'admin', 'Earn', 1572370200, 1572413400, 'Annual leave coverage', 'Cakep', '2019-10-29'),
(2, 'admin', 'Earn', 1571724000, 1571752800, 'Other', 'Training Efficient in work ', '2019-10-22'),
(4, 'admin', 'Earn', 1569904200, 1569947400, 'Public holiday', 'Public holiday', '2019-10-01'),
(5, 'admin', 'Earn', 1572283800, 1572327000, 'Annual leave coverage', 'Covering Ronald', '2019-10-28'),
(7, 'brw02366', 'Earn', 1572283800, 1572327000, 'Annual leave coverage', '-', '2019-10-28'),
(8, 'brw02366', 'Earn', 1572370200, 1572413400, 'Annual leave coverage', 'Covering Mihir', '2019-10-29'),
(9, 'admin', 'Earn', 1573709400, 1573752600, 'Annual leave coverage', 'Cover Mr. Kamal', '2019-11-14'),
(10, 'admin', 'Earn', 1579757400, 1579800600, 'Training coverage', 'test 4', '2020-01-23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_charging`
--

CREATE TABLE `tbl_charging` (
  `uid` int(11) NOT NULL,
  `charge_dt` datetime NOT NULL,
  `charge_date` date NOT NULL,
  `charging_dt` int(11) NOT NULL,
  `material` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `uom` char(5) NOT NULL,
  `lotnum` varchar(25) NOT NULL,
  `charge_by` varchar(50) NOT NULL,
  `charge_to` varchar(25) NOT NULL,
  `level_b4` int(11) NOT NULL,
  `notes` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_charging`
--

INSERT INTO `tbl_charging` (`uid`, `charge_dt`, `charge_date`, `charging_dt`, `material`, `qty`, `uom`, `lotnum`, `charge_by`, `charge_to`, `level_b4`, `notes`) VALUES
(1, '2018-07-23 05:24:00', '2018-12-01', 1549964221, 'Peroxide', 5, 'drum', '71214', 'Antil', 'TK-152', 50, '-'),
(2, '2018-07-23 12:00:00', '2018-11-29', 1549964221, 'Nofmer', 2, 'drum', '31331', 'Tariq', 'TK-157', 30, '-'),
(3, '2018-08-02 06:00:00', '2018-12-04', 1549964221, 'Peroxide', 10, 'drum', '672513', 'Omar', 'TK-152', 45, 'Empty drum bit damage'),
(6, '0000-00-00 00:00:00', '2018-12-11', 1549964221, 'Peroxide', 2, 'drum', '8768', 'Me', 'TK-152', 0, 'Ok'),
(7, '0000-00-00 00:00:00', '2018-12-09', 1549964221, 'Nofmer', 3, 'drum', '8978', 'Dave', 'TK-157', 0, 'Drum dirty'),
(9, '0000-00-00 00:00:00', '2018-12-18', 1549964221, 'Peroxide', 11, 'Drums', '13321', 'brw02206', 'TK-310', 30, 'ok'),
(10, '0000-00-00 00:00:00', '2019-01-15', 1549964221, 'Peroxide', 90, 'Bags', '144224', 'brw02396', 'TK-309', 35, 'Tetrsttd'),
(11, '0000-00-00 00:00:00', '2019-01-16', 1549964221, 'Nofmer', 2, 'Drums', '1553', 'brw02248', 'TK-310', 33, 'Teaast'),
(12, '0000-00-00 00:00:00', '2019-01-16', 1549964221, 'Peroxide', 3, 'Drums', '12323', 'brw99999', 'TK-309', 43, '12312'),
(13, '0000-00-00 00:00:00', '2019-01-16', 1549964221, 'Peroxide', 110, 'Drums', '43532', 'brw99999', 'TK-309', 35, 'sdqasdq'),
(14, '0000-00-00 00:00:00', '2019-01-16', 1452207600, 'Nofmer', 2, 'Drums', '234234', 'brw99999', 'TK-309', 0, 'Data no 14'),
(16, '0000-00-00 00:00:00', '0000-00-00', 1549864800, 'Additive', 3, 'Drums', '12', 'brw99999', 'TK-309', 35, 'Data 15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_container`
--

CREATE TABLE `tbl_container` (
  `uid` int(11) NOT NULL,
  `sn` int(11) NOT NULL,
  `uid_mstr` int(9) NOT NULL,
  `bay_no` varchar(2) NOT NULL,
  `contr_no` varchar(15) NOT NULL,
  `material` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_container`
--

INSERT INTO `tbl_container` (`uid`, `sn`, `uid_mstr`, `bay_no`, `contr_no`, `material`, `qty`, `unit`, `status`) VALUES
(1, 2, 201908181, 'X2', 'BRGU0021778', 'LS4201R', 20, 'FOB', 'RTPO'),
(2, 3, 201908181, 'X3', 'CMSA2332181', 'LS4201R', 40, 'HOB', 'RTPO'),
(4, 1, 201908231, 'X4', 'RSTU3244323', 'R', 40, 'FOB', 'RTPO, Door not close'),
(5, 2, 201908231, 'X3', 'BRGU0021733', 'XLPE', 18, 'FOB', 'RTPO'),
(6, 5, 201908231, 'X7', 'CMSA2002181', 'LS4201H', 40, 'HOB', 'Hold'),
(7, 0, 201910012, '', '', '', 0, '', ''),
(8, 0, 201910051, '2', 'BRGU113', 'LS4201H 46190990', 20, 'fob', 'loading in progress'),
(9, 0, 201910032, '7', 'BRGU1130012', 'LS4201R 46190990', 40, 'hob', 'loading in progress');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_container_bay`
--

CREATE TABLE `tbl_container_bay` (
  `Bay` varchar(2) NOT NULL,
  `Container` varchar(50) NOT NULL,
  `Seal` varchar(50) NOT NULL,
  `Material` varchar(50) NOT NULL,
  `BN` int(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  `UOM` varchar(50) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_container_bay`
--

INSERT INTO `tbl_container_bay` (`Bay`, `Container`, `Seal`, `Material`, `BN`, `Qty`, `UOM`, `Status`) VALUES
('X1', 'HLXU2446517', '-', 'Jacket HOB', 0, 0, '', 1),
('X2', 'BRGU0012325', '-', 'LS4201R', 46201009, 20, 'FOB', 4),
('X3', 'GMCU0091132', 'GMX1098923', 'LS4201H', 46201880, 40, 'HOB', 3),
('X4', 'GMCU1391100', 'GMX1098924', 'LS4201R GR', 46201880, 40, 'HOB', 2),
('X5', '', '', '-', 0, 0, '', 0),
('X6', '', '', '-', 0, 0, 'FOB', 3),
('X7', '', 'SEAL90	', 'LS4201H', 0, 0, 'FOB', 5),
('X8', 'BRGU0016626', 'SELAMAT Siip X', 'LS4201RR', 46201009, 20000, 'Kg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_container_mstr`
--

CREATE TABLE `tbl_container_mstr` (
  `uid` int(9) NOT NULL,
  `Loading_date` int(11) NOT NULL,
  `Team` varchar(1) NOT NULL,
  `Shift` varchar(10) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Loadby` varchar(20) NOT NULL,
  `Forklift_opr` varchar(20) NOT NULL,
  `Last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_container_mstr`
--

INSERT INTO `tbl_container_mstr` (`uid`, `Loading_date`, `Team`, `Shift`, `Status`, `Loadby`, `Forklift_opr`, `Last_update`) VALUES
(201908181, 1566301285, 'A', 'Morning', 'confirm', 'Ryan', 'Adhalat', '2019-08-20 11:42:56'),
(201908231, 1566538170, 'C', 'Morning', 'ok', 'Hasan', 'Babar', '2019-08-23 05:30:07'),
(201910012, 1569880800, 'A', 'Night', '', 'brw02405', 'Adhalat', '2019-10-03 08:11:30'),
(201910032, 1570053600, 'B', 'Night', '', 'brw02430', 'Babar', '2019-10-05 14:00:51'),
(201910051, 0, 'D', 'Morning', '', 'brw02474', 'Babar', '2019-10-05 13:57:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_etask`
--

CREATE TABLE `tbl_etask` (
  `uid` int(11) NOT NULL,
  `Etask_uid` int(11) NOT NULL,
  `Assign_to` varchar(50) NOT NULL,
  `Assign_date` int(11) NOT NULL,
  `Target_date` int(11) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Attachment` varchar(255) NOT NULL,
  `Acknowledge_by` varchar(50) NOT NULL,
  `Comment` text NOT NULL,
  `Last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_etask`
--

INSERT INTO `tbl_etask` (`uid`, `Etask_uid`, `Assign_to`, `Assign_date`, `Target_date`, `Status`, `Attachment`, `Acknowledge_by`, `Comment`, `Last_update`) VALUES
(2, 2, 'brw02405', 1567746000, 1567746000, 'Completed', 'JUMUAH.png', 'brw02125', 'Siip lah', '2019-09-10 23:26:09'),
(3, 4, 'brw02256', 1567918800, 1567918800, 'UnComplete', '', 'brw00693', 'ok', '2019-09-10 22:14:21'),
(5, 3, 'brw02430', 1567918800, 1567918800, 'Completed', 'uploads/selesai.pdf', 'brw02125', 'Selesai lah', '2019-09-10 08:19:57'),
(7, 2, 'brw02390', 1568005200, 1568178000, 'UnComplete', '', '', '', '2019-09-10 06:05:04'),
(8, 2, 'brw02162', 1568005200, 1568264400, 'UnComplete', '', '', '', '2019-09-10 06:05:04'),
(9, 6, 'brw02308', 1568178000, 1568264400, 'Completed', 'brw02308-190913-kk-respberry.jpg', 'brw02125', 'done', '2019-09-13 01:07:04'),
(10, 5, 'brw02396', 1568178000, 1568264400, 'Completed', 'brw02396-190913-Madinah_Hotel_29Mar_1Apr.pdf', 'brw02098', 's', '2019-09-13 01:13:32'),
(11, 2, 'brw02307', 1568350800, 1568437200, 'UnComplete', '', '', '', '2019-09-13 02:28:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_etask_exec`
--

CREATE TABLE `tbl_etask_exec` (
  `uid` int(11) NOT NULL,
  `Etask_uid` int(11) NOT NULL,
  `Plan_exec` int(11) NOT NULL,
  `Assign_to` varchar(50) NOT NULL,
  `Assign_date` int(11) NOT NULL,
  `Target_date` int(11) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Attachment` varchar(255) NOT NULL,
  `Acknowledge_by` varchar(50) NOT NULL,
  `Comment` text NOT NULL,
  `Completed_date` int(11) NOT NULL,
  `Update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_etask_exec`
--

INSERT INTO `tbl_etask_exec` (`uid`, `Etask_uid`, `Plan_exec`, `Assign_to`, `Assign_date`, `Target_date`, `Status`, `Attachment`, `Acknowledge_by`, `Comment`, `Completed_date`, `Update_at`) VALUES
(2, 2, 1, 'brw02386', 1567738800, 1567738800, 'Completed', 'brw02386-190914-pic1.jpg', 'brw00158', 'ok', 0, '2019-09-19 17:03:13'),
(3, 1, 1, 'brw02771', 1567911600, 1567911600, 'Completed', '', '', '', 0, '2019-09-28 05:59:42'),
(5, 3, 1, 'brw02430', 1567911600, 1567911600, 'Progress', '', '', '', 0, '2019-09-21 16:40:34'),
(6, 1, 2, 'brw02474', 1567998000, 1568170800, 'Completed', 'Mohammed Ali', '', 'No comments', 0, '2019-09-19 17:03:03'),
(7, 2, 4, 'brw02390', 1568005200, 1568178000, 'Progress', '', '', '', 0, '2019-09-21 16:40:52'),
(8, 1, 3, 'brw02162', 1567998000, 1568257200, 'Completed', 'uploads/job-done.pdf', 'Abhilash', 'Job done', 0, '2019-09-19 17:03:08'),
(9, 7, 1, 'brw02307', 1568084400, 1568257200, 'Progress', '', '', '', 0, '2019-09-19 17:07:41'),
(10, 13, 1, 'brw02386', 1568775600, 1568862000, 'Completed', '', '', '', 0, '2019-09-28 06:19:34'),
(11, 1, 4, 'brw02256', 1569042000, 1569214800, 'Progress', '', '', '', 0, '2019-09-21 16:38:26'),
(12, 1, 5, 'brw02256', 1569042000, 1569214800, 'Progress', '', '', '', 0, '2019-09-21 16:38:35'),
(13, 4, 1, 'brw02307', 1569042000, 1569042000, 'Progress', '', '', '', 0, '2019-09-21 16:40:58'),
(17, 5, 1, 'brw02307', 1569042000, 1569042000, 'Progress', '', '', '', 0, '2019-09-21 16:41:03'),
(18, 1, 6, 'brw02390', 1569042000, 1569042000, 'Progress', '', '', '', 0, '2019-09-21 17:30:33'),
(19, 1, 8, 'brw02316', 1569042000, 1569042000, 'Progress', '', '', '', 0, '2019-09-21 17:34:17'),
(21, 4, 4, 'brw02371', 1569042000, 1569042000, 'Progress', '', '', '', 0, '2019-09-21 17:39:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_etask_job`
--

CREATE TABLE `tbl_etask_job` (
  `uid` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Frequency` varchar(50) NOT NULL,
  `File` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_etask_job`
--

INSERT INTO `tbl_etask_job` (`uid`, `Title`, `Frequency`, `File`) VALUES
(1, 'Safety Shower Check List', 'Weekly', 'Awok_com_-_Order_26527093A1_(_Tax_Credit_Note_).pdf'),
(2, 'Radio Check List', 'Monthly', 'Radio-Check-List.pdf'),
(3, 'LO LC Area-2', 'Monthly', 'lo-lc-area-2'),
(4, 'LO LC Area-3', 'Monthly', 'lo-lc-area-3'),
(5, 'Bellow Check List Area 0&1', 'Monthly', 'Bellow-Check-List-Area-0n1.pdf'),
(6, 'Bellow Check List Area 2', 'Monthly', 'Bellow-Check-List-Area-2.pdf'),
(7, 'Bellow Check List Area 3', 'Bi-Weekly', 'Bellow-Check-List-Area-3.pdf'),
(8, 'PSV Checklist Area-3', 'Monthly', 'XLPE_Shift_Schedule.pdf'),
(11, 'PSV Checklist Area-0n1', 'Monthly', 'Madinah_Hotel_29Mar_1Apr.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_etask_list`
--

CREATE TABLE `tbl_etask_list` (
  `uid` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Frequency` varchar(50) NOT NULL,
  `Freq_every` varchar(50) NOT NULL,
  `File` varchar(255) NOT NULL,
  `Update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_etask_list`
--

INSERT INTO `tbl_etask_list` (`uid`, `Title`, `Frequency`, `Freq_every`, `File`, `Update_at`) VALUES
(1, 'XLPE Battery Limit Conditions CHECK LIST', 'Monthbase', '1-Months', 'uploads/XLPE Battery Limit Conditions CHECK LIST.pdf', '2019-09-17 16:13:43'),
(2, 'XLPE LOLC Checklist', 'Monthbase', '3-Months', 'uploads/XLPE LOLC Checklist.pdf', '0000-00-00 00:00:00'),
(3, 'XLPE PSV-PSE Checklist', 'Monthbase', '6-Months', 'uploads/XLPE PSV-PSE Checklist.pdf', '0000-00-00 00:00:00'),
(4, 'XLPE Vent, Drain, End Flange Checklist  AREA-0', 'Monthbase', '3-Months', 'uploads/XLPE Vent, Drain, End Flange Checklist  AREA-0.pdf', '0000-00-00 00:00:00'),
(5, 'XLPE Vent, Drain, End Flange Checklist  AREA-1', 'Monthbase', '3-Months', 'uploads/XLPE Vent, Drain, End Flange Checklist  AREA-1.pdf', '0000-00-00 00:00:00'),
(6, 'XLPE Vent, Drain, End Flange Checklist  AREA-2', 'Monthbase', '3-Months', 'uploads/XLPE Vent, Drain, End Flange Checklist  AREA-2.pdf', '0000-00-00 00:00:00'),
(7, 'XLPE Vent, Drain, End Flange Checklist  AREA-3', 'Monthbase', '3-Months', 'uploads/XLPE Vent, Drain, End Flange Checklist  AREA-3.pdf', '0000-00-00 00:00:00'),
(8, 'XLPE Vent, Drain, End Flange Checklist  AREA-9', 'Monthbase', '3-Months', 'uploads/XLPE Vent, Drain, End Flange Checklist  AREA-9.pdf', '0000-00-00 00:00:00'),
(9, 'XLPE Field Toolbox Checklist', '', '', 'uploads/XLPE Field Toolbox Checklist.pdf', '0000-00-00 00:00:00'),
(10, 'XLPE Utility station Checklist', 'Monthbase', '12-Months', 'uploads/XLPE Utility station Checklist.pdf', '0000-00-00 00:00:00'),
(11, 'XLPE Bicycle Checklist', '', '', 'uploads/XLPE Bicycle Checklist.pdf', '0000-00-00 00:00:00'),
(12, 'Tetra radio Checklist', '', '', 'uploads/Tetra radio Checklist.pdf', '0000-00-00 00:00:00'),
(13, 'XLPE Safety Showers & Eye Washers Checklist', 'Weekbase', '1-Weeks', 'uploads/XLPE Safety Showers & Eye Washers Checklist.pdf', '0000-00-00 00:00:00'),
(14, 'XLPE Housekeeping Checklist', '', '', 'XLPE Housekeeping Checklist.pdf', '2019-09-20 14:07:11'),
(15, 'PALLET TRUCK S1.5S - SL Checklist ', '', '', 'uploads/PALLET TRUCK S1.5S - SL Checklist .pdf', '0000-00-00 00:00:00'),
(16, 'XLPE Gas detector Checklist', 'Weekbase', '3-Weeks', 'uploads/XLPE Gas detector Checklist.pdf', '0000-00-00 00:00:00'),
(17, 'XLPE First Aid items Checklist', 'Weekbase', '2-Weeks', 'uploads/XLPE First Aid items Checklist.pdf', '0000-00-00 00:00:00'),
(18, 'Checklist Forklifts J3-J4.OXN', '', '', 'uploads/Checklist Forklifts J3-J4.OXN.pdf', '0000-00-00 00:00:00'),
(19, 'Bellows- Flexible hoses checklists', '', '', 'uploads/Bellows- Flexible hoses checklists.pdf', '0000-00-00 00:00:00'),
(20, 'K-tron feeders Calibration Schedule & Records', 'Monthbase', '12-Months', 'Master_Task_List.pdf', '2019-09-20 14:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_etask_plan`
--

CREATE TABLE `tbl_etask_plan` (
  `uid` int(11) NOT NULL,
  `Etask_uid` int(11) NOT NULL,
  `Frequency` varchar(50) NOT NULL,
  `Freq_every` varchar(50) NOT NULL,
  `Plan_exec` int(11) NOT NULL,
  `isAssigned` tinyint(1) NOT NULL DEFAULT '0',
  `Update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_etask_plan`
--

INSERT INTO `tbl_etask_plan` (`uid`, `Etask_uid`, `Frequency`, `Freq_every`, `Plan_exec`, `isAssigned`, `Update_at`) VALUES
(1, 1, 'Monthbase', '1-Months', 1, 1, '2019-09-21 17:09:52'),
(2, 1, 'Monthbase', '1-Months', 2, 1, '2019-09-21 17:16:55'),
(3, 1, 'Monthbase', '1-Months', 3, 1, '2019-09-21 17:16:59'),
(4, 1, 'Monthbase', '1-Months', 4, 1, '2019-09-21 17:17:03'),
(5, 1, 'Monthbase', '1-Months', 5, 1, '2019-09-21 17:17:11'),
(6, 1, 'Monthbase', '1-Months', 6, 1, '2019-09-21 17:30:33'),
(7, 1, 'Monthbase', '1-Months', 7, 0, '2019-09-17 16:20:00'),
(8, 1, 'Monthbase', '1-Months', 8, 1, '2019-09-21 17:34:18'),
(9, 1, 'Monthbase', '1-Months', 9, 0, '2019-09-17 16:20:00'),
(10, 1, 'Monthbase', '1-Months', 10, 0, '2019-09-17 16:20:00'),
(11, 1, 'Monthbase', '1-Months', 11, 0, '2019-09-17 16:20:00'),
(12, 1, 'Monthbase', '1-Months', 12, 0, '2019-09-17 16:20:00'),
(13, 2, 'Monthbase', '3-Months', 1, 1, '2019-09-21 17:17:56'),
(14, 2, 'Monthbase', '3-Months', 4, 1, '2019-09-21 17:18:00'),
(15, 2, 'Monthbase', '3-Months', 7, 0, '2019-09-17 16:20:00'),
(16, 2, 'Monthbase', '3-Months', 10, 0, '2019-09-17 16:20:00'),
(17, 3, 'Monthbase', '6-Months', 1, 1, '2019-09-21 17:18:18'),
(18, 3, 'Monthbase', '6-Months', 7, 0, '2019-09-17 16:20:00'),
(19, 4, 'Monthbase', '3-Months', 1, 1, '2019-09-21 17:18:22'),
(20, 4, 'Monthbase', '3-Months', 4, 1, '2019-09-21 17:39:05'),
(21, 4, 'Monthbase', '3-Months', 7, 0, '2019-09-17 16:20:00'),
(22, 4, 'Monthbase', '3-Months', 10, 0, '2019-09-17 16:20:00'),
(23, 5, 'Monthbase', '3-Months', 1, 1, '2019-09-21 17:18:26'),
(24, 5, 'Monthbase', '3-Months', 4, 0, '2019-09-17 16:20:00'),
(25, 5, 'Monthbase', '3-Months', 7, 0, '2019-09-17 16:20:00'),
(26, 5, 'Monthbase', '3-Months', 10, 0, '2019-09-17 16:20:00'),
(27, 6, 'Monthbase', '3-Months', 1, 0, '2019-09-17 16:20:00'),
(28, 6, 'Monthbase', '3-Months', 4, 0, '2019-09-17 16:20:00'),
(29, 6, 'Monthbase', '3-Months', 7, 0, '2019-09-17 16:20:00'),
(30, 6, 'Monthbase', '3-Months', 10, 0, '2019-09-17 16:20:00'),
(31, 7, 'Monthbase', '3-Months', 1, 1, '2019-09-21 17:18:38'),
(32, 7, 'Monthbase', '3-Months', 4, 0, '2019-09-17 16:20:00'),
(33, 7, 'Monthbase', '3-Months', 7, 0, '2019-09-17 16:20:00'),
(34, 7, 'Monthbase', '3-Months', 10, 0, '2019-09-17 16:20:00'),
(35, 8, 'Monthbase', '3-Months', 1, 0, '2019-09-17 16:20:00'),
(36, 8, 'Monthbase', '3-Months', 4, 0, '2019-09-17 16:20:00'),
(37, 8, 'Monthbase', '3-Months', 7, 0, '2019-09-17 16:20:00'),
(38, 8, 'Monthbase', '3-Months', 10, 0, '2019-09-17 16:20:00'),
(39, 13, 'Weekbase', '1-Weeks', 1, 1, '2019-09-21 17:18:46'),
(40, 13, 'Weekbase', '1-Weeks', 2, 0, '2019-09-17 16:20:00'),
(41, 13, 'Weekbase', '1-Weeks', 3, 0, '2019-09-17 16:20:00'),
(42, 13, 'Weekbase', '1-Weeks', 4, 0, '2019-09-17 16:20:00'),
(43, 13, 'Weekbase', '1-Weeks', 5, 0, '2019-09-17 16:20:00'),
(44, 13, 'Weekbase', '1-Weeks', 6, 0, '2019-09-17 16:20:00'),
(45, 13, 'Weekbase', '1-Weeks', 7, 0, '2019-09-17 16:20:00'),
(46, 13, 'Weekbase', '1-Weeks', 8, 0, '2019-09-17 16:20:00'),
(47, 13, 'Weekbase', '1-Weeks', 9, 0, '2019-09-17 16:20:00'),
(48, 13, 'Weekbase', '1-Weeks', 10, 0, '2019-09-17 16:20:00'),
(49, 13, 'Weekbase', '1-Weeks', 11, 0, '2019-09-17 16:20:00'),
(50, 13, 'Weekbase', '1-Weeks', 12, 0, '2019-09-17 16:20:00'),
(51, 13, 'Weekbase', '1-Weeks', 13, 0, '2019-09-17 16:20:00'),
(52, 13, 'Weekbase', '1-Weeks', 14, 0, '2019-09-17 16:20:00'),
(53, 13, 'Weekbase', '1-Weeks', 15, 0, '2019-09-17 16:20:00'),
(54, 13, 'Weekbase', '1-Weeks', 16, 0, '2019-09-17 16:20:00'),
(55, 13, 'Weekbase', '1-Weeks', 17, 0, '2019-09-17 16:20:00'),
(56, 13, 'Weekbase', '1-Weeks', 18, 0, '2019-09-17 16:20:00'),
(57, 13, 'Weekbase', '1-Weeks', 19, 0, '2019-09-17 16:20:00'),
(58, 13, 'Weekbase', '1-Weeks', 20, 0, '2019-09-17 16:20:00'),
(59, 13, 'Weekbase', '1-Weeks', 21, 0, '2019-09-17 16:20:00'),
(60, 13, 'Weekbase', '1-Weeks', 22, 0, '2019-09-17 16:20:00'),
(61, 13, 'Weekbase', '1-Weeks', 23, 0, '2019-09-17 16:20:00'),
(62, 13, 'Weekbase', '1-Weeks', 24, 0, '2019-09-17 16:20:00'),
(63, 13, 'Weekbase', '1-Weeks', 25, 0, '2019-09-17 16:20:00'),
(64, 13, 'Weekbase', '1-Weeks', 26, 0, '2019-09-17 16:20:00'),
(65, 13, 'Weekbase', '1-Weeks', 27, 0, '2019-09-17 16:20:00'),
(66, 13, 'Weekbase', '1-Weeks', 28, 0, '2019-09-17 16:20:00'),
(67, 13, 'Weekbase', '1-Weeks', 29, 0, '2019-09-17 16:20:00'),
(68, 13, 'Weekbase', '1-Weeks', 30, 0, '2019-09-17 16:20:00'),
(69, 13, 'Weekbase', '1-Weeks', 31, 0, '2019-09-17 16:20:00'),
(70, 13, 'Weekbase', '1-Weeks', 32, 0, '2019-09-17 16:20:00'),
(71, 13, 'Weekbase', '1-Weeks', 33, 0, '2019-09-17 16:20:00'),
(72, 13, 'Weekbase', '1-Weeks', 34, 0, '2019-09-17 16:20:00'),
(73, 13, 'Weekbase', '1-Weeks', 35, 0, '2019-09-17 16:20:00'),
(74, 13, 'Weekbase', '1-Weeks', 36, 0, '2019-09-17 16:20:00'),
(75, 13, 'Weekbase', '1-Weeks', 37, 0, '2019-09-17 16:20:00'),
(76, 13, 'Weekbase', '1-Weeks', 38, 0, '2019-09-17 16:20:00'),
(77, 13, 'Weekbase', '1-Weeks', 39, 0, '2019-09-17 16:20:00'),
(78, 13, 'Weekbase', '1-Weeks', 40, 0, '2019-09-17 16:20:00'),
(79, 13, 'Weekbase', '1-Weeks', 41, 0, '2019-09-17 16:20:00'),
(80, 13, 'Weekbase', '1-Weeks', 42, 0, '2019-09-17 16:20:00'),
(81, 13, 'Weekbase', '1-Weeks', 43, 0, '2019-09-17 16:20:00'),
(82, 13, 'Weekbase', '1-Weeks', 44, 0, '2019-09-17 16:20:00'),
(83, 13, 'Weekbase', '1-Weeks', 45, 0, '2019-09-17 16:20:00'),
(84, 13, 'Weekbase', '1-Weeks', 46, 0, '2019-09-17 16:20:00'),
(85, 13, 'Weekbase', '1-Weeks', 47, 0, '2019-09-17 16:20:00'),
(86, 13, 'Weekbase', '1-Weeks', 48, 0, '2019-09-17 16:20:00'),
(87, 13, 'Weekbase', '1-Weeks', 49, 0, '2019-09-17 16:20:00'),
(88, 13, 'Weekbase', '1-Weeks', 50, 0, '2019-09-17 16:20:00'),
(89, 13, 'Weekbase', '1-Weeks', 51, 0, '2019-09-17 16:20:00'),
(90, 13, 'Weekbase', '1-Weeks', 52, 0, '2019-09-17 16:20:00'),
(91, 10, 'Monthbase', '12-Months', 12, 0, '2019-09-17 16:20:00'),
(92, 16, 'Weekbase', '3-Weeks', 3, 0, '2019-09-17 16:20:00'),
(93, 16, 'Weekbase', '3-Weeks', 6, 0, '2019-09-17 16:20:00'),
(94, 16, 'Weekbase', '3-Weeks', 9, 0, '2019-09-17 16:20:00'),
(95, 16, 'Weekbase', '3-Weeks', 12, 0, '2019-09-17 16:20:00'),
(96, 16, 'Weekbase', '3-Weeks', 15, 0, '2019-09-17 16:20:00'),
(97, 16, 'Weekbase', '3-Weeks', 18, 0, '2019-09-17 16:20:00'),
(98, 16, 'Weekbase', '3-Weeks', 21, 0, '2019-09-17 16:20:00'),
(99, 16, 'Weekbase', '3-Weeks', 24, 0, '2019-09-17 16:20:00'),
(100, 16, 'Weekbase', '3-Weeks', 27, 0, '2019-09-17 16:20:00'),
(101, 16, 'Weekbase', '3-Weeks', 30, 0, '2019-09-17 16:20:00'),
(102, 16, 'Weekbase', '3-Weeks', 33, 0, '2019-09-17 16:20:00'),
(103, 16, 'Weekbase', '3-Weeks', 36, 0, '2019-09-17 16:20:00'),
(104, 16, 'Weekbase', '3-Weeks', 39, 0, '2019-09-17 16:20:00'),
(105, 16, 'Weekbase', '3-Weeks', 42, 0, '2019-09-17 16:20:00'),
(106, 16, 'Weekbase', '3-Weeks', 45, 0, '2019-09-17 16:20:00'),
(107, 16, 'Weekbase', '3-Weeks', 48, 0, '2019-09-17 16:20:00'),
(108, 16, 'Weekbase', '3-Weeks', 51, 0, '2019-09-17 16:20:00'),
(109, 17, 'Weekbase', '2-Weeks', 1, 0, '2019-09-17 16:20:00'),
(110, 17, 'Weekbase', '2-Weeks', 3, 0, '2019-09-17 16:20:00'),
(111, 17, 'Weekbase', '2-Weeks', 5, 0, '2019-09-17 16:20:00'),
(112, 17, 'Weekbase', '2-Weeks', 7, 0, '2019-09-17 16:20:00'),
(113, 17, 'Weekbase', '2-Weeks', 9, 0, '2019-09-17 16:20:00'),
(114, 17, 'Weekbase', '2-Weeks', 11, 0, '2019-09-17 16:20:00'),
(115, 17, 'Weekbase', '2-Weeks', 13, 0, '2019-09-17 16:20:00'),
(116, 17, 'Weekbase', '2-Weeks', 15, 0, '2019-09-17 16:20:00'),
(117, 17, 'Weekbase', '2-Weeks', 17, 0, '2019-09-17 16:20:00'),
(118, 17, 'Weekbase', '2-Weeks', 19, 0, '2019-09-17 16:20:00'),
(119, 17, 'Weekbase', '2-Weeks', 21, 0, '2019-09-17 16:20:00'),
(120, 17, 'Weekbase', '2-Weeks', 23, 0, '2019-09-17 16:20:00'),
(121, 17, 'Weekbase', '2-Weeks', 25, 0, '2019-09-17 16:20:00'),
(122, 17, 'Weekbase', '2-Weeks', 27, 0, '2019-09-17 16:20:00'),
(123, 17, 'Weekbase', '2-Weeks', 29, 0, '2019-09-17 16:20:00'),
(124, 17, 'Weekbase', '2-Weeks', 31, 0, '2019-09-17 16:20:00'),
(125, 17, 'Weekbase', '2-Weeks', 33, 0, '2019-09-17 16:20:00'),
(126, 17, 'Weekbase', '2-Weeks', 35, 0, '2019-09-17 16:20:00'),
(127, 17, 'Weekbase', '2-Weeks', 37, 0, '2019-09-17 16:20:00'),
(128, 17, 'Weekbase', '2-Weeks', 39, 0, '2019-09-17 16:20:00'),
(129, 17, 'Weekbase', '2-Weeks', 41, 0, '2019-09-17 16:20:00'),
(130, 17, 'Weekbase', '2-Weeks', 43, 0, '2019-09-17 16:20:00'),
(131, 17, 'Weekbase', '2-Weeks', 45, 0, '2019-09-17 16:20:00'),
(132, 17, 'Weekbase', '2-Weeks', 47, 0, '2019-09-17 16:20:00'),
(133, 17, 'Weekbase', '2-Weeks', 49, 0, '2019-09-17 16:20:00'),
(134, 17, 'Weekbase', '2-Weeks', 51, 0, '2019-09-17 16:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keyreg`
--

CREATE TABLE `tbl_keyreg` (
  `uid` int(11) NOT NULL,
  `Key_type1` tinyint(1) NOT NULL,
  `Key_type2` tinyint(1) NOT NULL,
  `Key_type3` tinyint(1) NOT NULL,
  `Reason` text NOT NULL,
  `Taken_dt` datetime NOT NULL,
  `Taken_by` varchar(20) NOT NULL,
  `Returned_dt` datetime DEFAULT NULL,
  `Returned_by` varchar(20) NOT NULL,
  `Notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_keyreg`
--

INSERT INTO `tbl_keyreg` (`uid`, `Key_type1`, `Key_type2`, `Key_type3`, `Reason`, `Taken_dt`, `Taken_by`, `Returned_dt`, `Returned_by`, `Notes`) VALUES
(11, 1, 0, 0, 'Check input NULL to datettime of Returned Date', '2019-10-16 00:10:00', 'brw02308', '2019-10-04 04:40:00', 'brw02334', '2'),
(18, 0, 1, 0, 'Test: Bypassing PDI-3021. To prevent frequent alarm', '2019-10-01 12:35:00', 'brw02371', '2019-10-07 07:00:00', 'brw10001', 'Update Return Date 02-10-19 02:00'),
(20, 1, 0, 0, 'Test3', '2019-10-03 03:00:00', 'brw02256', '2019-10-05 05:00:00', 'brw02308', 'Test3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_overtime`
--

CREATE TABLE `tbl_overtime` (
  `uid` int(11) NOT NULL,
  `usr_ID` varchar(20) NOT NULL,
  `ot_date_from` int(11) NOT NULL,
  `ot_date_to` int(11) NOT NULL,
  `ot_category` varchar(20) NOT NULL,
  `ot_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_overtime`
--

INSERT INTO `tbl_overtime` (`uid`, `usr_ID`, `ot_date_from`, `ot_date_to`, `ot_category`, `ot_reason`) VALUES
(15, 'user_2', 1548457200, 1548457200, '250%', 'Shutdown activities'),
(18, 'user_2', 1547946000, 1547989200, '400%', 'Turn around activities'),
(19, 'user_2', 1548676800, 1548687600, '150%', 'Training coverage'),
(20, 'user_2', 1548610200, 1548653400, '250%', 'Turn around activities'),
(25, 'user_2', 1546383600, 1546470000, '100%', 'Annual leave coverage'),
(26, 'user_2', 1546556400, 1546650000, '100%', 'Annual leave coverage'),
(27, 'test', 1557226800, 1557262800, '100%', 'Annual leave coverage'),
(28, 'test', 1556683200, 1556726400, '250%', 'Visico octabin campaigne'),
(29, 'test', 1566059400, 1566102600, '100%', 'Annual leave coverage'),
(30, 'brw02366', 1566145800, 1566189000, '100%', 'Annual leave coverage'),
(31, 'test', 1566750600, 1566793800, '100%', 'Annual leave coverage'),
(32, 'test', 1566837000, 1566880200, '100%', 'Annual leave coverage');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz_cat`
--

CREATE TABLE `tbl_quiz_cat` (
  `uid` int(11) NOT NULL,
  `Area` varchar(50) NOT NULL,
  `Question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz_quest`
--

CREATE TABLE `tbl_quiz_quest` (
  `Quest_id` int(11) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Quiz_level` int(11) NOT NULL DEFAULT '2',
  `Exam_id` int(11) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Quest_title` varchar(255) NOT NULL,
  `The_answer` varchar(255) NOT NULL,
  `Answer_opt` int(11) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_quiz_quest`
--

INSERT INTO `tbl_quiz_quest` (`Quest_id`, `Category`, `Quiz_level`, `Exam_id`, `Type`, `Quest_title`, `The_answer`, `Answer_opt`, `isActive`) VALUES
(1, 'Area-2', 2, 1, 'Multioption', 'Test Question No.1', 'Explanation Answer of Question no.1', 3, 1),
(2, 'Area-2', 2, 1, 'Multianswer', 'Test Question No.2', 'Explanation Answer of Question no.2', 2, 1),
(3, 'Area-9', 2, 2, 'Multioption', 'Test Question No.3', 'Explanation Answer of Question no.3', 4, 1),
(4, 'Area-9', 2, 2, 'Truefalse', 'Is it True or False', 'Yes it is a TRUE answer', 1, 1),
(5, 'Area-1', 2, 1, 'Multioption', 'What kind of water that use in Eye Wash & Safety Shower Station?', 'Potable water is used for all safety shower/eye-wash stations throughout the facility.', 3, 1),
(6, 'Area-1', 2, 1, 'Multioption', 'Each utility station mostly is equipped with this thing except...', 'Each utility station mostly is equipped Utility Air, LP Demin Water, HP Demin Water and Central Vacuum', 3, 1),
(7, 'Area-1', 2, 1, 'Multioption', 'The Vacuum system will automatically shut-down if more than ..... outlets are being used simultaneously.', 'The Vacuum system will automatically shut-down if more than 2 outlets are being used simultaneously.', 0, 1),
(8, 'Area-1', 2, 1, 'Multioption', 'Where Service Water is utilized in XLPE Plant ?', 'Necessary to allow the molten polymer to harden when it comes in contact with the service water', 4, 1),
(9, 'Area-1', 2, 1, 'Multioption', 'Where Nitrogen is utilized in XLPE Plant ?', 'Nitrogen is utilized in the following areas: *)Additive feeders; *)Resin and Copolymer feeders; *)Extruder hopper; *)Extruder service station', 0, 1),
(10, 'Area-1', 2, 1, 'Multioption', 'What is the different between Plant Air and Instrument Air ?', 'Instrument air is provided from the distribution point to the XLPE plant; instrument air is filtered at the plant distribution header with a 10µm filter element. Unlike plant air, that is not filtered; instrument air should be used wherever the possibilit', 3, 1),
(11, 'Area-1', 2, 1, 'Multioption', 'What is the pressure of Low Pressure Steam', 'Pressure of Low Pressure Steam is around 4 Bg, mostly 4.1-4.3 Bg', 2, 1),
(12, 'Area-1', 2, 1, 'Multioption', 'What is the temperature of Low Pressure Steam', 'Temperature of Low Pressure Steam is around 155 degC', 1, 1),
(13, 'Area-1', 2, 1, 'Multioption', 'What is the first equipment that receive LP-Steam from ISBL', 'LP-Steam from ISBL goes to NF-010 to separate/filterate Steam from it is impurities', 0, 1),
(14, 'Area-1', 2, 1, 'Multioption', 'What is operating temperature for Hot Water Washing of Silo\'s', 'To do Hot Water Washing of Silo\'s the recommended temperature is 60°C', 3, 1),
(15, 'Area-1', 2, 1, 'Multioption', 'Why do we need Purge Air in the Tank?', 'Purge air system provides slightly positive pressure to the tanks. Particle ingress which would contribute to contamination can be prevented.', 1, 1),
(16, 'Area-1', 2, 1, 'Multioption', 'It\'s system is to provide Hot Water for maintaining temperature in Peroxide Unit', 'Jacket Hot Water System is to provide Hot Water for maintaining temperature in Peroxide Unit', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz_quest_opt`
--

CREATE TABLE `tbl_quiz_quest_opt` (
  `Opt_id` int(11) NOT NULL,
  `Quest_id` int(11) NOT NULL,
  `Opt_num` int(11) NOT NULL,
  `Opt_title` varchar(255) NOT NULL,
  `isCorrect` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_quiz_quest_opt`
--

INSERT INTO `tbl_quiz_quest_opt` (`Opt_id`, `Quest_id`, `Opt_num`, `Opt_title`, `isCorrect`) VALUES
(1, 3, 1, 'Soal-3 Option Answer-1', 0),
(2, 3, 2, 'Soal-3 Option Answer-2', 0),
(3, 3, 3, 'Soal-3 Option Answer-3', 1),
(4, 3, 4, 'Soal-3 Option Answer-4', 0),
(5, 1, 1, 'Option Answer-1', 1),
(6, 1, 2, 'Option Answer-2', 0),
(7, 1, 3, 'Option Answer-3', 0),
(8, 1, 4, 'Option Answer-4', 0),
(9, 2, 1, 'Soal-2 Option Answer-1', 0),
(10, 2, 2, 'Soal-2 Option Answer-2', 1),
(11, 2, 3, 'Soal-2 Option Answer-3', 1),
(12, 2, 4, 'Soal-2 Option Answer-4', 0),
(13, 4, 1, 'True', 1),
(14, 4, 2, 'False', 0),
(15, 5, 1, 'Demineralized Water', 0),
(16, 5, 2, 'Chilled Water', 0),
(17, 5, 3, 'Cooling Water', 0),
(18, 5, 4, 'Potable Water', 1),
(19, 6, 1, 'Nitrogen', 1),
(20, 6, 2, 'Utility Air', 0),
(21, 6, 3, 'LP Demin Water', 0),
(22, 6, 4, 'Central Vacuum', 0),
(23, 7, 1, '1', 0),
(24, 7, 2, '2', 1),
(25, 7, 3, '3', 0),
(26, 7, 4, '4', 0),
(27, 8, 1, 'Jacket Hot Water', 0),
(28, 8, 2, 'Water Tempering Unit', 0),
(29, 8, 3, 'Cooling Water System', 0),
(30, 8, 4, 'Extruder Startup Sump', 1),
(31, 9, 1, 'Seal in Additive feeders', 1),
(32, 9, 2, 'To operate Control Valve', 0),
(33, 9, 3, 'Seal in Slurry pumps to avoid contamination', 0),
(34, 9, 4, 'Inflation Air system', 0),
(35, 10, 1, 'Plant Air is filtered air', 0),
(36, 10, 2, 'Instrument Air is filtered air', 1),
(37, 10, 3, 'Plant Air is heated air', 0),
(38, 10, 4, 'Instrument Air is heated air', 0),
(39, 11, 1, '1 Bg', 0),
(40, 11, 2, '2 Bg', 0),
(41, 11, 3, '4 Bg', 1),
(42, 11, 4, '6 Bg', 0),
(43, 12, 1, '105 degC', 0),
(44, 12, 2, '155 degC', 1),
(45, 12, 3, '175 degC', 0),
(46, 12, 4, '205 degC', 0),
(47, 13, 1, 'NF-010', 1),
(48, 13, 2, 'HE-101', 0),
(49, 13, 3, 'NF-001', 0),
(50, 13, 4, 'VV-110', 0),
(51, 14, 1, '30°C', 0),
(52, 14, 2, '40°C', 0),
(53, 14, 3, '50°C', 0),
(54, 14, 4, '60°C', 1),
(55, 15, 1, 'To cool down the Tank', 0),
(56, 15, 2, 'To have slightly positive pressure to the Tank', 1),
(57, 15, 3, 'To heat up the Tank', 0),
(58, 15, 4, 'To prevent bad Odor in the Tank', 0),
(59, 16, 1, 'Jacket Hot Water System', 1),
(60, 16, 2, 'Heating Water System', 0),
(61, 16, 3, 'Steam Condensate System', 0),
(62, 16, 4, 'Hydraulic Conveying System', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_site_cookies`
--

CREATE TABLE `tbl_site_cookies` (
  `uid` int(11) NOT NULL,
  `cookie_code` varchar(128) NOT NULL,
  `usr_ID` varchar(20) NOT NULL,
  `expiry_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_site_cookies`
--

INSERT INTO `tbl_site_cookies` (`uid`, `cookie_code`, `usr_ID`, `expiry_date`) VALUES
(1, 'jL5AaswVNlTqRazus6l78SyKYL6qDrhxc8V6cxrxLTCRvVOyvRSxmpaj9LuNtFdxqlbsBuI27lHdwCruVwNPWM9HFDg6FLwq3rMGpkonOEaqTaskK472V4tZzopffKeb', '88', 1543167335),
(2, 'quEoran6oVvHBk9sVgR5IeNKOcwfyC8JMucXQgP9ATDYmSHJYcB6OgsgH6QXY8Rswm7qDeF6bJabukDSpYHXibuCXQxzNvY3D6pJM5SS8r3dYEVUdEcJ9WSRCvC4ZKuv', '88', 1543167501),
(3, '3pLNz2qBTPYvFAOZUsM5iddbPZUgcCiNpf9N7AOHnTctNRzzuJPZ2didvvNavmIkaWRF24BFePLjk4H2qTgN87L8wS5UdWxHhyYpknLwqEIZd6dlIU4uBRCTU9IzirIW', '88', 1543167567),
(4, '8H5VkNtzs2i9QPCOoe3nmCEZD25qzSmQYd72fpr9buVU8TFBVDhSWaOZ3qSEvTB5eywXwSMzfOVBJQ7gQWRhUzlRNG6KOMebPNkNbfuSH3k9JFUMa8QxhQfCVPEJvxd9', '88', 1543167653);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `uid` int(11) NOT NULL,
  `usr_ID` varchar(20) NOT NULL,
  `usr_Pass` varchar(60) NOT NULL,
  `usr_Name` varchar(50) NOT NULL,
  `usr_Nickname` varchar(10) NOT NULL,
  `usr_Position` varchar(50) NOT NULL,
  `usr_Level` varchar(5) NOT NULL,
  `usr_Status` int(11) NOT NULL,
  `usr_Email` varchar(50) NOT NULL,
  `usr_Big_pic` varchar(255) NOT NULL,
  `usr_Small_pic` varchar(255) NOT NULL,
  `usr_Phone1` varchar(20) NOT NULL,
  `usr_Phone2` varchar(20) NOT NULL,
  `usr_Phone_ext` varchar(20) NOT NULL,
  `usr_Phone_emg` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`uid`, `usr_ID`, `usr_Pass`, `usr_Name`, `usr_Nickname`, `usr_Position`, `usr_Level`, `usr_Status`, `usr_Email`, `usr_Big_pic`, `usr_Small_pic`, `usr_Phone1`, `usr_Phone2`, `usr_Phone_ext`, `usr_Phone_emg`) VALUES
(2, 'admin', '$2y$11$pE5sqlluHjWR4N8PDGrdReefpKtqWKXuUqpsBdRpv2q9ahlCSHjsy', 'Administrator', 'Admin', 'Web Administrator', '5', 1, 'admin@smartxl.com', 'kk-peach.jpg', '', '53452352352', '', '', '12343523'),
(3, 'user', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'User Test', '', '', '1', 1, '', 'man-user.png', '', '', '', '', ''),
(6, 'brw02199', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Semar Abdul Khader Syed', '', 'Office Administrator', '1', 0, 'semar.syed@borouge.com', 'man-user.png', '', '050 4120450', '', '85190', ''),
(7, 'brw02356', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Robert John Shingare', '', 'HSE Coordinator (LDPE & XLPE)', '2', 0, 'robert.shingare@borouge.com', 'man-user.png', '', '0562681576', '', '85192', ''),
(8, 'brw02067', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Paritosh Haldar', '', 'Process Trainer (LDPE & XLPE)', '2', 0, 'paritosh.haldar@borouge.com', 'man-user.png', '', '0566123729', '', '85244', ''),
(9, 'brw00764', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Joseph Roy Diwa', '', 'Controller Day (LDPE & XLPE)', '2', 0, 'joseph.diwa@borouge.com', 'man-user.png', '', '0507803745', '', '85288', ''),
(10, 'brw02496', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Constantin Negreci', '', 'Sr.Day Operator (LDPE & XLPE)', '1', 0, 'constantin.negreci@borouge.com', 'man-user.png', '', '0503199305', '', '85152', ''),
(11, 'brw02036', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Ahmed Belal Mohamed', '', 'Day Operator (LDPE & XLPE)', '1', 0, 'Ahmed.Mohamed@borouge.com', 'man-user.png', '', '0507064666', '', '85154', ''),
(12, 'brw00096', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Ramachandran Lokaiah', '', 'Lead Eng- Prod - XLPE', '4', 1, 'ramachandran.lokaiah@borouge.com', 'man-user.png', '', '0505627360', '', '785225', '+919789054667 and +9'),
(13, 'brw90248', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Paul Vinken', '', 'SU Lead Eng', '4', 0, 'paul.vinken@borouge.com', 'man-user.png', '', '0566106360', '', '', ''),
(14, 'brw02206', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Kalpesh Pagariya', '', 'Eng Prod', '3', 1, 'kalpesh.pagariya@borouge.com', 'man-user.png', '', '0567942743', '', '', ''),
(15, 'brw02245', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Shibu Karunakaran', '', 'Eng Prod', '3', 1, 'shibu.karunakaran@borouge.com', 'man-user.png', '', '0561330529', '', '', ''),
(16, 'brw02239', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Nuraine Binti Iberahim', '', 'Process Control Eng  ', '3', 1, 'nuraine.iberahim@borouge.com', 'man-user.png', '', '0508259048', '0562685582', '', '+60123887922'),
(17, 'brw90286', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Asa Bjork', '', 'SU Specialist', '3', 0, 'asa.bjork@borouge.com', 'man-user.png', '', '0562072275', '', '', ''),
(18, 'brw90287', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Roland Lucien Martha Poppe', '', 'SU Specialist', '4', 0, 'roland.poppe@borouge.com', 'man-user.png', '', '0562078456', '', '', ''),
(19, 'brw90251', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Jan Sacker', '', 'SU Specialist', '4', 0, 'jan.sacker@borouge.com', 'man-user.png', '', '0502421784', '', '', ''),
(20, 'brw90314', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Erik Joseph M Stoffijn', '', 'SU Specialist', '3', 0, 'erik.stoffijn@borouge.com', 'man-user.png', '', '0562890780', '', '', ''),
(21, 'brw90331', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Dirk Maria G Breugelmans', '', 'SU Panel Operator', '2', 0, 'dirk.breugelmans2@borouge.com', 'man-user.png', '', '0561963500', '', '', ''),
(22, 'brw90332', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Bo Linus Broberg', '', 'SU Panel Operator', '2', 0, 'bo.broberg@borouge.com', 'man-user.png', '', '0562127397', '', '', ''),
(23, 'brw90335', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Emil Christer Ekelund', '', 'SU Panel Operator', '2', 0, 'emil.ekelund2@borouge.com', 'man-user.png', '', '0562127387', '', '', ''),
(24, 'brw00693', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Ahmed Tareq Yousif Al Ansari', '', 'Controller Shift', '2', 1, 'ahmed.alansari@borouge.com', 'man-user.png', '', '0505119991', '0505119991', '', '0501666772'),
(25, 'brw00983', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Salem Rashed Alnaqbi', '', 'Controller Shift', '2', 1, 'Salem.alnaqabi@borouge.com', 'man-user.png', '', '0507185511', '', '', ''),
(26, 'brw00158', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Mohamed Hanifa M Ali', '', 'Controller Shift- Group A', '2', 1, 'mohamed.hanifa@borouge.com', 'man-user.png', '', '0505467091', '028762392', '', ''),
(27, 'brw02248', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Abhilash Vadakkedath S', '', 'Controller Shift- Group B', '2', 1, 'abhilash.sivasankarannair@borouge.com', 'man-user.png', '', '0501216960', '028768725', '', '+918592912081'),
(28, 'brw02098', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Soni Yusup Komar Suriadji', '', 'Controller Shift- Group C', '2', 1, 'soni.suriadji@borouge.com', 'man-user.png', '', '0561975841', '0567342774', '', '+622678457605'),
(29, 'brw02125', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Ismail Bin B Mohamed', '', 'Controller Shift- Group D', '2', 1, 'ismail.mohamed@borouge.com', 'man-user.png', '', '0562369685', '', '', ''),
(30, 'brw02396', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Antil Kiritbhai Patel', '', 'Operator', '1', 1, 'antil.patel@borouge.com', 'man-user.png', '', '0566901296', '028768124', '', '0091 9979891029'),
(31, 'brw02405', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Dave Singayen Germo', '', 'Operator', '1', 1, 'dave.germo@borouge.com', 'man-user.png', '', '0566901296', '028764030', '', '+639103575403'),
(32, 'brw02366', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Maulana Hazmi', 'Hazmi', 'Operator', '1', 1, 'maulana.hazmi@borouge.com', 'man-user.png', '', '0562681844', '', '', ''),
(33, 'brw02771', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Hasmukhkumar Z Patel', '', 'Operator', '1', 1, 'hasmukhkumar.patel@borouge.com', 'man-user.png', '', '0507068394', '0507068394', '', '00919998004757'),
(34, 'brw02308', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Zenrio Ryan Borbon', '', 'Operator', '1', 1, 'zenrio.borbon@borouge.com', 'man-user.png', '', '0562681560', '', '', '+639192836358'),
(35, 'brw02412', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Muardi Bn Sumpono', '', 'Operator', '1', 1, 'muardi.pawirodiharjo@borouge.com', 'man-user.png', '', '0563483577', '', '', '+628121351947'),
(36, 'brw02430', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'MihirKumar Dinesh Patel', '', 'Operator', '1', 1, 'mihirkumar.patel@borouge.com', 'man-user.png', '', '0563198863', '028768064', '', 'IND-00919724007614'),
(37, 'brw02470', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Laurence delos Reyes', '', 'Operator', '1', 1, 'laurence.reyes@borouge.com', 'man-user.png', '', '0563198349', '0563198349', '', '+639275139876'),
(38, 'brw02380', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Bjorn Villaflor Fernandez', '', 'Operator', '1', 1, 'bjorn.fernandez@borouge.com', 'man-user.png', '', '0566913092', '', '', ''),
(39, 'brw02336', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Ahmed Fayez Al Wahedi', '', 'Operator', '1', 1, 'ahmed.alwahedi@borouge.com', 'man-user.png', '', '0503172007', '', '', ''),
(40, 'brw02829', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Ali Salem Ali Al Hosani', '', 'Operator (U/D)', '1', 0, 'ali.alhosani3@borouge.com', 'man-user.png', '', '0507614771', '', '', ''),
(41, 'brw02371', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Samir Kumar Patel ', '', 'Operator', '1', 1, 'samirkumar.patel@borouge.com', 'man-user.png', '', '0562681841', '028768197', '', '00918128817577'),
(42, 'brw02316', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Manuel Nunez Manzano', '', 'Operator', '1', 0, 'manuel.manzano@borouge.com', 'man-user.png', '', '0502290130', '', '', ''),
(43, 'brw02390', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Syed Ahmed', '', 'Operator', '1', 1, 'syed.mohamed@borouge.com', 'man-user.png', '', '0507904711', '', '', ''),
(44, 'brw02448', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Mohd. Kamal Bin Jais', '', 'Operator', '1', 1, 'mohd.jais@borouge.com', 'man-user.png', '', '0562127365', '', '', '+60127433233'),
(45, 'brw02307', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Ralph Navarro Diaz', '', 'Operator', '1', 1, 'ralph.diaz@borouge.com', 'man-user.png', '', '0562681584', '028768145', '', '+639228012056'),
(46, 'brw02335', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Musleh Saleh Al Sayari', '', 'Operator', '1', 0, 'musleh.alsayari@borouge.com', 'man-user.png', '', '0501175524', '', '', ''),
(47, 'brw02162', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Kalpeshkumar K Dadhania', '', 'Operator', '1', 1, 'kalpeshkumar.dadhania@borouge.com', 'man-user.png', '', '0567734210', '', '', '00919662545562'),
(48, 'brw02399', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Paresh Laxman Savaliya', '', 'Operator', '1', 1, 'paresh.savaliya@borouge.com', 'man-user.png', '', '0566901289', '', '', '00919979294600'),
(49, 'brw02474', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Ahmad Hasan Ali Chitra', '', 'Operator', '1', 1, 'ahmad.chitra@borouge.com', 'man-user.png', '', '0562127365', '028768068', '', '+6287871241909'),
(50, 'brw02386', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Ronald Sevilla Torrico', '', 'Operator', '1', 1, 'ronald.torrico@borouge.com', 'man-user.png', '', '0566914291', '', '', ''),
(51, 'brw02256', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Gopalkumar Krishnalal Vyas', '', 'Operator', '1', 1, 'gopalkumar.krishnalalvyas@borouge.com', 'man-user.png', '', '0562898117', '', '', 'IND-00919427950343'),
(52, 'brw02334', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Abdulla Salem Al Ameri', '', 'Operator', '1', 1, 'abdulla.alameri2@borouge.com', 'man-user.png', '', '0507749947', '', '', ''),
(53, 'brw03194', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Khaled A M S Alkouri', '', 'Operator (U/D)', '1', 0, 'Khaled.AlKouri@borouge.com', 'man-user.png', '', '0522396807', '', '', ''),
(54, 'brw03198', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Mohamed Arif Alameri', '', 'Operator (U/D)', '1', 0, 'Mohamed.AlAmeri5@borouge.com', 'man-user.png', '', '0502633313', '', '', ''),
(55, 'brw03053', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Abdulla M Al Hammadi', '', 'Operator (U/D)', '1', 0, 'Abdulla.AlHammadi5@borouge.com', 'man-user.png', '', '', '', '', ''),
(56, 'brw10001', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Mohd. Jaib Bin Ismail', '', 'Operator', '1', 0, '', 'man-user.png', '', '', '', '', '+60167607574'),
(57, 'brw10001', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Abdullah Alfazari', '', '', '3', 1, '', 'man-user.png', '', '0501709180', '', '', ''),
(58, 'brw10001', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Nasir Al Hosani', '', 'Operator', '1', 1, '', 'man-user.png', '', '0506772672', '0506281808', '', ''),
(59, 'brw10001', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Mohamed Al Kalbani', '', 'Operator', '1', 1, '', 'man-user.png', '', '', '0509992109', '', ''),
(60, 'brw10001', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Hamad Al Shamsi', '', 'Operator', '1', 1, '', 'man-user.png', '', '', '0501861617-Father', '', '0507038580 new mob.'),
(61, 'brw10001', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Mohamed Al Katheeri', '', 'Operator', '1', 1, '', 'man-user.png', '', '', '0528006033-Father', '', '0501128204'),
(62, 'brw10001', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Tareq Al Azri', '', 'Operator', '1', 1, '', 'man-user.png', '', '', '', '', ''),
(63, 'brw10001', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Fahad Almsalami', '', 'Operator', '1', 1, '', 'man-user.png', '', '', '0506607090-Uncle', '', ''),
(64, 'brw10001', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Ali Al Menhali', '', 'Operator', '1', 1, '', 'man-user.png', '', '', '', '', ''),
(65, 'brw90000', '$2y$11$pE5sqlluHjWR4N8PDGrdReefpKtqWKXuUqpsBdRpv2q9ahlCSHjsy', 'Admin of XLPE', 'admin', 'Administrator', '5', 1, 'admin@xlpe.com', 'man-user.png', '', '055555555', '02888888', '88888', '88888'),
(66, 'brw90374', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Gauthier Hanquet', '', 'VP, Specialty Polymers', '4', 0, 'Gauthier.Hanquet@borouge.com', 'man-user.png', '', '0567280436', '', '74421', ''),
(67, 'brw90266', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Paulus Berg', '', 'Lead Eng- OpEX', '4', 0, 'paulus.berg@borouge.com', 'man-user.png', '', '0561553086', '', '85233', ''),
(68, 'brw00463', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Kulaifikh Naser Al Hajri', '', 'LDPE-Operation Mgr', '4', 1, 'kulaifikh.alhajri@borouge.com', 'man-user.png', '', '0504469050', '', '85222', ''),
(69, 'brw90236', '$2y$11$1DHQPiPeL/1plmVbf7BsfehF2eZBsx5LOrCyWZDI.SIR26Eo/N93y', 'Marc Theo De Vleeschhauwer', '', 'XLPE-Operation Mgr', '4', 0, 'marc.vleeschhauwer@borouge.com', 'man-user.png', '', '0566136321', '', '', '+32475755889');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_webpages`
--

CREATE TABLE `tbl_webpages` (
  `uid` int(11) NOT NULL,
  `date_published` int(11) NOT NULL,
  `author` varchar(50) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_url` varchar(255) NOT NULL,
  `page_keywords` text NOT NULL,
  `page_description` text NOT NULL,
  `headline` varchar(255) NOT NULL,
  `page_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_webpages`
--

INSERT INTO `tbl_webpages` (`uid`, `date_published`, `author`, `page_title`, `page_url`, `page_keywords`, `page_description`, `headline`, `page_content`) VALUES
(1, 0, 'emhazed', '', '', 'Keyword of Homepage', 'This is Page description', '', 'This is Homepage Content'),
(2, 0, 'me', 'Contact us', 'Contact-us', 'dfasf', 'asdfas', 'gdfjhgfj', 'Contact us content');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `num` (`uid`);

--
-- Indexes for table `tbl_bypass`
--
ALTER TABLE `tbl_bypass`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_calendar`
--
ALTER TABLE `tbl_calendar`
  ADD PRIMARY KEY (`Datefield`);

--
-- Indexes for table `tbl_cdo`
--
ALTER TABLE `tbl_cdo`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_charging`
--
ALTER TABLE `tbl_charging`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_container`
--
ALTER TABLE `tbl_container`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_container_bay`
--
ALTER TABLE `tbl_container_bay`
  ADD PRIMARY KEY (`Bay`);

--
-- Indexes for table `tbl_container_mstr`
--
ALTER TABLE `tbl_container_mstr`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_etask`
--
ALTER TABLE `tbl_etask`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_etask_exec`
--
ALTER TABLE `tbl_etask_exec`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_etask_job`
--
ALTER TABLE `tbl_etask_job`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_etask_list`
--
ALTER TABLE `tbl_etask_list`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_etask_plan`
--
ALTER TABLE `tbl_etask_plan`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_keyreg`
--
ALTER TABLE `tbl_keyreg`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_overtime`
--
ALTER TABLE `tbl_overtime`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_quiz_cat`
--
ALTER TABLE `tbl_quiz_cat`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_quiz_quest`
--
ALTER TABLE `tbl_quiz_quest`
  ADD PRIMARY KEY (`Quest_id`);

--
-- Indexes for table `tbl_quiz_quest_opt`
--
ALTER TABLE `tbl_quiz_quest_opt`
  ADD PRIMARY KEY (`Opt_id`);

--
-- Indexes for table `tbl_site_cookies`
--
ALTER TABLE `tbl_site_cookies`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `num` (`uid`);

--
-- Indexes for table `tbl_webpages`
--
ALTER TABLE `tbl_webpages`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tbl_bypass`
--
ALTER TABLE `tbl_bypass`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_cdo`
--
ALTER TABLE `tbl_cdo`
  MODIFY `uid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_charging`
--
ALTER TABLE `tbl_charging`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_container`
--
ALTER TABLE `tbl_container`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_etask`
--
ALTER TABLE `tbl_etask`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_etask_exec`
--
ALTER TABLE `tbl_etask_exec`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_etask_job`
--
ALTER TABLE `tbl_etask_job`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_etask_list`
--
ALTER TABLE `tbl_etask_list`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_etask_plan`
--
ALTER TABLE `tbl_etask_plan`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `tbl_keyreg`
--
ALTER TABLE `tbl_keyreg`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_overtime`
--
ALTER TABLE `tbl_overtime`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_quiz_quest_opt`
--
ALTER TABLE `tbl_quiz_quest_opt`
  MODIFY `Opt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tbl_site_cookies`
--
ALTER TABLE `tbl_site_cookies`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tbl_webpages`
--
ALTER TABLE `tbl_webpages`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
