RENAME TABLE forum_settings TO users_notify_settings;
ALTER TABLE users_notify_settings ADD COLUMN `notifyCommentToMyComment` TINYINT(2) DEFAULT 1;

RENAME TABLE `activities` TO `main_activities`;

CREATE TABLE `forum_activities` (
  `activityID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `objectID` int(11) NOT NULL,
  `objectType` enum('forum') NOT NULL,
  `activityType` enum('replied_to_reply','replied_to_topic','reply_approved','topic_approved') NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actionID` int(11) NOT NULL,
  `isNew` tinyint(1) NOT NULL,
  `activityStatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`activityID`),
  KEY `userID_index` (`userID`) USING BTREE,
  KEY `objectID_index` (`objectID`) USING BTREE,
  KEY `actionID_index` (`actionID`) USING BTREE,
  KEY `activityType_index` (`activityType`) USING BTREE,
  KEY `createdDate_index` (`createdDate`),
  KEY `actionID_activityType_index` (`actionID`,`activityType`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;


CREATE TABLE `main_notifications` (
  `userID` int(11) NOT NULL,
  `activityID` int(11) NOT NULL,
  `notificationType` tinyint(2) DEFAULT '1' COMMENT '1: CommentToPost, 2: CommentedToMyComment',
  `isNew` tinyint(2) DEFAULT '1',
  `createdDate` int(11) DEFAULT NULL,
  PRIMARY KEY (`userID`,`activityID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

