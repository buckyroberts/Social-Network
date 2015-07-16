ALTER TABLE `trade_items` ADD COLUMN `expiryDate` DATETIME;
ALTER TABLE `trade_items` ADD COLUMN `listingDuration` TINYINT(4);
UPDATE trade_items
SET listingDuration = 7, expiryDate = DATE_ADD(`createdDate`, INTERVAL 7 DAY);