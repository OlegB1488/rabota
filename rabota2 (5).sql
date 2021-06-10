-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 10 2021 г., 06:04
-- Версия сервера: 5.7.29
-- Версия PHP: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `rabota2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1612263948),
('rd', '11', 1612290172),
('rd', '13', 1613028330),
('rd', '9', 1612264349),
('student', '10', 1612264529),
('student', '12', 1612981012),
('student', '8', 1612264217);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1612263948, 1612263948),
('rd', 1, NULL, NULL, NULL, 1612263948, 1612263948),
('student', 1, NULL, NULL, NULL, 1612263948, 1612263948);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `mesto`
--

CREATE TABLE `mesto` (
  `id` int(11) NOT NULL,
  `fio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mesto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `mesto`
--

INSERT INTO `mesto` (`id`, `fio`, `mesto`, `id_user`) VALUES
(1, 'Пупкин залупкин капупкин', 'работаю здеся', 10),
(2, 'Пупкин залупкин капупкин', 'работаю здеся', 10),
(3, 'Пупкин залупкин капупкин', 'работаю здеся', 10),
(4, 'Юлия Глазюлия', 'работает тута', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1612122071),
('m130524_201442_init', 1612122073),
('m140506_102106_rbac_init', 1612263817),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1612263817),
('m180523_151638_rbac_updates_indexes_without_prefix', 1612263817),
('m200409_110543_rbac_update_mssql_trigger', 1612263818);

-- --------------------------------------------------------

--
-- Структура таблицы `otklik`
--

CREATE TABLE `otklik` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_vacancy` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `otklik`
--

INSERT INTO `otklik` (`id`, `id_user`, `id_vacancy`) VALUES
(13, 10, 6),
(14, 10, 7),
(15, 10, 10),
(16, 10, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `rezume`
--

CREATE TABLE `rezume` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `rezume`
--

INSERT INTO `rezume` (`id`, `id_user`, `text`) VALUES
(4, 10, '123'),
(5, 12, '1234567890-dfh');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', 'gl-7zL1QMWXMb3kBdHhlhGslhgxgOJxS', '$2y$13$4/uA1HwL/9UH.f9bCn4/9e/8RD40tRuT4Eww9dhDJWLqgbE31i8QO', NULL, 'admin@mail.ru', 10, 1612264217, 1612264217, 'zK0U7GiQAe6iR7OiNTpDHMQJJ2lRgMj1_1612264217'),
(9, 'test2', '5LjIYNseikm86NmPgBBMSJo8nOI5R0NN', '$2y$13$Odp8Bjdoqytgl42QIxOFaOyQKSVkNVy/XWyc8PS4D1QF/Nm//16XG', NULL, 'test2@mail.ru', 10, 1612264349, 1612264349, 'X4oqZC96H8Q8t6dg6nifA4TkV8gjaB7E_1612264349'),
(10, 'student', 'CN4FSOnxSgz3Q57wGHueWSuGcEV0tgfv', '$2y$13$j93kO5W2gIpKdLkp30yvee/f5hMUy3AUasqEacrXhLYu0xIbDJ.Le', NULL, 'student@mail.ru', 10, 1612264529, 1612264529, 'uqhqSbWmUUAENARp4Rk-w3ISlYE7BLXT_1612264529'),
(11, 'rd', 'XB6OSLHGDwcuRyrVABXAQhGTsNRpfhHX', '$2y$13$G4GUMJhv2bo5stkqJgrEw.o2wK0IzXwxBC6Av9eLSxTw294LOi3N6', NULL, 'rd@mail.ru', 10, 1612290172, 1612290172, 'PimdOUVLiK22M9UhrIavvkcLZEuny-Cz_1612290172'),
(12, 'test3', 'GbdmfZuhGHdGRFH9vcZZN8Fo3QD55kes', '$2y$13$i4gUyhYjUwrN/.wF5PEH3exk7EsiI4mWDMU15AGTl76mgKSM61xqS', NULL, 'test3@ya.ru', 10, 1612981012, 1612981012, '03gmkYU0K1ENx99Cnps7epr-zC0p_3Qd_1612981012'),
(13, 'rab', 'tWuMJrfleSo5zSDi_sXH6D0ChGo2zdnx', '$2y$13$CgcX2HCv69s./8xPWQyZbOkFvO1L5z/oHSFCAFdqI98RXMTEKtbze', NULL, 'rab@ya.ru', 10, 1613028330, 1613028330, 'Fkv1lXfZjc91b7PzCvKK2Q0W_Pi3Hryl_1613028330');

-- --------------------------------------------------------

--
-- Структура таблицы `vacancy`
--

CREATE TABLE `vacancy` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `zp` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `vacancy`
--

INSERT INTO `vacancy` (`id`, `title`, `zp`, `description`, `id_user`, `created_at`, `updated_at`) VALUES
(6, 'Мыть слона', '10.000 р.', 'Мыть 24/7', 11, NULL, NULL),
(7, 'Работяга', '1.000 р.', 'Нужно работать мда ага. 1 раз в месяц.', 11, NULL, NULL),
(9, '4444', '123', 'awdawd', 11, NULL, NULL),
(10, 'Учитель младших классов', 'за еду', 'Предусмотрена уборка горшков за детьми.', 11, NULL, NULL),
(11, 'Учитель средних классов', '10.000 р.', 'фывфвфывфвфa', 13, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `mesto`
--
ALTER TABLE `mesto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `otklik`
--
ALTER TABLE `otklik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_vacancy` (`id_vacancy`);

--
-- Индексы таблицы `rezume`
--
ALTER TABLE `rezume`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Индексы таблицы `vacancy`
--
ALTER TABLE `vacancy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `mesto`
--
ALTER TABLE `mesto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `otklik`
--
ALTER TABLE `otklik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `rezume`
--
ALTER TABLE `rezume`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `vacancy`
--
ALTER TABLE `vacancy`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `mesto`
--
ALTER TABLE `mesto`
  ADD CONSTRAINT `mesto_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `otklik`
--
ALTER TABLE `otklik`
  ADD CONSTRAINT `otklik_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `otklik_ibfk_2` FOREIGN KEY (`id_vacancy`) REFERENCES `vacancy` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rezume`
--
ALTER TABLE `rezume`
  ADD CONSTRAINT `rezume_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `vacancy`
--
ALTER TABLE `vacancy`
  ADD CONSTRAINT `vacancy_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
