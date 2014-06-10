-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 10, 2014 at 05:39 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `NewEnglish`
--

-- --------------------------------------------------------

--
-- Table structure for table `Dictionary`
--

CREATE TABLE IF NOT EXISTS `Dictionary` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '字典名字',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `Dictionary`
--

INSERT INTO `Dictionary` (`id`, `name`) VALUES
(1, 'cet4'),
(2, 'cet6'),
(3, 'kaoyan'),
(4, 'ielts'),
(5, 'toefl');

-- --------------------------------------------------------

--
-- Table structure for table `DicWordRela`
--

CREATE TABLE IF NOT EXISTS `DicWordRela` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `word_id` int(100) NOT NULL COMMENT 'word外键',
  `dictionary_id` int(100) NOT NULL COMMENT 'dictionary外键',
  `word_order` int(100) NOT NULL COMMENT '对应这个word在dictionary中的第几个',
  PRIMARY KEY (`id`),
  KEY `word_id` (`word_id`),
  KEY `dictionary_id` (`dictionary_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Mark`
--

CREATE TABLE IF NOT EXISTS `Mark` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `word_id` int(100) NOT NULL COMMENT '对应user标记了哪个单词',
  `user_id` int(100) NOT NULL COMMENT '对应哪个user',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `word_id` (`word_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Process`
--

CREATE TABLE IF NOT EXISTS `Process` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'user外键',
  `dicWordRela_id` int(11) NOT NULL COMMENT '对应到dicwordreal 这样可以计算出背到了那个记录',
  PRIMARY KEY (`id`),
  KEY `dicWordRela_id` (`dicWordRela_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `account` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'md5密码',
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `now_dictionary_id` int(100) NOT NULL COMMENT '现在正在背的字典',
  `now_order` int(100) NOT NULL COMMENT '现在背的字典的第几个单词',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Word`
--

CREATE TABLE IF NOT EXISTS `Word` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `word` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '单词',
  `trans` varchar(200) COLLATE utf8_bin NOT NULL COMMENT '解释 以;为分隔符',
  `phoneticEn` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '英国音标',
  `phoneticUs` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '美国音标',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `DicWordRela`
--
ALTER TABLE `DicWordRela`
  ADD CONSTRAINT `dicwordrela_ibfk_2` FOREIGN KEY (`dictionary_id`) REFERENCES `dictionary` (`id`),
  ADD CONSTRAINT `dicwordrela_ibfk_1` FOREIGN KEY (`word_id`) REFERENCES `word` (`id`);

--
-- Constraints for table `Mark`
--
ALTER TABLE `Mark`
  ADD CONSTRAINT `mark_ibfk_2` FOREIGN KEY (`word_id`) REFERENCES `word` (`id`),
  ADD CONSTRAINT `mark_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `Process`
--
ALTER TABLE `Process`
  ADD CONSTRAINT `process_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `process_ibfk_1` FOREIGN KEY (`dicWordRela_id`) REFERENCES `DicWordRela` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
