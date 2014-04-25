-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 25 2014 г., 10:22
-- Версия сервера: 5.6.12-log
-- Версия PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Структура таблицы `cinema`
--

CREATE TABLE IF NOT EXISTS `cinema` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `cinema`
--

INSERT INTO `cinema` (`id`, `name`) VALUES
(1, 'cinema 1'),
(2, 'cinema 2'),
(3, 'cinema 3'),
(4, 'cinema 4');

-- --------------------------------------------------------

--
-- Структура таблицы `films`
--

CREATE TABLE IF NOT EXISTS `films` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `films`
--

INSERT INTO `films` (`id`, `name`) VALUES
(1, 'saw'),
(2, 'saw 2'),
(3, 'saw 3'),
(4, 'saw 4'),
(5, 'saw 5'),
(6, 'saw 6'),
(7, 'saw 7'),
(8, 'Final Destination'),
(9, 'Final Destination 2'),
(10, 'Final Destination 3'),
(11, 'Final Destination 4'),
(12, 'Mr Bin');

-- --------------------------------------------------------

--
-- Структура таблицы `halls`
--

CREATE TABLE IF NOT EXISTS `halls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_cinema` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `count_place` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_cinima` (`id_cinema`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `halls`
--

INSERT INTO `halls` (`id`, `id_cinema`, `name`, `count_place`) VALUES
(1, 1, 'cinema 1 Зал 1', 15),
(2, 1, 'cinema 1 Зал 2', 10),
(3, 1, 'cinema 1 Зал 3', 10),
(4, 2, 'cinema 2 Зал 1', 10),
(5, 2, 'cinema 2 Зал 2', 13),
(6, 2, 'cinema 2 Зал 3', 10),
(7, 3, 'cinema 3 Зал 1', 6),
(8, 3, 'cinema 3 Зал 2', 10),
(9, 3, 'cinema 3 Зал 3', 10),
(10, 3, 'cinema 3 Зал 4', 6),
(11, 4, 'cinema 4 Зал 1', 10),
(12, 4, 'cinema 4 Зал 2', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `places`
--

CREATE TABLE IF NOT EXISTS `places` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_session` int(10) unsigned NOT NULL,
  `nr` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_session` (`id_session`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_halls` int(10) unsigned NOT NULL,
  `id_films` int(10) unsigned NOT NULL,
  `begin` datetime NOT NULL,
  `end` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_halls` (`id_halls`),
  KEY `id_films` (`id_films`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `halls`
--
ALTER TABLE `halls`
  ADD CONSTRAINT `halls_ibfk_1` FOREIGN KEY (`id_cinema`) REFERENCES `cinema` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_2` FOREIGN KEY (`id_films`) REFERENCES `films` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`id_halls`) REFERENCES `halls` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
