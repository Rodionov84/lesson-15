<?php
include("connect.php");

$query = "-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 21 2018 г., 22:33
-- Версия сервера: 5.6.38
-- Версия PHP: 5.5.38

SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = \"+00:00\";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lesson-15`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) NOT NULL,
  `descriptions` text NOT NULL,
  `date_addedsd` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `descriptions`, `date_addedsd`) VALUES
(1, 'Сделать д/з', '0000-00-00 00:00:00'),
(4, 'тестирование-перетестирование', '2018-03-11 00:00:00'),
(5, 'Сделать что-нибудь', '0000-00-00 00:00:00'),
(8, 'Задание 3', '2018-03-15 15:26:47'),
(17, 'ascacs', '2018-03-17 00:45:17'),
(18, 'ОТлмоыавпгру гымвты', '2018-03-17 00:46:31'),
(19, 'ОТлмоыавпгру гым', '2018-03-17 00:46:44'),
(20, 'ОТлмоыавпгру гым', '2018-03-17 00:47:47'),
(21, 'Тест 1', '2018-03-17 00:48:04'),
(22, 'тест 2', '2018-03-17 00:48:42'),
(25, 'оририори', '2018-03-17 00:55:03');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks2`
--

CREATE TABLE `tasks2` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `is_done` varchar(12) NOT NULL,
  `date_added` datetime NOT NULL,
  `author` text NOT NULL,
  `responsible` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks2`
--

INSERT INTO `tasks2` (`id`, `description`, `is_done`, `date_added`, `author`, `responsible`) VALUES
(1, 'Сделать д/з!', '1', '0000-00-00 00:00:00', '1', 0),
(4, 'тестирование-перетестирование', '0', '2018-03-11 00:00:00', '1', 0),
(5, 'Сделать что-нибудь', '1', '0000-00-00 00:00:00', '1', 0),
(6, 'доделать всё', '0', '2018-03-11 00:00:00', '1', 7),
(7, 'доделать всё', '0', '2018-03-11 00:00:00', '1', 0),
(8, 'Задание 3', '1', '2018-03-15 15:26:47', '1', 3),
(15, 'Сработало почти', '1', '2018-03-15 16:41:53', '1', 4),
(16, 'ascacs', '1', '2018-03-17 00:45:13', '1', 3),
(18, 'ОТлмоыавпгру гымвты', '0', '2018-03-17 00:46:31', '1', 7),
(26, '', '0', '2018-03-17 17:17:16', '0', NULL),
(27, 'lkml lkml', '0', '2018-03-17 17:17:23', '0', NULL),
(28, 'lkml lkml', '0', '2018-03-17 17:17:25', '0', NULL),
(29, 'lkml lkml', '0', '2018-03-17 17:17:29', '0', NULL),
(30, 'lkml lkml', '0', '2018-03-17 17:18:12', '0', NULL),
(31, 'dfb', '0', '2018-03-17 17:18:19', '0', NULL),
(32, 'dfb', '0', '2018-03-17 17:18:40', '0', NULL),
(33, 'dfb', '0', '2018-03-17 17:18:41', '0', NULL),
(34, 'dfbasc', '0', '2018-03-17 17:18:43', '0', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'admin', '8e04ed8d93bb3694745f89915cda4181'),
(3, 'user', '5e98eddf126cddc692c650b0a0d68dab'),
(4, 'Ivan', 'f3c917e78ce96f1cb437e6f73461649b'),
(5, 'Nikolay', 'c05cf9c255f2d40bff7147db124f54b4'),
(6, 'Andrey', 'dee86fbb851ffba4d2263082fc8df0af'),
(7, 'Anna', '7974268c6d5b790c566bc694b36791e9'),
(8, 'Valentina', 'ab13f0008dbb6202193c7485fb49972a'),
(9, 'Ilya', '25d548aa8d28109e1be790f64993eea2');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tasks2`
--
ALTER TABLE `tasks2`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tasks2`
--
ALTER TABLE `tasks2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

";

echo $db->exec($query) ? "true" : "false";

print_r($db->errorInfo());

