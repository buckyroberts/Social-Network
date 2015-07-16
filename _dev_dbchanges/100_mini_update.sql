ALTER TABLE `trade_users` ADD COLUMN `shippingFullName` VARCHAR(250)
AFTER `userID`;
ALTER TABLE `trade_users` ADD COLUMN `shippingAddress2` VARCHAR(500)
AFTER `shippingAddress`;

ALTER TABLE `trade_shipping_info` DROP `lastName`;
ALTER TABLE `trade_shipping_info` CHANGE `firstName` `fullName` VARCHAR(512);
ALTER TABLE `trade_shipping_info` ADD COLUMN `address2` VARCHAR(500)
AFTER `address`;


CREATE TABLE `shop_orders_shipping` (
  `shippingID` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fullName`   VARCHAR(512)
               COLLATE utf8_unicode_ci   DEFAULT NULL,
  `address`    VARCHAR(1000)
               COLLATE utf8_unicode_ci   DEFAULT NULL,
  `address2`   VARCHAR(500)
               COLLATE utf8_unicode_ci   DEFAULT NULL,
  `city`       VARCHAR(500)
               COLLATE utf8_unicode_ci   DEFAULT NULL,
  `state`      VARCHAR(500)
               COLLATE utf8_unicode_ci   DEFAULT NULL,
  `countryID`  INT(11) UNSIGNED          DEFAULT NULL,
  `zip`        VARCHAR(30)
               COLLATE utf8_unicode_ci   DEFAULT NULL,
  PRIMARY KEY (`shippingID`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  COLLATE = utf8_unicode_ci
  CHECKSUM = 1
  DELAY_KEY_WRITE = 1
  ROW_FORMAT = DYNAMIC;

ALTER TABLE `shop_orders` DROP `shippingAddress`;
ALTER TABLE `shop_orders` ADD COLUMN `buyerShippingID` INT(11)
AFTER `totalPrice`;


RENAME TABLE shop_bitcoin_transaction TO bitcoin_transaction;


ALTER TABLE bitcoin_transaction MODIFY COLUMN `activityType` TINYINT(2) DEFAULT '1'
COMMENT '1: Listing product in shop, 2: Shop order transaction, 3: Listing item in trade section';
ALTER TABLE bitcoin_transaction MODIFY COLUMN `activityID` INT(11) UNSIGNED NOT NULL
COMMENT 'Listing product ID / Shop Order ID / Trade Item ID';


ALTER TABLE `trade_users` ADD COLUMN `optProductSoldOnShop` TINYINT(2) DEFAULT '1'
COMMENT '0: disagree; 1: agree that you receive notification when someone buy your product on shop'
AFTER `optFeedbackReceived`;
