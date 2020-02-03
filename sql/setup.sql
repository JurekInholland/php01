SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS cms_users, cms_comments, cms_images, cms_login_tokens, cms_posts, cms_role_names, cms_api_keys, cms_password_tokens, cms_jobs, cms_settings;
SET FOREIGN_KEY_CHECKS=1;

ALTER DATABASE projectdb CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

SET time_zone = "+1:00";

CREATE TABLE `cms_users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `role` INT(11) NOT NULL,
    `registration_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `profile_image` CHAR(16) NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
)ENGINE=InnoDB;

CREATE TABLE `cms_images` (
    `image_id` CHAR(16) NOT NULL,
    `filename` VARCHAR(100) NULL DEFAULT NULL,
    `extension` CHAR(5) NULL DEFAULT NULL,
    PRIMARY KEY (`image_id`)

)ENGINE=InnoDB;

CREATE TABLE `cms_posts` (
	`post_id` INT(11) NOT NULL AUTO_INCREMENT,
	`post_title` VARCHAR(50) NULL DEFAULT NULL,
	`post_content` TEXT NULL,
	`slug` VARCHAR(50) NULL DEFAULT NULL,
	`privacy` TINYINT(4) NULL DEFAULT NULL,
	`post_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	`post_image` CHAR(16) NULL DEFAULT NULL,
	`user_id` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`post_id`),
	INDEX `cms_posts_ibfk_1` (`user_id`),
	INDEX `FK_cms_posts_cms_images` (`post_image`),
	CONSTRAINT `FK_cms_posts_cms_images` FOREIGN KEY (`post_image`) REFERENCES `cms_images` (`image_id`) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT `cms_posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `cms_users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
ENGINE=InnoDB;


CREATE TABLE `cms_comments` (
    `comment_id` INT(11) NOT NULL AUTO_INCREMENT,
    `comment_title` VARCHAR(100) NULL DEFAULT NULL,
    `comment_text` TEXT NOT NULL,
    `comment_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `user_id` INT(11) NOT NULL,
    `post` INT(11) NOT NULL,
    PRIMARY KEY (`comment_id`),
    CONSTRAINT `cms_comments_ibfk_1` FOREIGN KEY (`post`) REFERENCES `cms_posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB;


CREATE TABLE `cms_login_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` char(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `cms_login_tokens_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `cms_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB;


CREATE TABLE `cms_password_tokens` (
    `token_id` INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NOT NULL,
    `token` CHAR(32) NOT NULL COLLATE 'utf8_bin',
    `token_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`token_id`),
    UNIQUE INDEX `FK_cms_password_tokens_cms_users` (`user_id`),
    CONSTRAINT `FK_cms_password_tokens_cms_users` FOREIGN KEY (`user_id`) REFERENCES `cms_users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDB;


CREATE TABLE `cms_role_names` (
    `role_id` INT(11) NULL DEFAULT NULL,
    `role_name` VARCHAR(50) NULL DEFAULT NULL
)ENGINE=InnoDB;

CREATE TABLE `cms_api_keys` (
	`key_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL,
	`api_key` CHAR(24) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`last_used` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`key_id`),
	UNIQUE INDEX `user_id` (`user_id`),
	CONSTRAINT `cms_api_keys_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `cms_users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDB;


