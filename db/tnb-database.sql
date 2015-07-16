SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS `buckysroom` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `buckysroom`;

CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `adKey` varchar(255) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '0' COMMENT '0: Pending, 1: Active, 2: Expired',
  `defaultAd` tinyint(2) DEFAULT '0',
  `ownerID` int(11) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `startedDate` datetime DEFAULT NULL,
  `endedDate` datetime DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL COMMENT '''Text'' and ''Image''',
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT '',
  `description` varchar(2000) DEFAULT NULL,
  `adSize` int(11) DEFAULT '0',
  `fileName` varchar(255) DEFAULT '',
  `url` varchar(500) DEFAULT NULL,
  `display_url` varchar(500) DEFAULT '',
  `budget` double(12,10) DEFAULT NULL,
  `impressions` int(11) DEFAULT '0',
  `receivedImpressions` int(11) DEFAULT '0',
  `clicks` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ad` (`defaultAd`,`status`,`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=120 ;

CREATE TABLE IF NOT EXISTS `ad_sizes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `size` varchar(200) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `ads` tinyint(8) DEFAULT '1',
  `class` varchar(100) DEFAULT NULL,
  `type` varchar(20) DEFAULT 'horizontal',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

CREATE TABLE IF NOT EXISTS `albums` (
  `albumID` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `visibility` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`albumID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=598 ;

CREATE TABLE IF NOT EXISTS `albums_photos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `album_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1355 ;

