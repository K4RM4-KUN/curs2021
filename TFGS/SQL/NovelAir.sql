-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Temps de generació: 16-04-2021 a les 17:07:56
-- Versió del servidor: 5.7.33-0ubuntu0.16.04.1
-- Versió de PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `dflores_db_NovelAir`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `chapters`
--

CREATE TABLE `chapters` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `chapter_n` float NOT NULL,
  `route` varchar(255) COLLATE utf8_bin NOT NULL,
  `novel_id` bigint(20) NOT NULL,
  `public` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de la taula `donations`
--

CREATE TABLE `donations` (
  `id` bigint(20) NOT NULL,
  `amount` float NOT NULL,
  `donator_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `message` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de la taula `follows`
--

CREATE TABLE `follows` (
  `id` bigint(20) NOT NULL,
  `follower_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de la taula `novels`
--

CREATE TABLE `novels` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL,
  `genre` varchar(255) COLLATE utf8_bin NOT NULL,
  `sinopsis` varchar(400) COLLATE utf8_bin NOT NULL,
  `novel_dir` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_dir` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de la taula `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) NOT NULL,
  `rol_name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de la taula `rol_users`
--

CREATE TABLE `rol_users` (
  `rol_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de la taula `states`
--

CREATE TABLE `states` (
  `id` bigint(20) NOT NULL,
  `state_name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de la taula `suscriptions`
--

CREATE TABLE `suscriptions` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `subscriber_id` bigint(20) NOT NULL,
  `subscription_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de la taula `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) NOT NULL,
  `tag_name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de la taula `tags_novels`
--

CREATE TABLE `tags_novels` (
  `novel_id` bigint(20) NOT NULL,
  `tag_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de la taula `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `surname` varchar(255) COLLATE utf8_bin NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `birth_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de la taula `user_directories`
--

CREATE TABLE `user_directories` (
  `user_id` bigint(20) NOT NULL,
  `route` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de la taula `U_N_S`
--

CREATE TABLE `U_N_S` (
  `novel_dir` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `state_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_chapter_novel` (`novel_id`);

--
-- Índexs per a la taula `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_donator_user` (`donator_id`),
  ADD KEY `fk_userId_user` (`user_id`);

--
-- Índexs per a la taula `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_follower_user` (`follower_id`),
  ADD KEY `fk_followerUser_user` (`user_id`);

--
-- Índexs per a la taula `novels`
--
ALTER TABLE `novels`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `rol_users`
--
ALTER TABLE `rol_users`
  ADD KEY `fk_rolUserId_user` (`user_id`),
  ADD KEY `fk_rol_user` (`rol_id`);

--
-- Índexs per a la taula `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `suscriptions`
--
ALTER TABLE `suscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subsciver_user` (`subscriber_id`),
  ADD KEY `fk_SubscriptionsUser_user` (`user_id`);

--
-- Índexs per a la taula `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `tags_novels`
--
ALTER TABLE `tags_novels`
  ADD KEY `fk_tagNovel_novel` (`novel_id`),
  ADD KEY `fk_tagTag_novel` (`tag_id`);

--
-- Índexs per a la taula `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `user_directories`
--
ALTER TABLE `user_directories`
  ADD KEY `fk_directories_user` (`user_id`);

--
-- Índexs per a la taula `U_N_S`
--
ALTER TABLE `U_N_S`
  ADD KEY `fk_UNSUser_user` (`user_id`),
  ADD KEY `fk_UNS_state` (`state_id`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `donations`
--
ALTER TABLE `donations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `follows`
--
ALTER TABLE `follows`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `novels`
--
ALTER TABLE `novels`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `suscriptions`
--
ALTER TABLE `suscriptions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `fk_chapter_novel` FOREIGN KEY (`novel_id`) REFERENCES `novels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per a la taula `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `fk_donator_user` FOREIGN KEY (`donator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_userId_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per a la taula `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `fk_followerUser_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_follower_user` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per a la taula `rol_users`
--
ALTER TABLE `rol_users`
  ADD CONSTRAINT `fk_rolUserId_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rol_user` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per a la taula `suscriptions`
--
ALTER TABLE `suscriptions`
  ADD CONSTRAINT `fk_SubscriptionsUser_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_subsciver_user` FOREIGN KEY (`subscriber_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per a la taula `tags_novels`
--
ALTER TABLE `tags_novels`
  ADD CONSTRAINT `fk_tagNovel_novel` FOREIGN KEY (`novel_id`) REFERENCES `novels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tagTag_novel` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per a la taula `user_directories`
--
ALTER TABLE `user_directories`
  ADD CONSTRAINT `fk_directories_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriccions per a la taula `U_N_S`
--
ALTER TABLE `U_N_S`
  ADD CONSTRAINT `fk_UNSUser_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_UNS_state` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
