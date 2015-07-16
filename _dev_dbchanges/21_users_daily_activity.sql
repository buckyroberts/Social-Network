CREATE TABLE `users_daily_activities` (
  `userID`         INT(11) NOT NULL,
  `date`           DATE    NOT NULL,
  `posts`          INT(11) DEFAULT '0',
  `comments`       INT(11) DEFAULT '0',
  `likes`          INT(11) DEFAULT '0',
  `friendRequests` INT(11) DEFAULT '0',
  PRIMARY KEY (`userID`, `date`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;
ALTER TABLE `users` ADD COLUMN `created_date` DATETIME;
ALTER TABLE `users` ADD COLUMN `ip_addr` VARCHAR(20) DEFAULT '';