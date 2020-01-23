DROP TABLE IF EXISTS cms_users;

CREATE TABLE cms_users (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `role` INT(11) NOT NULL,
	`registration_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`profile_image` CHAR(16) NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `cms_comments` (
	`comment_id` INT(11) NOT NULL AUTO_INCREMENT,
	`comment_title` VARCHAR(100) NULL DEFAULT NULL,
	`comment_text` TEXT NOT NULL,
	`comment_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`user_id` INT(11) NOT NULL,
	`post` INT(11) NOT NULL,
	PRIMARY KEY (`comment_id`)
)ENGINE=InnoDB;



CREATE TABLE `cms_images` (
	`image_id` CHAR(16) NULL DEFAULT NULL,
	`filename` VARCHAR(100) NULL DEFAULT NULL,
	`extension` CHAR(5) NULL DEFAULT NULL
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
	PRIMARY KEY (`post_id`)
)ENGINE=InnoDB;

CREATE TABLE `cms_users` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100) NOT NULL,
	`email` VARCHAR(100) NOT NULL,
	`password` VARCHAR(100) NOT NULL,
	`role` INT(11) NOT NULL,
	`registration_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`profile_image` CHAR(16) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
)ENGINE=InnoDB;

-- INSERT INTO cms_users (id, name, email, password, role) VALUES
-- (1, 'admin', 'admin@mail.com', 'asd', 1),
-- (2, 'user', 'user@mail.com', 'password', 0);

INSERT INTO `cms_users` (`id`, `name`, `email`, `password`, `role`, `registration_date`, `profile_image`) VALUES (1, 'admin', 'admin@mail.com', 'asd', 1, '2020-01-22 20:48:03', NULL);
INSERT INTO `cms_users` (`id`, `name`, `email`, `password`, `role`, `registration_date`, `profile_image`) VALUES (2, 'user', 'user@mail.com', 'password', 0, '2020-01-22 20:48:03', '111111111111111');

INSERT INTO `cms_posts` (`post_id`, `post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES (1, 'title #1', 'ksdfsdhflsfh', 'title', 0, '2020-01-23 04:08:33', '1234567890qwertz', 1);
INSERT INTO `cms_posts` (`post_id`, `post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES (2, 'titl2', '2222', 'titl2', 1, '2020-01-23 03:24:52', '1111111111111111', 2);

INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('1234567890qwertz', 'image01.jpg', 'jpg');
INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('111111111111111', 'profilepic.jpg', 'jpg');

INSERT INTO `cms_comments` (`comment_id`, `comment_title`, `comment_text`, `comment_date`, `user_id`, `post`) VALUES (1, 'comment #1', 'lol a comment', '2020-01-23 03:57:10', 1, 1);
INSERT INTO `cms_comments` (`comment_id`, `comment_title`, `comment_text`, `comment_date`, `user_id`, `post`) VALUES (2, 'comment #2', '2nd comment', '2020-01-23 04:09:22', 2, 1);
