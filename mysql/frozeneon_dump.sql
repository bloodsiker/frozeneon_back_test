-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Апр 03 2022 г., 11:18
-- Версия сервера: 8.0.28
-- Версия PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `frozeneon`
--

-- --------------------------------------------------------

--
-- Структура таблицы `analytics`
--

CREATE TABLE `analytics` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `object` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `object_id` int DEFAULT NULL,
  `amount` int DEFAULT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `boosterpack`
--

CREATE TABLE `boosterpack` (
  `id` int NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bank` decimal(10,2) NOT NULL DEFAULT '0.00',
  `us` int NOT NULL,
  `time_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `time_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `boosterpack`
--

INSERT INTO `boosterpack` (`id`, `price`, `bank`, `us`, `time_created`, `time_updated`) VALUES
(1, '5.00', '0.00', 1, '2022-04-01 18:14:08', '2022-04-03 11:03:38'),
(2, '20.00', '0.00', 2, '2022-04-01 18:14:08', '2022-04-03 11:03:48'),
(3, '50.00', '0.00', 5, '2022-04-01 18:14:08', '2022-04-02 20:48:34');

-- --------------------------------------------------------

--
-- Структура таблицы `boosterpack_info`
--

CREATE TABLE `boosterpack_info` (
  `id` int NOT NULL,
  `boosterpack_id` int NOT NULL,
  `item_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `boosterpack_info`
--

INSERT INTO `boosterpack_info` (`id`, `boosterpack_id`, `item_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 2, 6),
(8, 2, 7),
(9, 2, 8),
(10, 2, 5),
(11, 3, 8),
(12, 3, 9),
(13, 3, 10),
(14, 3, 11),
(15, 3, 12);

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `assign_id` int UNSIGNED NOT NULL,
  `reply_id` int DEFAULT NULL,
  `text` text NOT NULL,
  `likes` int DEFAULT NULL,
  `time_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `time_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `id` int NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `name`, `price`) VALUES
(1, '1 Likes', 1),
(2, '2 Likes', 2),
(3, '3 Likes', 3),
(4, '5 Likes', 5),
(5, '10 Likes', 10),
(6, '15 Likes', 15),
(7, '20 Likes', 20),
(8, '30 Likes', 30),
(9, '50 Likes', 50),
(10, '100 Likes', 100),
(11, '200 Likes', 200),
(12, '500 Likes', 500);

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE `post` (
  `id` int NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `img` varchar(1024) DEFAULT NULL,
  `likes` int DEFAULT NULL,
  `time_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `time_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `post`
--

INSERT INTO `post` (`id`, `user_id`, `text`, `img`, `likes`, `time_created`, `time_updated`) VALUES
(1, 1, 'Post 1', '/images/posts/1.png', 0, '2022-04-01 18:14:09', '2022-04-03 11:17:36'),
(2, 1, 'Post 2', '/images/posts/2.png', 0, '2022-04-01 18:14:09', '2022-04-03 11:17:39');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `personaname` varchar(50) NOT NULL DEFAULT '',
  `avatarfull` varchar(150) NOT NULL DEFAULT '',
  `rights` tinyint NOT NULL DEFAULT '0',
  `likes_balance` int DEFAULT '0',
  `wallet_balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `wallet_total_refilled` decimal(10,2) NOT NULL DEFAULT '0.00',
  `wallet_total_withdrawn` decimal(10,2) NOT NULL DEFAULT '0.00',
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `personaname`, `avatarfull`, `rights`, `likes_balance`, `wallet_balance`, `wallet_total_refilled`, `wallet_total_withdrawn`, `time_created`, `time_updated`) VALUES
(1, 'admin@admin.pl', '$2y$10$kV6AHOCqO14rnDOUmHJuPOM8cEhwYXP.SxOrMzsBpwQMSp3Ep3LLi', 'Admin User', 'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/96/967871835afdb29f131325125d4395d55386c07a_full.jpg', 0, 0, '0.00', '0.00', '0.00', '2022-04-01 18:14:09', '2022-04-03 11:17:59'),
(2, 'user@user.pl', '$2y$10$Msj7L3OAwt3psJWgKXgZLOcbUZB3lYuksKzvsyAjdGSqY7Au9jneO', 'User #1', 'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/86/86a0c845038332896455a566a1f805660a13609b_full.jpg', 0, 0, '0.00', '0.00', '0.00', '2022-04-01 18:14:09', '2022-04-03 11:18:00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `analytics`
--
ALTER TABLE `analytics`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `boosterpack`
--
ALTER TABLE `boosterpack`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `boosterpack_info`
--
ALTER TABLE `boosterpack_info`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `analytics`
--
ALTER TABLE `analytics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `boosterpack`
--
ALTER TABLE `boosterpack`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `boosterpack_info`
--
ALTER TABLE `boosterpack_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `post`
--
ALTER TABLE `post`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
