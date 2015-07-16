CREATE TABLE `shop_categories` (
  `catID`    INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`     VARCHAR(255)
             COLLATE utf8_unicode_ci   DEFAULT NULL,
  `parentID` INT(11)                   DEFAULT '0',
  `status`   TINYINT(2)                DEFAULT '1'
  COMMENT '0: disable, 1: enable',
  PRIMARY KEY (`catID`)
)
  ENGINE = INNODB;

INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('1', 'Antiques', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('2', 'Art', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('3', 'Automotive', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('4', 'Baby', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('5', 'Books', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('6', 'Business & Industrial', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('7', 'Cameras & Photo', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('8', 'Clothing & Accessories', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('9', 'Collectibles', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('10', 'Computers', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('11', 'Crafts', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('12', 'Digital Goods', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('13', "DVD's & Movies", '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('14', 'Electronics', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('15', 'Health & Beauty', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('16', 'Home & Garden', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('17', 'Jewelry & Watches', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('18', 'Music', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('19', 'Pet Supplies', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('20', 'Services', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('21', 'Sports & Outdoors', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`)
VALUES ('22', 'Sports Memorabilia & Cards', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`)
VALUES ('23', 'Tools & Home Imporvement', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('24', 'Toys & Hobbies', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('25', 'Video Games', '0', '1');
INSERT INTO `shop_categories` (`catID`, `name`, `parentID`, `status`) VALUES ('26', 'Other', '0', '1');