CREATE TABLE `cms_jobs` (
	`job_id` INT(11) NOT NULL AUTO_INCREMENT,
	`job_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`status` TINYINT(4) NULL DEFAULT NULL,
	PRIMARY KEY (`job_id`)
)ENGINE=InnoDB;

CREATE TABLE `cms_settings` (
	`cronjob_key` CHAR(16) NULL DEFAULT NULL,
	`job_interval` SMALLINT(6) NULL DEFAULT NULL
)ENGINE=InnoDB;

-- INSERT INTO cms_users (id, name, email, password, role) VALUES
-- (1, 'admin', 'admin@mail.com', 'asd', 1),
-- (2, 'user', 'user@mail.com', 'password', 0);

INSERT INTO `cms_users` (`name`, `email`, `password`, `role`, `registration_date`, `profile_image`) VALUES ('admin', 'admin@mail.com', '$2y$10$.IjBJAY6iKuuouGuZxfb2es70exK/eDnffsg12UU4fqA/wXUeCeiy', 1, '2020-01-22 19:48:03', NULL);
INSERT INTO `cms_users` (`name`, `email`, `password`, `role`, `registration_date`, `profile_image`) VALUES ('user', 'user@mail.com', '$2y$10$evO095wRndo4yc7ezFvYSuYHfbHGMMnaifAwIrnUGd0Ai1OH7OT/q', 1, '2020-01-22 19:48:03', 'tG9UkEvAjM9pK1K3');
INSERT INTO `cms_users` (`name`, `email`, `password`, `role`, `registration_date`, `profile_image`) VALUES ('superadmin', 'superadmin@mail.com', '$2y$10$onYX8gB7VCtfSuyY7U0yLurz6eb3WnPI2ORHQfxtd/oalgzrSj.R6', 2, '2020-01-22 19:48:03', NULL);
INSERT INTO `cms_users` (`name`, `email`, `password`, `role`, `registration_date`, `profile_image`) VALUES ('Donald Trump', 'potus@gov.com', '$2y$10$BdQDuhl0gSMeejAKJe2h9OaXfRK/mUB5cwT2KL8VAONYI38oWPQnW', 1, '2020-01-30 10:06:38', 'B2AUHSunJG4Bg21H');
INSERT INTO `cms_users` (`name`, `email`, `password`, `role`, `registration_date`, `profile_image`) VALUES ('Vincent', 'vincent@vangogh@yahoo.com', '$2y$10$AIKr.2iLH7c66DNSh5limulgrjDuxI3ElGKS.RD7rrWM8tOLWoyyC', 3, '2020-01-30 10:08:53', 'nyPrc11I7mpHUxPw');
INSERT INTO `cms_users` (`name`, `email`, `password`, `role`, `registration_date`, `profile_image`) VALUES ('Randall', 'randalmunroe@email.com', '$2y$10$NYDXgWs4tPA1AaZswM.zM.Uz1.QSHeYnmP25C7BemDxXX3ioma5m6', 1, '2020-01-30 10:32:32', 'bfHXB3ig7zecynND');
INSERT INTO `cms_users` (`name`, `email`, `password`, `role`, `registration_date`, `profile_image`) VALUES ('Thomas Luny', 'thomas@luny.net', '$2y$10$0k6poZGFdFwGywUOiuqAR.5ml1UM18Elwpy/gywmNWEVQDJMkfN.C', 1, '2020-01-31 07:08:39', 'rsnbwcGZ8j6EIsM9');
INSERT INTO `cms_users` (`name`, `email`, `password`, `role`, `registration_date`, `profile_image`) VALUES ('jurek', 'jurek.baum.ann@gmail.com', '$2y$10$vMB9CMYCTtw9g3qPTBx6S.i0iojD6paaTzbYKKcHEsT0BDEBrZY3K', 3, '2020-01-31 07:43:11', NULL);

INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('2xW2crjMc9OcYKcK', 'waterc11.jpg', 'jpg');
INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('B2AUHSunJG4Bg21H', 'kisspng-cartoon-donald-trump-5acb87db5b58a4.1011517515232880273742.png', 'png');
INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('bfHXB3ig7zecynND', 'Randall_Munroe_ducks.jpg', 'jpg');
INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('ePpb7opBCzN0rZfm', 'The-Bombardment-of-Algiers-27-August-1816-by-George-Chambers-Senior.jpg', 'jpg');
INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('goaH34P4CSKASqON', 'code_quality_2.png', 'png');
INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('HrTeD9H35ZbVWQCp', 'arles69.jpg', 'jpg');
INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('IKOLf7cJsIlfgoUx', 'major_in_the_universe.png', 'png');
INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('jqrrEItKvbaawkEt', 'Thomas_Luny_-_The_Battle_of_The_Saints.jpg', 'jpg');
INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('KqDg4MbKZtxWzAnY', 'logical.png', 'png');
INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('mJMP8eieen5muaW3', 'auvers08.jpg', 'jpg');
INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('nJqsQyEHja0H78JJ', 'the_history_of_unicode.png', 'png');
INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('nyPrc11I7mpHUxPw', 'Van_Gogh_Self-Portrait_with_Straw_Hat_1887-Detroit.jpg', 'jpg');
INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('R5pRS3HSYG7aSTNy', 'donald-trump-angela-merkel-g7-summit.jpg', 'jpg');
INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('rsnbwcGZ8j6EIsM9', '489px-Thomas_Luny,_by_Thomas_Luny.jpg', 'jpg');
INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('rvzuRQ25FYVQUG2B', '2hague04.jpg', 'jpg');
INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('tG9UkEvAjM9pK1K3', 'user-male-icon.png', 'png');
INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('tStcL7StPkgfHknK', 'thomas_luny_a2621_battle_of_cape_st_vincent.jpg', 'jpg');
INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('WfusXJqDfo2PEFeC', 'fruit_collider.png', 'png');
INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('ZOxPOsaHR4V2fQAt', 'arles66.jpg', 'jpg');

INSERT INTO `cms_posts` (`post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES ('Bulb Fields', 'Bulb Fields\r\nApril 1883, The Hague\r\nOil on canvas on panel, 48 x 65 cm', 'bulb-fields', 0, '2020-01-30 10:10:26', 'rvzuRQ25FYVQUG2B', 5);
INSERT INTO `cms_posts` (`post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES ('Some nice shoes', 'A Pair of Leather Clogs\r\nSpring 1889, Arles\r\nOil on canvas, 33 x 41 cm', 'some-nice-shoes', 0, '2020-01-30 10:11:18', 'ZOxPOsaHR4V2fQAt', 5);
INSERT INTO `cms_posts` (`post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES ('La Crau with Peach Trees in Blossom', 'La Crau with Peach Trees in Blossom\r\nApril 1889, Arles\r\nOil on canvas, 65 x 81 cm', 'la-crau-with-peach-trees-in-blossom', 0, '2020-01-30 10:11:43', 'HrTeD9H35ZbVWQCp', 5);
INSERT INTO `cms_posts` (`post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES ('Houses in Auvers', 'Houses in Auvers\r\nMay 1890, Auvers-sur-Oise\r\nOil on canvas, 72 x 61 cm', 'houses-in-auvers', 0, '2020-01-30 10:12:54', 'mJMP8eieen5muaW3', 5);
INSERT INTO `cms_posts` (`post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES ('The Night CafÃ© in the Place Lamartine in Arles', 'The Night CafÃ© in the Place Lamartine in Arles\r\nSeptember 1888, Arles\r\nWatercolour, 444 x 632 mm', 'the-night-caf-in-the-place-lamartine-in-arles', 0, '2020-01-30 10:13:57', '2xW2crjMc9OcYKcK', 5);
INSERT INTO `cms_posts` (`post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES ('Vibin with the crew', 'I have many friends', 'vibin-with-the-crew', 0, '2020-01-30 10:30:37', 'R5pRS3HSYG7aSTNy', 4);
INSERT INTO `cms_posts` (`post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES ('Major in the Universe', 'Permanent link to this comic: https://xkcd.com/863/', 'major-in-the-universe', 0, '2020-01-30 10:34:32', 'IKOLf7cJsIlfgoUx', 6);
INSERT INTO `cms_posts` (`post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES ('Logical', 'Permanent link to this comic: https://xkcd.com/1901/', 'logical', 0, '2020-01-31 06:44:21', 'KqDg4MbKZtxWzAnY', 6);
INSERT INTO `cms_posts` (`post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES ('Fruit Collider', 'Permanent link to this comic: https://xkcd.com/1949/\r\n', 'fruit-collider', 0, '2020-01-31 06:45:28', 'WfusXJqDfo2PEFeC', 6);
INSERT INTO `cms_posts` (`post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES ('The History of Unicode', 'Permanent link to this comic: https://xkcd.com/1953/', 'the-history-of-unicode', 0, '2020-01-31 07:01:13', 'nJqsQyEHja0H78JJ', 6);
INSERT INTO `cms_posts` (`post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES ('The Bombardment of Algiers', 'Drawn in 1816.', 'the-bombardment-of-algiers', 0, '2020-01-31 07:10:20', 'ePpb7opBCzN0rZfm', 7);
INSERT INTO `cms_posts` (`post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES ('The Battle of The Saints', 'Some battleships', 'the-battle-of-the-saints', 0, '2020-01-31 07:11:14', 'jqrrEItKvbaawkEt', 7);
INSERT INTO `cms_posts` (`post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES ('Battle of Cape St. Vincent', 'pew pew pew', 'battle-of-cape-st-vincent', 0, '2020-01-31 07:36:03', 'tStcL7StPkgfHknK', 7);
INSERT INTO `cms_posts` (`post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES ('Code quality', 'Permanent link to this comic: https://xkcd.com/1695/\r\n', 'code-quality', 0, '2020-01-31 11:58:45', 'goaH34P4CSKASqON', 6);


INSERT INTO `cms_comments` (`comment_title`, `comment_text`, `comment_date`, `user_id`, `post`) VALUES
(NULL, 'I drew this!', '2020-01-30 10:10:43', 5, 3),
(NULL, 'This is from a private collection. Fancy', '2020-01-30 10:14:08', 5, 7),
(NULL, 'Tremendous shoes!', '2020-01-30 10:28:10', 4, 4),
(NULL, 'Those flower fields are huuuuuuge!', '2020-01-30 10:28:41', 4, 3),
(NULL, 'Haha i\'m president lol', '2020-01-30 10:31:09', 4, 8),
(NULL, 'The most delicious exotic fruit discovered this way is the strawberry banana. Sadly, it\'s only stable in puree form, so it\'s currently limited to yogurt and smoothies, but they\'re building a massive collider in Europe to search for a strawberry banana that can be eaten whole.', '2020-01-31 06:46:19', 6, 12),
(NULL, 'ðŸ¦žðŸ¦žðŸ¦ž', '2020-01-31 07:01:32', 6, 13),
(NULL, 'It\'s like you tried to define a formal grammar based on fragments of a raw database dump from the QuickBooks file of a company that\'s about to collapse in an accounting scandal.', '2020-01-31 11:58:53', 6, 20),
(NULL, 'I don\'t get it', '2020-01-31 12:04:05', 4, 20),
(NULL, 'I don\'t get it', '2020-01-31 12:04:18', 4, 11),
(NULL, 'Huuuuge ships! Very legal and very cool!', '2020-01-31 12:05:27', 4, 16);

INSERT INTO `cms_role_names` (`role_id`, `role_name`) VALUES
(0, 'Guest'),
(1, 'User'),
(2, 'Administrator'),
(3, 'Superadministrator');
