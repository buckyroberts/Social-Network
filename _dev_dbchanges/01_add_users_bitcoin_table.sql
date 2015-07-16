CREATE TABLE `users_bitcoin` (
  `id`               INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userID`           INT(11)                   DEFAULT NULL,
  `bitcoin_guid`     VARCHAR(100)              DEFAULT '',
  `bitcoin_address`  VARCHAR(100)              DEFAULT '',
  `bitcoin_link`     VARCHAR(200)              DEFAULT NULL,
  `bitcoin_password` VARCHAR(250)              DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
