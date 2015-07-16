CREATE TABLE `forum_followers` (
  `id`      INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `forumID` INT(11)                   DEFAULT NULL,
  `userID`  INT(11)                   DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

CREATE TABLE `forum_categories_links` (
  `id`         INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `categoryID` INT(11)                   DEFAULT NULL,
  `linkTitle`  VARCHAR(100)              DEFAULT NULL,
  `linkUrl`    VARCHAR(100)              DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

CREATE TABLE `forum_moderators` (
  `id`          INT(11) UNSIGNED NOT NULL   AUTO_INCREMENT,
  `userID`      INT(11)                     DEFAULT '0',
  `categoryID`  INT(11)                     DEFAULT '0',
  `status`      ENUM('Pending', 'Approved') DEFAULT 'Pending',
  `createdDate` DATETIME                    DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