CREATE TABLE IF NOT EXISTS `banned_users` (
  `bannedID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `bannedUserID` int(11) DEFAULT NULL,
  `bannedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`bannedID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `bitcoin_transaction` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `receiverID` int(11) unsigned NOT NULL,
  `payerID` int(11) unsigned NOT NULL,
  `activityType` tinyint(2) DEFAULT '1' COMMENT '1: Listing product in shop, 2: Shop order transaction, 3: Listing item in trade section',
  `activityID` int(11) unsigned NOT NULL COMMENT 'Listing product ID / Shop Order ID / Trade Item ID',
  `amount` double DEFAULT NULL COMMENT 'Payment amount',
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(2) DEFAULT '1' COMMENT '0: pending, 1: Paid',
  PRIMARY KEY (`id`),
  KEY `receiverID_index` (`receiverID`) USING BTREE,
  KEY `payerID_index` (`payerID`) USING BTREE,
  KEY `activityID_index` (`activityID`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=34 ;

CREATE TABLE IF NOT EXISTS `countries` (
  `countryID` int(11) NOT NULL AUTO_INCREMENT,
  `country_title` varchar(255) NOT NULL DEFAULT '',
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `status` tinyint(2) DEFAULT '1' COMMENT '0: disable, 1: enable',
  PRIMARY KEY (`countryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=491 ;

CREATE TABLE IF NOT EXISTS `credit_activity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `receiverID` int(11) unsigned NOT NULL COMMENT 'The user ID who has received this credits',
  `payerID` int(11) unsigned NOT NULL COMMENT 'The user ID who has sent this credits. 0 means paypal',
  `activityType` tinyint(2) DEFAULT '0' COMMENT '0: Deposit from Paypal Payments, 1: Payment to other, 2: Trade Item Add, 9: other',
  `amount` double(11,5) DEFAULT '0.00000',
  `transactionID` int(11) unsigned DEFAULT '0' COMMENT 'If the payer is paypal, then it will save transaction ID',
  `receiverBalance` double(11,5) DEFAULT '0.00000',
  `payerBalance` double(11,5) DEFAULT '0.00000',
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=2089 ;

CREATE TABLE IF NOT EXISTS `feedbacks` (
  `feedbackID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `activityID` int(11) unsigned NOT NULL COMMENT 'tradeID or ShopOrderID',
  `activityType` tinyint(2) DEFAULT '1' COMMENT '1: Trade, 2: Shop Order',
  `receiverID` int(11) unsigned NOT NULL,
  `writerID` int(11) unsigned NOT NULL,
  `itemID` int(11) unsigned NOT NULL COMMENT 'tradeItemID or ShopProductID',
  `score` tinyint(2) DEFAULT '0' COMMENT '0: No score 1: positive, -1: negative',
  `comment` text COLLATE utf8_unicode_ci,
  `createdDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`feedbackID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=22 ;

CREATE TABLE IF NOT EXISTS `forum_activities` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=175583 ;

CREATE TABLE IF NOT EXISTS `forum_blocked_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `categoryID` smallint(5) unsigned NOT NULL,
  `blockedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `forum_categories` (
  `categoryID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `parentID` int(11) DEFAULT '0' COMMENT 'Parent category id',
  `creatorID` int(11) DEFAULT '0',
  `topics` int(11) DEFAULT '0' COMMENT 'The number of topics',
  `replies` int(11) DEFAULT '0' COMMENT 'The number of replies',
  `followers` int(11) DEFAULT '0',
  `lastTopicID` int(11) DEFAULT '0',
  `sortOrder` int(11) DEFAULT '0',
  `createdDate` datetime DEFAULT NULL,
  `image` varchar(100) DEFAULT '',
  PRIMARY KEY (`categoryID`),
  UNIQUE KEY `icat` (`categoryID`,`categoryName`),
  FULLTEXT KEY `name_description` (`categoryName`,`description`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=223 ;

CREATE TABLE IF NOT EXISTS `forum_categories_links` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `categoryID` smallint(5) unsigned NOT NULL,
  `linkTitle` varchar(100) DEFAULT NULL,
  `linkUrl` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=135 ;

CREATE TABLE IF NOT EXISTS `forum_followers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `categoryID` smallint(5) unsigned NOT NULL,
  `userID` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2763894 ;

CREATE TABLE IF NOT EXISTS `forum_moderators` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT '0',
  `categoryID` smallint(5) unsigned NOT NULL,
  `status` enum('Pending','Approved') DEFAULT 'Pending',
  `createdDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=541 ;

CREATE TABLE IF NOT EXISTS `forum_replies` (
  `replyID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `topicID` int(11) DEFAULT NULL,
  `replyContent` text,
  `creatorID` int(11) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `status` varchar(10) DEFAULT '',
  `votes` int(11) DEFAULT NULL,
  PRIMARY KEY (`replyID`),
  FULLTEXT KEY `search` (`replyContent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22632 ;

CREATE TABLE IF NOT EXISTS `forum_topics` (
  `topicID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `topicTitle` varchar(500) DEFAULT NULL,
  `topicContent` text,
  `categoryID` smallint(5) unsigned NOT NULL,
  `creatorID` int(11) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `replies` int(11) DEFAULT NULL COMMENT 'The number of Replies',
  `lastReplyID` int(11) DEFAULT NULL,
  `lastReplyDate` datetime DEFAULT NULL,
  `lastReplierID` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT 'pending',
  `votes` int(11) DEFAULT '0',
  PRIMARY KEY (`topicID`),
  KEY `ftopics` (`topicID`,`topicTitle`,`topicContent`(100),`categoryID`,`creatorID`,`createdDate`,`replies`,`lastReplyID`,`lastReplierID`,`views`,`status`,`votes`),
  FULLTEXT KEY `search` (`topicTitle`,`topicContent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8057 ;

CREATE TABLE IF NOT EXISTS `forum_votes` (
  `voteID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `objectID` int(11) NOT NULL,
  `voterID` int(11) NOT NULL,
  `voteDate` datetime NOT NULL,
  `voteStatus` tinyint(2) NOT NULL DEFAULT '1',
  `objectType` enum('reply','topic') NOT NULL,
  PRIMARY KEY (`voteID`),
  KEY `ivotes` (`voteID`,`voteStatus`,`objectID`,`objectType`,`voterID`),
  KEY `ix_object_voter_type` (`objectID`,`voterID`,`objectType`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20381 ;

CREATE TABLE IF NOT EXISTS `friends` (
  `friendID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `userFriendID` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`friendID`),
  KEY `userID_index` (`userID`) USING BTREE,
  KEY `userFriendID_index` (`userFriendID`) USING BTREE,
  KEY `userFriendID_userID_index` (`userFriendID`,`userID`),
  KEY `status_userID_userFriendID` (`status`,`userID`,`userFriendID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=517180 ;

CREATE TABLE IF NOT EXISTS `friends_old` (
  `friendID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `userFriendID` int(11) DEFAULT NULL,
  `status` enum('pending','approved','declined') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`friendID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `main_activities` (
  `activityID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `objectID` int(11) NOT NULL,
  `objectType` enum('post','forum','trade','shop') NOT NULL,
  `activityType` enum('comment','feedback','like','offer_accepted','offer_declined','offer_received','replied_to_reply','replied_to_topic','reply_approved','sold','topic_approved') NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=357938 ;

CREATE TABLE IF NOT EXISTS `main_notifications` (
  `userID` int(11) NOT NULL,
  `activityID` int(11) NOT NULL,
  `notificationType` tinyint(2) DEFAULT '1' COMMENT '1: CommentToPost, 2: CommentedToMyComment',
  `isNew` tinyint(2) DEFAULT '1',
  `createdDate` int(11) DEFAULT NULL,
  PRIMARY KEY (`userID`,`activityID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `messages` (
  `messageID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL COMMENT 'Message Owner ID',
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `subject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `body` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('read','unread') COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `is_trash` tinyint(2) DEFAULT '0',
  `messageStatus` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`messageID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25285 ;

CREATE TABLE IF NOT EXISTS `messenger_blocklist` (
  `messengerBlocklistID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT '0',
  `blockedID` int(11) DEFAULT '0',
  `blockedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`messengerBlocklistID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=90 ;

CREATE TABLE IF NOT EXISTS `messenger_buddylist` (
  `messengerBuddylistID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `buddyID` int(11) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`messengerBuddylistID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;

CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `messageID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `buddyID` int(11) NOT NULL,
  `messageType` tinyint(2) DEFAULT '0' COMMENT '0: Sent, 1: received',
  `message` text,
  `isNew` tinyint(2) DEFAULT '0',
  `createdDate` datetime DEFAULT NULL,
  PRIMARY KEY (`messageID`),
  KEY `buddyID_index` (`buddyID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=127800 ;

CREATE TABLE IF NOT EXISTS `messenger_messages_old` (
  `messageID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `messageOwnerID` int(11) DEFAULT NULL,
  `senderID` int(11) DEFAULT NULL,
  `receiverID` int(11) DEFAULT NULL,
  `isNew` tinyint(2) DEFAULT '0',
  `message` text,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`messageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `moderator` (
  `moderatorID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `moderatorType` tinyint(5) DEFAULT NULL COMMENT '1: Community, 2: Forum, 3: Trade',
  `userID` int(11) DEFAULT NULL,
  `moderatorStatus` tinyint(2) DEFAULT '0' COMMENT '0: Expired, 1: Active',
  `electedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`moderatorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

CREATE TABLE IF NOT EXISTS `moderator_candidates` (
  `candidateID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `candidateText` text,
  `votes` int(11) DEFAULT '0',
  `appliedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`candidateID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

CREATE TABLE IF NOT EXISTS `moderator_votes` (
  `voteID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `voterID` int(11) DEFAULT NULL,
  `candidateID` int(11) unsigned NOT NULL,
  `voteType` tinyint(2) DEFAULT '0' COMMENT '1: Approval Vote, 0: Negative Vote',
  `voteDate` datetime DEFAULT NULL,
  `voteStatus` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`voteID`),
  KEY `MODERATOR_VOTES_CANDIDATES_ID_INDEX` (`candidateID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=228 ;

CREATE TABLE IF NOT EXISTS `pages` (
  `pageID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) unsigned NOT NULL COMMENT 'Creator ID',
  `title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `about` text COLLATE utf8_unicode_ci,
  `links` text COLLATE utf8_unicode_ci COMMENT 'serialized title=>link pair list',
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(2) DEFAULT '1' COMMENT '0: Inactive, 1: Active',
  PRIMARY KEY (`pageID`),
  KEY `userID_index` (`userID`) USING BTREE,
  FULLTEXT KEY `title` (`title`,`about`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=2341 ;

CREATE TABLE IF NOT EXISTS `page_followers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pageID` int(11) unsigned NOT NULL,
  `userID` int(11) unsigned NOT NULL COMMENT 'follower ID',
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pageID_index` (`pageID`) USING BTREE,
  KEY `userID_index` (`userID`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9744 ;

CREATE TABLE IF NOT EXISTS `posts` (
  `postID` int(11) NOT NULL AUTO_INCREMENT,
  `poster` int(11) NOT NULL,
  `pageID` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '0: means it doesnot belong to a page. If it is bigger than 0, it means it belonged to a page',
  `profileID` int(11) DEFAULT '0',
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `post_date` datetime NOT NULL,
  `visibility` tinyint(10) NOT NULL DEFAULT '0' COMMENT '0: private, 1: public',
  `content` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `youtube_url` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_profile` tinyint(2) DEFAULT '0',
  `likes` int(11) DEFAULT '0',
  `comments` int(11) DEFAULT '0',
  `post_status` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`postID`),
  KEY `poster_index` (`poster`) USING BTREE,
  KEY `pageID_index` (`pageID`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51398 ;

CREATE TABLE IF NOT EXISTS `posts_comments` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `postID` int(11) NOT NULL,
  `commenter` int(11) NOT NULL,
  `content` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `posted_date` datetime NOT NULL,
  `commentStatus` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`commentID`),
  KEY `postID_index` (`postID`) USING BTREE,
  KEY `commenter_index` (`commenter`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=79934 ;

CREATE TABLE IF NOT EXISTS `posts_hits` (
  `hitID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `postID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `hitDate` datetime DEFAULT NULL,
  PRIMARY KEY (`hitID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=142414 ;

CREATE TABLE IF NOT EXISTS `posts_likes` (
  `likeID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `postID` int(11) NOT NULL,
  `liked_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `likeStatus` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`likeID`),
  KEY `ix_post_user` (`postID`,`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=90097 ;

CREATE TABLE IF NOT EXISTS `publisher_ads` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `publisherID` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `borderColor` varchar(10) DEFAULT '006699',
  `bgColor` varchar(10) DEFAULT 'FFFFFF',
  `titleColor` varchar(10) DEFAULT '006699',
  `textColor` varchar(10) DEFAULT '999999',
  `urlColor` varchar(10) DEFAULT '006699',
  `createdDate` datetime NOT NULL,
  `impressions` mediumint(12) NOT NULL,
  `paidImpressions` mediumint(12) NOT NULL,
  `earnings` double(10,8) DEFAULT '0.00000000',
  `status` tinyint(2) DEFAULT '1' COMMENT '1: Active, 0: Deleted',
  `token` varchar(255) DEFAULT NULL,
  `adType` tinyint(4) DEFAULT '1' COMMENT '1: Customer Ad, 2: Page & Profile Ad, 3: Forum Ad',
  PRIMARY KEY (`id`),
  KEY `publisherID_index` (`publisherID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=96701 ;

CREATE TABLE IF NOT EXISTS `reports` (
  `reportID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `reporterID` int(11) DEFAULT NULL,
  `reportedID` int(11) DEFAULT NULL,
  `objectID` int(11) DEFAULT NULL,
  `objectType` varchar(20) DEFAULT NULL COMMENT 'post, comment, message',
  `reportedDate` datetime DEFAULT NULL,
  `reportStatus` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`reportID`),
  KEY `idtype` (`reportID`,`objectType`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

CREATE TABLE IF NOT EXISTS `sessions` (
  `sessionID` char(26) NOT NULL DEFAULT '',
  `userID` int(11) DEFAULT '0',
  `expiry` int(11) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`sessionID`),
  KEY `asessions` (`sessionID`,`userID`,`expiry`),
  KEY `idsessions` (`userID`,`expiry`),
  KEY `expiry` (`expiry`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

CREATE TABLE IF NOT EXISTS `shop_categories` (
  `catID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `parentID` int(11) DEFAULT '0',
  `status` tinyint(2) DEFAULT '1' COMMENT '0: disable, 1: enable',
  `isDownloadable` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`catID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

CREATE TABLE IF NOT EXISTS `shop_orders` (
  `orderID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sellerID` int(11) unsigned NOT NULL,
  `buyerID` int(11) unsigned NOT NULL,
  `productID` int(11) unsigned NOT NULL COMMENT 'Sold product ID',
  `unitPrice` double NOT NULL COMMENT 'unitPrice',
  `shippingPrice` double NOT NULL COMMENT 'shippingPrice',
  `totalPrice` double NOT NULL COMMENT 'total',
  `buyerShippingID` int(11) DEFAULT NULL,
  `trackingNo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isRead` tinyint(2) DEFAULT '0' COMMENT '0: New, 1: Read',
  `isArchived` tinyint(2) DEFAULT '0' COMMENT '0: No, 1: Yes',
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(2) DEFAULT '1' COMMENT '1: Sold',
  PRIMARY KEY (`orderID`),
  KEY `sellerID_index` (`sellerID`) USING BTREE,
  KEY `buyerID_index` (`buyerID`) USING BTREE,
  KEY `productID_index` (`productID`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=22 ;

CREATE TABLE IF NOT EXISTS `shop_orders_shipping` (
  `shippingID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fullName` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `countryID` int(11) unsigned DEFAULT NULL,
  `zip` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`shippingID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=11 ;

CREATE TABLE IF NOT EXISTS `shop_products` (
  `productID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) unsigned NOT NULL,
  `title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `price` double DEFAULT NULL COMMENT 'Price in BTC',
  `subtitle` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `catID` int(11) unsigned NOT NULL COMMENT 'It will use trade_category',
  `locationID` int(11) unsigned DEFAULT NULL,
  `images` text COLLATE utf8_unicode_ci,
  `returnPolicy` text COLLATE utf8_unicode_ci,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(2) DEFAULT '1' COMMENT '0: Inactive, 1: ACTIVE, 2: Sold',
  `expiryDate` datetime DEFAULT NULL,
  `listingDuration` tinyint(4) DEFAULT NULL,
  `fileName` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `isDownloadable` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`productID`),
  KEY `userID_index` (`userID`) USING BTREE,
  KEY `catID_index` (`catID`) USING BTREE,
  KEY `locationID_index` (`locationID`) USING BTREE,
  FULLTEXT KEY `title` (`title`,`subtitle`,`description`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=142 ;

CREATE TABLE IF NOT EXISTS `shop_shipping_price` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `productID` int(11) unsigned NOT NULL,
  `locationID` int(11) unsigned NOT NULL,
  `price` double DEFAULT NULL COMMENT 'Price',
  PRIMARY KEY (`id`),
  KEY `productID_index` (`productID`) USING BTREE,
  KEY `locationID_index` (`locationID`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=157 ;

CREATE TABLE IF NOT EXISTS `stats_post` (
  `postID` int(11) unsigned NOT NULL,
  `postType` varchar(10) DEFAULT NULL,
  `sortOrder` int(10) DEFAULT '0',
  `createdDate` datetime DEFAULT NULL,
  PRIMARY KEY (`postID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `temp_users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `activation` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tracker` (
  `trackID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT '0',
  `ipAddr` varchar(255) DEFAULT NULL,
  `trackedTime` int(11) DEFAULT NULL,
  `action` varchar(100) DEFAULT '',
  PRIMARY KEY (`trackID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=193367 ;

CREATE TABLE IF NOT EXISTS `trade` (
  `tradeID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sellerID` int(11) unsigned NOT NULL,
  `buyerID` int(11) unsigned NOT NULL,
  `sellerItemID` int(11) unsigned NOT NULL,
  `buyerItemID` int(11) unsigned NOT NULL,
  `sellerShippingID` int(11) unsigned NOT NULL,
  `buyerShippingID` int(11) unsigned NOT NULL,
  `sellerTrackingNo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `buyerTrackingNo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(2) DEFAULT '1' COMMENT '1: traded',
  PRIMARY KEY (`tradeID`),
  KEY `sellerID_index` (`sellerID`) USING BTREE,
  KEY `buyerID_index` (`buyerID`) USING BTREE,
  KEY `sellerItemID_index` (`sellerItemID`) USING BTREE,
  KEY `buyerItemID_index` (`buyerItemID`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=17 ;

CREATE TABLE IF NOT EXISTS `trade_categories` (
  `catID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parentID` int(11) DEFAULT '0',
  `status` tinyint(2) DEFAULT '1' COMMENT '0: disable, 1: enable',
  PRIMARY KEY (`catID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=26 ;

CREATE TABLE IF NOT EXISTS `trade_items` (
  `itemID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) unsigned NOT NULL,
  `title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `itemWanted` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `catID` int(11) unsigned NOT NULL,
  `locationID` int(11) unsigned DEFAULT NULL,
  `images` text COLLATE utf8_unicode_ci,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(2) DEFAULT '1' COMMENT '0: Inactive, 1: ACTIVE, 2: Traded',
  `expiryDate` datetime DEFAULT NULL,
  `listingDuration` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`itemID`),
  KEY `userID_index` (`userID`) USING BTREE,
  KEY `catID_index` (`catID`) USING BTREE,
  KEY `locationID_index` (`locationID`) USING BTREE,
  FULLTEXT KEY `title` (`title`,`subtitle`,`description`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=961 ;

CREATE TABLE IF NOT EXISTS `trade_offers` (
  `offerID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `targetItemID` int(11) unsigned NOT NULL,
  `offeredItemID` int(11) unsigned NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastUpdateDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'it will save the last status change date',
  `targetHideDeclined` tinyint(2) DEFAULT '0' COMMENT 'The man who declines this offer removed this after declining. 0: show, 1: hide',
  `offeredHideDeclined` tinyint(2) DEFAULT '0' COMMENT 'The man who offered this offer removed this after being declined. 0: show, 1: hide',
  `status` tinyint(2) DEFAULT '1' COMMENT '0: Inactive, 1: Active, 2: Declined',
  `isNew` tinyint(2) DEFAULT '1' COMMENT '0: not new, 1: new',
  PRIMARY KEY (`offerID`),
  KEY `targetItemID_index` (`targetItemID`) USING BTREE,
  KEY `offeredItemID_index` (`offeredItemID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `trade_shipping_info` (
  `shippingID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fullName` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `countryID` int(11) unsigned DEFAULT NULL,
  `zip` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`shippingID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=26 ;

CREATE TABLE IF NOT EXISTS `trade_users` (
  `userID` int(11) unsigned NOT NULL,
  `shippingFullName` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shippingAddress` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shippingAddress2` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shippingCity` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shippingState` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shippingZip` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shippingCountryID` int(11) unsigned DEFAULT NULL,
  `optOfferReceived` tinyint(2) DEFAULT '1' COMMENT '0: disagree; 1: agree that you receive notification when someone makes me an offer',
  `optOfferAccepted` tinyint(2) DEFAULT '1' COMMENT '0: disagree; 1: agree that you receive notification when someone accepts my offer',
  `optOfferDeclined` tinyint(2) DEFAULT '1' COMMENT '0: disagree; 1: agree that you receive notification when someone declines my offer',
  `optFeedbackReceived` tinyint(2) DEFAULT '1' COMMENT '0: disagree; 1: agree that you receive notification when someone declines my offer',
  `optProductSoldOnShop` tinyint(2) DEFAULT '1' COMMENT '0: disagree; 1: agree that you receive notification when someone buy your product on shop',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) unsigned NOT NULL,
  `payer_email` varchar(255) DEFAULT NULL COMMENT 'payer email address',
  `amount` double(11,5) NOT NULL,
  `currency` varchar(5) DEFAULT NULL,
  `trackNumber` varchar(500) DEFAULT NULL COMMENT 'You may read paypal transaction id from here',
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=29 ;

CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email_visibility` tinyint(2) DEFAULT '0',
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `gender_visibility` tinyint(2) DEFAULT '0',
  `birthdate` date DEFAULT '0000-00-00',
  `birthdate_visibility` tinyint(2) DEFAULT '0',
  `relationship_status` tinyint(2) DEFAULT '0' COMMENT '1: Single, 2: In a Relation',
  `relationship_status_visibility` tinyint(2) DEFAULT '0',
  `religion` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `religion_visibility` tinyint(2) DEFAULT '0',
  `political_views` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `political_views_visibility` tinyint(2) DEFAULT '0',
  `birthplace` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `birthplace_visibility` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `current_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `current_city_visibility` tinyint(2) DEFAULT '0',
  `home_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `home_phone_visibility` tinyint(2) DEFAULT '0',
  `cell_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `cell_phone_visibility` tinyint(2) DEFAULT '0',
  `work_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `work_phone_visibility` tinyint(2) DEFAULT '0',
  `address1` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `state` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `zip` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `address_visibility` tinyint(2) DEFAULT '0',
  `token` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `status` tinyint(2) DEFAULT '0',
  `messenger_privacy` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'all',
  `show_messenger` tinyint(2) DEFAULT '0',
  `timezone` varchar(255) COLLATE utf8_unicode_ci DEFAULT '(UTC) Coordinated Universal Time',
  `timezone_visibility` tinyint(2) DEFAULT '0',
  `attributes` varchar(5000) COLLATE utf8_unicode_ci DEFAULT '',
  `user_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Registered',
  `user_acl_id` tinyint(4) NOT NULL DEFAULT '2',
  `credits` double(11,5) DEFAULT '0.00000',
  `posts_count` int(11) DEFAULT '0',
  `posts_rating` int(11) DEFAULT '0',
  `created_date` datetime DEFAULT NULL,
  `ip_addr` varchar(20) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`userID`),
  KEY `cusers` (`userID`,`firstName`,`lastName`,`thumbnail`,`messenger_privacy`,`status`),
  KEY `busers` (`userID`,`firstName`,`lastName`,`thumbnail`,`messenger_privacy`,`status`),
  KEY `iusers` (`firstName`,`lastName`,`thumbnail`),
  KEY `ausers` (`userID`,`firstName`,`lastName`,`thumbnail`,`messenger_privacy`),
  FULLTEXT KEY `firstName` (`firstName`,`lastName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=62229 ;

CREATE TABLE IF NOT EXISTS `users_bitcoin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `bitcoin_guid` char(36) NOT NULL,
  `bitcoin_address` varchar(34) NOT NULL,
  `bitcoin_link` varchar(200) DEFAULT NULL,
  `bitcoin_password` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userID_index` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47442 ;

CREATE TABLE IF NOT EXISTS `users_bitcoin_transactions_history` (
  `transactionID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `hash` varchar(200) DEFAULT NULL,
  `addr` text,
  `type` varchar(10) DEFAULT NULL COMMENT 'sent, received',
  `amount` text,
  `totalAmount` int(11) DEFAULT NULL,
  `balance` bigint(20) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`transactionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1294 ;

CREATE TABLE IF NOT EXISTS `users_contact` (
  `userID` int(11) NOT NULL,
  `contact_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `contact_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `visibility` tinyint(2) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userID`,`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `users_daily_activities` (
  `userID` int(11) NOT NULL,
  `date` date NOT NULL,
  `posts` int(11) DEFAULT '0',
  `comments` int(11) DEFAULT '0',
  `likes` int(11) DEFAULT '0',
  `friendRequests` int(11) DEFAULT '0',
  PRIMARY KEY (`userID`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `users_educations` (
  `userID` int(11) NOT NULL,
  `school` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `visibility` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0: Private, 1: Public',
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userID`,`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `users_employments` (
  `userID` int(11) NOT NULL,
  `employer` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `visibility` tinyint(2) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userID`,`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `users_links` (
  `userID` int(11) NOT NULL,
  `title` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `visibility` tinyint(2) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userID`,`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `users_notify_settings` (
  `settingID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `notifyRepliedToMyTopic` tinyint(2) DEFAULT '1' COMMENT 'Someone replies to my topic',
  `notifyRepliedToMyReply` tinyint(2) DEFAULT '1' COMMENT 'Someone replies to a topic that I replied to',
  `notifyMyPostApproved` tinyint(2) DEFAULT '1' COMMENT 'My post has been approved.',
  `notifyCommentToMyComment` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`settingID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=225 ;

CREATE TABLE IF NOT EXISTS `users_rating` (
  `userID` int(11) unsigned NOT NULL,
  `totalRating` int(11) unsigned DEFAULT '0' COMMENT 'count of feedback, cronjob will update this automatically',
  `positiveRating` int(11) unsigned DEFAULT '0' COMMENT 'Positive rating count',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

CREATE TABLE IF NOT EXISTS `users_stats` (
  `userID` int(11) unsigned NOT NULL,
  `pageFollowers` int(11) DEFAULT '0',
  `likes` int(11) DEFAULT '0',
  `comments` int(11) DEFAULT '0',
  `voteUps` int(11) DEFAULT '0',
  `replies` int(11) DEFAULT '0',
  `reputation` int(11) DEFAULT '0',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `users_token` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `userToken` varchar(256) DEFAULT NULL,
  `tokenDate` int(11) DEFAULT NULL,
  `tokenType` varchar(20) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38981 ;

CREATE TABLE IF NOT EXISTS `user_acl` (
  `aclID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) DEFAULT NULL,
  `Level` tinyint(11) DEFAULT '0',
  PRIMARY KEY (`aclID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

CREATE TABLE IF NOT EXISTS `videos` (
  `videoID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `categoryID` int(11) DEFAULT '0',
  `title` varchar(80) DEFAULT NULL,
  `code` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`videoID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30015 ;

CREATE TABLE IF NOT EXISTS `video_categories` (
  `categoryID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parentID` int(11) DEFAULT '0',
  `subjectID` int(11) NOT NULL DEFAULT '0',
  `categoryName` varchar(255) DEFAULT '',
  `categoryDescription` varchar(2000) NOT NULL,
  `videosCount` int(11) DEFAULT '0',
  `forumCategoryID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=357 ;

CREATE TABLE IF NOT EXISTS `video_comments` (
  `commentID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `videoID` int(11) DEFAULT '0',
  `userID` int(11) DEFAULT NULL,
  `content` varchar(5000) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  PRIMARY KEY (`commentID`),
  KEY `vid` (`videoID`,`createdDate`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1113 ;

CREATE TABLE IF NOT EXISTS `video_subjects` (
  `subjectID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subjectTitle` varchar(255) DEFAULT '',
  `subjectName` varchar(255) DEFAULT '',
  `featuredVideoCode` varchar(50) DEFAULT '' COMMENT 'Youtube Video Code',
  `featuredVideoTitle` varchar(200) DEFAULT '' COMMENT 'Video Title',
  `featuredVideoDescription` varchar(2000) NOT NULL,
  `topCourses` varchar(100) DEFAULT '' COMMENT 'category ids divided by comma',
  PRIMARY KEY (`subjectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;


ALTER TABLE `moderator_votes`
  ADD CONSTRAINT `MODERATOR_CANDIDATE_ID_FOREIGN_KEY` FOREIGN KEY (`candidateID`) REFERENCES `moderator_candidates` (`candidateID`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
