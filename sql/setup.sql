SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS cms_users, cms_comments, cms_images, cms_login_tokens, cms_posts, cms_role_names, cms_api_keys;
SET FOREIGN_KEY_CHECKS=1;



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

) ENGINE=InnoDB;

CREATE TABLE `cms_role_names` (
    `role_id` INT(11) NULL DEFAULT NULL,
    `role_name` VARCHAR(50) NULL DEFAULT NULL
)ENGINE=InnoDB;

CREATE TABLE `cms_api_keys` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `api_key` char(24) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `cms_api_keys_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `cms_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;


-- INSERT INTO cms_users (id, name, email, password, role) VALUES
-- (1, 'admin', 'admin@mail.com', 'asd', 1),
-- (2, 'user', 'user@mail.com', 'password', 0);

INSERT INTO `cms_users` (`id`, `name`, `email`, `password`, `role`, `registration_date`, `profile_image`) VALUES (1, 'admin', 'admin@mail.com', 'asd', 1, '2020-01-22 20:48:03', NULL);
INSERT INTO `cms_users` (`id`, `name`, `email`, `password`, `role`, `registration_date`, `profile_image`) VALUES (2, 'user', 'user@mail.com', 'password', 0, '2020-01-22 20:48:03', '111111111111111');
INSERT INTO `cms_users` (`id`, `name`, `email`, `password`, `role`, `registration_date`, `profile_image`) VALUES (3, 'superadmin', 'superadmin@mail.com', 'password', 2, '2020-01-22 20:48:03', NULL);

INSERT INTO `cms_posts` (`post_id`, `post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES (1, 'Post #1', 'Helvetica direct trade vexillologist slow-carb, asymmetrical etsy 90s mustache williamsburg. Gastropub single-origin coffee deep v tilde kombucha activated charcoal meggings kale chips flannel cardigan hot chicken.', 'title', 0, '2020-01-23 04:08:33', '1234567890qwertz', 1);
INSERT INTO `cms_posts` (`post_id`, `post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES (2, 'Posttitle 2', 'Pickled cold-pressed flexitarian chillwave beard celiac. Glossier chicharrones yuccie snackwave.', 'titl2', 1, '2020-01-23 03:24:52', '1111111111111111', 2);
INSERT INTO `cms_posts` (`post_id`, `post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES (3, 'Another title', 'Sartorial edison bulb pickled fashion axe biodiesel butcher semiotics.', 'titl3', 1, '2020-01-23 21:49:48', NULL, 1);
INSERT INTO `cms_posts` (`post_id`, `post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES (4, 'Post 4', 'Tumblr asymmetrical brooklyn gentrify actually, neutra readymade trust fund poutine man braid artisan lyft twee.', 'p4', 1, '2020-01-24 12:58:17', NULL, 1);
INSERT INTO `cms_posts` (`post_id`, `post_title`, `post_content`, `slug`, `privacy`, `post_date`, `post_image`, `user_id`) VALUES (5, 'That would be post 5', 'Meditation vape food truck post-ironic shabby chic. XOXO listicle deep v slow-carb taiyaki, banh mi chillwave beard chartreuse gentrify chambray. ', 'p5', 1, '2020-01-24 13:36:11', NULL, 1);


INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('1234567890qwertz', 'image01.jpg', 'jpg');
INSERT INTO `cms_images` (`image_id`, `filename`, `extension`) VALUES ('111111111111111', 'profilepic.jpg', 'jpg');

INSERT INTO `cms_comments` (`comment_id`, `comment_title`, `comment_text`, `comment_date`, `user_id`, `post`) VALUES (1, 'comment #1', 'lol a comment', '2020-01-23 03:57:10', 1, 1);
INSERT INTO `cms_comments` (`comment_id`, `comment_title`, `comment_text`, `comment_date`, `user_id`, `post`) VALUES (2, 'comment #2', '2nd comment', '2020-01-23 04:09:22', 2, 1);

INSERT INTO `cms_role_names` (`role_id`, `role_name`) VALUES (0, 'Guest');
INSERT INTO `cms_role_names` (`role_id`, `role_name`) VALUES (1, 'User');
INSERT INTO `cms_role_names` (`role_id`, `role_name`) VALUES (2, 'Administrator');
INSERT INTO `cms_role_names` (`role_id`, `role_name`) VALUES (3, 'Superadministrator');
