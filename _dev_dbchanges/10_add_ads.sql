CREATE TABLE `ads` (
  `id`                  INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `adKey`               VARCHAR(255)              DEFAULT NULL,
  `status`              TINYINT(2)                DEFAULT '0'
  COMMENT '0: Pending, 1: Active, 2: Expired',
  `defaultAd`           TINYINT(2)                DEFAULT '0',
  `ownerID`             INT(11)                   DEFAULT NULL,
  `createdDate`         DATETIME                  DEFAULT NULL,
  `startedDate`         DATETIME                  DEFAULT NULL,
  `endedDate`           DATETIME                  DEFAULT NULL,
  `type`                VARCHAR(10)               DEFAULT NULL
  COMMENT '''Text'' and ''Image''',
  `name`                VARCHAR(255)              DEFAULT NULL,
  `title`               VARCHAR(255)              DEFAULT '',
  `description`         VARCHAR(2000)             DEFAULT NULL,
  `adSize`              INT(11)                   DEFAULT '0',
  `fileName`            VARCHAR(255)              DEFAULT '',
  `url`                 VARCHAR(500)              DEFAULT NULL,
  `display_url`         VARCHAR(500)              DEFAULT '',
  `budget`              DOUBLE(12, 10)            DEFAULT NULL,
  `impressions`         INT(11)                   DEFAULT '0',
  `receivedImpressions` INT(11)                   DEFAULT '0',
  `clicks`              INT(11)                   DEFAULT '0',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*Data for the table `ads` */
INSERT INTO `ads` (`id`, `adKey`, `status`, `defaultAd`, `ownerID`, `createdDate`, `startedDate`, `endedDate`, `type`, `name`, `title`, `description`, `adSize`, `fileName`, `url`, `display_url`, `budget`, `impressions`, `receivedImpressions`, `clicks`)
VALUES
  (1, '5fa85996829ac14585b7cfc7ef72d7f3', 1, 1, 1, '2014-07-09 16:18:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00',
   'Text', 'Default Ad1', 'Default Ad1', 'Default Description1', 0, '', 'https://buckysroom.org', 'Buckysroom.org',
   0.0020000000, 5000, 8, 0);
INSERT INTO `ads` (`id`, `adKey`, `status`, `defaultAd`, `ownerID`, `createdDate`, `startedDate`, `endedDate`, `type`, `name`, `title`, `description`, `adSize`, `fileName`, `url`, `display_url`, `budget`, `impressions`, `receivedImpressions`, `clicks`)
VALUES
  (2, 'f4d1f60a649da7935f2ac9670aae4729', 1, 1, 1, '2014-07-09 16:19:34', '0000-00-00 00:00:00', '0000-00-00 00:00:00',
   'Text', 'Default Ad2', 'Default Ad2', 'Default Description2', 0, '', 'https://buckysroom.org', 'Buckysroom.org',
   0.0002000000, 500, 1, 0);
INSERT INTO `ads` (`id`, `adKey`, `status`, `defaultAd`, `ownerID`, `createdDate`, `startedDate`, `endedDate`, `type`, `name`, `title`, `description`, `adSize`, `fileName`, `url`, `display_url`, `budget`, `impressions`, `receivedImpressions`, `clicks`)
VALUES
  (3, 'f7462c1bc146ce69c8a4f82ac97339fa', 1, 1, 1, '2014-07-09 16:24:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00',
   'Text', 'Default Ad3', 'Default Ad3', 'Default Description4', 0, '', 'https://buckysroom.org', 'Buckysroom.org',
   0.0020000000, 5000, 0, 0);
INSERT INTO `ads` (`id`, `adKey`, `status`, `defaultAd`, `ownerID`, `createdDate`, `startedDate`, `endedDate`, `type`, `name`, `title`, `description`, `adSize`, `fileName`, `url`, `display_url`, `budget`, `impressions`, `receivedImpressions`, `clicks`)
VALUES
  (4, 'b5dcd7bc965d8555271162691c196793', 1, 1, 1, '2014-07-09 16:25:09', '0000-00-00 00:00:00', '0000-00-00 00:00:00',
   'Text', 'Default Ad4', 'Default Ad4', 'Default Description4', 0, '', 'https://buckysroom.org', 'Buckysroom.org',
   0.0002000000, 500, 0, 0);
INSERT INTO `ads` (`id`, `adKey`, `status`, `defaultAd`, `ownerID`, `createdDate`, `startedDate`, `endedDate`, `type`, `name`, `title`, `description`, `adSize`, `fileName`, `url`, `display_url`, `budget`, `impressions`, `receivedImpressions`, `clicks`)
VALUES
  (5, 'e87c3c6cf5d1bfa37f9f427d05458c47', 1, 1, 1, '2014-07-09 16:26:08', '0000-00-00 00:00:00', '0000-00-00 00:00:00',
   'Text', 'Default Ad5', 'Default Ad5', 'Default Description5', 0, '', 'https://buckysroom.org', 'Buckysroom.org',
   0.0020000000, 5000, 1, 0);
INSERT INTO `ads` (`id`, `adKey`, `status`, `defaultAd`, `ownerID`, `createdDate`, `startedDate`, `endedDate`, `type`, `name`, `title`, `description`, `adSize`, `fileName`, `url`, `display_url`, `budget`, `impressions`, `receivedImpressions`, `clicks`)
VALUES
  (6, 'c1705fa2cac973c35b0fdff478c32878', 1, 1, 1, '2014-07-09 16:26:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00',
   'Text', 'Default Ad6', 'Default Ad6', 'Default Description6', 0, '', 'https://buckysroom.org', 'Buckysroom.org',
   0.0020000000, 5000, 1, 0);
INSERT INTO `ads` (`id`, `adKey`, `status`, `defaultAd`, `ownerID`, `createdDate`, `startedDate`, `endedDate`, `type`, `name`, `title`, `description`, `adSize`, `fileName`, `url`, `display_url`, `budget`, `impressions`, `receivedImpressions`, `clicks`)
VALUES
  (7, '6a3769bb839035d0e58e6475b4dada25', 1, 1, 1, '2014-07-09 16:26:43', '0000-00-00 00:00:00', '0000-00-00 00:00:00',
   'Text', 'Default Ad7', 'Default Ad7', 'Default Description7', 0, '', 'https://buckysroom.org', 'Buckysroom.org',
   0.0020000000, 5000, 1, 0);
INSERT INTO `ads` (`id`, `adKey`, `status`, `defaultAd`, `ownerID`, `createdDate`, `startedDate`, `endedDate`, `type`, `name`, `title`, `description`, `adSize`, `fileName`, `url`, `display_url`, `budget`, `impressions`, `receivedImpressions`, `clicks`)
VALUES
  (8, '5fd4dc2355c0a9ff4f5cd6c1e01beac5', 1, 1, 1, '2014-07-09 16:27:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00',
   'Text', 'Default Ad8', 'Default Ad8', 'Default Description8', 0, '', 'https://buckysroom.org', 'Buckysroom.org',
   0.0020000000, 5000, 2, 0);
INSERT INTO `ads` (`id`, `adKey`, `status`, `defaultAd`, `ownerID`, `createdDate`, `startedDate`, `endedDate`, `type`, `name`, `title`, `description`, `adSize`, `fileName`, `url`, `display_url`, `budget`, `impressions`, `receivedImpressions`, `clicks`)
VALUES
  (9, '444ed47700886e61da770e476ce36ad9', 1, 1, 1, '2014-07-09 16:27:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00',
   'Text', 'Default Ad9', 'Default Ad9', 'Default Description9', 0, '', 'https://buckysroom.org', 'Buckysroom.org',
   0.0020000000, 5000, 2, 0);
INSERT INTO `ads` (`id`, `adKey`, `status`, `defaultAd`, `ownerID`, `createdDate`, `startedDate`, `endedDate`, `type`, `name`, `title`, `description`, `adSize`, `fileName`, `url`, `display_url`, `budget`, `impressions`, `receivedImpressions`, `clicks`)
VALUES
  (10, 'dd92d6808e0707aa3b516a4f16ea037c', 1, 1, 1, '2014-07-09 16:27:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00',
   'Text', 'Default Ad10', 'Default Ad10', 'Default Description10', 0, '', 'https://buckysroom.org', 'Buckysroom.org',
   0.0020000000, 5000, 1, 0);


CREATE TABLE `publisher_ads` (
  `id`              INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `publisherID`     INT(11)                   DEFAULT NULL,
  `size`            INT(11)                   DEFAULT NULL,
  `name`            VARCHAR(100)              DEFAULT NULL,
  `borderColor`     VARCHAR(10)               DEFAULT '006699',
  `bgColor`         VARCHAR(10)               DEFAULT 'FFFFFF',
  `titleColor`      VARCHAR(10)               DEFAULT '006699',
  `textColor`       VARCHAR(10)               DEFAULT '999999',
  `urlColor`        VARCHAR(10)               DEFAULT '006699',
  `createdDate`     DATETIME                  DEFAULT NULL,
  `impressions`     MEDIUMINT(12)             DEFAULT NULL,
  `paidImpressions` MEDIUMINT(12)             DEFAULT '0',
  `earnings`        DOUBLE(10, 8)             DEFAULT '0.00000000',
  `status`          TINYINT(2)                DEFAULT '1'
  COMMENT '1: Active, 0: Deleted',
  `token`           VARCHAR(255)              DEFAULT NULL,
  `adType`          TINYINT(4)                DEFAULT '1'
  COMMENT '1: Customer Ad, 2: Page & Profile Ad, 3: Forum Ad',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `ad_sizes` (
  `id`     INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `size`   VARCHAR(200)              DEFAULT NULL,
  `width`  INT(11)                   DEFAULT NULL,
  `height` INT(11)                   DEFAULT NULL,
  `order`  INT(11)                   DEFAULT NULL,
  `ads`    TINYINT(8)                DEFAULT '1',
  `class`  VARCHAR(100)              DEFAULT NULL,
  `type`   VARCHAR(20)               DEFAULT 'horizontal',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*Data for the table `ad_sizes` */

INSERT INTO `ad_sizes` (`id`, `size`, `width`, `height`, `order`, `ads`, `class`, `type`)
VALUES (1, '180 x 150 - Small rectangle', 180, 150, 1, 1, 'small_rectangle', 'horizontal');
INSERT INTO `ad_sizes` (`id`, `size`, `width`, `height`, `order`, `ads`, `class`, `type`)
VALUES (2, '300 x 250 - Medium rectangle', 300, 250, 2, 3, 'medium_rectangle', 'vertical');
INSERT INTO `ad_sizes` (`id`, `size`, `width`, `height`, `order`, `ads`, `class`, `type`)
VALUES (3, '336 x 280 - Large rectangle', 336, 280, 3, 3, 'large_rectangle', 'vertical');
INSERT INTO `ad_sizes` (`id`, `size`, `width`, `height`, `order`, `ads`, `class`, `type`)
VALUES (4, '728 x 90 - Leaderboard', 728, 90, 4, 2, 'leaderboard', 'horizontal');
INSERT INTO `ad_sizes` (`id`, `size`, `width`, `height`, `order`, `ads`, `class`, `type`)
VALUES (5, '970 x 90 - Large leaderboard', 970, 90, 5, 3, 'large_leaderboard', 'horizontal');
INSERT INTO `ad_sizes` (`id`, `size`, `width`, `height`, `order`, `ads`, `class`, `type`)
VALUES (6, '120 x 600 - Skyscraper', 120, 600, 6, 4, 'skyscraper', 'vertical');
INSERT INTO `ad_sizes` (`id`, `size`, `width`, `height`, `order`, `ads`, `class`, `type`)
VALUES (7, '240 x 400 - Fat Skyscraper', 240, 400, 7, 3, 'fat_skyscraper', 'vertical');
INSERT INTO `ad_sizes` (`id`, `size`, `width`, `height`, `order`, `ads`, `class`, `type`)
VALUES (8, '160 x 600 - Wide skyscraper', 160, 600, 8, 5, 'wide_skyscraper', 'vertical');
INSERT INTO `ad_sizes` (`id`, `size`, `width`, `height`, `order`, `ads`, `class`, `type`)
VALUES (9, '230 x 600 - Bucky’s skyscraper', 230, 600, 9, 5, 'buckys_skyscraper', 'vertical');
INSERT INTO `ad_sizes` (`id`, `size`, `width`, `height`, `order`, `ads`, `class`, `type`)
VALUES (10, '300 x 600 - Large skyscraper', 300, 600, 10, 6, 'large_skyscraper', 'vertical');
INSERT INTO `ad_sizes` (`id`, `size`, `width`, `height`, `order`, `ads`, `class`, `type`)
VALUES (11, '234 x 60 - Half banner', 234, 60, 11, 1, 'half_banner', 'vertical');
INSERT INTO `ad_sizes` (`id`, `size`, `width`, `height`, `order`, `ads`, `class`, `type`)
VALUES (12, '468 x 60 - Banner', 468, 60, 12, 2, 'banner', 'horizontal');
INSERT INTO `ad_sizes` (`id`, `size`, `width`, `height`, `order`, `ads`, `class`, `type`)
VALUES (13, '120 x 240 - Vertical banner', 120, 240, 13, 3, 'vertical_banner', 'vertical');
INSERT INTO `ad_sizes` (`id`, `size`, `width`, `height`, `order`, `ads`, `class`, `type`)
VALUES (14, '125 x 125 - Button', 125, 125, 14, 1, 'button', 'vertical');
INSERT INTO `ad_sizes` (`id`, `size`, `width`, `height`, `order`, `ads`, `class`, `type`)
VALUES (15, '200 x 200 - Small square', 200, 200, 15, 2, 'small_square', 'vertical');
INSERT INTO `ad_sizes` (`id`, `size`, `width`, `height`, `order`, `ads`, `class`, `type`)
VALUES (16, '250 x 250 - Square', 250, 250, 16, 3, 'square', 'vertical');

