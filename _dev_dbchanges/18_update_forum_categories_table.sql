ALTER TABLE `forum_categories` ADD COLUMN `followers` INT(11) DEFAULT 0
AFTER `replies`;
ALTER TABLE `forum_categories` ADD COLUMN `description` TEXT DEFAULT ''
AFTER `categoryName`;
ALTER TABLE `forum_categories` ADD COLUMN `creatorID` INT(11) DEFAULT '0'
AFTER `parentID`;
ALTER TABLE `forum_categories` ADD COLUMN `image` VARCHAR(100) DEFAULT '';
UPDATE `forum_categories`
SET `image` = CONCAT(`categoryID`, '.png');