-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Апр 08 2013 г., 01:04
-- Версия сервера: 5.5.25
-- Версия PHP: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `tour`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `city_id` int(225) NOT NULL AUTO_INCREMENT,
  `city` varchar(100) NOT NULL,
  `country_id` int(225) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`city_id`, `city`, `country_id`) VALUES
(63, 'Sidney', 49),
(64, 'Darvin', 49),
(65, 'Buenos Aires', 50),
(66, 'Santa Fe', 50),
(67, 'Bridgetown', 51);

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int(225) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(150) NOT NULL,
  `client_pasport` int(10) NOT NULL,
  `client_city` varchar(150) NOT NULL,
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `client_pasport` (`client_pasport`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `country_id` int(225) NOT NULL AUTO_INCREMENT,
  `country` varchar(100) NOT NULL,
  PRIMARY KEY (`country_id`),
  UNIQUE KEY `country` (`country`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`country_id`, `country`) VALUES
(50, 'Argentina'),
(49, 'Australia'),
(51, 'Barbados');

-- --------------------------------------------------------

--
-- Структура таблицы `hotels`
--

CREATE TABLE IF NOT EXISTS `hotels` (
  `hotel_id` int(255) NOT NULL AUTO_INCREMENT,
  `country_id` int(252) NOT NULL,
  `city_id` int(255) NOT NULL,
  `tour_id` int(255) NOT NULL,
  `hotel_name` varchar(50) NOT NULL,
  `rate` tinyint(1) NOT NULL,
  `stat` tinyint(1) NOT NULL,
  `people` tinyint(1) NOT NULL,
  PRIMARY KEY (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `reserved`
--

CREATE TABLE IF NOT EXISTS `reserved` (
  `reserved_id` int(225) NOT NULL AUTO_INCREMENT,
  `client_id` int(225) NOT NULL,
  `tour_id` int(225) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`reserved_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tours`
--

CREATE TABLE IF NOT EXISTS `tours` (
  `tour_id` int(225) NOT NULL AUTO_INCREMENT,
  `tour_name` varchar(300) NOT NULL,
  `country_id` int(225) NOT NULL,
  `city_id` int(225) NOT NULL,
  `cost` tinyint(6) NOT NULL,
  `date_leave` date NOT NULL,
  `date_return` date NOT NULL,
  `nights` tinyint(1) NOT NULL,
  `hotel_id` int(225) NOT NULL,
  `room` tinyint(2) NOT NULL,
  PRIMARY KEY (`tour_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Дамп данных таблицы `tours`
--

INSERT INTO `tours` (`tour_id`, `tour_name`, `country_id`, `city_id`, `cost`, `date_leave`, `date_return`, `nights`, `hotel_id`, `room`) VALUES
(38, 'australia-tour', 49, 63, 0, '0000-00-00', '0000-00-00', 0, 0, 0),
(39, 'aires - tour', 50, 65, 0, '0000-00-00', '0000-00-00', 0, 0, 0),
(40, 'santa fe', 50, 66, 0, '0000-00-00', '0000-00-00', 0, 0, 0),
(41, 'barbados', 51, 67, 0, '0000-00-00', '0000-00-00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `login` varchar(25) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `city` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`,`mail`),
  UNIQUE KEY `login_2` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `mail`, `name`, `surname`, `city`) VALUES
(1, 'admin', 'admin', 'admin@admin.admin', 'Admin', 'Adminov', 'Adminsk'),
(2, 'user', 'user', 'user@user.user', 'User', 'Userov', 'Userinsk'),
(3, 'qqqqqq', '11111', '', '', '', ''),
(6, '123', '202cb962ac59075b964b', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
