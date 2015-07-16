ALTER TABLE posts_comments ADD COLUMN `image` VARCHAR(100) DEFAULT ''
AFTER `content`;