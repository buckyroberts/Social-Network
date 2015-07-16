CREATE TABLE `users_stats` (
  `userID`        INT(11) UNSIGNED NOT NULL,
  `pageFollowers` INT(11) DEFAULT '0',
  `likes`         INT(11) DEFAULT '0',
  `comments`      INT(11) DEFAULT '0',
  `voteUps`       INT(11) DEFAULT '0',
  `replies`       INT(11) DEFAULT '0',
  `reputation`    INT(11) DEFAULT '0',
  PRIMARY KEY (`userID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;