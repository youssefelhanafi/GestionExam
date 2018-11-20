-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 30, 2016 at 07:29 PM
-- Server version: 5.6.30-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `correspondances`
--

CREATE TABLE IF NOT EXISTS `correspondances` (
  `NumMatiere` varchar(20) NOT NULL,
  `NumMatiereC` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `crypt`
--

CREATE TABLE IF NOT EXISTS `crypt` (
  `NE` int(10) NOT NULL,
  `NC1` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE IF NOT EXISTS `etudiant` (
  `Nec` int(10) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Prenom` varchar(20) NOT NULL,
  `Necrylevel1` int(10) DEFAULT NULL,
  `Necrylevel2` int(10) DEFAULT NULL,
  `Necrylevel3` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`Nec`, `Nom`, `Prenom`, `Necrylevel1`, `Necrylevel2`, `Necrylevel3`) VALUES
(11450923, 'a', 'j', NULL, NULL, NULL),
(12983261, 'd', 'm', NULL, NULL, NULL),
(23113355, 'f', 'o', NULL, NULL, NULL),
(45556644, 'i', 'r', NULL, NULL, NULL),
(99776623, 'h', 'q', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Matieres`
--

CREATE TABLE IF NOT EXISTS `Matieres` (
  `NumMatiere` varchar(20) DEFAULT NULL,
  `Designation` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Matieres`
--

INSERT INTO `Matieres` (`NumMatiere`, `Designation`) VALUES
('12fG67', 'Tech'),
('GHDue7', 'JAVA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`Nec`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
