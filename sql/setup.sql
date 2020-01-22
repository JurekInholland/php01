DROP TABLE IF EXISTS cms_users;

CREATE TABLE cms_users (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

INSERT INTO cms_users (id, name) VALUES
(1, 'admin'),
(2, 'user');