-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 24, 2021 at 07:47 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `php_shilling`
--
CREATE DATABASE IF NOT EXISTS `php_shilling` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `php_shilling`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `userid` varchar(100) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`userid`, `pwd`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(200) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `newuser`
--

CREATE TABLE IF NOT EXISTS `newuser` (
  `uname` varchar(100) NOT NULL,
  `addr` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `uphoto` varchar(500) NOT NULL,
  `ftype` varchar(200) NOT NULL,
  `rtime` varchar(50) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newuser`
--

INSERT INTO `newuser` (`uname`, `addr`, `gender`, `dob`, `mobile`, `userid`, `pwd`, `uphoto`, `ftype`, `rtime`) VALUES
('Baskar', '343,Main Street,', 'Male', '1989-06-05', '9870235254', 'baskar@gmail.com', 'baskar', 'ups/userpic.gif', 'image/jpeg', '2021-07-09 03 pm'),
('Hari', '343,North Street,\r\nMadurai', 'Male', '1993-12-19', '8326225458', 'hari@gmail.com', 'hari', 'ups/userpic.gif', 'image/jpeg', '2021-07-09 03 pm'),
('Kamal', '343,south street,', 'Male', '1990-04-05', '8901255458', 'kamal@gmail.com', 'kamal', 'ups/userpic.gif', 'image/jpeg', '2021-07-09 03 pm'),
('Kumar', '343,south Car street,', 'Male', '1991-04-10', '8021355685', 'kumar@gmail.com', 'kumar', 'ups/userpic.gif', 'image/jpeg', '2021-07-09 03 pm'),
('Ram', '334,south Street', 'Male', '1990-04-05', '9823034839', 'ram@gmail.com', 'ram', 'ups/1625743131a3.jpg', 'image/jpeg', '2021-07-08 02 pm'),
('Samuel', '343,Church Road,', 'Male', '1992-09-04', '9215250025', 'sam@gmail.com', 'sam', 'ups/userpic.gif', 'image/jpeg', '2021-07-08 02 pm'),
('Suresh', '87,North Street,', 'Male', '1990-12-05', '8900325212', 'suresh@gmail.com', 'suresh', 'ups/userpic.gif', 'image/jpeg', '2021-07-09 03 pm');

-- --------------------------------------------------------

--
-- Table structure for table `pcategory`
--

CREATE TABLE IF NOT EXISTS `pcategory` (
  `cname` varchar(100) NOT NULL,
  PRIMARY KEY (`cname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pcategory`
--

INSERT INTO `pcategory` (`cname`) VALUES
('mobile'),
('television');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(100) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `pimage` varchar(300) NOT NULL,
  `ftype` varchar(300) NOT NULL,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `pid` (`pid`),
  UNIQUE KEY `pname` (`pname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `cname`, `pname`, `brand`, `price`, `pimage`, `ftype`) VALUES
(7, 'mobile', 'N8', 'Nokia', 12000, 'pimages/1625741794nokia1.jpg', 'image/jpeg'),
(8, 'television', 'Bravia V2', 'Sony', 18000, 'pimages/1625741816images8.jpg', 'image/jpeg'),
(9, 'mobile', 'N9', 'Nokia', 13500, 'pimages/1625814972nokia2.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `pur`
--

CREATE TABLE IF NOT EXISTS `pur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(200) NOT NULL,
  `dt` bigint(20) NOT NULL,
  `pid` int(11) NOT NULL,
  `delivery` varchar(10) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `pur`
--

INSERT INTO `pur` (`id`, `userid`, `dt`, `pid`, `delivery`) VALUES
(2, 'ram@gmail.com', 1625844841, 7, 'no'),
(8, 'ram@gmail.com', 1625847220, 8, 'no'),
(10, 'ram@gmail.com', 1625849850, 7, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dt` date NOT NULL,
  `userid` varchar(200) NOT NULL,
  `pid` int(11) NOT NULL,
  `prating` int(11) NOT NULL,
  `pur` varchar(10) NOT NULL DEFAULT 'no',
  `fdt` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `dt`, `userid`, `pid`, `prating`, `pur`, `fdt`) VALUES
(2, '2021-07-09', 'ram@gmail.com', 7, 5, 'no', '2021-07-09'),
(3, '2021-07-09', 'sam@gmail.com', 7, 4, 'no', '2021-07-09'),
(8, '2021-07-09', 'ram@gmail.com', 8, 4, 'no', '2021-07-09'),
(9, '2021-07-09', 'ram@gmail.com', 7, 2, 'no', '2021-07-09');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `pid` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`pid`, `count`) VALUES
(7, 0),
(8, 0),
(9, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
