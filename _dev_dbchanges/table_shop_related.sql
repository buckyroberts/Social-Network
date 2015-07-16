CREATE TABLE IF NOT EXISTS `shop_products` (
  `productID`    INT(11) UNSIGNED        NOT NULL AUTO_INCREMENT,
  `userID`       INT(11) UNSIGNED        NOT NULL,
  `title`        VARCHAR(500)
                 COLLATE utf8_unicode_ci NOT NULL,
  `price`        DOUBLE                           DEFAULT NULL
  COMMENT 'Price in BTC',
  `subtitle`     VARCHAR(500)
                 COLLATE utf8_unicode_ci NOT NULL,
  `description`  TEXT
                 COLLATE utf8_unicode_ci NOT NULL,
  `catID`        INT(11) UNSIGNED        NOT NULL
  COMMENT 'It will use trade_category',
  `locationID`   INT(11) UNSIGNED                 DEFAULT NULL,
  `images`       TEXT
                 COLLATE utf8_unicode_ci,
  `returnPolicy` TEXT
                 COLLATE utf8_unicode_ci,
  `createdDate`  TIMESTAMP               NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status`       TINYINT(2)                       DEFAULT '1'
  COMMENT '0: Inactive, 1: ACTIVE, 2: Sold',
  PRIMARY KEY (`productID`),
  KEY `userID_index` (`userID`) USING BTREE,
  KEY `catID_index` (`catID`) USING BTREE,
  KEY `locationID_index` (`locationID`) USING BTREE,
  FULLTEXT KEY `title` (`title`, `subtitle`, `description`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  COLLATE = utf8_unicode_ci
  CHECKSUM = 1
  DELAY_KEY_WRITE = 1
  ROW_FORMAT = DYNAMIC
  AUTO_INCREMENT = 1;


CREATE TABLE IF NOT EXISTS `shop_shipping_price` (
  `id`         INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `productID`  INT(11) UNSIGNED NOT NULL,
  `locationID` INT(11) UNSIGNED NOT NULL,
  `price`      DOUBLE                    DEFAULT NULL
  COMMENT 'Price',
  PRIMARY KEY (`id`),
  KEY `productID_index` (`productID`) USING BTREE,
  KEY `locationID_index` (`locationID`) USING BTREE
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  COLLATE = utf8_unicode_ci
  CHECKSUM = 1
  DELAY_KEY_WRITE = 1
  ROW_FORMAT = DYNAMIC
  AUTO_INCREMENT = 1;


CREATE TABLE IF NOT EXISTS `shop_orders` (
  `orderID`         INT(11) UNSIGNED        NOT NULL AUTO_INCREMENT,
  `sellerID`        INT(11) UNSIGNED        NOT NULL,
  `buyerID`         INT(11) UNSIGNED        NOT NULL,
  `productID`       INT(11) UNSIGNED        NOT NULL
  COMMENT 'Sold product ID',
  `unitPrice`       DOUBLE                  NOT NULL
  COMMENT 'unitPrice',
  `shippingPrice`   DOUBLE                  NOT NULL
  COMMENT 'shippingPrice',
  `totalPrice`      DOUBLE                  NOT NULL
  COMMENT 'total',
  `shippingAddress` TEXT
                    COLLATE utf8_unicode_ci NOT NULL,
  `trackingNo`      VARCHAR(255)
                    COLLATE utf8_unicode_ci          DEFAULT NULL,
  `isRead`          TINYINT(2)                       DEFAULT '0'
  COMMENT '0: New, 1: Read',
  `isArchived`      TINYINT(2)                       DEFAULT '0'
  COMMENT '0: No, 1: Yes',
  `createdDate`     TIMESTAMP               NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status`          TINYINT(2)                       DEFAULT '1'
  COMMENT '1: Sold',
  PRIMARY KEY (`orderID`),
  KEY `sellerID_index` (`sellerID`) USING BTREE,
  KEY `buyerID_index` (`buyerID`) USING BTREE,
  KEY `productID_index` (`productID`) USING BTREE
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  COLLATE = utf8_unicode_ci
  CHECKSUM = 1
  DELAY_KEY_WRITE = 1
  ROW_FORMAT = DYNAMIC
  AUTO_INCREMENT = 1;

DROP TABLE `trade_feedbacks`;

CREATE TABLE IF NOT EXISTS `feedbacks` (
  `feedbackID`   INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `activityID`   INT(11) UNSIGNED NOT NULL
  COMMENT 'tradeID or ShopOrderID',
  `activityType` TINYINT(2)                DEFAULT '1'
  COMMENT '1: Trade, 2: Shop Order',
  `receiverID`   INT(11) UNSIGNED NOT NULL
  COMMENT '',
  `writerID`     INT(11) UNSIGNED NOT NULL
  COMMENT '',
  `itemID`       INT(11) UNSIGNED NOT NULL
  COMMENT 'tradeItemID or ShopProductID',
  `score`        TINYINT(2)                DEFAULT '0'
  COMMENT '0: No score 1: positive, -1: negative',
  `comment`      TEXT
                 COLLATE utf8_unicode_ci,
  `createdDate`  TIMESTAMP        NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`feedbackID`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  COLLATE = utf8_unicode_ci
  CHECKSUM = 1
  DELAY_KEY_WRITE = 1
  ROW_FORMAT = DYNAMIC
  AUTO_INCREMENT = 1;


CREATE TABLE IF NOT EXISTS `users_rating` (
  `userID`         INT(11) UNSIGNED NOT NULL,
  `totalRating`    INT(11) UNSIGNED DEFAULT '0'
  COMMENT 'count of feedback, cronjob will update this automatically',
  `positiveRating` INT(11) UNSIGNED DEFAULT '0'
  COMMENT 'Positive rating count',
  PRIMARY KEY (`userID`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  COLLATE = utf8_unicode_ci
  CHECKSUM = 1
  DELAY_KEY_WRITE = 1
  ROW_FORMAT = DYNAMIC;

ALTER TABLE trade_users DROP COLUMN totalRating;
ALTER TABLE trade_users DROP COLUMN positiveRating;


CREATE TABLE IF NOT EXISTS `shop_bitcoin_transaction` (
  `id`           INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `receiverID`   INT(11) UNSIGNED NOT NULL,
  `payerID`      INT(11) UNSIGNED NOT NULL,
  `activityType` TINYINT(2)                DEFAULT '1'
  COMMENT '1: Listing product in shop, 2: Shop order transaction',
  `activityID`   INT(11) UNSIGNED NOT NULL
  COMMENT 'Listing product ID / Shop Order ID',
  `amount`       DOUBLE                    DEFAULT NULL
  COMMENT 'Payment amount',
  `createdDate`  TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status`       TINYINT(2)                DEFAULT '1'
  COMMENT '0: pending, 1: Paid',
  PRIMARY KEY (`id`),
  KEY `receiverID_index` (`receiverID`) USING BTREE,
  KEY `payerID_index` (`payerID`) USING BTREE,
  KEY `activityID_index` (`activityID`) USING BTREE
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  COLLATE = utf8_unicode_ci
  CHECKSUM = 1
  DELAY_KEY_WRITE = 1
  ROW_FORMAT = DYNAMIC
  AUTO_INCREMENT = 1;