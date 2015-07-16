DROP TABLE IF EXISTS `users_bitcoin_transactions_history`;
CREATE TABLE `users_bitcoin_transactions_history` (
  `transactionID` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userID`        INT(11)                   DEFAULT NULL,
  `hash`          VARCHAR(200)              DEFAULT NULL,
  `addr`          TEXT,
  `type`          VARCHAR(10)               DEFAULT NULL
  COMMENT 'sent, received',
  `amount`        TEXT,
  `totalAmount`   INT(11)                   DEFAULT NULL,
  `balance`       BIGINT(20)                DEFAULT NULL,
  `date`          INT(11)                   DEFAULT NULL,
  PRIMARY KEY (`transactionID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
