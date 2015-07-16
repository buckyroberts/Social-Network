CREATE TABLE `users_bitcoin_transactions_history` (
  `transactionID` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userID`        INT(11)                   DEFAULT NULL,
  `hash`          VARCHAR(200)              DEFAULT NULL,
  `addr`          VARCHAR(200)              DEFAULT NULL,
  `type`          VARCHAR(10)               DEFAULT NULL
  COMMENT 'sent, received',
  `amount`        DOUBLE(10, 8)             DEFAULT NULL,
  `balance`       DOUBLE(10, 8)             DEFAULT NULL,
  `date`          INT(11)                   DEFAULT NULL,
  PRIMARY KEY (`transactionID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
