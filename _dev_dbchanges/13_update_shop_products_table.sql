ALTER TABLE `shop_products` ADD COLUMN `expiryDate` DATETIME;
ALTER TABLE `shop_products` ADD COLUMN `listingDuration` TINYINT(4);
UPDATE shop_products
SET listingDuration = 7, expiryDate = DATE_ADD(`createdDate`, INTERVAL 7 DAY);