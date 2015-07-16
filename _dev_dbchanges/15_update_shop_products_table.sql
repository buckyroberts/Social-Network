ALTER TABLE `shop_categories` ADD COLUMN `isDownloadable` TINYINT(1) DEFAULT 0;
ALTER TABLE `shop_products` ADD COLUMN `fileName` VARCHAR(50) DEFAULT '';
ALTER TABLE `shop_products` ADD COLUMN `isDownloadable` TINYINT(1) DEFAULT 0;