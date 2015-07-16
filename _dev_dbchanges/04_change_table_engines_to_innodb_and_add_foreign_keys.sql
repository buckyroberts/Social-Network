ALTER TABLE `moderator_candidates` ENGINE = InnoDB;
ALTER TABLE `moderator_votes` ENGINE = InnoDB;

CREATE TABLE `moderator_candidates` (
  `candidateID`   INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userID`        INT(11)                   DEFAULT NULL,
  `candidateText` TEXT,
  `votes`         INT(11)                   DEFAULT '0',
  `appliedDate`   DATETIME                  DEFAULT NULL,
  PRIMARY KEY (`candidateID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

CREATE TABLE `moderator_votes` (
  `voteID`      INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `voterID`     INT(11)                   DEFAULT NULL,
  `candidateID` INT(11) UNSIGNED NOT NULL,
  `voteType`    TINYINT(2)                DEFAULT '0'
  COMMENT '1: Approval Vote, 0: Negative Vote',
  `voteDate`    DATETIME                  DEFAULT NULL,
  `voteStatus`  TINYINT(2)                DEFAULT '1',
  PRIMARY KEY (`voteID`),
  KEY `MODERATOR_VOTES_CANDIDATES_ID_INDEX` (`candidateID`),
  CONSTRAINT `MODERATOR_CANDIDATE_ID_FOREIGN_KEY` FOREIGN KEY (`candidateID`) REFERENCES `moderator_candidates` (`candidateID`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;
