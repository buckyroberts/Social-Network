CREATE TABLE `video_categories` (
  `categoryID`   INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parentID`     INT(11)                   DEFAULT '0',
  `categoryName` VARCHAR(255)              DEFAULT '',
  `videosCount`  INT(11)                   DEFAULT '0',
  `order`        INT(11)                   DEFAULT '0',
  PRIMARY KEY (`categoryID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (1, 67, '3Ds Max 2010', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (2, 65, 'Adobe After Effects', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (3, 65, 'Adobe Premiere Pro', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (4, 67, 'Advanced UDK', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (5, 68, 'Algebra', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (6, 66, 'Android Application Development', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (7, 68, 'Basic Math', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (8, 69, 'Battlefield 2 Gameplay', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (9, 69, 'Backgammon', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (10, 66, 'Beginner JavaScript', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (11, 66, 'PHP', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (12, 67, 'UDK', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (13, 69, 'Bucky Roberts Live', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (14, 66, 'C', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (15, 66, 'C#', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (16, 66, 'C++', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (17, 69, 'Call of Duty Gameplay', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (18, 68, 'Chemistry', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (19, 66, 'Cocos2D', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (20, 66, 'Computer Game Development', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (21, 65, 'Dreamweaver', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (22, 66, 'Computer Game Development', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (23, 68, 'Geometry', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (24, 67, 'How to Build a Computer', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (25, 66, 'Intermediate Java', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (26, 68, 'Introduction to Biology', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (27, 68, 'Introduction to Geometry', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (28, 66, 'iPhone Development', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (29, 69, 'iPhone App Review', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (30, 66, 'Java Game Development', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (31, 66, 'Java', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (32, 66, 'jQuery', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (33, 66, 'Objective-C', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (34, 66, 'PHP', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (35, 68, 'Physics', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (36, 66, 'Python', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (37, 69, 'Surviving the Wilderness', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (38, 69, 'thenewboston Live!', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (39, 66, 'Visual Basic', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (40, 67, 'XHTML & CSS', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (41, 68, 'Robotics & Electronics', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (42, 66, 'wxPython', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (43, 67, 'HTML5', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (44, 67, 'Networking', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (45, 65, 'Adobe Flash', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (46, 65, 'Adobe Photoshop', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (47, 69, 'thenewboston Podcast', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (48, 66, 'PHP Stock Market Analyzer', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (49, 67, 'MySQL Database', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (50, 66, 'Ruby', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (51, 66, 'Trading Website (Project Lisa)', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (52, 69, 'Buckys Vlog', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (53, 68, 'How to Build a Go Kart', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (54, 66, 'Java Game Development with Slick', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (55, 65, 'Adobe Photoshop', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (56, 69, 'Surviving the Wilderness 2', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (57, 66, 'C++ GUI with Qt', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (58, 68, 'Biology Lecture', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (59, 68, 'Don\'t Try This at Home', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (60, 68, 'Chemistry Lab', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (61, 66, 'AJAX', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (62, 68, 'How to Make Beer', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (63, 67, 'CSS3 Awesome Footer Tutorial', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (64, 66, 'AJAX Chat Tutorial', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (65, 0, 'Adobe', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (66, 0, 'Computer Programming', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (67, 0, 'Computer Science', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (68, 0, 'Educational', 0, 0);
INSERT INTO `video_categories` (`categoryID`, `parentID`, `categoryName`, `videosCount`, `order`)
VALUES (69, 0, 'Other', 0, 0);

CREATE TABLE `videos` (
  `videoID`    INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `categoryID` INT(11)                   DEFAULT '0',
  `title`      VARCHAR(80)               DEFAULT NULL,
  `code`       VARCHAR(40)               DEFAULT NULL,
  PRIMARY KEY (`videoID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1, 1, 'Introduction to the Interface', 'KwRkkGzA98k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2, 1, 'The Viewport', 'LJG3HuQ54yo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (3, 1, 'More Views and Merging', 'KYmteholfck');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (4, 1, 'Creating Basic Objects', 'VBhZhIMB54M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (5, 1, 'Binding Objects', 'CA5w2fOzli4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (6, 1, 'Advanced Selections', 'HmlpS1itzkU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (7, 1, 'Hide, Freeze, and Layers', 'voxomHt7pkU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (8, 1, 'Cloning and Arrays', 'IH1BsoQu-Bs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (9, 1, 'Grouping and Linking', 'ffkLJ1mn9Qo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (10, 1, 'Subobjects', '7M5l8I7Gmc8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (11, 1, 'Modifiers', 'oAzbXq_1IaY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (12, 1, 'Shapes and Splines', 'njmCzCLjliY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (13, 1, 'Extrude Splines', 'xfpRrui4Kc4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (14, 1, 'Editable Polygons', '21XD-dmrhYI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (15, 1, 'Material Editor', 'VNaXrWcbQfw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (16, 1, 'More on Materials and Maps', 'SCQL_yq6Q5U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (17, 1, 'Applying Maps', 'lVyCLpD73MA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (18, 1, 'Compound Materials', 'GIhHV-U2A60');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (19, 1, 'Cameras', 'bkSqc0YcY4Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (20, 1, 'Lights', 'N2BwjYd_yWI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (21, 1, 'Animation', 'kqQmwXCH6w8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (22, 1, 'Using Trajectories', '-7wEO5Tq1fg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (23, 2, 'Introduction ', 'MvJeQaTRT5E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (24, 2, 'Creating a Composition', 'LKKdJbacpJU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (25, 2, 'Advanced Composition Panel', 'bsWMSUyI-4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (26, 2, 'Basic Animation', '9nt-BMN_GIw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (27, 2, 'Editing the Animation Path', 'lUAMRl_NgK4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (28, 2, 'Animating Opacity', 'Eux1K9_Ey44');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (29, 2, 'Animating Scale', 'PiU5LbQf80w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (30, 2, 'Animating Rotation', 'WGsQzlqgpiE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (31, 2, 'Basic Keyframe Velocity', 'OiCoZh2E-Jc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (32, 2, 'Advanced Keyframe Velocity', 'GEfO4VF9BY8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (33, 2, 'Editing Multiple Values', 'xRu0Kf0gZgo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (34, 2, 'Holding and Roving Keyframes', 'lGoujBlO9N0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (35, 2, 'Creating a Motion Sketch', 'TdmnKMgroD8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (36, 2, 'Auto Orient and The Wiggler', 'yOSJ56tjeRI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (37, 2, 'Tools for Editing Clips', '8o6G_mCj3AE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (38, 2, 'Blending Modes', 'iXMK2MS0l5U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (39, 2, 'Introduction to Masking', 'kWd51xDqzlc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (40, 2, 'Editing Mask Properties', 'CIdW8SbgluQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (41, 2, 'Masking with the Pen Tool', 'G15FFYWWBRo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (42, 2, 'Luma Matte Effect', 'TFjr0EhHnKA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (43, 2, 'Contrast of Mattes', 'bfUriKmMMuk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (44, 2, 'Videos as Mattes', '5Y0B_qY-5Qg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (45, 2, 'Introduction to 3D', 'iCRw6Ot6VYg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (46, 2, 'Working with 3D', '5jvnN9VdRXg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (47, 2, 'Making a 3D Animation', 'iSi0G5AcpSM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (48, 2, 'Introduction to Cameras', 'jJjkwrW2ir4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (49, 2, 'Animating Cameras', '5nnW15urRZY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (50, 2, 'Basic Lighting', 'jLBs1FW-Ulw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (51, 2, 'Shadows', '8GaVfKHdFDs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (52, 2, 'Parenting', 'omYO1jRgaC8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (53, 2, 'Moving Text Along a Path', 'mR8j4GlG9L8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (54, 2, 'Text Animator', 'fT4c4UkgRt0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (55, 2, 'Waterfall Text Animation', 'tTRZaQ1G9M0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (56, 2, 'How to Use Effects', 'jDCkj7bfKH0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (57, 2, 'Beginning Presets', 'AIo4m4wRVzc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (58, 2, 'Built in Presets', 'njLN4KJYrdY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (59, 2, 'Messing with Time', 'MIq-JbL7iCs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (60, 2, 'Freeze Frames', 'yxOBmZMEzXo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (61, 2, 'Motion Tracking', 'rz8BM2luOeE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (62, 3, 'Starting a New Project ', 'DLElzmuhrnY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (63, 3, 'Customizing Your Workspace', 'jTenejNLlWg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (64, 3, 'Project Panel', 'EpqZJF1_j5s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (65, 3, 'The Timeline', 'MfY0nD4uYAA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (66, 3, 'Monitor Panels', 'rd0P8Z0COxc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (67, 3, 'Adding Effects to Video Clips', 'YqXSJCtfAVQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (68, 3, 'Effects Control Panel', 'PWVDE6KTIBA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (69, 3, 'Working with Keyframes', '4-3eBMyfL-0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (70, 3, 'Tools Panel', 'tBZNkXbUmpQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (71, 3, 'Syncing and Unlinking Audio & Video', 'wE5sgxX2iNg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (72, 3, 'Clipping Video Tracks', 'IXTc_9wYViM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (73, 3, 'Titles and Exporting Video', '46MLWBEvgrU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (74, 4, 'Introduction to Physics Objects ', '0zjfyz6fAmY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (75, 4, 'KActor Properties', 'u_MPCg51sWA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (76, 5, 'Multiplying and Dividing Real Numbers ', 'sGURwvXB2H0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (77, 5, 'Order of Operations', 'XHnW7GhTeCA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (78, 5, 'Opposite and Absolute Values', 'fdicjdiVZ6g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (79, 5, 'Combining Like Terms', 'Ks_if4Rw29s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (80, 5, 'Solving Equations with Addition and Subtraction', 'I-kLIRsOuac');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (81, 5, 'Solving Equations with Multiplication and Division', 'YBGTfWY08zE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (82, 5, 'Solving Combined Equations', 'P6vAhqgAI8Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (83, 5, 'Solving Equations with Variables on Both Sides', 'VWsGpzLbnlk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (84, 5, 'Solving Word Problems with Equations', 'F1LTPDMxwRc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (85, 5, 'Solving and Graphing Basic Inequalities', 'Ea48-Nmv0jo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (86, 5, 'Solving and Graphing Compound Inequalities', 'oFux3hP7iGk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (87, 5, 'Exponents', 'VqT0kD4lEEU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (88, 5, 'Adding and Subtracting Polynomials', 'RdzRWAHiuPM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (89, 5, 'Multiplying a Polynomial by a Monomial', 'KRTlxRuyT5o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (90, 5, 'Multiplying Binomials', 'opcT1Wi_VM8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (91, 5, 'Multiplying Polynomials', 'KegINotKOSU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (92, 5, 'Special Products of Binomials', '9rPgEko98G0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (93, 5, 'Squaring Binomials', 'L5EE9nir0RI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (94, 5, 'Polynomial Equations', 'yFKD92VHVjc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (95, 5, 'Solving Geometry Problems with Polynomials', 'KyB1CwBREiA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (96, 5, 'Solving Word Problems with Polynomials', 'TenlbkEJGe4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (97, 5, 'Greatest Common Factor', 'Zs198VJRwiU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (98, 5, 'Factoring the Difference of Squares', 'fzV0GjV8Oqk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (99, 5, 'Factoring Perfect Square Trinomials', 'AbKkxZMfL5c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (100, 5, 'Factoring Trinomials', 'y1L1Gx0TiMo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (101, 5, 'Solving Equations- Factoring', 'Cx_SJN3_YFg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (102, 5, 'Factoring- Word Problems', 'LFiSmVHu10w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (103, 5, 'Factoring- Geometry Problems', 'rFJxi_zUQXI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (104, 5, 'Dividing Monomials', 'K9Hi85Wzqaw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (105, 5, 'Dividing a Polynomial by a Monomial', '7r8LByz5DWQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (106, 5, 'Simplifying Fractions', 'kqOb08yjec0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (107, 5, 'Multiplying Fractions', '_rz3RHFLAkE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (108, 6, 'Download and Install the Java JDK ', 'SUOWNXGRc6g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (109, 6, 'Installing Eclipse and Setting up the ADT', '857zrsYZKGo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (110, 6, 'Installing Android SDK and Set up Emulator', 'Da1jlmwuW_w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (111, 6, 'Setting up an Android Project', 'MIKl8PX838E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (112, 6, 'Overview of Project and Adding Folders', 'sPFUTJgvVpQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (113, 6, 'Introduction to Layouts in XML', 'maYFI5O6P-8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (114, 6, 'Creating A Button in XML and Adding an ID', '6moe-rLZKCk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (115, 6, 'Setting up Variables and Referencing XML ids', 'eKXnQ83RU3I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (116, 6, 'Set up a Button with OnClickListener', 'WjE-pWYElsE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (117, 6, 'Using setText method for our button', 'hUA_isgpTHI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (118, 6, 'Adding Resources and Setting Background', 'IHg_0HJ5iQo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (119, 6, 'Setting up an Activity and Using SetContentView', 'H92G3CpSQf4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (120, 6, 'Introduction to the Android Manifest', 'B5uJeno3xg8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (121, 6, 'The Framework of a Thread', 'hy0mRoT1ZlM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (122, 6, 'How to Start a New Activity via Intent', 'Xpkbu2GrJpE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (123, 6, 'Activity Life Cycle', '-G91Hp3t6sg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (124, 6, 'Adding Music with MediaPlaye', '-zGS_zrL0rY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (125, 6, 'Create a List Menu from the ListActivity class', '4LHIESO0NGk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (126, 6, 'Setting up an ArrayAdapter', '8kybpxIixRk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (127, 6, 'Starting an Activity with a Class Object', 'eHh2Yib7u-A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (128, 6, 'Finishing ListActivity', 'zjHYyAJQ7Vw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (129, 6, 'XML Introducting the EditText', 'ma8aUC-Mf5M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (130, 6, 'XML ToggleButton, WeightSum, and Layout Weight', '4MnuiIKCqsQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (131, 6, 'XML Padding and Setting Toggle to On', 'gz6P2E9lkfo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (132, 6, 'Quick Review by setting up a new Activity', 'roulejuE6B8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (133, 6, 'If Toggle Button is checked', 'NyusGsXc6SQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (134, 6, 'Set the Input Type of an EditText', '_joTj5XTwuQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (135, 6, 'Comparing Strings with else if', '55G47PgDwkY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (136, 6, 'Set Gravity within Java', '0MkeTcH0SPc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (137, 6, 'Setting Color of a TextView in Java', 'QjQg8NkHGbw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (138, 6, 'Wheres the Fridge, thats Random', '2CuTy8SA5kU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (139, 6, 'Switch and Case', 'MC2WFgZIZjo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (140, 6, 'Creating a Method', 'G_MkSpfKIPA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (141, 6, 'Implementing Classes for Better Programming', 'Krt3g9HhhZ4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (142, 6, 'XML ScrollView and AnalogClock', 'lIwTbp5N7Hw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (143, 6, 'Setting up An Email Activity', 'geB8FqcUjo8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (144, 6, 'PutExtra method for an Email Intent', 'Sqk154QSe8Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (145, 6, 'XML ImageView for Camera Application', 'nq3yUjZGj5c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (146, 6, 'Starting an Activity for a Result', '8yA0vkjREyI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (147, 6, 'Getting Data from a different Activity ', 'AlC_Z5w8nDE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (148, 6, 'Finish Camera and Wallpaper App', 'I9ldAcnx_jc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (149, 6, 'Using BitmapFactory and InputStream to set Bitmap', 'RHN_mwyXoVQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (150, 6, 'Set Fixed Screen Orientation', 'i-QX8kAvSLM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (151, 6, 'XML Relative Layout', 'rNK_qOxO1qM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (152, 6, 'RadioButtons in a RadioGroup', 'u_kGz5J-dNw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (153, 6, 'Set the Radio to the OnCheckedChangeListener ', '2jduTfdt8RY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (154, 6, 'Passing a String between Activities', '6AoBM110DAY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (155, 6, 'Recieving Bread String from Activity', 'n6xhAVcopYU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (156, 6, 'StartActivityForResult setup', 'P2tNi1tS0xU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (157, 6, 'setResult for the Start Activity For Result', 'AEA1qJFpheY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (158, 6, 'Setting up a Menu with MenuInflater', 'iA2Efmo2PCA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (159, 6, 'Making MenuItems do something', '0-NTc0ezXes');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (160, 6, 'Text Activity with Theme', 'jbUQyJdf2P8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (161, 6, 'Setting up Preferences', 'zJ9qzvOOjAM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (162, 6, 'Setting up a String array resource', 'wRa5Q2Eloa4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (163, 6, 'Creating a PreferenceActivity', 'Df129IGl31I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (164, 6, 'Accessing Preferences from an Activity', 'SGx03Uqn9JA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (165, 6, 'More with Preferences', 'oaNus5QigYA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (166, 6, 'Altered Landscape Layout', 'fV3cpnNPWo0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (167, 6, 'Creating Custom Buttons', 'zXXCFmfJMNw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (168, 6, 'Full Screen Activities', 'iFoaqeEtTNU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (169, 6, 'Custom Animation Class', 'UlOM-CUlsBc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (170, 6, 'Using a Constructor to pass Context', 'XzTSdfLJt04');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (171, 6, 'Drawing Bitmaps to Canvas View', 'iMe4fW31jMs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (172, 6, 'Animating a Bitmap', 'BlKDYBqlfgs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (173, 6, 'Using the Asset Folder for Typeface', 'kOJGmVXuuFA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (174, 6, 'Setting up a SurfaceView class', 'wUmId0rwsBQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (175, 6, 'Setting up Animation Thread', '0wy907WZFiA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (176, 6, 'Locking and Unlocking a Canvas', 'ZMcYbf9Hhe4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (177, 6, 'Establishing a Better Animation Thread', 'yowNavIDzzE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (178, 6, 'Setting up the OnTouch Method', 'cJUsL7sc1E8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (179, 6, 'Defining a Class within a Class', 'Od3xkrxcsE8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (180, 6, 'Graphics Trick', 'iZMNaPgP4Ak');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (181, 6, 'MotionEvents and Motion Actions', 'PmOtvJqDfqY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (182, 6, 'Game Programming concept', 'ulFq_0x29sI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (183, 6, 'Cleaning up some Errors', 'Dmq_WGhJbgI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (184, 6, 'Sleeping to Achieve desired FPS', 'S36C23lW5qI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (185, 6, 'WakeLock to keep you app from sleeping', '3r9NGjBvv2w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (186, 6, 'SoundPool helps with explosions', 'ioGWpu8Ud7A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (187, 6, 'Using the OnLongClick method', 'K7YuusyEvOg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (188, 6, 'SlidingDrawer Example', '3OhGkg_XT3o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (189, 6, 'Introduction to the FrameLayout', 'G8QK452ynr4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (190, 6, 'Methods of the SlidingDrawer', 'XVPCXNoiYIg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (191, 6, 'Tabs setup with TabHost', 'm1AeMJux0Zo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (192, 6, 'Setting up the TabHost in Java', 'o5LrdSQrWEI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (193, 6, 'Creating Tabs in Java', 'NcKSFlYEqYY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (194, 6, 'Getting the Time from the System', 'N2Tx8S2V8ek');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (195, 6, 'Formatting and using the Modulus', 'Iy3wCppq2Yc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (196, 6, 'Create a Browser with WebView', 'lkadcYQ6SuY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (197, 6, 'WebView navigation methods', 'PQ94MmEg0Qw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (198, 6, 'Set WebView Client for a Brower app', 'DqNzTaf9g5w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (199, 6, 'WebView Settings', 'BWGW8UsO4Hc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (200, 6, 'Hiding the Keyboard', 'b4MYh6N4z6s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (201, 6, 'ViewFlipper Example', '9xGIlaezMAU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (202, 6, 'Saving Data with SharedPreferences', 'UC2wAuxECw0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (203, 6, 'SharedPreferences Editor', 'zRqcoUSbMI0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (204, 6, 'Loading SharedPreferences Data', 'D2iMtK8ETGs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (205, 6, 'File Output Stream for Internal Storage', 'PJL8UChOsSk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (206, 6, 'Writing Data to File Output Stream', 'QbD6qwxiEUU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (207, 6, 'File Input Stream', '-ZbdfYleuJU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (208, 6, 'Async Task class to load stuff ', 'JVaGZwuYmck');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (209, 6, 'The 4 AsyncTask Methods', '5pr7jwYF0JU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (210, 6, 'ProgressDialog and Correction', 'MNCAmgFHcOI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (211, 6, 'External Storage State', 'tXR0AlhNYxQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (212, 6, 'Spinners and ArrayAdapter', 'GtWXOzsD5Fw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (213, 6, 'OnItemSelected and File Directories', 'Oy7v_Pfz0p4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (214, 6, 'Toggling Visibility', 'mMTBlnxgv1g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (215, 6, 'InputStream and OutputStream', 'GPGPcBGevx8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (216, 6, 'Write External Data Permission', 'l9SzY3fsds8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (217, 6, 'Media Scanner Connection', 'OmYJ9sOu9qs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (218, 6, 'TableLayout and Intro SQLite Database    ', '1JyC_xv20yE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (219, 6, 'Setting up SQLite Database Variables', 'gEg9OdufXmM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (220, 6, 'SQLite class implementing SQLiteOpenHelper', 'BD3XYu924Nc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (221, 6, 'Creating SQLite Database', 'bF1sxGfNz-o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (222, 6, 'Opening SQLite database to write', 'WaRqrxpRIbE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (223, 6, 'Closing SQLite Database', 'WKf5CvuQwAQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (224, 6, 'Inserting Data into SQLite Database', 'S3Z4e7KgNdU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (225, 6, 'How to Create a Dialog', '9ew_Ajpqwqg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (226, 6, 'Setting up method to Read SQLite', 'sT2q9ECfZb0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (227, 6, 'Reading SQLite Database with Cursor', '1qYuGjTzshU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (228, 6, 'Setting up more SQLite methods', 'XGQphG3B2Ek');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (229, 6, 'Getting a Specific Entry', 'E-D-GzTzbQ4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (230, 6, 'Updating SQLite Entry', '0YjiX0EdGdM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (231, 6, 'Deleting Entry from SQLite Database', 'HRId7kvLyJk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (232, 6, 'Setting up a Accelerometer class', 'WgKTY_RSFyM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (233, 6, 'Setting up Sensor Manager', 'F0Gr9uL4CvQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (234, 6, 'OnSensorChanged accelerometer method', 'BlmavgYIfuk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (235, 6, 'Finishing Accelerometer and unregistering', 'zKsuyn_HKv4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (236, 6, 'Setting up a Google Maps Activity', 'lywa-2-lQCg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (237, 6, 'Obtaining Google Maps API debug key', 'qHAnGcnvRBI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (238, 6, 'Displaying the MapView', '8eRo2yOEAOs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (239, 6, 'MapView Overlay', '9C4JlgzfU6o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (240, 6, 'Overlay MotionEvent time', '-mbQMX8KR9Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (241, 6, 'AlertDialog methods and ClickListener', 'Oz8KG4wwBzA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (242, 6, 'Compass and Map Controller', '14SiJfIYrvs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (243, 6, 'Geocoder and GeoPoint', 'D_3zkEe71ZM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (244, 6, 'Geocoding a Location for an Address', 'HjwgRIZSjFg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (245, 6, 'Toggling Street and Satellite views', '7zv6QPbkUIs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (246, 6, 'ItemizedOverlay to draw on our Map', 'soxX_3QYUVc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (247, 6, 'Creating a Custom pinpoint ', 'i7EaMbukAl8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (248, 6, 'Placing a Pinpoint on a MapView', 'pLM8ZubmMmY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (249, 6, 'LocationManager and Location Permissions', 'Q5U2cbJNBM8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (250, 6, 'Criteria and getting Location', 'doVEch9WNG8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (251, 6, 'Updating with OnLocationChanged method', 'IJn8va9Z0cM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (252, 6, 'Exporting apk and signing keystore', 'IYhJp-jqJyM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (253, 6, 'Obtaining Key for a specific Project ', '95y8wsjvnHE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (254, 6, 'Introduction to HttpClient', 'TxcfhAU2dDg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (255, 6, 'Executing HttpGet on a Http Client', 'qLSjn6pzTr0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (256, 6, 'Viewing Internet data via StringBuffer', 'X_Kn9K30c0s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (257, 6, 'Introduction to JSON parsing', 'H1o15gHPw2A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (258, 6, 'JSONArrays and JSONObjects', 'YgkhwNGIFOk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (259, 6, 'Appending with StringBuilder', 'USzAbMTK66s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (260, 6, 'Reading JSON information', '5SP7a2thq6g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (261, 6, 'Setting up XML Parsing Project', 'Z1rtldBTzCE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (262, 6, 'StringBuilder and XML Parsing Framework', 'meXgGO4LTO8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (263, 6, 'Setting up a parsed XML data collection class', 'pb1vwqPE9hE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (264, 6, 'SAXParserFactory and XMLReader', 'Bi69ZAiYHOI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (265, 6, 'Start Element method', 'iIGtHOo1fqY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (266, 6, 'Finishing XML parser', 'dWV4Z4nHkS8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (267, 6, 'Creating a Widget receiver', 'NiTDS16P1LI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (268, 6, 'Setting up Widget Configuration Activity', '11qBU-oqfcw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (269, 6, 'Basic Widget Design', 'jvk33uKqMwM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (270, 6, 'Updating and Deleting Widget', 'ylhlPUM4gzk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (271, 6, 'Updating a Widget TextView', 'SqXbd6jww08');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (272, 6, 'Setting up Widget Configuration Class', 'kGHCeu88l1o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (273, 6, 'Relating Context with the Widget Manager', 'uvnk98H9NVM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (274, 6, 'PendingIntent and widget Buttons', '07JXJ0uQ1Gs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (275, 6, 'Introduction to OpenGL ES', 'JVr4eDNedbY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (276, 6, 'OpenGL Renderer Basics', 'A_asBr_txZU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (277, 6, 'Rendering A Background', 'B6cjvf_z0QE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (278, 6, 'OpenGl 2D vertices', 'eB2gquFQ3Cc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (279, 6, 'Byte and Float Buffers', 'cCfvKGqeN5M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (280, 6, 'ShortBuffer to handle Indices', 'qVc3VCvwzeA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (281, 6, 'Creating Draw method for OpenGL', 'baNDJ6DrEPM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (282, 6, 'glDrawElements method', 'ZqXLGASb-c0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (283, 6, 'OpenGL Boosting Performance', '3M0Ugy7vybQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (284, 6, 'On Surface Changed', 'ou3XBYhIqio');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (285, 6, 'Using GLU to set up the Camera', 'WdGF7Bw6SUg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (286, 6, '3D Cube Intro', 'n18ZL5cnzkQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (287, 6, 'Indices of a Cube', 'u58DwKPzBoY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (288, 6, 'OpenGL Culling', 'A4I2X5hHSVc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (289, 6, '3D Rotation', 'RFuKI2olihU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (290, 6, 'OpenGL Vertex Color Buffer', 'vJN00OaE9iY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (291, 6, 'Stock Android SDK Themes', '8-z573RTZ3o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (292, 6, 'Voice Recognition', 'XGvUCx9FBS4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (293, 6, 'Voice Recognition Result', '8_XW_5JDxXI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (294, 6, 'Text to Speech', 'J_F1_wekc_k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (295, 6, 'Set Language and Speak', 'kNoMFBsdBIo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (296, 6, 'Notifiying Status Bar', 'e74z0_Z5QWI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (297, 6, 'Setting up a Notification', 'Vj7HZROhWL4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (298, 6, 'Notification Manager Methods', '4vDHn4ZO6LY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (299, 6, 'AudioManager Methods', 'u0qThjhvbzI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (300, 6, 'Changing the Volume with a SeekBar', '8sr2Y6Aff6Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (301, 6, 'Downloading Admob SDK', '8IerupLaakE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (302, 6, 'Adding External Jar', 'a9Zf7d25eTs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (303, 6, 'Adding Admob Ad via XML', 'kzRN2U7H6LA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (304, 6, 'Adding Ad Unit Id and Ad Size', 'rrRcGz15LcM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (305, 6, 'Adding Admob Ads via Java', 'Ll8uYcH6Ex8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (306, 6, 'Putting an App on the Market', '1j4prh3NAZE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (307, 6, 'Updating Application', 's9ryE6GwhmA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (308, 7, 'Addition of Whole Numbers ', 'UxhMTi2bh7k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (309, 7, 'Addition with Decimals', '3-XXZdmiGZQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (310, 7, 'Addition with Perimeters', 'DWM6TBCNAWg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (311, 7, 'Addition of Money', 'tMEJNcyNUOA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (312, 7, 'Fill in the Missing Measurement', 'mPRwodI4hpQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (313, 7, 'Subtracting with Decimals', '3yOd7Drwi4I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (314, 7, 'Fill in the Missing Measurement', 'mPRwodI4hpQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (315, 7, 'Subtracting Money', 'r97txPxajuE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (316, 7, 'Write the Equivalent for Each Measurement', 'FlMGaOjZgmc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (317, 7, 'Find the Missing Side', 'dleTDjWNCC4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (318, 7, 'Word Problems with Time', 'SlWyvdKiCJo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (319, 8, 'Online Multiplayer Kill Montage and One WTF Kill!', '0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (320, 8, '13 Kills in 2 Minutes Online Multiplayer (HD)', '0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (321, 8, '5 Headshots in 50 seconds (Online Multiplayer Gameplay) (HD)', '0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (322, 8, 'Two Minutes of Pwnage! (Online Multiplayer Gameplay) (HD)', '0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (323, 8, 'Epic Pwnage! (Online Multiplayer Gameplay) (HD)', '5');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (324, 8, 'Pwning n00bs (Online Multiplayer Gameplay) (HD)', '2');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (325, 9, 'Setting up the Board', 'h0D0bQE_Lfc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (326, 9, 'How to Move the Checkers', '5iC2nwinv5I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (327, 9, 'Hitting and Re-Entering', 'tejHPF5RwQ0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (328, 9, 'Bearing Off', 'ip4_CixxExA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (329, 9, 'Making Points', 'BRdMbs3HQoc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (330, 9, 'Primes', 'GzTtdF0b7fU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (331, 9, 'Hit vs. New Points', '5_c1EwZGYmc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (332, 9, 'Slowing Down an Opponent', 'Z4-vVYViTbA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (333, 10, 'Introduction to JavaScript ', 'yQaAGmHNn9s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (334, 10, 'Comments and Statements', 'yUyJ1gcaraM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (335, 10, 'Variables', 'og4Zku5VVl0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (336, 10, 'Different Types of Variables', 'sY8qiSaAi9g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (337, 10, 'Using Variables with Strings', 'QLpghQ2MMfs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (338, 10, 'Functions', '5nuqALOHN1M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (339, 10, 'Using Parameters with Functions', '7i1f23AVsn4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (340, 10, 'Functions with Multiple Parameters', 'BgtdojEoWFI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (341, 10, 'The return Statement', 'AdQcd3sKGC8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (342, 10, 'Calling a Function From Another Function', '95mIis5M-gU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (343, 10, 'Global & Local Variables', 'waF2Isf-phQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (344, 10, 'Math Operators', 'ZH5qZB0UucQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (345, 10, 'Assignment Operators', 'VfBr32W-hRA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (346, 10, 'if Statement', '5gjr15aWp24');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (347, 10, 'if/else Statement', 'FKyrQYkihGw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (348, 10, 'Nesting and Fridays!', 'ebjo8_u82mI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (349, 10, 'Complex Conditions', 'aQf-zeuHijU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (350, 10, 'switch', 'NXMu5ljw9kc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (351, 10, 'for Loop', 'Coxgr66EwRk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (352, 10, 'while Loop', 'QPFW_0blw9w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (353, 10, 'do while', '7Eb7D_IOaog');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (354, 10, 'Event Handlers', '9rvB27xXO_I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (355, 10, 'onMouseOver & onLoad', 'OleFcGMPZKI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (356, 10, 'Objects', 'mgwiCUpuCxA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (357, 10, 'Creating Our Own Objects', '6xLcSTDeB7A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (358, 10, 'Object Initializers', '0TL5SRttIs0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (359, 10, 'Adding Methods to Our Objects', '6lQEtgFnZTY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (360, 10, 'Arrays', 'nEvBcwlpkBQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (361, 10, 'Other Ways to Create Arrays', 'CSL9A8j5cAY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (362, 10, 'Array Properties and Methods', 'PE5A0jLIxBg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (363, 10, 'join and pop', 'rhnqA9kmFRE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (364, 10, 'reverse, push, sort', 'Yl6PSgHPHF0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (365, 10, 'Add Array Elements Using a Loop', 'n6pCS-w1M3o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (366, 10, 'Cool Technique to Print Array Elements', 'UH5QPYMFlIM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (367, 10, 'Associative Arrays', 'uTCyLN3iKeA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (368, 10, 'Math Objects', 'F30jLIqGQpo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (369, 10, 'Date Objects', 'Xhqvh52VsIo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (370, 10, 'Accessing Forms', 'IzkAi2QMp7Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (371, 10, 'Accessing Form Elements', 'VvB4gDYhcgo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (372, 10, 'Simple Form Validation', 'RzVURjrIFxo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (373, 11, 'Introduction to PHP ', 'iCUV3iv9xOs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (374, 11, 'Installing XAMPP Part 1', 'k6ZiPqsBvEQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (375, 11, 'Installing XAMPP Part 2', 'F0epWxZDlOk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (376, 11, 'Creating Your First PHP File', '7NuTyB8Ypxc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (377, 11, 'Writing Your First PHP File', 'saxBXBb-f8c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (378, 11, 'The phpinfo Function', 'iMb-R6NSfmc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (379, 11, 'The php.ini File', 'Kqxq9Et4Dpg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (380, 11, 'Indentation', 'EsF2Sb3pf6w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (381, 11, 'echo', '7Dwsa7aWfN8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (382, 11, 'print', 'TI6mXu42L3U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (383, 11, 'Output HTML Using echo/print', 't3pp_fQWVWo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (384, 11, 'Embedding PHP Inside HTML', '4AmTiWaxwLU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (385, 11, 'comments', 'OVyMffqb32k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (386, 11, 'Error Reporting', 'qFFPrMID8FE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (387, 11, 'More on Error Reporting', 'IxE4NdfhnEQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (388, 11, 'Variables', 'PL3NC52V4h4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (389, 11, 'Concatenation', 'XJJVnLj1lgA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (390, 11, 'if / if else Statement', 'r7O7EMrZ9EI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (391, 11, 'if / else if Statement', 'F3U9WogSVsQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (392, 11, 'Assignment Operators', 'fPNmZ94FJfI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (393, 11, 'Comparison Operators', 'xsIoEEJqPMo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (394, 11, 'Arithmetic Operators', '0xmbVzsxiY8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (395, 11, 'Logical Operators', 'j9xt9ddFTEk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (396, 11, 'Triple Equals', 'BrEm2dcoFxo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (397, 11, 'while Loop', '0HBLrQe2Ack');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (398, 11, 'do while Loop', 'MxPVNaArOSk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (399, 11, 'for Loop', 'EFjiuTicHns');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (400, 11, 'switch Statement', 'VbiPMsBpJ7w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (401, 11, 'die and exit Functions', 'zcKt7Lj1kjo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (402, 11, 'Basic Functions', '5qmbPoaMlnY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (403, 11, 'Functions with Arguments', '8peN5QYpjCM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (404, 11, 'Functions with a Return Value', 'yU0Z8sVGBx0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (405, 11, 'Global Variables and Functions', 'jhZLfyscYgI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (406, 11, 'String Functions Part 1', 'QTIlNPmwISY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (407, 11, 'String Functions Part 2', 'OlqfAYoxK08');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (408, 11, 'String Functions Part 3', 'a8cwNsDnCrw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (409, 11, 'String Functions Part 4', 'yx6VDuD5iXk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (410, 11, 'Introduction to Arrays', 'bhNq7Y6QH0A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (411, 11, 'Associative Arrays', '0S10VOdez3g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (412, 11, 'Multi-dimensional Arrays ', 'TFDALOr-JKg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (413, 11, 'for each Statement', 'U0PtKHhWzDc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (414, 11, 'include and require Functions', '7TkWocNqHU0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (415, 11, 'include_once and require_once', 'VLlcGgovHNc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (416, 11, 'Expression Matching', 'bvGMVmJ0mAk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (417, 11, 'More on Expression Matching', 'zAHHj7CY5Eo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (418, 11, 'String Functions: String Length ', 'xR9LddrVDmY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (419, 11, 'String Functions: Upper / Lower Case Conversion', '-jO3LdBNd-o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (420, 11, 'String Functions: String Position Part 1', '3yZq2Epb3FI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (421, 11, 'String Functions: String Position Part 2', '8Z5dy7_u8os');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (422, 11, 'String Functions: Replacing Part of a String', 'aGwa5yE43Mg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (423, 11, 'String Functions: Replacing Predefined Part of a String', '6JB2qGohdt4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (424, 11, 'Word Censoring Part 1', 'hlfWVIia4yA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (425, 11, 'Word Censoring Part 2', 'x3QH9tkoF5I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (426, 11, 'Creating a Find and Replace Application Part 1', 'g74FGWy8Cs0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (427, 11, 'Creating a Find and Replace Application Part 2', 'VQ2HSOKq9jM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (428, 11, 'Creating a Find and Replace Application Part 3', 'IrV2HrfkTjs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (429, 11, 'Creating a Find and Replace Application Part 4', 'Vs2B4Q1mmzI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (430, 11, 'timestamps', '0Oh-zCtpcok');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (431, 11, 'Modifying timestamps', 'eKv8uV07y5E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (432, 11, 'Random Number Generation', 'ESm6kb-XVbU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (433, 11, '$_SERVER Variables: Script Name', 'k-toXiaTV0k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (434, 11, '$_SERVER Variables: Host Name', 'CFKEnbPBAKc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (435, 11, 'Using the Header to Force Page Redirect', 'QYTmOVeVj24');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (436, 11, 'ob_start', 'V79Adzba1yA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (437, 11, 'Getting Visitors IP Address', 'sGvPPw-kAl8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (438, 11, 'Better Way to Get Visitors IP Address', 'TVcSMRKuW3U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (439, 11, 'Detecting a Visitors Browser Part 1', 'mdoRUbvIZ28');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (440, 11, 'Detecting a Visitors Browser Part 2', 's2l8MMFdRAM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (441, 11, 'Working with $_GET Variables', 'ZMLkF1vmZdE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (442, 11, 'Working with $_POST Variables', 'KgTOKFgCKxM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (443, 11, 'Working with Form Data', 'oEtura7P2so');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (444, 11, 'Using htmlentities for Security', 'MTAVk6skQek');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (445, 11, 'Setting PHP Sessions', 'WuZBQ706thI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (446, 11, 'Unsetting PHP Sessions', 'KdYPi8ublKw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (447, 11, 'Creating Cookies with PHP', 'tOuym4a7XjY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (448, 11, 'Deleting Cookies with PHP', '7Yx4RfxlqEk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (449, 11, 'File Handling: Writing to a File', 'gC8sLGB8SSM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (450, 11, 'File Handling: Reading a File', 'yBKwGXCJ6RU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (451, 11, 'File Handling: Appending a File', '5i7NJHdYIno');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (452, 11, 'The explode Function with File Handling Example', 'AxuRhz0igmc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (453, 11, 'The implode Function with File Handling Example', '0TmTHlGAM5s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (454, 11, 'File Handling: Listing Files Part 1', 'XcDODevXROM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (455, 11, 'File Handling: Listing Files Part 2', 'zlpOZ3f0Nn4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (456, 11, 'File Handling: Checking if a File Exists', 'mZRkUJHpHK0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (457, 11, 'File Handling: Deleting and Renaming Files Part 1', 'Rj2EdIlPOzs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (458, 11, 'File Handling: Deleting and Renaming Files Part 2', 'nYhK6G_y2tY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (459, 11, 'Uploading Files: The Basics', 'PYSW-Xejn1s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (460, 11, 'Uploading Files: The Basics Part 2', 'jOrFvgwIPxQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (461, 11, 'Uploading Files: Restricting File Size', 'X6shoAqzvVU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (462, 11, 'Uploading Files: Restricting File Extensions Part 1', 'USjZjups-Rc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (463, 11, 'Uploading Files: Restricting File Extensions Part 2', 'rkKKP3eOtU4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (464, 11, 'Creating a non-unique Hit Counter', 'htYbc8ndWt8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (465, 11, 'Creating a File Based Unique Hit Counter Part 1', 'k5Suj0amo60');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (466, 11, 'Creating a File Based Unique Hit Counter Part 2', 'hQp_tVtKgMU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (467, 11, 'Creating a File Based Unique Hit Counter Part 3', 'w4wZHul6Aqk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (468, 11, 'MD5 Encryption Part 1', 'usKJk07iF78');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (469, 11, 'MD5 Encryption Part 2', '-X2HY8akWxA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (470, 11, 'Sending an Email Part 1', 'L-WBJwaJ7go');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (471, 11, 'Sending an Email Part 2', '0o8cJOpqez0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (472, 11, 'Creating a Simple Contact Form Part 1', 'BjGtEMTxn54');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (473, 11, 'Creating a Simple Contact Form Part 2 ', '4L06eBsDNpM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (474, 11, 'Creating a Simple Contact Form Part 3', 'hPwpGO5oy_E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (475, 11, 'Creating a Simple Contact Form Part 4', 'FvttRT67P_8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (476, 11, 'An Introduction to XML', 'TAw4uo6a0Tk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (477, 11, 'Reading a Simple XML File: Part 1', 'MVeeIsFtJC4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (478, 11, 'Reading a Simple XML File: Part 2', 'KkyeImH_McQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (479, 11, 'A YouTube XML Example', '_JpM2AAF8v8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (480, 11, 'An Introduction to Databases', '83pUFQc6yW8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (481, 11, 'More About Databases', 'E8VQX6WGnxo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (482, 11, 'phpMyAdmin Part 1', 'msCY6evKpNI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (483, 11, 'phpMyAdmin Part 2', 'Yo5y49DHslw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (484, 11, 'phpMyAdmin Part 3', 'cRftgt5Wl2I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (485, 11, 'Connecting to a Server and Database Part 1', '114ddqVNNws');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (486, 11, 'Connecting to a Server and Database Part 2', 'i5mAbluLyJA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (487, 11, 'SELECT Part 1', 'TuXwEENdrn8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (488, 11, 'SELECT Part 2', 'TSX72_O7QYY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (489, 11, 'SELECT Part 3', 'z1yhd2DmMkE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (490, 11, 'SELECT By Example Part 1', 'P0zWopVbW4k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (491, 11, 'SELECT By Example Part 2', 'zTM8icnkQKo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (492, 11, 'More Basic Querying Part 1', '_hM0o-1Ckks');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (493, 11, 'More Basic Querying Part 2', 'bgK7R028SjU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (494, 11, 'More Basic Querying Part 3', 'OYol4xIHieM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (495, 11, 'Creating a Database Hit Counter Part 1', 'maBMsxf4T2g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (496, 11, 'Creating a Database Hit Counter Part 2', 'uLQbT-9Jlio');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (497, 11, 'Creating a Database Hit Counter Part 3', 'ZKxpglN9C_8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (498, 11, 'Creating a Database Hit Counter Part 4', '06uzQXxCIjM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (499, 11, 'LEFT JOIN', 'YMlDCL_xNJs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (500, 11, 'RIGHT JOIN', 'OK8QO73uIMk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (501, 11, 'JOIN', 'UEjkvevAu9k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (502, 11, 'LIKE With a Search Engine Example Part 1', '5cTp0UtEMIM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (503, 11, 'LIKE With a Search Engine Example Part 2', '4zAts74_kdo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (504, 11, 'LIKE With a Search Engine Example Part 3', 'VxqmBEDNZww');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (505, 11, 'LIKE With a Search Engine Example Part 4', 'aEAR676ious');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (506, 11, 'SELECT DISTINCT', 'K2xoOIktfbo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (507, 11, 'Creating Tables', 'RhynekIxQ-4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (508, 11, 'Logging the User In Part 1', 'mRmLkzrfDzU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (509, 11, 'Logging the User In Part 2', 'LqWJ6fPsV84');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (510, 11, 'Logging the User In Part 3', 'Y2nHg6jG9hA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (511, 11, 'Logging the User In Part 4', '7sHlFFJWTuc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (512, 11, 'Logging the User Out ', 't1jorTmPE18');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (513, 11, 'Getting User Data Part 1', 'yPiy72MsN7A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (514, 11, 'Getting User Data Part 2', 'OEl78NxZHcA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (515, 11, 'Protecting the User Against SQL Injection', '6B4DapTufWI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (516, 11, 'Registration Form Part 1', 'FdD1m5z-YYc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (517, 11, 'Registration Form Part 2', 'MFriz0yv9HA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (518, 11, 'Registration Form Part 3 ', 'DIVtcoeDCdE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (519, 11, 'Registration Form Part 4', 'F2foUWPQHfY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (520, 11, 'More Validation Part 1', 'xSMLhdwdoQo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (521, 11, 'More Validation Part 2', 'YdiaR0LPtaQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (522, 11, 'More Validation Part 3', '-ME7NY7mxNQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (523, 11, 'SQL Injection Part 1', 'L41oWB4I1po');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (524, 11, 'SQL Injection Part 2', '3ANVO7oLfec');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (525, 11, 'SQL Injection Part 3', 'mGoAxzCoZj0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (526, 11, 'SQL Injection Part 4', 'DLyxhmAYKmg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (527, 11, 'SQL Injection Part 5', 'aO5sQSoYpq4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (528, 11, 'Introduction to GD', 'whczgU3K7Mw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (529, 11, 'Protecting Email with String to Image Part 1', 'nw4dwc7FgXc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (530, 11, 'Protecting Email with String to Image Part 2', 'oWmwukr4VBk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (531, 11, 'Protecting Email with String to Image Part 3', 'zX-c8aoQpZc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (532, 11, 'Protecting Email with String to Image Part 4', 'Sj7WKx6nXZ0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (533, 11, 'Watermarking Images Part 1', 'gQ6UJRmriLc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (534, 11, 'Watermarking Images Part 2', 'qI3ysgw9Wk0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (535, 11, 'Watermarking Images Part 3', 'EDiQvGA3eqU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (536, 11, 'Creating Captcha Image Security Part 1', 'yt2iE2-jYoI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (537, 11, 'Creating Captcha Image Security Part 2', 'bQNAbXbutck');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (538, 11, 'Creating Captcha Image Security Part 3', 'ulkgsUXKJoY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (539, 11, 'Creating Captcha Image Security Part 4', 'c_SpC0isxz0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (540, 11, 'Scaling Down Images to Thumbnails Part 1', 'sBGpp5-GBdM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (541, 11, 'Scaling Down Images to Thumbnails Part 2', 'e_uD7NCSHfM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (542, 11, 'Scaling Down Images to Thumbnails Part 3', 'cRwziqA6fR4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (543, 11, 'Introduction to AJAX', 'm3eSLQww3OI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (544, 11, 'Loading in file Contents to a DIV Part 1', 'bTlsP_T8GCc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (545, 11, 'Loading in file Contents to a DIV Part 2', 'q7i4QJPLg_w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (546, 11, 'Loading in file Contents to a DIV Part 3', '2dpHvdJpj8c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (547, 11, 'Auto Suggest Application Part 1', 'xogxy86-LI0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (548, 11, 'Auto Suggest Application Part 2', 'rttSgvhG7-Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (549, 11, 'Auto Suggest Application Part 3', 'KNW_-oOHTy4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (550, 11, 'Auto Suggest Application Part 4', 'A1Ug1a7aZgQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (551, 11, 'Auto Suggest Application Part 5', 'iYiS3Ka1g3Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (552, 11, 'POSTing Data Part 1', 'Qz4rpFOuDHY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (553, 11, 'POSTing Data Part 2', 'toNrHVhXEpo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (554, 11, 'POSTing Data Part 3', 'PzHOW7AqIYQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (555, 11, 'POSTing Data Part 4', 'tTBzJMcOU6w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (556, 11, 'POSTing Data Part 5', '7ng_282FOrs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (557, 11, 'Throwing an Exception', '0l7IjO33vHM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (558, 11, 'try, throw, catch', 'xlUMy4RotdU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (559, 11, 'Custom Exceptions', 'iLcHWD-8T5g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (560, 11, 'Custom Error Messages', 'nsUaDRgPh4Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (561, 11, 'Introduction to OOP', 'IyRVN9UsLEA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (562, 11, 'Classes, Properties, and Methods', 'kc3y-1tKEwA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (563, 11, 'Return a Property Value', '1yJTACtS7GA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (564, 11, 'Changing a Property Value', 'OCFqXVaQS3Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (565, 11, 'public, private, and protected', 'ySGWhP353cE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (566, 11, 'Constants', 'FKpUeMjlWtc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (567, 11, 'Class Constructor', 'Q5pPGYnxiTI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (568, 11, 'Multiple Instances of Classes', '0VPxns5hn3E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (569, 11, 'extends Part 1', 'ROcTQt4RbTs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (570, 11, 'extends Part 2', 'v6r282rYcY0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (571, 11, 'Connecting to a Database the OOP Way', 'zcBtUUDjdu4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (572, 11, ' Final PHP Video!!!', 'k47VMPKZPoo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (573, 12, 'Downloading an Installing the UDK ', 'K7AAgQHJWGc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (574, 12, 'How to Move Around', 'ox2SF3sxzsA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (575, 12, 'User Interface Viewports', 'oj_ulA1Y3I4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (576, 12, 'Viewport Options and Realtime', 'ndwQC-wpgTE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (577, 12, 'Different Viewing Modes', 'DuM1bR1IKCc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (578, 12, 'Lock Viewport and Camera Speed', '8n9owxPnLfw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (579, 12, 'Introduction to Brushes', 'HaHG2KUkXtg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (580, 12, 'CSG Operations', 'fTI4zm-hcbU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (581, 12, 'Grid Size and Brush Order', '1eU8WL26LkU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (582, 12, 'Building a Simple Floor', 'Ydwo4Dhp6P8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (583, 12, 'Creating our Four Walls', 'B1wNJ2Y-alU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (584, 12, 'Geometry Mode', 'Fv8-3wf4BF8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (585, 12, 'Adding Doors and Windows', '7JgW1HCWFlU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (586, 12, 'Adding Pillars to the House', '9TPewEz1l4U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (587, 12, 'Finishing Our House', 'weR7Qtw_258');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (588, 12, 'Content Browser', 'gYj7YYiFg_w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (589, 12, 'Introduction to Materials', 'WgO_4c1ZlRc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (590, 12, 'Surface Properties', 'nAoXdnc3T_Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (591, 12, 'Fixing Our Walls and Roof', 'LJT19nDnozg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (592, 12, 'Collections', 'XEkwtLmpqhA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (593, 12, 'Creating Custom Materials', 'HZzATIl92kg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (594, 12, 'Material Expressions', '56PXMtE1gus');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (595, 12, 'Textures and Materials', 'aiE4fVCtEBQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (596, 12, 'Normal Maps', 'epGkooMyMtg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (597, 12, 'Multiply', 'v8E1_xV9m2w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (598, 12, 'Texture Alignment Mode', 'r0wkd7JKbAg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (599, 12, 'Emissive Materials', 'nfBf-de-z5Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (600, 12, 'Specular Control', 'h_m-C29HY90');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (601, 12, 'Introduction to Static Meshes', 'ueM9K-hutAE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (602, 12, 'Arches and Walls', 'CZwmMYsJhX0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (603, 12, 'Clubbin Statues', 'EsP6G3Eot4k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (604, 12, 'Finishing and Lighting the Castle', 'tMQyvB2N-Tk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (605, 12, 'Advanced Lighting', 'cYWOEgpv6N0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (606, 12, 'Spotlights', 'QZvp5F0KbHA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (607, 12, 'Important Lighting Concepts', 'S_G964wedVk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (608, 12, 'Introducing Terrain', '0A7fOPTcMas');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (609, 12, 'Adding Grass to the Terrain', 'T6gv7k9y-VU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (610, 12, 'Terrain Tools', 'thCYLTiUsm4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (611, 12, 'Other Terrain Settings', 'KHX0_q36500');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (612, 12, 'Adding Trees and Plants ', 'f3HlZv20jTY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (613, 12, 'Introduction to Kismet', 'yboxORyV9pA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (614, 12, 'Preparing the Level for Kismet', 'NeQm7Gnsso8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (615, 12, 'Turning on Lights with Kismet', '3vaR9g3Gwxk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (616, 12, 'Fixing Our Lights', 'htCoEB84VGQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (617, 12, 'Playing Sounds in Kismet', 'IhxBncI_V2g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (618, 12, 'Announcements in Kismet ', 'cMF5vypMW2g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (619, 12, 'Kismet Comments', 'ubVRxABKA0M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (620, 12, 'Delay', '1hEEj4gtSu4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (621, 12, 'Gate', 'T-Q7TnI3X-o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (622, 12, 'Switch', 'eN_u71ncJxk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (623, 12, 'Take Damage', 'bHMnKMOBTdM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (624, 12, 'Hiding Statues', 'MQI--Su4iqU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (625, 12, 'Blowing out Lights', 'DmVCSfAmVog');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (626, 12, 'Adjusting the Lights', '4B9YaqCh8Oo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (627, 12, 'Busting the Light with Kismet', 'ii6j5Ne5FVw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (628, 12, 'Duplicating the Light System', 'WKCmk_Y0ZoI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (629, 12, 'Introduction to Matinee', 'H9fwT1ghMrg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (630, 12, 'Finishing the Door Animation', 'Uq9XWWTojkE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (631, 12, 'Matinee Interface', '-ZB9W6hb74A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (632, 12, 'More on Matinee', '-AvVuZLzkcg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (633, 12, 'The Curve Edito', '00cDiZrd1tI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (634, 12, 'Animating Materials', 'R8ls74sxFys');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (635, 12, 'Finishing up the Material Animation', 'TwRBRjdW598');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (636, 12, 'Volumes', 'nfA1MIb4hjw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (637, 12, 'Last Video in Beginner Series', 'efvmX6doLZc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (638, 13, 'Lasagna in My Bathtub...', 'IMHr5NyyISk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (639, 13, 'Clues in the Shower', 'T_72tsE6Odo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (640, 13, 'Going Blank', 'lvCfTNSqJLs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (641, 13, 'Being Lazy', '42JtgmGRXdw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (642, 13, 'Reading Books', 'Ou-WINT5RH8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (643, 13, 'Addictions', '9rPs_0eJMI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (644, 13, 'Restaurants', 'rz-haLWclZ0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (645, 13, 'Art Class', '90H8SjSMQqk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (646, 13, 'Shopping Styles', 'FLAT2Bo5Dkw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (647, 13, 'Shopping Check Out', 'gO4FGRl8SAo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (648, 14, 'Hello World ', 'b00HsZvg-V0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (649, 14, 'Intro to Variables', 'SBQwQRwkg6U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (650, 14, 'Comments and Math Functions', 'cC90Uv1kVHM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (651, 14, 'If Statement Decision', 'K2RfUgCzZR8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (652, 14, 'If, Else If, Else Statements', 'SOnpOBvyhDM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (653, 14, 'While Loops', 'Rtww83GH0BU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (654, 14, 'More on Loops', 'z773Xu4-kIY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (655, 14, 'Switch Statement', 'uw95S87TW8s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (656, 14, 'Do While Loops', 'uOUpEKh8l60');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (657, 14, 'Logical Operators', '-NigITzZteM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (658, 14, 'Into to Functions', 'iOS5sPivuJA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (659, 14, 'Random Number Function', '0Nuhjvxzwro');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (660, 14, 'Seeding Random Numbers', 'qs8vVgy5AMc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (661, 14, 'Intro to Arrays', 'BjVeWRNiddE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (662, 14, 'Simple Array Program', 'BqU3_ouKHwk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (663, 15, 'Introduction and Installing C# 2010', 'x_9lfHjYtVg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (664, 15, 'Changing Forms Properties', 'zUbVMdF_kU4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (665, 15, 'Showing MessageBoxes', 'glzUzy1C7IM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (666, 15, 'Variables', 'Em9VcqdGatg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (667, 15, 'Changing Properties With Code', 'x-OynOfFoA8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (668, 15, 'If Statements', 'QX-x-48xP5U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (669, 15, 'More on If Statements', 'PAwO1ZbvMI4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (670, 15, 'If Statements pt 3', 'i4nys8oPT_U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (671, 15, 'Switch Statements', 'uEnWW8ba-wI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (672, 15, 'Mathematical Operators', '2KG_ADNE4fg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (673, 15, 'Arrays', 'RdrbVnMhDTQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (674, 15, 'Lists', 'nP_kYxxhaX4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (675, 15, 'For and Foreach Loop', 'rdLa8BtneF0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (676, 15, 'Do and Do While', '9n36Yru7UpM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (677, 15, 'Try, Catch and Finally', '0FQM0RUEgYg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (678, 15, 'Methods pt 1', 'SRwDqyyZFXY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (679, 15, 'Methods pt 2', 'ND8aXadDbyg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (680, 15, 'Continue and Break', 'Pexgcu7EBg0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (681, 15, 'Overview of Namespaces and Classes', 'dAeMBeZHdVc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (682, 15, 'Constructors', 'Waq_xVXNJCQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (683, 15, 'Access Modifiers and Static', '5ZzMeHUhMyo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (684, 15, 'Overloading Methods and Enumerations', '5rXpHAT5YTs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (685, 15, 'Creating Your Own Properties', 'SwGkUxjiDYA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (686, 15, 'Throwing Exceptions', 'lvt_pYIqf5A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (687, 15, 'Inheritance and Overriding', 'aKaneSO9HLc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (688, 15, 'More on Inheritance and Interfaces', 'eonOsiceiIk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (689, 15, 'Indexers', 'igmAVtGsSvs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (690, 15, 'Structs', 'g1X4FE1OW2E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (691, 15, 'Partial', 'KAa6L8SRM3Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (692, 15, 'Abstract', '-qbrsfy_uKo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (693, 15, 'Delegates', 'CtIX1ei1I9Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (694, 15, 'Events', 'DGY2YXUz3lQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (695, 15, 'Ternary Operator', 'MqdPPGSyXKs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (696, 15, 'OpenFileDialogs', 'a1Ryv6DX6vU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (697, 15, 'More Variable Types', 'z3ybtGzL09o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (698, 15, 'StreamReader pt 1', '--YPtMsg_6E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (699, 15, 'StreamReader pt 2', 'd_uzSF0v7J4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (700, 15, 'StreamReader pt 3', 'Xi1wJSYEU4Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (701, 15, 'StreamWriter pt 1', 'ZhL0eECzcYM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (702, 15, 'StreamWriter pt 2StreamWriter pt 2', 'uEcwwjB7Fg4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (703, 15, 'BinaryReader pt 1', 'oEVDVreWrTA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (704, 15, 'BinaryReader pt 2', 'goOUqBqCww8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (705, 15, 'BinaryWriter', '0Pj1F0trB_c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (706, 15, 'SaveFileDialog', 'LydFPT5eyXE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (707, 15, 'Convert Class', '-5gPI1q4Cz4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (708, 15, 'Special Folder Locations', 'i2815OKe_IU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (709, 15, 'Is, as, and Casting', '4Vzn-YM42Zw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (710, 15, 'Convert Class', 'QUhmLsx1vm8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (711, 15, 'Substrings', 'H8e5MegKKOA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (712, 15, 'IndexOf and Trim', 'J23tKs_s1bk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (713, 15, 'Remove and Replace', 'JD9wyDH9guI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (714, 15, 'Split and ToCharArray', 'Fwkb0-sFyFs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (715, 15, 'Math Class', 'AcjUu4VWPzQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (716, 15, 'Generating Random Numbers', 'G7ofO5qCL0w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (717, 15, 'Generating Random String', 'U9RdDVstjM8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (718, 15, 'FolderBrowserDialog', 'tRyBXDo4yog');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (719, 15, 'Directory Class pt 1', 'swZGPrUqo0E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (720, 15, 'Directory Class pt 2', 'jsxdeAF5kvM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (721, 15, 'Directory Class pt 3', 'sqgWi4kSsEI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (722, 15, 'File Class pt 1', '3NyqdwQhmZ8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (723, 15, 'File Class pt 2', 'u2Xp8j5ZYko');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (724, 15, 'Path Class', 'JsTgC1hIEw0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (725, 15, 'Process Class pt 1', '9jpGfSIMX4w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (726, 15, 'Process Class pt 2', 'XPpC4TQNniI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (727, 15, 'Null Coalesce Operator', 'mySZi03pAvc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (728, 15, 'Bitwise Operators pt 1', 'heRtRoBuV6E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (729, 15, 'Bitwise Operators pt 2', 'cAe1j8V2PFk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (730, 15, 'Bitwise Operators pt 3', 'vqztkB-OOzM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (731, 15, 'Threading pt 1', 'UgVkI7ZJyMc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (732, 15, 'Threading pt 2', '2e_dvohtZGc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (733, 15, 'Threading pt 3', 'NgymJoo0tiM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (734, 15, 'WebClient pt 1 Status Log', '832cyifOnso');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (735, 15, 'WebClient Class pt 2 Downloading Files', 'pzl5VMf4Dlg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (736, 15, 'Project 1 Email Sender, pt 1', '2tw6l-bzp4w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (737, 15, 'Project 1 Email Sender, pt 2', 'mGDnQchFZJg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (738, 15, 'Project 1 Email Sender, pt 3', 'PQGYtZdOkeQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (739, 15, 'DateTimePicker', '9I8BVf5raHo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (740, 15, 'DateTime Struct', 'fJL2Q-sElgg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (741, 15, 'Picture Box and Image Class', 'pHNEJ9QoWFU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (742, 15, 'Clipboard Class', '2wgpb3wpoFg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (743, 15, 'ColorDialog', 'Rsdxdh1w9tM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (744, 15, 'Color Struct', '1ZJ_-fByjOQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (745, 15, 'FontDialog', 'ueiGFAvGou0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (746, 15, 'Timer Control', 'tVlYojL7iCI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (747, 15, 'Playing Sounds', '4cdjFADJ41Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (748, 15, 'MaskedTextBox Control', 'TR-f0k0Xj5c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (749, 15, 'Multiple Forms', 'ooX_paV5Eoc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (750, 15, 'Multi Document Interface MDI', 'zuRx2q1r8Bc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (751, 15, 'ComboBox Control', 'CgUS4lLjIfA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (752, 15, 'ProgressBar Control', 'H-BGhsCRecs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (753, 15, 'ListView Control pt 1', 'powg_2OlmiE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (754, 15, 'ListView Control pt 2', 'rQ3w23TlKvg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (755, 15, 'ListView Control pt 3', 'YNjGrM7kwMM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (756, 15, 'ListView Control pt 4', 'FQ_gnTm7zaA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (757, 15, 'ToolStrip and StatusStrip Controls', 'wCZrSmOIra8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (758, 15, 'NotifyIcon Control', 'vBBFo0QfzW0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (759, 15, 'Opening Files With Your App', 'NpNqrrtrY24');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (760, 15, 'Settings', '1-aPZWXYVbo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (761, 15, 'TreeView Control pt 1', 'aGEdb-4mH5E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (762, 15, 'TreeView pt 2', '_pxVZuLfbjM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (763, 15, 'TreeView pt 3', '9E_ke7XrT74');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (764, 15, 'Property Grid', 'jO8Yfi_843I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (765, 15, 'Accessing All Controls pt 1', 'pz6CtuLkucs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (766, 15, 'Accessing All Controls pt 2', 'MEu3Y5cTwZI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (767, 15, 'WebBrowser Control pt 1', '6esPvx0o5uU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (768, 15, 'WebBrowser Control pt 2', '8jHIeHB-fyg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (769, 15, 'WebBrowser Control pt 3', 'NFSBdlP7QG8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (770, 15, 'TrackBar and NumericUpDown Controls', 'LseN7M_zZA0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (771, 15, 'Reading XML pt 1', 'DPY1v7sDK9w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (772, 15, 'Reading XML pt 2', 'Wa9KbLDtxCI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (773, 15, 'Editing XML File', 'nPg7CMJ6q60');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (774, 15, 'Writing New XML file', 'iSUxvnppFJA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (775, 15, 'Write Nodes to Existing XML File', 'EAvlXSAHRvk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (776, 15, 'Deleting a XML Node', 'KhYDIgF3OtM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (777, 15, 'MD5 and SHA1', '_P315F8PHVc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (778, 15, 'TripleDES Encryption', 'FN_yjEOdttw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (779, 15, 'TripleDES Decryption', 'SJu7pUsuAoo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (780, 15, 'Drag and Drop', 'O8tfuST7hzY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (781, 15, 'Drawing Shapes', 'YKckcMwyvPE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (782, 15, 'Drawing More Shapes', '2WeFMKk8Jxo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (783, 15, 'Drawing with Pen Class pt 1', 'fY8REwOa1RM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (784, 15, 'Drawing With Pen Class pt 2', 'TWqM3PQvRdw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (785, 15, 'Drawing Strings Text', 'nrpDXEzyvGI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (786, 15, 'LinearGradientBrush', 'RlUKwUz2gsg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (787, 15, 'Multiple Colors in a LinearGradientBrush', 'WpnxasmPzFo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (788, 15, 'PathGradientBrush pt 1', 'WkcWtSv2j5Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (789, 15, 'PathGradientBrush pt 2', 'wKmcXe8Mof0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (790, 15, 'Project 2 Paint Program, pt 1', 'jFVd6d0yvzU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (791, 15, 'Project 2 Paint Program, pt 2', 'E4L4i4NplZg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (792, 15, 'Project 2 Paint Program, pt 3', 'vEauSn7XyhA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (793, 15, 'Project 2 Paint Program, pt 4', 'sDxn_omSLeE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (794, 15, 'Project 2 Paint Program, pt 5', 'V2IEQWGDYdg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (795, 15, 'Making Controls pt 1', '6WMT1jojpZs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (796, 15, 'Making Controls pt 2', 'bZTyafLW-JQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (797, 15, 'Making Controls pt 3', '_WKrldzEwC0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (798, 15, 'Making Controls pt 4', 'sD_Pf4yK8-E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (799, 15, 'Making Controls pt 5', 'kK8Y0HrEEf8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (800, 15, 'Making Controls pt 6', 'KQeKwhi10vU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (801, 15, 'Inheriting From Existing Controls', 'ow0JBlsRDj4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (802, 15, 'Splash Screen', 'ERuh0Rs4Vfw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (803, 15, 'Making a DLL', 'reG1qqkoHtU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (804, 15, 'Internal Access Modifier', 'iFvuHpMviME');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (805, 15, 'Comments and Descriptions', '3T5UjG69Ryk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (806, 15, 'Goto Keyword and Regions', 'qrOox-nRW4Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (807, 15, 'Capturing Screen', 'K_6d4OBoScQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (808, 15, 'Making Keyboard Shortcuts', 'XdMrl8CPKXw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (809, 15, 'Checking Controls on Leave', 'Qyv2PCLNWwk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (810, 15, 'Overloading Operators pt 1', 'GIHMCJVDRzM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (811, 15, 'Overloading Operators pt 2', '95gOUaxV3vE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (812, 15, 'Overloading Operators pt 3', 'NMdBBkKRJ34');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (813, 15, 'Overloading Operators pt 4', 'y66w6NCTwjQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (814, 15, 'Making Conversion Operators', 'QOrF1ykFwJ0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (815, 15, 'Ref and Out Keywords', 'ZcouA7mu2aQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (816, 15, 'Project 3 Hang Man Game, Making the UI', 'E8XQ9x-7yYk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (817, 15, 'Project 3 Hangman, Drawing Hang Post', 'aIdKAWOPS3Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (818, 15, 'Project 3 Hang Man, Drawing Face', 'kqHeuNFqRlo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (819, 15, 'Project 3 Hang Man, Drawing Bosy and Arms', 'kEh8_0PVGXI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (820, 15, 'Project 3 Hang Man, Drawing Legs', '-RlAJmf9WfY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (821, 15, 'Project 3 Hang Man, Getting Random Word', 'QUsaNXdvgWM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (822, 15, 'Project 3 Hang Man, Making the Labels pt 1', 'miEgnaicp7E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (823, 15, 'Project 3 Hang Man, Making the Labels pt 2', 'lzc3oHveb4k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (824, 15, 'Project 3 Hang Man, Submit Button', 'ycLCnVP8TDs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (825, 15, 'Project 3 Hang Man, Submitting Wrong Letter', 'Lfew3eegnV0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (826, 15, 'Project 3 Hang Man, Resetting Game', 'UUxrx_t2rZY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (827, 15, 'Project 3 Hang Man, Submit Word Button', 'nwWSIljiKaM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (828, 15, 'Optional Parameters', '4i0F3Nb0UIw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (829, 15, 'IEnumerable and Yield Return', 'F7L9seU_mak');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (830, 15, 'Make a Class for a Foreach Loop', 'Pn7ykmfEDVY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (831, 15, 'Project 4 Address Book, Making UI', 'GVpY0Y9uQM0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (832, 15, 'Project 4 Address Book, Making Class and Files', 'qY7C9fcbILg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (833, 15, 'Project 4 Address Book, Adding Data to Classes', 'GdTEfLHgYDY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (834, 15, 'Project 4 Address Book, Updating Information and Removing People', '0ZoDmeAZAD8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (835, 15, 'Project 4 Address Book, Save Changes Button', 'BKID413hlOw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (836, 15, 'Project 4 Address Book, Writing to XML File', 'PvDRQhNq3G8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (837, 15, 'Project 4 Address Book, Reading People', 'PMUDcLoQwB4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (838, 15, 'Notified When Files Change', 'Sw5Ym7hFrHs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (839, 15, 'Zipping Files and Folders', '0haa-piN1JE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (840, 15, 'Preprocessor Directives', 'zVJEQTr0tbI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (841, 15, 'Project 5 Captcha Generator, Setting Up', 'PsxRx7o7ITk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (842, 15, 'Project 5 Captcha Generator, Drawing Random String', 'oUp-o_ZMvtA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (843, 15, 'Project 5 Captcha Generator, Drawing Shapes', '3fj5yAUhS84');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (844, 15, 'Project 5 Captcha Generator, Getting Image Name', 'gCpzJRMd6WE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (845, 15, 'Project 5 Captcha Generator, Returning Images', 'jTdBIfmzrvg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (846, 15, 'Project 5 Captcha Generator, Saving the Images', 'ECIv5zZ1H68');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (847, 15, 'Project 5 Captcha Generator, Using the Images', 'p69txeff2E8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (848, 15, 'Project 6 Reading and Writing Class, Making Base Class', 'ty4MHFy1doU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (849, 15, 'Project 6 Reading and Writing Classes, Begining Reading Class', 'gQCyBz6--qE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (850, 15, 'Project 6 Reading and Writing Classes, Reading Methods', 'Cl9AkUL49U0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (851, 15, 'Project 6 Reading and Writing Classes, Changing Byte Order ect', '04iURUOB11A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (852, 15, 'Project 6 Reading and Writing Class, Reading Strings', 'xtn7wU27uCg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (853, 15, 'Project 6 Reading and Writng Classes, Finishing and Testing Reader', 'L1HxCNvkMqQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (854, 15, 'Project 6 Reading and Writing Classes, Begin Writing Class', 'Vjky_asimoE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (855, 15, 'Project 6 Reading and Writing Classes, Writing Bytes', 'Et2rhtxHt1E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (856, 15, 'Project 6 Reading and Writing Classes, Writing Strings', 'jKq3FS8TB4s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (857, 15, 'Project 6 Reading and Writing Class, Finishing Class Up', 'U-Ya5K0pLsY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (858, 15, 'Project 6 Reading and Writing Class, Using the Writing Class', 't68MaJMSAfM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (859, 15, 'IDisposable pt 1', 'CkB6Y5tv5Jk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (860, 15, 'IDisposable pt 2', '1GJENmBJCB8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (861, 15, 'ICloneable', 'psLMm4FRTq8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (862, 15, 'Changing Your Projects Properties', 'B2ZsdS2s2G0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (863, 16, 'Installing CodeBlocks ', 'tvC1WCdV1XU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (864, 16, 'Understanding a Simple C++ Program', 'SWZfFNyUsxc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (865, 16, 'More on Printing Text', 'sPv0HQ8xOaU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (866, 16, 'Variables', 'QwBSv4-_Lmk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (867, 16, 'Creating a Basic Calculator', 'yjucJUsHSqg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (868, 16, 'Variables Memory Concepts', '3Iq_uFbc4L4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (869, 16, 'Basic Arithmetic', 'L1z2dpCosXU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (870, 16, 'if Statement', 'yEY8xlnarNo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (871, 16, 'Functions', 'bsWWHo4KDHE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (872, 16, 'Creating Functions That Use Parameters', '-87KQS-rZCA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (873, 16, 'Functions That Use Multiple Parameters', 'fQ_CBGVfGbM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (874, 16, 'Introduction to Classes and Objects', 'ABRP_5RYhqU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (875, 16, 'Using Variables in Classes', 'jTS7JTud1qQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (876, 16, 'Constructors', '_b7odUc7lg0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (877, 16, 'Placing Classes in Separate Files', 'NTip15BHVZc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (878, 16, 'if Statement.....again', 'uYciTJ7CDOY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (879, 16, 'if / else Statement', 'jK83lln_T1k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (880, 16, 'while Loops', 'KLKhsaOPnLk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (881, 16, 'Simple Program Using a Loop', 'GGA0z_6tvOU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (882, 16, 'Sentinel Controlled Program', '791XRPJYdfA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (883, 16, 'Assignment and Increment Operators', 'T0kEDZ-tuNw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (884, 16, 'for Loops', 'sBO8yvyyBI0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (885, 16, 'Making a Stock Market Simulator', '1S__GRWtyvg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (886, 16, 'do while Loops', 'yRdPe2acogw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (887, 16, 'switch', 'TNUCZpgPjrw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (888, 16, 'Logical Operators', 'o78khWdmqIE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (889, 16, 'Random Number Generator', 'naXUIEAIt4U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (890, 16, 'Default Arguments / Parameters', '66zF2rqoKI8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (891, 16, 'Unary Scope Resolution Operator', 'ZwxMlIS6TLM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (892, 16, 'Function Overloading', 'IAMzWp3kS_k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (893, 16, 'Recursion', '4agL-MQq05E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (894, 16, 'Arrays', '1kLw8kZuccQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (895, 16, 'Create an Array Using Loops', 'Z9Wc8EsGjJY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (896, 16, 'Using Arrays in Calculations', 'v2dKtxtWT5o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (897, 16, 'Passing Arrays to Functions', 'VnZbghMhfOY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (898, 16, 'Multidimensional Arrays', 'B3iC40frU4M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (899, 16, 'How to Print Out Multidimensional Arrays', 'pAKZp_EucVg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (900, 16, 'Introduction to Pointers', 'Fa6S8Pz924k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (901, 16, 'Pass by Reference with Pointers', '_ja8iizm7nk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (902, 16, 'sizeof', '_5EEHKkvv1s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (903, 16, 'Pointers and Math', 'dPAbm-3iAN4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (904, 16, 'Arrow Member Selection Operator', '2RP4f9beidc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (905, 16, 'Deconstructors', '4P4Im0vF_mU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (906, 16, 'const Objects', 'k55CRqm1gzk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (907, 16, 'Member Initializers', '53VYYMy-LBo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (908, 16, 'Composition', 'jn3lT07owCo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (909, 16, 'Composition Part 2', 'jCaxfmcDYjs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (910, 16, 'friend    ', 'WCFGNdXSzus');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (911, 16, 'this', 'Fcdkcx4achs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (912, 16, 'Operator Overloading', 'PgGhEovFhd0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (913, 16, 'More on Operator Overloading', 'q4vZIF-uMzs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (914, 16, 'Inheritance', 'gq2Igdc-OSI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (915, 16, 'protected Members', 'DHAAy4GJ684');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (916, 16, 'Derived Class Constructors and Destructors', 'Z_vJEKU9WTg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (917, 16, 'Introduction to Polymorphism', 'R_PPA9eejDw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (918, 16, 'virtual Functions', 'DudHooleNVg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (919, 16, 'Abstract Classes and Pure virtual Functions', 'ndz3EHpFEZc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (920, 16, 'function Templates', 'W0aoAm6eYSk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (921, 16, 'function Templates with Multiple Parameters', 'SeleR7PDs5Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (922, 16, 'class Templates', 'U2QvTsMvWmM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (923, 16, 'Template Specializations', '8kjVFp-Y4GA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (924, 16, 'Exceptions', 'mFAaqmj399I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (925, 16, 'More Exceptions Examples', '5369xtKS42s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (926, 16, 'Working with Files', 'HcONWqVyvlg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (927, 16, 'Tips for File Handling', 'qdkabVYgV24');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (928, 16, 'Writing Custom File Structures', 'iGWhPwh3n-o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (929, 16, 'Reading Custom File Structures', 'EjJY7yA5SWw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (930, 16, 'Cool Program Working with Files', 'Xb-ae2NEGRs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (931, 16, 'Finishing the Awesome Program', 'xpV-Dpflob8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (932, 16, 'Reviewing the Final Program', '86rBqzYIbjA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (933, 16, 'string Class and string Functions', 'dSfjBoip4c0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (934, 16, 'string substrings, swapping, and finding', 'nkKeA74p3RY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (935, 16, ' Final Video for this Series', 'Djc4AScpuf4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (936, 17, 'Team Deathmatch Estate 23-8', 'nf--C5_4rtg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (937, 17, 'Modern Warfare 2 - Massacre at Scrapyard 23-4 ', 'rZA1YHNiOCY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (938, 17, 'Pwning n00bs 20-6 at Wasteland ', 'MQ3aNMNkZPo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (939, 17, 'Gameplay and commentary 33-5', 'D-VyPjK1M4Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (940, 17, 'Gameplay / Commentary 28-5', 'pCxBv1kaBlo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (941, 17, 'Barrett .50cal Gameplay @ Scrapyard with Commentary', 'gh0ELYp_MIU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (942, 17, 'Sniping with Thermal Scope 36-4', 'nneCUh1vOzs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (943, 17, 'Awesome Game Winning Kill after Flashbanged', 'U6jIxIpqTcA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (944, 17, 'Search and Destroy at Skidrow 9-3', 'TK5aE2xv0jg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (945, 17, 'Sniping at the Terminal 16-4 ', 'UFZFpfb_mvs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (946, 17, 'Search and Destroy at Afghan 10-4', 'Y1ubPp8eUG4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (947, 17, 'Using Silenced UMP at Quarry 21-9', '1oRG8Z66CD0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (948, 17, 'Perfect Game on Search and Destroy 9-0', 'pL1KyvNPClg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (949, 17, 'Scrap Yard Domination (gameplay/commentary)', 'Wg6ltoumZnQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (950, 17, 'Some Sub base Action (gameplay/commentary) 23-10', 'F_NPobTMZF0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (951, 17, 'Sub Base TDE with silenced UMP (gameplay/commentary)', '74hl8QsJQrg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (952, 17, 'Uber Beatdown on Derail (gameplay/commentary)', 'T-zzKjRNXr4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (953, 17, 'Rundown 28-7 and Game Winning Kill (gameplay/commentary) ', 'X13WrO4dE5o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (954, 18, 'What is Chemistry?', '4SbyQ9eVP7Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (955, 18, 'Matter Changing States', 'Gj6weMW6Dfc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (956, 18, 'Classifying Matter, Again!', 'Sy-sMp8jdPk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (957, 18, 'Pure Substances', 'ciVCBeqpiyw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (958, 18, 'Lets Mix It Up', 'AneNEWH32TY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (959, 18, 'Energy', '8U33HKEZ6jk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (960, 18, 'The Atom (not Adam)', 'CRNhJn4XIbk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (961, 18, 'So where the heck are the electrons?', 'STCrjxxRf-g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (962, 18, 'Quantum Mechanical Model', 'cKzh5yeQGjA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (963, 18, 'Orientation and Electron Spin', 'ECUybycbm3U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (964, 18, 'Figuring Out the Quantum Numbers', 'lo45fTuRAIY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (965, 18, 'Energy Level Diagram and Electron Configuration', '_rFuaCgPGtg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (966, 18, 'Valence Electrons and Isotopes', 'QpahQwxtkKQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (967, 18, 'Ions', 'qOyt9BGK3mQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (968, 18, 'Periodic Table of the Elements', 'uQ7g_yz0s1E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (969, 18, 'Nuclear Chemistry Baby!', 'DiHTj5ynZOw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (970, 18, 'Radioactivity', 'q1pMDMXLSBI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (971, 18, 'Beta Emissions', 'rd_G-ZRZdao');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (972, 18, 'Gamma Emissions', 'kWtgr6xJRrg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (973, 18, 'Positron Emissions and Anti-matter!', 'lD39aGISTTo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (974, 18, 'Electron Capture and X-Rays', 'FY_d9ELdyLc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (975, 18, 'Half-Lives', 'K6Ze5m3kJmo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (976, 18, 'Nuclear Fission', 'zKDcAcrlWoA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (977, 18, 'Nuclear Fusion', 'uji9M5K7HP8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (978, 18, 'Ionic Bonds', 'SbaFYIhWm0c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (979, 18, 'The Criss-Cross Rule', 'kG_T-T09c3k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (980, 18, 'Covalent Bonds', 'qE2jH5HtB-s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (981, 18, 'Triple Covalent Bonds', 'zpUjwFcHpHk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (982, 18, 'Structural vs. Molecular Formula', 'oB1WgUSvMXs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (983, 18, 'Electronegativity', '8N3jq4iljLM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (984, 18, 'Different Types of Chemical Bonds', 'spdE3oxklIg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (985, 18, 'Chemical Reactions', 'MiIuwtnE0do');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (986, 18, 'Decomposition Reactions', 'K7rLxnMr9TY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (987, 18, 'Single Displacement Reactions', 'BD_fJfaVDrU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (988, 18, 'Double Displacement Reactions', 'IMfNi_C2DTg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (989, 18, 'Question on Double Displacement Reactions    ', 'rGl4ble8f_k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (990, 18, 'Combustion Reactions', 'CxevMnzrnDo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (991, 18, 'Balancing Chemical Reactions', 'Xt1r6IMxjRc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (992, 19, 'Downloading the Cocos2D Framework ', 'pdVNahZb1PU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (993, 19, 'Setting up a Cocos2D Template', 'B6SjWP9GcPU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (994, 19, 'Creating Sprites', 'mNJ0RoepySQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (995, 19, 'Making Stuff Move', 'WGtMMx4DxwM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (996, 19, 'I Like It When You Touch Me', 'ogEsGZ2D-pw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (997, 19, 'How to Create Menus and Menu Items', 'g_65LWdZH5U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (998, 19, 'How to Create Scenes', 'ziQ6rYjqZO0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (999, 19, 'Intro to Actions', '9sdq1ueNqOM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1000, 19, 'Some Examples of Actions', 'j_IJFsl-N-4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1001, 19, 'Sequence, Spawn, and Repeat Actions', 'yX4RpU7wDA4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1002, 19, 'Repeat, RepeatForever, and Ease', 'ohs-edNZ7Ks');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1003, 19, 'Creating RPG with Tiled Map', 'aFjQVoxLcpU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1004, 19, 'Adding the Map to the Scene', 'cjduXkenf4w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1005, 19, 'Using Object Layers in Tiled', 'ZCMT_LvdY-w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1006, 19, 'Adding a Character to the RPG', 'Mtc0nXp6uDg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1007, 19, 'Moving the Camera Around', 'isYIyPz-e_0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1008, 19, 'Making the Dude Move', 'smRmcOWuaKw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1009, 19, 'Making Stuff to Bump Into', 'RTg3O3TiRc0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1010, 19, 'Converting the Map to Coordinates', 'LNYxEl1v_mI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1011, 19, 'Watching the Dude Bump into Stuff!', 'NBVswCvgM7c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1012, 20, 'Installing Pygame', '0xgn-HKzZes');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1013, 20, 'Basic Pygame Program', 'IG2WidpYUY8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1014, 20, 'Completed Pygame Program', 'Kls88vnGC_Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1015, 20, 'Event Basics', '30-fZs4nMw0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1016, 20, 'Simple Event Program', '9YWzFcHMz78');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1017, 20, 'Drawing Shapes', 'LdXtjCfU_4g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1018, 20, 'Polygons', 'I2dhn3UOWKc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1019, 20, 'Drawing Circles', '6WtyuXTYgy8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1020, 20, 'Drawing Ellipse', '9GraxbYyFts');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1021, 20, 'Drawing Lines', 'dy6M-32FdOI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1022, 20, 'Line Drawing Program', 'mmocQcv--7w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1023, 20, 'Intro to Animation', 'iRS10eHzAGQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1024, 20, 'Time Based Animation', '615JTGsEH_c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1025, 20, 'Diagonal Movement', 'TYhGiXHYImw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1026, 20, 'Beginning Vectors', 'x9M3R6igH2E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1027, 20, 'Vector Distance', 'gjsdAXSGEe8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1028, 20, 'Unit Vector', 'RRYxNYpyLSo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1029, 21, 'Creating a New Website', 'TEu3dEkF_v4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1030, 21, 'Creating a New HTML File', '_EiXecWla1o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1031, 21, 'Creating Tables', 'qz-mvwEWx74');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1032, 21, 'Inserting Images', 'lAGcw_dMdwQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1033, 21, 'Editing Text', 'o30zxwz-eL8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1034, 21, 'How to apply a CSS Style', 'W9UiBelZlSI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1035, 21, 'Controling Images with CSS', 'X-u66h3gdQI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1036, 21, 'Built in Image Editing Tools', 'y9VfwF7MbVQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1037, 21, 'Image Hotspots', '1qvuJ7rp764');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1038, 21, 'CSS Styling', 'kuN-NPYTBqA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1039, 21, 'CSS of Block Elements', 'mGmyda9msr4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1040, 21, 'CSS and Borders', 'z9HeXDOId4U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1041, 21, 'CSS for Positioning', 'W8g8CP1NQHk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1042, 21, 'Padding and Margin with CSS', 'VmtMGIyDwlc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1043, 21, 'Page Layout with CSS', 'pE4_dFRl0co');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1044, 21, 'More on Page Layouts', '2kUlPc8UoWQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1045, 21, 'Finishing Page Layouts', 'qSWn-fSpdYs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1046, 21, 'Fixed vs Liquid', 'axTQJyiO194');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1047, 21, 'Code View', 'zMOjK25Nxyk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1048, 21, 'Inserting JavaScript', 'VPH4GT3M0Jg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1049, 21, 'Introduction to Forms', '_f2Pm3A4jQc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1050, 21, 'Forms and Checkboxes', 'RDaJo7tBUQw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1051, 21, 'Radio Buttons', 'Mxc1r2Mvl6E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1052, 21, 'Lists and Menus', 'hWjGcShLk50');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1053, 21, 'Fieldsets, Jump Menus, and More!', '5dX5Szfk0FI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1054, 21, 'Introduction to Form Validation', 'WwqZJocw_OI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1055, 21, 'Form Validation and CSS', 'E6b03jxdpcs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1056, 21, 'Text Field Form Validation', 'bzsPKmGtpPw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1057, 21, 'Custom Text Fields', '6jEb7yB8Nd4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1058, 21, 'More on Custom Text Fields', 'rxOYWlWkGiI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1059, 21, 'Form Validation of Text Area', '_b6PPCB_DHk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1060, 21, 'Form Validation of Password', 'VMgyslLYKsg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1061, 21, 'Form Validation of Checkboxes', 'enYbzehwjQc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1062, 21, 'Spry Validation of a Dropdown List', 'CT_G69nezdo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1063, 21, 'Form Validation of a Confirmation', '2CQjJ4x-RvE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1064, 21, 'Spry Validation of Radio Groups', '7jRzaL2ONf8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1065, 21, 'Finishing up Forms', 'moOTMZGT_K4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1066, 21, 'Tabbed Panels', 'JMW6q4bKzMI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1067, 21, 'Accordian', 'zqfgUCfDHLE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1068, 21, 'Collapsible Panels', '2CR61X4tlP8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1069, 21, 'Tool Tips', 'X_GW90Bmeg0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1070, 23, 'Algebra Applications with Angles', '4vVmsyP4G_I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1071, 23, 'Transformations Review and Graphing Transformations', '2A3c2YO3hv0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1072, 23, 'Triangle Inequality', 'kQZenwLkVDg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1073, 23, 'Proving Triangles Congruent', 'rp34O51CPvw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1074, 23, 'Nonlinear Equations - Parabolas', 'o3IUHdz45cc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1075, 23, 'Nonlinear Equations - Circles', 'up_US3NSwng');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1076, 23, 'Nonlinear Equations - Eclipses', 'juEmRdlSC-M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1077, 23, 'Nonlinear Equations - Hyperbola', 'LDpCjklo6AQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1078, 23, 'Triangle Proofs', 'jgJ11Vu0Sk0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1079, 23, 'Proving Triangles are Similar', 'l3CdgBidZ4E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1080, 23, 'Solving any Triangle - Law of Cosines', '23407mDm9xA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1081, 23, 'Solving any Triangle - Law of Sines', '7PP6LyP9EOw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1082, 23, 'Proving Parallelograms', 'G0Qgz51tjy0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1083, 23, 'More Practice with Proving Parallelograms', 'pa9iac9tcF4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1084, 23, 'Arc Length and Sector Area', 'L5Z4DHNicSM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1085, 23, 'Proof Practice', 'HYkO-wrIH1c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1086, 23, 'Prisms - Volume, Lateral Area, and Total Area', '7OvA2oxsA3c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1087, 23, 'Right Circular Cylinder - Volume, Lateral Area, and Total Area', 'W3TSRirDU6c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1088, 23, 'Pyramids - Volume, Lateral Area, and Total Area', '8n12p11VB-k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1089, 23, 'Right Circular Cone- Volume, Lateral Area, and Total Area', 'Nw7KCNzk1Ak');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1090, 23, 'Logic', 'kW9ESJgb2v4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1091, 23, 'Proofs Using Definition of Bisect', 'A6GcGPTRPLY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1092, 23, 'Proving Lines Perpendicular', '2He3UdcoQko');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1093, 24, 'Choosing a CPU', 'NNbEBARu6LY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1094, 24, 'More on CPUs', '9LdtybJbP3U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1095, 24, 'Choosing a Motherboard', 'QTBA7Orz8cQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1096, 24, 'More on Choosing a Motherboard', 'A-65CSiSmL8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1097, 24, 'Choosing RAM', 'UGLAwF6SO28');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1098, 24, 'More on RAM', 'Y7uBoOA11Pw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1099, 24, 'Choosing the Hard Drive', 'HjnuA8FlPVc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1100, 24, 'More Stuff About Hard Drives', 'CwEn9gYE-Dk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1101, 24, 'Choosing an Optical Drive', 'goqQ5TOGwFA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1102, 24, 'More on Optical Drives', 'nlkJwaG5hbE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1103, 24, 'Choosing a Case', '11_cm66HXgI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1104, 24, 'More on Cases', 'b63fgqXGvRc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1105, 24, 'Power Supplies', 'oJGY_sc8jc4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1106, 24, 'The Motherboard', 'I9x52cH3lWA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1107, 24, 'Installing the CPU', 'H8vZbW7ZNpE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1108, 24, 'Installing CPU Fan', 'GkyYHSRQYUI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1109, 24, 'Installing the RAM', 'pemQxhE7Jhk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1110, 24, 'Preparing the Case', 'Abr_Lj-umBE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1111, 24, 'Mounting the Motherboard', 'QsGxYQlYYlU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1112, 24, 'Installing the Optical Drive', 'AMPl4hTpni8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1113, 24, 'Installing the Hard Drive', 'zyYUTuuh7zo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1114, 24, 'Installing the PSU', 'dPYkv8p2cSw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1115, 24, '100k views Free Computer Giveaway', 'PtQ7O5jZK6U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1116, 25, 'Common String Methods', 'vW53w7me4AE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1117, 25, 'Some More String Methods', 'Qi09pWsc7nA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1118, 25, 'Recursion', 'fpuWkZs51aM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1119, 25, 'Introduction to Collections', 'jU5ACV5MucM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1120, 25, 'ArrayList Program', 'uoLgfgcB3XQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1121, 25, 'LinkedList', 'BRcY2vIr-EQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1122, 25, 'LinkedList Program', 'rW2OppsgJjQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1123, 25, 'Converting Lists to Arrays', 'Sj2kCLjZZgk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1124, 25, 'Collections Method sort', '1QhS0aTiFhQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1125, 25, 'Methods reverse and copy', 'CfJCamxV3NQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1126, 25, 'Collections Methods fill', 'C_etrOreNQM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1127, 25, 'addAll', 'pUT9C9Mo0WM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1128, 25, 'frequency, disjoint', '_8JMw7VATZA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1129, 25, 'Stacks, push, pop', '8TMBjfS8wY0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1130, 25, 'Queue', 'ZRs6dN_xUU0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1131, 25, 'HashSet', 'Wd4jfE-iNnE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1132, 25, 'Generic Methods', 'J6B_qauxfuc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1133, 25, 'Implementing a Generic Method', 'ZoJaD0Qoi0o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1134, 25, 'Generic Return Types', 'QB5pQT45zvg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1135, 25, 'Introduction to Applets', '2owQOOuRX60');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1136, 25, 'How to put an Applet on a Website', 'P6skXp4sLdQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1137, 25, 'init for Applets', 'Ud9G_AFqTsk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1138, 25, 'Drawing an Oval with Slider', 'ME4k3U05RMo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1139, 25, 'Building the Window for the Slider', 'I1X9QUb-C1k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1140, 25, 'Finishing the Oval Slider Program', 'X8ffr3UeE8c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1141, 25, 'Learning about Threads', 'VYN-CBtPNiM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1142, 25, 'What do I look like, a Thread?', 'oUSpVDbT5eg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1143, 25, 'Beginning Networking', 'dlgnmZD-Dzk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1144, 25, 'Making a Simple Networking Applet', 'CadrkLb4AAU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1145, 25, 'init for Networking Applet', 'nZJbjC7pOl0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1146, 25, 'Listening for User Events', 'vrl8AJCSKL4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1147, 25, 'Getting the Data from the HTML File', 'FMV1eMapiSY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1148, 25, 'Uploading and Testing the Applet', 'kXGHTYRgjgk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1149, 25, 'Creating a Simple Web Browser', 'anoPsxasIBE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1150, 25, 'Building the GUI', '1Fqeik0iN3s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1151, 25, 'loadCrap', 'PVOG57JaHPg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1152, 25, 'Best Browser Ever?', '1mHqkbt0w6Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1153, 25, 'Awesome Instant Messaging Program with Streams and Sockets', 'pr02nyPqLBU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1154, 25, 'GUI for Bucky Instant Messenger', '9gDErZCtdzM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1155, 25, 'Setting Up the Server', 'vJ3jAaKPFIU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1156, 25, 'Waiting for a Connection', '7Y2rj3tFQK0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1157, 25, 'Setting Up the Streams', 'OqPH0SSjjH0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1158, 25, 'whileChatting', 'pERSi0SjgyI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1159, 25, 'Closing Down the Streams and Sockets', 'KenYq5Na8QY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1160, 25, 'How to Send Messages', 'r-yuvNv58nM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1161, 25, 'Displaying Messages in the Chat Window', 'S8bEQMYDzkU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1162, 25, 'Giving the User Permission to Type', 'Vlu2m5wCwjg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1163, 25, 'Testing the Servers Instant Messenger', 'MYjodmqION0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1164, 25, 'Beginning the Client Messaging System', 'Igx1uEfCcXI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1165, 25, 'showMessage and able To Type', 'd0E7xVgiWog');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1166, 25, 'Sending Messages to the Server', '-5SDy0am1QI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1167, 25, 'Closing Down the Client Stuff', '_hP3IfnrJ5U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1168, 25, 'whileChatting Client', 'eEmfeZNF_f4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1169, 25, 'Setting Up the Client Streams', 'r8qUd4lINmI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1170, 25, 'Creating the GUI for the Client', 'YFqVL2qSMs0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1171, 25, 'Setting Up the Client for Chatting', 'a_4NM9duhSY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1172, 25, 'Connecting to the Server', 'XJpgUbUzGOg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1173, 25, 'Finishing the Coding for the Instant Message Program', 'qEcztLI84A4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1174, 25, 'Running Buckys Instant Messenger!', 'pyqThWRHiHA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1175, 26, 'What is Biology?', 'CiaxT_4zvx0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1176, 26, 'Definition of Life & Classification', 'vsvhGCoPYIw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1177, 26, 'Basic Chemistry', 'NjB_wVDe104');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1178, 26, 'Some More on Chemistry', 'Vry5s0Yh3z4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1179, 26, 'Cell Chemistry', 'EjJR9cBeQl8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1180, 26, 'Carbohydrates, Lipids, Proteins, & More!', 'c1WEL2CQeDc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1181, 26, 'Structure of a Cell', 'hW4Fr2ToS9E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1182, 26, 'Binary Fission and Mitosis', 'E8_1S8tBwzQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1183, 26, 'Meiosis', 'wtv1Q2PMdQM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1184, 26, 'Enzymes', '3iIt8pFg9tA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1185, 26, 'Glycolysis', 'PL5FpRwPAKM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1186, 26, 'TCA / Citric Acid / Krebs Cycle', 'DgA6HMxE-9c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1187, 26, 'Introduction to Photosynthesis', 'Apd-CxLNoo4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1188, 26, 'More on Photosynthesis', 'dFYZKuTs1N8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1189, 26, 'Even More on Photosynthesis', 'NIeXGEc7V2I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1190, 26, 'Cell Signaling', 'Su_54K4UZxg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1191, 27, 'Congruence and Naming Properties of Segments ', 'IxWfRmYbHYc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1192, 27, 'Naming and Classifying Angles', 'nRTte86myIY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1193, 27, 'Congruence & Addition Properties of Angles', 'Z7fQtbtnPUQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1194, 27, 'Special Angle Pairs', 'Ba3E92Vv8os');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1195, 27, 'Classifying Triangles by Sides', 'kepsp-97qUI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1196, 27, 'Classifying Triangles by Angles', 'XXPi2Nv0Z8A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1197, 27, 'Interior Angles of Triangles', 'd3d9mSGlCFc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1198, 27, 'Two Triangle Inequality', 'MnFSXeGXvl4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1199, 27, 'Square and Square Roots', 'YyTqiIv9Mgc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1200, 27, 'Right Triangles (Pythagorean Theorem))', '_CFUymayOiA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1201, 27, 'Special Right Triangles', 'AV6Bfl0ryaY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1202, 27, 'Right Triangle Trigonometry', 'xDWw0ipGXnY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1203, 27, 'Transformations', 'tPWFnFsjSBY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1204, 27, 'Parts of Congruent Triangles', 'ymD7nHz7EQA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1205, 27, 'Congruent Triangles SSS, SAS', 'ZVtPNgthV_w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1206, 27, 'Congruent Triangles ASA, AAS', '9wimnki44N4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1207, 27, 'Congruent Triangles HL', 'H05qJb52yBU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1208, 27, 'Properties of Isosceles Triangles', 'N6AqZRaWxLQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1209, 27, 'Ratios & Proportions', 'ocGvDXAja-k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1210, 27, 'Similar Triangles', 'JuIb2426C4o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1211, 27, 'Identifying Similar Triangles AA', 'E4nMxd_6N-M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1212, 27, 'Identifying Similar Triangles SAS, SSS', 'IBtgu_dlGfA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1213, 27, 'Perimeter and Similar Triangles', 'nH50RxGA50A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1214, 27, 'Parallel and Perpendicular Triangles', 'vMN1Kl_jb3s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1215, 27, 'Angles formed by Intersecting Lines', 'iAK2eRwal4o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1216, 27, 'Corresponding Angles Formed by Parallel Lines', 'S-HhK-IRjBk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1217, 27, 'Other Angles Formed by Parallel Lines', 'SAxDjFRUS4c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1218, 27, 'Parts of Polygons', 'UhCwBNFEleA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1219, 27, 'Classifying Polygons', '_01VVaulMME');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1220, 27, 'Angle Measures in Convex Polygons', 'SAKwNjzyjE0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1221, 27, 'Angle Measures of Regular Polygons', 'mHhAybHejCU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1222, 27, 'Parallelograms', 'FKWFlFDklbQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1223, 27, 'Special Parallelograms', '7RyMPMlDyFg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1224, 27, 'Trapazoids', 'O8S7lgA9QIs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1225, 27, 'Midpoint Segments', '9eBEUbbey7Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1226, 27, 'Ordered Pairs and Graphing', '-r6EMlL-fkI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1227, 27, 'Distance Formula', 'Rr40dLlEwrE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1228, 27, 'Midpoint Formula', '22sAUro4iyI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1229, 27, 'Slope of a Line', '2ePQ8dy09PY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1230, 27, 'Equation of a Line in Slope Intercept and Standard Form', 'TbY42AZy_gg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1231, 27, 'Graphing Lines', 'HXfYzQ6dzK0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1232, 27, 'Solving Systems of Equations by Graphing', 'kJkeg_JmxwE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1233, 27, 'Solving Systems of Equations by Elimination', '9dBulrQgIqk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1234, 27, 'Parts of a Circle', '_sSDNFZ26bg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1235, 27, 'Secants and Tangents', 'GxBN5FLMklw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1236, 27, 'Arcs and Angles', 'byeYQhzrRXA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1237, 27, 'Arcs and Angles, Inscribed Angles', 'b9Hk7RMkQ94');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1238, 27, 'Arcs and Chords, Perpendicular Bisector', '1geb9KJAmsA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1239, 27, 'Length of Segments in a Circle', 'H5lOAdMprdU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1240, 27, 'Perimeter', 'sqbOnkgHId8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1241, 27, 'Perimeter and Ratios', 'ffs-DCMmgxY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1242, 27, 'Area of Rectangles and Squares', 'Vq7MM-riLfs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1243, 27, 'Area of Parallelograms and Triangles', 'nQHh6Ggl3Wg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1244, 27, 'Area of a Trapezoid', 'Q3zLfX5AkWg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1245, 27, 'Circumference of a Circle', 'eJbzCyMcX2U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1246, 27, 'Area of a Circle', 'lOoIqCUHi7g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1247, 27, 'Surface Area of Prisms', 'fklWu5-Jk7w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1248, 27, 'Volume of Prisms', 'E70O3cZizwQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1249, 27, 'Surface Area of a Cylinder', 'Z9qw38iqQxk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1250, 27, 'Volume of a Cylinder', 'iIzbPunK1Sk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1251, 27, 'Surface Area of a Pyramid', 'BTJ2ODBea4c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1252, 27, 'Volume of a Pyramid', 'p2BhX1On6O4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1253, 27, 'Surface Area of a Right Circular Cone', 'o42gKBC22WA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1254, 28, 'Installing Xcode and the iPhone SDK', 'abcMmyhKCno');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1255, 28, 'Adding a Text Label to the Screen', 'cXCOr8CWM0c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1256, 28, 'How to Make a Sweet App Icon', 'SXovxDL2B8A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1257, 28, 'Finally, Beginning User Interaction!', 'B7jB0D3Y7Ws');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1258, 28, 'Oh Yea, Coding the Action Methods', 'jUbnUFWIZgI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1259, 28, 'Connecting Outlets and Actions and stuff', 'Grf_RRwyNZw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1260, 28, 'More on User Interaction', 'CZrMt0qVf58');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1261, 28, 'Adding Images and Text Fields', 'g_KaTlRC2ao');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1262, 28, 'Getting Rid of Keyboards', '7-QFzN-p7oU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1263, 28, 'How to make Sliders)', 'wBAWV-Tz5v8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1264, 28, 'Finishing the Slider Program', '-CDcsaFC-tw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1265, 28, 'Segmented Controls', 'f5677_q3HlU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1266, 28, 'Coding the Switches Method', 'xtqdm_eSI1M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1267, 28, 'Running the Segmented Controls Program', 'hGv580Me6k8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1268, 28, 'How to create Action Sheets', 'UXJM8Vcc6b8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1269, 28, 'Making Alert Boxes', 'YlXQUQh7Sd4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1270, 28, 'Autosizing and Autorotation', 'f3yb24f8O1Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1271, 28, 'Size Inspector', '7lzbVURh4mM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1272, 28, 'Manually Positioning Objects', 'gQg_T9UcpQw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1273, 28, 'Finishing the Program with Bigger Buttons', 'xFjUcOTggkY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1274, 28, 'Intro to Multiview Apps', 'VoW7Knkb1s0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1275, 28, 'Working with the SwitchClass', 'jybmCY-NrWk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1276, 28, 'Changing MainWindow.xib', 'NwBey8Jknxk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1277, 28, 'viewDidLoad Method', 'bm0iRREC5ZU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1278, 28, 'Crap Loads of Code', '3YoclS46Irs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1279, 28, 'Finishing the Multiview App', 'MwzFWnCux6s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1280, 28, 'Intro to Pickers', 'Iu996FvfSf8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1281, 28, 'Adding a root controller', 'YpIcEE-Rz8M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1282, 28, 'Adding the Picker', 'TUiv5furU68');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1283, 28, 'Finishing the Date Pecker', '3Cc0OIKL9_U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1284, 28, 'Single Pecker', 'I6kX4ZHo0SU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1285, 28, 'Creating the Array for singlePecker', 'D-1EGeg2kr8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1286, 28, 'Finally finishing this dumb program!', 'IMHLpmvhkMw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1287, 28, 'How to Save Data', 'VblMOSymSGU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1288, 28, 'Saving Files', 'Jo_FEH2LJfY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1289, 28, 'Loading the Files', 'qwtSL9qJmWI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1290, 28, 'Dont Touch Me There!', 'Qo_nMJ6D65c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1291, 29, 'Call of Duty World at War Zombies', 'L1XiXHXg638');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1292, 29, 'Bejeweled 2', 'YiMdcu8UVts');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1293, 29, 'DoodleJump', 'Uox4PugPaQc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1294, 29, 'Skee-Ball', 'B8Su0kLHTv0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1295, 29, 'High School Super Star!', '-1ay4OgxvE8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1296, 29, 'Unblock Me', 'j1-bKv0X6xs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1297, 29, 'iMobsters', 'yBKYLA47pY4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1298, 29, 'Kingdoms Live', '2kD3XNYd9Cs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1299, 29, 'The Sims 3', 'bkU5RVdl3Qc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1300, 29, 'NOVA', 'Kmejcf4Gpnk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1301, 29, 'Need for Speed Shift', 'k3I6r9Ww10Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1302, 29, 'The Weather Channel Max', '96zfA8VeynQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1303, 29, 'AllRecipes Dinner Spinner', 'Wk0Uc_uyWFE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1304, 29, 'MLIA My Life is Average', 'lSeACF1-9-4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1305, 29, 'Fandango', 'nlgCvRRpbJI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1306, 29, 'The Moron Test', 'SZCcBfBojvc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1307, 29, 'iTrade', 'AduBLCt3JK4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1308, 29, 'FML', 'lG4WhCRa4Qc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1309, 29, 'Lets Golf!', 'x5cLDE_v3_A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1310, 29, 'Zombieville USA', '5eI1OWungF8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1311, 29, 'PapiRiver', 'H8srunpMvb4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1312, 29, 'Crush the Castle', 'cWoXJobjl_8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1313, 29, 'Action Potato', 'DoBos79HDRk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1314, 29, 'Lemonade Tycoon', 'MKz73OXDNyM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1315, 29, 'Scoops', '2dpZCoi4xFk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1316, 30, 'Threads', 'hBhAWTSu104');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1317, 30, 'Starting Threads', 'XMbXnRGkRsE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1318, 30, 'Creating a Screen for Games', '_Nt1KvRZ64A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1319, 30, 'Restoring Screen Size', 'vElmkRPpev8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1320, 30, 'Creating a Full Screen Display', '9wJqWfMXMMQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1321, 30, 'Making Text Smooth', 'sSho1X9ZUdA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1322, 30, 'Loading Images', '5jb3rOeIiOQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1323, 30, 'Beginning Animation', 'wb1q7Mqosy4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1324, 30, 'Changing Scenes', '0aB_9L0OlDQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1325, 30, 'Finishing the Animation Class', 'H1hYVvhNzsA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1326, 30, 'Loading Pictures for the Movie', 'qCeGi4m-jyo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1327, 30, 'Main Movie Loop', '9btO2IRuJwE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1328, 30, 'Completing the Animation', 'UMli3e0zHas');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1329, 30, 'Making a Better Screen Class', 'vzfnUSLKUDs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1330, 30, 'Finding Compatible Modes', 'roWl3dsfucA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1331, 30, 'Comparing Display Modes', 'WeZNExun6IU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1332, 30, 'Full Screen with Buffer Strategy', 'nzHDQvzUXL0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1333, 30, 'Updating Display and Restore Screen', 'KKtjhDw6omc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1334, 30, 'Compatible Buffer Images', 'oAwrpKuBZCI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1335, 30, 'Creating Display Modes List', 'mxQmrP8lHVE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1336, 30, 'Run and Movie Loop Methods', 'tcPVLbuDyRY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1337, 30, 'Finishing the Perfect Animation', 'c74DlUMbeZI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1338, 30, 'Introduction to Sprites', 'xKGpBl3D0v0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1339, 30, 'Finishing the Sprite Class', 'q1glr6ValIo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1340, 30, 'Starting the Sprites Movement', '6DZoAbp04Mw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1341, 30, 'Watching the Sprite Move', 'sfECvOR--Xk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1342, 30, 'Creating a Core Class', '4Q0hgzl-wWg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1343, 30, 'Intro to Keyboard Input', '4r00P_EoZg0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1344, 30, 'Handling Key Events', 'eIMq17AdV8Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1345, 30, 'Final Keyboard Input', '5IjVJKZPbPM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1346, 30, 'User Mouse Input', 'i71FoOnA4x0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1347, 30, 'Final Mouse Input', 'aS-K0KY1A0k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1348, 30, 'Intro to Mouselook', 'pPyUyF9qkxE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1349, 30, 'Mouselooks draw Method', 'BPT-rPoq5p8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1350, 30, 'Using the Robot', 'BpJhWlqBB0g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1351, 30, 'Final Mouselook Program', 'xMe4CLmNnFk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1352, 31, 'Installing the JDK', 'Hl-zzrqQoSE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1353, 31, 'Running a Java Program', '5u8rFbpdvds');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1354, 31, 'Downloading Eclipse', 'CE8UIbb_4iM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1355, 31, 'Hello YouTube', 'SHIT5VkNrCg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1356, 31, 'Variables', 'gtQJXzi3Yns');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1357, 31, 'Getting User Input', '5DdacOkrTgo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1358, 31, 'Building a Basic Calculator', 'ANuuSFY2BbY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1359, 31, 'Math Operators', '8ZaTSedtf9M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1360, 31, 'Increment Operators', 'ydcTx6idTs0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1361, 31, 'If Statement', 'iMeaovDbgkQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1362, 31, 'Logical Operators', 'PAaqgTr7Cx4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1363, 31, 'Switch Statement', 'RVRPmeccFT0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1364, 31, 'While Loop', '8ZuWD2CBjgs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1365, 31, 'Using Multiple Classes', 'XqTg2buXS5o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1366, 31, 'Use Methods with Parameters', '7MBgaF8wXls');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1367, 31, 'Many Methods and Instances', '9t78g0U8VyQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1368, 31, 'Constructors', 'tPFuVRbUTwA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1369, 31, 'Nested if Statements', 'Y4xFGCyt1ww');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1370, 31, 'else if Statement', 'C0YRYVn_BeI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1371, 31, 'Conditional Operators', 'Y6NheSwTsDs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1372, 31, 'Simple Averaging Program', 'KXuQQh6AynQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1373, 31, 'for Loops', 'rjkYAs6gAkk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1374, 31, 'Compound Interest Program', 'T9TcAm9g0mo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1375, 31, 'do while Loops', 'nfr52iR0Pyg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1376, 31, 'Math Class Methods', 'JzMdepMLW44');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1377, 31, 'Random Number Generator', 'AhwIYAXPASw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1378, 31, 'Introduction to Arrays', 'L06uGnF4IpY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1379, 31, 'Creating an Array Table', 'nTF-RcgsV0E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1380, 31, 'Summing Elements of Arrays', 'etyrkipdKvc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1381, 31, 'Array Elements as Counters', 'pHxtKDENDdE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1382, 31, 'Enhanced for Loop', 'w41D0V-BnKQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1383, 31, 'Arrays in Methods', 'rzXoz2KOP7E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1384, 31, 'Multidimensional Arrays', 'ctab5xPv-Vk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1385, 31, 'Table for Multi Arrays', 'hbot9MQVHOM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1386, 31, 'Variable Length Arguments', 'BFL1oWnEO2k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1387, 31, 'Time Class', 'o4Or0PMI_aI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1388, 31, 'Display Regular time', 'E0BTAqIltFc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1389, 31, 'Public, Private and this', 'csjfLTt6-io');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1390, 31, 'Multiple Constructors', 'LS7BzkBzn3Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1391, 31, 'Set and Get Methods', 'eqP5X6APc5w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1392, 31, 'Building Objects for Constructors', 'MK2SMJZbUmU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1393, 31, 'toString', 'l0N6WvIVoUI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1394, 31, 'Composition', 'ZBkyPA6NZR8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1395, 31, 'Enumeration', 'uFGrL5vyp54');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1396, 31, 'EnumSet range', 'r-_6fJpC-pk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1397, 31, 'Static ', 'Mhxp5dZOy78');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1398, 31, 'More on Static', '14c1oJjgC8g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1399, 31, 'final', 'Suxdg95FV1w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1400, 31, 'Inheritance', '9JpNY-XAseg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1401, 31, 'Graphical User Interface GUI', 'jJjg4JweJZU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1402, 31, 'GUI with JFrame', 'jUdIAgJ7JKo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1403, 31, 'Event Handling', '3EE7E3bvfe8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1404, 31, 'ActionListner', 'qhYook53olE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1405, 31, 'Event Handler Program', 'M1_-sigEPtE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1406, 31, 'Intoduction to Polymorphism', '0xw06loTm1k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1407, 31, 'Polymorphic Arguements', 'KKbN5pjBZGM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1408, 31, 'Overriding Rules', 'zN9pKULyoj4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1409, 31, 'Abstract and Concrete Classes', 'TyPNvt6Zg8c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1410, 31, 'Class to Hold Objects', 'slY5Ag7IjM0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1411, 31, 'Array Holding Many Objects', '0--h2x6HENA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1412, 31, 'Simple Polymorphic Program', '6d0m_L8_1XU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1413, 31, 'JButton', '6iV-v_m0z0w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1414, 31, 'JButton Final Program', '3RQOikbGGUM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1415, 31, 'JCheckBox', '_UuDuj-RNRg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1416, 31, 'The Final Check Box Program', 'Y8zKDsenQFA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1417, 31, 'JRadioButton', '_d4CU9MveLE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1418, 31, 'JRadioButton Final Program', '-ptlsT9KsM8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1419, 31, 'JComboBox', 'vd-k2oBMXUI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1420, 31, 'Drop Down List Program', 'XS4-5GmRnp8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1421, 31, 'JList', 'GBlKa8cNROM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1422, 31, 'JList Program', 'aLkkYbHz16E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1423, 31, 'Multiple Selection List', '9z_8yEv7nIc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1424, 31, 'Moving List Items Program', '68X8RUxeXeA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1425, 31, 'Mouse Events', 'hsHqhX0s7Rs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1426, 31, 'MouseListener interface', 'MpIHF4V3zMc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1427, 31, 'MouseMotionListener interface', 'sdUJR_DSyBU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1428, 31, 'Adapter Classes', 'UuKNGMCfSkQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1429, 31, 'File Class', '7fC9nL3_AQQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1430, 31, 'Creating Files', 'G0DfmD0KKyc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1431, 31, 'Writing to Files', 'Bws9aQuAcdg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1432, 31, 'Reading from Files', '3RNYUKxAgmw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1433, 31, 'Exception Handling', 'K_-3OLkXkzY    ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1434, 31, 'FlowLayout', 'DFQzFJqOSbA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1435, 31, 'Drawing Graphics', '2l5-5PMUc5Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1436, 31, 'JColorChooser', '052U-bWEXrk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1437, 31, 'Drawing More Stuff', 'OWOeE90ET6w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1438, 31, 'Series Finale', '38UOAo1c_QA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1439, 32, 'Introduction to jQuery', 'GNb8T5NBdQg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1440, 32, 'An Example', 'PF7q6gweods');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1441, 32, 'Implementing jQuery', '1suGhgdpBGI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1442, 32, 'Testing jQuery', '1BSlmxZWNPk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1443, 32, 'Inline/External Scripting', 'DWovwudaP94');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1444, 32, 'Document Ready Event', 'ydchsJYj_Mg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1445, 32, 'Ready', 'SrsbCwq5MUA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1446, 32, 'Load', 'enc-dParMg4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1447, 32, 'Window Load', 'qtlVcqJ0gyU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1448, 32, 'Window Unload', 'sUiP7ylzTYc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1449, 32, 'Introduction to Selectors', 'UcVDmvED4uo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1450, 32, 'All selector', 'hiT2MvfyyEY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1451, 32, 'ID selector', 'rG0ORGjkIi0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1452, 32, 'Element selector', '9u7Fp2VVdkM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1453, 32, 'Submit selector', 'NoRhRb57hlo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1454, 32, 'Text selector', 'Xw3CRw5R0_k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1455, 32, 'A selector example with CSS', 'RcCjHE8BrSA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1456, 32, 'Multiple selectors', 'itfAmsLb3qU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1457, 32, 'This selector', 'U7qqnSH1APM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1458, 32, 'Even/odd selectors', 'NM9ZDQONSLc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1459, 32, 'Attribute selectors', 'SHe_Sy_cP7M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1460, 32, 'Attribute selectors', 'nh0ZQLO0FMo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1461, 32, 'Contains selector', 'XuiN5mUeduw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1462, 32, 'Contains selector', 'jIZFHjkUCrs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1463, 32, 'Basic form field selection', 'QsWORQctsX4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1464, 32, 'Basic form field selection', 'p0vpi94a3oM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1465, 32, 'Font size switcher', 'OnpItGNnUd8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1466, 32, 'Font size switcher', 'jPF0h6AryfY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1467, 32, 'Enable submit button after file selected', 'oofKo2dGOnU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1468, 32, 'Enable submit button after file selected', 'JzEDEJ8KqqI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1469, 32, 'Click', 'YxREwE-mriY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1470, 32, 'Double click', '_0Dr65u6Y-0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1471, 32, 'Key up/down', 'x-OfkxJKZX8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1472, 32, 'Change', 'bcHae_D43ZU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1473, 32, 'Submit', 'gI07mEgaZ3E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1474, 32, 'Toggle', 'VZBkc4qS2IE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1475, 32, 'Hover', 'qbSuGSRl2IQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1476, 32, 'Scrol', '2iFwLQNMmN4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1477, 32, 'Select', 'Zp6s5hC3AA8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1478, 32, 'Focus in', 'qIfVGUOciKY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1479, 32, 'Focus out', '47fzxu6REwg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1480, 32, 'Bind', 'FvD4i1W0nxQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1481, 32, 'Live', 'WDftw56YF6o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1482, 32, 'Live', 'LrWCff-cj_E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1483, 32, 'Character Counting Remaining on Textarea', '13bceSHothY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1484, 32, 'Character Counting Remaining on Textarea', 'BqcI0N87Xzw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1485, 32, 'Hide/Show a DIV', 'UHEcKmoMBZo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1486, 32, 'Hover over description', 'GkwbN3fTgE0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1487, 32, 'Hover over description', 'thkTtgg_dB4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1488, 32, 'Hover over description', 'SL0yz6iyMwI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1489, 32, 'Hover over description', '_GrWaN05-Vs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1490, 32, 'html', 'wnDhjAGohyY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1491, 32, 'val', 'GdAPeB4KkMg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1492, 32, 'attr', 'tC6gWcLSEtY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1493, 32, 'addClass', 'H5wjj_RSSM0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1494, 32, 'removeClass', 'lJeuBEkt5VA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1495, 32, 'toggleClass', 'jSeU54-BVXA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1496, 32, 'removeAttr', 'x-AeFbi-00g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1497, 32, 'removeAttr', 'tDGaNKFfuc8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1498, 32, 'each', '0M6Ig0kfwmo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1499, 32, 'each', '6yBxPRo7RbY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1500, 32, 'next/nextAll and prev/prevAll', 'T1X32363Pew');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1501, 32, 'next/nextAll and prev/prevAll', 'r78nAN_pl0k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1502, 32, 'find', '6r1TXflpOiw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1503, 32, 'has', 'Clstoqr2ioo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1504, 32, 'Hide', '4g0vxRl86Eg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1505, 32, 'Show', 'wY3gbIXdBWs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1506, 32, 'Fade In', 'XDjsEsq915A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1507, 32, 'Fade Out', 'WnPs_NbVwFA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1508, 32, 'Fade Toggle', 'vv88l6K8UlA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1509, 32, 'Slide Down', '1YE_4PAdLnw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1510, 32, 'Slide Up', 'lR6Avn7hfIE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1511, 32, 'Slide Toggle', 'z170ZArKs8Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1512, 32, 'Stop', '0U6GJmP32wE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1513, 32, 'Delay', 'kNTbLIUFtgI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1514, 32, 'Gallery Fading Effect', 'diEhs-DXMy8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1515, 32, 'Gallery Fading Effect', 'ODmkKXj5CIQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1516, 32, 'append', 'onpTjGzFPcg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1517, 32, 'appendTo', 'ePN0HEvcHTY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1518, 32, 'clone', 'SGSRG0D8w5M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1519, 32, 'width/height', '0-gTZ7oPLzg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1520, 32, 'width/height', '-ujSSmDHby0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1521, 32, 'scrollTop', 'AwgODLLSgwU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1522, 32, 'Adding to a dropdown menu', 'EeuVoXgroso');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1523, 32, 'Placing DIV in very center of window', 'M1zvjaXylJE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1524, 32, 'Placing DIV in very center of window', 'sRKVX_eAusY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1525, 32, 'Minimum text field length', 'JQ1YPgXF4io');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1526, 32, 'Minimum text field length', '8ocO8C4tpqU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1527, 32, 'Scroll to top', 'FixZpR7TWTc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1528, 32, 'Enabling checkbox after scrolling', 'O929dtVphpg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1529, 32, 'Enabling checkbox after scrolling', 'Pq-jnNIB0Pg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1530, 32, 'inArray', 'xYwt5t32sec');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1531, 32, 'each', 'jcqbfcm6C54');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1532, 32, 'now', '9Yh-9f5ievM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1533, 32, 'Days until event', 'dYVq7y8yw40');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1534, 32, 'Load file', 'myYvsqhjG3g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1535, 32, 'GET HTTP Request', 'jUZ4TeR2dYA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1536, 32, 'GET HTTP Request', '98fSxqw-n94');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1537, 32, 'POST HTTP Request', '900LWBWR_mI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1538, 32, 'Other callback functions', 'vdpZT398koI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1539, 32, 'AJAX Load', 'SbQUJdimia4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1540, 32, 'AJAX Send Data', 'ra0X0GKkuJ8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1541, 32, 'AJAX Callback Handlers', 'icCIq3fnIQM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1542, 32, 'Changing AJAX data type', 't8CLLnVKCII');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1543, 32, 'AJAX Status Codes', 'pRsTOqrpRfU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1544, 32, 'Email validation', 'lMplDkrjKhg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1545, 32, 'Email validation', 'cNrfxRrkXW0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1546, 32, 'Email validation', 'Rj4xnuBH2no');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1547, 32, 'Email validation', '9h17R1PeUSY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1548, 32, 'Email validation', 'sNMD4jYemzA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1549, 32, 'Updating database table values', 'DC6zoiCAS3k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1550, 32, 'Updating database table values', 'zpR5dRVS-Pg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1551, 32, 'Updating database table values', 'jIArixb4fi8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1552, 32, 'Updating database table values', 'JwkWKwt7DRM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1553, 32, 'Introduction to Plugins', 'giFJ86CGUOw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1554, 32, 'Show password plugin', 'iKeg4IHjl-U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1555, 32, 'Show password plugin', 'An2SBo-8-1w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1556, 32, 'Creating a basic plugin', 'kmZCJxFeCUE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1557, 32, 'Creating a basic plugin', 'dR5c-fqwecs    ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1558, 32, 'Creating a basic plugin', 'QjctNokqleI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1559, 32, 'Highlight search plugin', 'uaryzn1IgJA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1560, 32, 'Highlight search plugin', 'yKLU9VCp3wI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1561, 32, 'Passing options to plugin', 'rceI52fq0MA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1562, 32, 'Passing options to plugin', 'OSCcEzxm-cU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1563, 32, 'Plugin callback functions', 'veaqFjCALCU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1564, 32, 'Plugin callback functions', '8i0LmnDkAbk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1565, 32, 'Creating a hover text plugin', '1bFjEN9vT_8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1566, 32, 'Creating a hover text plugin', '7p6ttNLWs_U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1567, 32, 'Creating a hover text plugin', 'nm9Y1I9P9es');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1568, 32, 'Creating a hover text plugin', 'ThePhWSUm70');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1569, 32, 'Creating a hover text plugin', 'NrMTqFuYdd8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1570, 32, 'Creating a hover text plugin', 'Vs2B5-lSY88');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1571, 32, 'Creating a day/hour/min/sec countdown plugin', 'z290okjnAnM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1572, 32, 'Creating a day/hour/min/sec countdown plugin', 'vziNlivCTk8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1573, 32, 'Creating a day/hour/min/sec countdown plugin', 'ryB1mkigmo8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1574, 32, 'Creating a day/hour/min/sec countdown plugin', 'o7fFdU25Ty4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1575, 32, 'Creating a day/hour/min/sec countdown plugin', 'QRc5cpUzUSk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1576, 32, 'Creating a day/hour/min/sec countdown plugin', 'ABOk--HrZ6Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1577, 32, 'Introduction to jQuery UI', 'KHk3bS-c6uk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1578, 32, 'Installing jQuery UI', 'NoH41RObujo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1579, 32, 'Draggable', 'WLdlB76wqv0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1580, 32, 'Draggable', 'iijxeW-G2hk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1581, 32, 'Draggable', 'feyT2GF8Eik');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1582, 32, 'Droppable', 'ey32VxTGaZ0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1583, 32, 'Droppable', 'DU8FXb6tZPU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1584, 32, 'Droppable', 'IatuTDyDv0M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1585, 32, 'Sortable', '4dc7urwLYmQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1586, 32, 'Sortable', '09TJJjAgLLo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1587, 32, 'Resizable', 'JL5oHGxovFk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1588, 32, 'Resizable', 'wU25RQpaitA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1589, 32, 'Resizable', '4RQk_CMTjJs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1590, 32, 'Accordion', 'hvOqlCha1SQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1591, 32, 'Accordion', 'uHixbmuVfak');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1592, 32, 'Datepicker', 'tkKrvgANv8A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1593, 32, 'Datepicker', '5sK7cw2Ph9k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1594, 32, 'Dialog', 'cxlqp60HVmA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1595, 32, 'Dialog', '4abdx8SF1gQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1596, 32, 'Dialog', 'ZvO0PPyvVuE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1597, 32, 'Progressbar', 'jBKQOEcNvf8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1598, 32, 'Progressbar', 'cs0pKNZAlhc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1599, 32, 'Slider', '3-pOP4mUsjI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1600, 32, 'Slider', 'ofbA_fFobjY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1601, 32, 'Tabs', 'B4zLhUb1baE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1602, 32, 'Tabs', 'nPQn6wsjr7o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1603, 32, 'Tabs', 'ji74iW5AYrQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1604, 32, 'Drag and Drop Lists', 'aN7rLIyLHpY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1605, 32, 'Drag and Drop Lists', 'Phx4fyWrSnE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1606, 32, 'Check if a Username is Available', 'OCRAw06kP8M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1607, 32, 'Check if a Username is Available', 'oXN9XTGp8Ds');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1608, 32, 'Check if a Username is Available', 'Cf8amekBiIc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1609, 32, 'Sliding down message', 'AY8w1_PexYc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1610, 32, 'Sliding down message', '7wNz5T8SepQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1611, 32, 'Countdown to redirect', 'E9Wb4lFd3O8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1612, 32, 'Countdown to redirect', 'UhKpcNa4fwQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1613, 32, 'Loading content with AJAX and fade effect', 'dmfZp4iFzOs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1614, 32, 'Loading content with AJAX and fade effect', 'B_uxTdKsTZA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1615, 32, 'Loading content with AJAX and fade effect', 'H0XnZsxxKFQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1616, 32, 'Instant search', 'vtm8viscjbo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1617, 32, 'Instant search', 'iVEWi8g0hhc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1618, 32, 'Instant search', '115U9gFzAWs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1619, 32, 'Instant search', 'Ww3HMYQp1rk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1620, 32, 'Users online sample application', 'yc7RiHZHVLE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1621, 32, 'Users online sample application', '9foxCPO9jfg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1622, 32, 'Users online sample application', 'osuxAakRhUo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1623, 32, 'Users online sample application', 'EsXKAydMF74');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1624, 32, 'Users online sample application', 'ndD68bJr6ZI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1625, 32, 'Multiple file upload ', '4s42bmcPvVQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1626, 32, 'Multiple file upload', 'yAv40-dgv9w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1627, 32, 'DIV that follows down screen', 'hwGcaO1qjps');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1628, 32, 'DIV that follows down screen', 'Bk9DReqsWGs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1629, 32, 'DIV that follows down screen', 'fp9qcDIY6uY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1630, 32, 'Textarea emoticon text inserter', 'o1Is405Rd2g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1631, 32, 'Textarea emoticon text inserter', 'qqTglCXxZS8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1632, 32, 'Textarea emoticon text inserter', '_BV2zwGo9Cg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1633, 32, 'Show/hide password in field', 'tjnlTz9q2qc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1634, 32, 'Show/hide password in field', 'v6lybadOe34');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1635, 32, 'Show/hide password in field', 'nM-jDbuvtbE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1636, 32, 'Show/hide password in field', '1VE7ICViVS4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1637, 32, 'Submit a form on element change', 'nXsGfTgVXjg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1638, 32, 'Submit a form on element change', 'pVnCkotKFLs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1639, 33, 'Setting up Xcode', '1Xqn5IHbusA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1640, 33, 'Explaining the Program', '7803KdMkfeQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1641, 33, 'Variables', 'NNsMkzmrZ90');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1642, 33, 'Interface', 'WHymKNc_gZk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1643, 33, 'Implementation', 'HjsZdPlrhNQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1644, 33, 'Creating an Object', 'bu8qDGeSuSk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1645, 33, 'Creating Multiple Objects', 'C2ijYMeHHfo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1646, 33, 'Accessing Instance Variables', 'y8WLhIsbiL4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1647, 33, 'Data Types and Other Stuff', '8zW4jym3fds');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1648, 33, 'int and float Conversions', 'mDMa9uGFZgM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1649, 33, 'Type Casting and Assignment Operators', 'BeFKCOyFNaM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1650, 33, 'Intro to Looping', '2AcToTwNfaY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1651, 33, 'scanf and increment operators', 'u-zceyWFHGo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1652, 33, 'Nested for Loops', 'V7TRMOsM49o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1653, 33, 'while Loops', 'XdLCxcBGogY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1654, 33, 'do Statements', 'i-anNHQQ0og');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1655, 33, 'if else', 'zLhgii2EJW4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1656, 33, 'Useful if else Program', 'QWRY6TOmQ2Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1657, 33, 'Nested if Statements', 'YmdzErxHJWA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1658, 33, 'else if Statements', 'ciWOw6Sp7Gk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1659, 33, 'switch', 'b4Jd6aEg-3A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1660, 33, 'Conditional Operator', 'hIiY6f9HUAc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1661, 33, 'Seperating Files', 'I-ZzeOS7-Cg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1662, 33, 'Running the New Program', '8YkxdqA1JIw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1663, 33, 'Synthesized Accessor Methods', 'o4xImiOzcfM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1664, 33, 'How young of a chick can I date?', 'aWA9EFrPaT0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1665, 33, 'But what if Im a millionaire?', 'mX2d6UU8Cqk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1666, 33, 'Inheritance', 'uvJ2-C_Ue7U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1667, 33, 'My Mom', 'Tde6aPeWuj0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1668, 33, 'Starting the Rectangle Class', 'Nb9-1rRjO_8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1669, 33, 'Finishing the Rectangle Class', 'Jo2vK8S36M4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1670, 33, 'OMG, a Square Class?!', 'CUcGZsJqwAo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1671, 33, 'Making steve the Square', 'Rn6PmtmLsos');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1672, 33, 'Creating a Point class', 'XqS0eI6S4OU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1673, 33, 'Enhancing the Rectangle class', 'I7x46vUsPU4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1674, 33, 'Running the Brand New Point Program', 'gIakJOsvaEg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1675, 33, 'Overriding Methods', 'nnApMXeXOGk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1676, 33, 'New Instance Variables and Abstract Classes', 'm4MDHpT9PWI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1677, 33, 'Introduction to Polymorphism', 'kG7YZpbeOmg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1678, 33, 'Running a Polymorphic Program', 'vx3HS2vTf0k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1679, 33, 'Dynamic Binding and id', 'gnx6h9UtsHQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1680, 33, 'Error / Exception Handling', 'Cn47XgIhWEs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1681, 33, 'Directives for Controlling Scope', 'tQgIHmjQT48');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1682, 33, 'External / Global Variables', 'JeYoxS2cq_g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1683, 33, 'Static Variables', 'gMUFi84JI_E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1684, 33, 'Enumerated Data Types', 'ehps96Rnjo4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1685, 33, 'Enum Program', 'pW1wKXryYMg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1686, 33, 'Categories', 'Wc8hUQRTYTU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1687, 33, '#define Statement', 'AIJGD92u0X4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1688, 33, '#import Statement', 'jehbbjHKegU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1689, 33, 'Introduction to Number Objects', '7XH8qJhRc4E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1690, 33, 'Number Object Methods', 'QGN9JdTgCVM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1691, 33, 'String Objects', '8Pfhmo-CHsA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1692, 33, 'Substrings and Ranges', 'r0UpVqG7Nbw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1693, 33, 'Mutable Strings', 'OqswjVvwOqI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1694, 33, 'Finishing Mutable Strings', 'MF6FEbHNObM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1695, 33, 'Introduction to Arrays', '9y2Ci0ynMR8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1696, 33, 'Mutable Arrays', 'jwNHH1251Ow');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1697, 33, 'Dictionary Objects', '22q-N-2oisc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1698, 33, 'Working with Files', '4mq_NUq3Jos');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1699, 33, 'Copy and Rename Files', 'cPrF6ciBw9Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1700, 33, 'Working with File Attributes', 'pYHVK6uZiO8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1701, 33, 'Deleting and Printing Files', 'Xi3DDRFLaF4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1702, 33, 'Working with Directories', 'lUV8D51Ss8g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1703, 33, 'Read and Write Files', 'iJl_R1Z8b6E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1704, 35, 'Vector Addition', 'fM6XNxN7yk4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1705, 35, 'Force', 'sMmqLaIs9jk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1706, 35, 'Projectile Motion', 'kv5NRUOqJs8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1707, 35, 'Speed and Velocity', 'h6X3j3SV8fQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1708, 35, 'Calculating Distance Traveled', 'iLlBmTQ4zvc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1709, 35, 'The Acceleration of Gravity', '9tAFhZb6DdA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1710, 35, 'Acceleration', 'VVk5mXPlGWM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1711, 35, 'Introduction to Physics', '6wb29I_79lA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1712, 35, 'Vector Subtraction', 'lnUiwGGPv6E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1713, 35, 'Newtons First Law of Motion', 'I4su8ckNJSo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1714, 35, 'Newtons Second Law and Meatloaf', 'Gu2Ak9L0uEs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1715, 35, 'Units of Force and Potatoes', 'JWvLYzfeBMw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1716, 35, 'Building a Baby Catapult', '5ygy4EW5s1Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1717, 35, 'Mass vs Weight', 'ouiowIeL1MM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1718, 35, 'Terminal Velocity', 'IaaXYzrFus8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1719, 35, 'Circular Motion / Centripetal Force', 'icq9YZ95oYc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1720, 35, 'Newtons Third Law', 'lhqde-BkVfM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1721, 35, 'Fat Friend', 'wBx9ZyQjjBs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1722, 35, 'Momentum', 'vxK83arpAVI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1723, 35, 'Conservation of Momentum', 'cxJMYpfVQFA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1724, 35, 'Bullet and Gun', 'jW1OfyO8ptA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1725, 35, 'Smacking Balls', 'Rz0TgygyOwk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1726, 35, 'Roast Beef Truck', 'vJvYCXgPHII');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1727, 35, 'Momentum Vector Addition', 'qiH6NeoyCjE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1728, 35, 'Calculating Kickback Speed', '77OXJPV373Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1729, 35, 'Work and Power', 'MUtDPfcjaBk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1730, 35, 'Potential Energy', 'B88Y9bXfNog');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1731, 35, 'Potential Energy of Bacon', '_MALUjZmwTE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1732, 35, 'Kinetic Energy', 'g157qwT1918');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1733, 35, 'Energy Consevation', 'gk7FwYIB9yA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1734, 35, 'Gravity', 'IpfQspeCXsc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1735, 35, 'Keplers First Law', 'CKsf9XpzclY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1736, 35, 'Keplers second Law', 'v6yjGYIJRFw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1737, 35, 'Satellites', 'J5x9IeqLQuk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1738, 35, 'Waves', 'VTNFa3GPb5o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1739, 35, 'Frequency of a Wave', 'Rq4Ozsgl-S4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1740, 35, 'Wavelength and Amplitude', '00OiptDj40w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1741, 35, 'Velocity of a Wave Formula', 'qf5aESZ0Fzg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1742, 35, 'Guitar Sound Waves Velocity', 'K9YqviBUk_0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1743, 35, 'Tranverse and Longitudinal Waves', '8ezODIKc1ck');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1744, 35, 'Doppler Effect', 'B2GG1J2asnY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1745, 35, 'How Sound Travels', 'uE7HiOfokV4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1746, 35, 'Frequency Range for Dogs', 'KcfprR0H8xU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1747, 35, 'Wave Intensity', 'qbiE-BkLrOU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1748, 35, 'Wave Resonance', 'DPH-JoOtcUo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1749, 36, 'Installing Python', '4Mf0h3HphEA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1750, 36, 'Numbers and Math', 'YW8jtSOTRAU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1751, 36, 'Variables', '667ZeuZ0Q8M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1752, 36, 'Modules and Functions', 'y-0lbZGdmIg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1753, 36, 'How to Save Your Programs', '-lfWzPxOJQ8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1754, 36, 'Strings', '9v1HcKR39qw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1755, 36, 'More on Strings', 'LBJWWjDc7wM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1756, 36, 'Raw Input', 'qsTdaxahTsM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1757, 36, 'Sequences and Lists', 'XWQ0cyCrY7w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1758, 36, 'Slicing', '_IySULAqE_k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1759, 36, 'Editing Sequences', '2IEePwMAb5Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1760, 36, 'More List Functions', '96Wr1OO-4d8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1761, 36, 'Slicing Lists', 'iD6a0G8MnjA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1762, 36, 'Intro to Methods', 'ZQywX4uGIfw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1763, 36, 'More Methods', 'rTaMwHjvUAs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1764, 36, 'Sort and Tuples', 'qUncPnnVkU0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1765, 36, 'Strings n Stuff', 'pUA6b86U08c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1766, 36, 'Cool String Methods', '5t4582nFP1c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1767, 36, 'Dictionary', '2j7ox_zqM4g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1768, 36, 'If Statement', 'II5WTVvryvk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1769, 36, 'else and elif', 'g1maz1ynR74');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1770, 36, 'Nesting Statements', '_HJTN1JRgC8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1771, 36, 'Comparison Operators', 'E-s9sXB0XwY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1772, 36, 'And and Or', 'cq-fGQZKLek');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1773, 36, 'For and While Loops', 'Q3T1yyGQd6o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1774, 36, 'Infinite Loops and Break', '2bw77b11bD0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1775, 36, 'Building Functions', 'gTwU8JPgu5E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1776, 36, 'Default Parameters', 'y_2uy1TOH1M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1777, 36, 'Multiple Parameters', 'z1MARRoshyU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1778, 36, 'Parameter Types', 'avhwN1LB1k8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1779, 36, 'Tuples as Parameters', 'sgnP62EXUtA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1780, 36, 'Object Oriented Program', 'JToAsK_7GmU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1781, 36, 'Classes and Self', 'M1BAlDufqao');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1782, 36, 'Subclasses Superclasses', 'pVjHVfzYKn0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1783, 36, 'Overwrite Variable on Sub', 'MLkvt2TNxv4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1784, 36, 'Multiple Parent Classes', 'x57d_PaskKo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1785, 36, 'Constructors', 'cb1FTIoVwu8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1786, 36, 'Import Modules', 'DkW5CSZ_VII');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1787, 36, 'reload Modules', 'JOqxKQnf5ZU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1788, 36, 'Getting Module Info', 'a9sTtnCwuPk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1789, 36, 'Working with Files', '0DHt_gC-k_E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1790, 36, 'Reading and Writing', 'gNVlxvSEFO4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1791, 36, 'Writing Lines', '1_kGbLoY63Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1792, 37, 'The Beginning', 'kWpnLoN8YEU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1793, 37, 'Finding Camp', '6mB8L9_iflc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1794, 37, 'Shelter', '2sCKVS_3Awc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1795, 37, 'Days End', 'AuvySVQijeY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1796, 37, 'Finding The Stream', 'Sdm5E3MJDtY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1797, 37, 'Fire', 'uNWsfUNVIFo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1798, 37, 'The First Meal', 'JTggry3pUnE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1799, 37, 'Another Night', '8GTbgH40L7o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1800, 37, 'Target Practice', '1fNCBQ7Y9dI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1801, 37, 'The Creek', 'Df7tOKeJ35c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1802, 37, 'Exploring', 'WF74e0yxNQ8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1803, 37, 'Rain', 'iJu4F6Lg5D4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1804, 37, 'Breakfast', 'iSWJMDnExDo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1805, 37, 'Seafood Lunch', 'x4nSKlBOwsc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1806, 37, 'Nighttime Rant', 'Au6KqhE6p3A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1807, 37, 'Gone Fishin', 'NUEjTMGPqbw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1808, 37, 'Packing Up', '-IOXuWx9nPQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1809, 37, 'Hiking', 'jgZxNcR8ag0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1810, 37, 'End of Day', '9F4ttl4DdEs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1811, 37, 'The Finale', 'IBoHST3Tgeo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1812, 38, 'Murdering Chickens and Animal Rights Activists', 'gtNJ2RX8d5s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1813, 38, 'How to be a Girls Best Friend Advice ', '_0YtQ-YqVW8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1814, 38, 'Embarrassing First Date Stories', 'QSXwgXbcoUQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1815, 38, 'Jobs That Make You Sick & Worst Jobs', 'hOtUzAYJdqg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1816, 38, 'Worlds Heaviest Woman', 'MohYP-RHngw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1817, 38, 'How to Lose Weight Quick Advice', 'A7C_Dq21iIo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1818, 38, 'Interesting Fast Food Fact', 'bQdfEnAAIeQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1819, 38, 'Most Disgusting Chicken Sandwich Story Ever', 'c0433Wc7cOc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1820, 38, 'Epic Gold Dollar Coin Scam', 'ttvrAXI8T2Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1821, 38, 'Lolas Criminal Plans', '1Ntzio-oMlc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1822, 38, 'Do We Have the Right to Hack?', '29VVKTQk5RE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1823, 38, 'Why Guys Dont Call Girls Back', 'TVmXG5xquQk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1824, 38, 'Fortune Teller/Psychic Scam Millions', 'xsBbb9oA3hk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1825, 38, 'Call From a Real Psychic', 'Lhsd6fwW8G0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1826, 38, 'JCPenneys Sexist T-Shirt Pulled', 'x3aPg2vSYD4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1827, 38, 'Call on JCPenneys Sexist T-Shirt & Buckys Rant', '9jpDKRkkarI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1828, 38, 'Buckys Chocolate Milk Addiction', 'FxLr3ama5t8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1829, 38, 'Buckys and Lolas O.C.D.', 'lbbvIJSCRPY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1830, 38, 'Lola Gets Locked Out of Her Car', 'h-j9x6CZxJ8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1831, 38, 'How Bucky Met Lola', 'DbTeeGFo-40');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1832, 38, 'Lolas Crazy Ex and Gross Cat Story', 'j0T6LxporPo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1833, 38, 'Buckys Near Death Experience', 'jxxIeaLGd7c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1834, 38, '5 Awesome Coma Stories', '5BgojHcwwSA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1835, 38, 'Childhood Dreams and Crazy Tire Salesman', 'f9YhLnCCFyE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1836, 38, 'Should Foodstamps be Allowed at Restaurants?', '3cZZL3ZWf9c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1837, 38, 'Caller Asking About Jobs in America', 'bpcMBe4oRh8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1838, 38, 'Hot Dogs, Chicken Nuggets, and Artificially Flavored Meat', 'z_URHxqH3Cg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1839, 38, 'Buckys Embarrassing Erection in Math Class', 'psfLE-47ztQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1840, 38, 'Buckys &quot;Love Filter&quot; Theory', 'eqL1qsbIfLQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1841, 38, '5 Things Girls Wish Guys Knew', 'qFDskrvxwuM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1842, 38, 'How to Pick-up Chicks', 'bDkmfYY7eWE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1843, 38, 'Can a Caller Pick-up Lola?', 'NBINYUCC6JQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1844, 38, '5 Things Teenage Girls Need to Know', 'pXxa7MGtsIE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1845, 38, 'Buckys Advice for Teenage Girls ', '11NiEuGh9MA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1846, 38, 'Falling Down a Flight of Stairs', 'C4OyPJIjtV0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1847, 38, '10 Most Bizarre Things You Can Buy Online', 'UVpos_0noFQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1848, 38, 'The Worlds Oldest', 'n1K_fdayuIw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1849, 38, 'Worlds Dumbest Mom Feed Ant Poison to Kid', '4DRBSU6mYwo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1850, 38, 'Naked and Crazy', '6mLs5fxbdm0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1851, 38, 'Does Money Have Any Real Value?', 'cnYC4tt1S1k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1852, 38, 'Why Do Some Kids Grow Up to be Douchebags?', 'zjSvnAb5KbA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1853, 38, 'Child Sucks Milk From a Cows Udder', 'kjZ3Eyw_pq0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1854, 38, 'Why Does Everybody Love Ron Paul?', 'DxCtVPWmqB0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1855, 38, 'SpongeBob Makes Kids Stupid', 'g8khbp4ALmE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1856, 38, 'Toilet with Poop in Front Lawn', 'q-jdNlrCM1o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1857, 38, 'Why do girls say theyre OK when theyre sad?', 'YZoX91vRQHw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1858, 38, '5 Mistakes Women Make at the Doctors Office', 'Oxd3WVVUauQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1859, 38, 'Caller asks &quot;How do you feel about Muslims?', 'rHSyI2TlrJY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1860, 38, 'Lady Gives Bucky Free Candy', '1z5ZUW2YWvg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1861, 38, 'Why do girls act so happy and perky?', 'Q0iMyvherjw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1862, 38, 'People Going Crazy Over Raw Beef', 'hDrTe0fVsjk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1863, 38, 'Fun Facts About Alcohol Advertising', 'HiTGVDvy4xc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1864, 38, 'Man Sues White Castle Because He Cant Fit Into Booths', 'EJy11TrO8NE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1865, 38, 'Amish Men Jailed for Buggy on Public Roads', '3rmYlZdeykU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1866, 38, 'Study Links Tattoos to Deviant Behavior', '-H7YtGfIi1o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1867, 38, 'When will people learn to stop taking nude pictures of themselves?', '7IucggoEaKM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1868, 38, 'Aliens and The Big Bang Theory!', '7ZqQ6HwZir4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1869, 38, 'Does Life Exist Outside of Earth?', '0m-JUUNcDHQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1870, 38, 'Evolution & The Beginning of Life', 'o2LONOXB7fg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1871, 38, '37 Students Stabbed With Needle in Puerto Rico', '_nGlEXdyEUQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1872, 38, '101 Year Old Evicted from Home in Detroit', 'qdMopC8LPYs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1873, 38, 'Should Women be Allowed to Go Topless?', 'u6zBZ_sGAds');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1874, 38, 'Caller About Topless Women', 'x8qwcIjgU8s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1875, 38, 'Two Men Accused of Using Their Dead Friends Debit Card', 'fPgxts_tXSc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1876, 38, 'Fun Facts About Cheating in School', 'f4rboSnuyUU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1877, 38, 'Billys Crazy Ghost Story', 'ETwILLNh6rA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1878, 38, 'Human Skull for Sale on Craigslist', 'GKtmusxMOoI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1879, 38, 'Kid Brings Crack Pipe in for Show & Tell! ', 'ZlPur6oR7pA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1880, 38, 'How to tell if a girl likes you', 'fPBNGy0zAU0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1881, 38, 'Wife Shoots Husband in Face', 'QPeZGYEssyM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1882, 38, '6 Assumptions About Women', 'sfki0oTUglc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1883, 38, 'Raleigh is the #1 City', '-aMeP2W06Jo    ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1884, 38, 'Worst Injuries and Worst Teachers Ever', '8RV2vP9iJbY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1885, 38, 'Caller Compliments Bucky', 'jpV4vhkhDyc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1886, 38, 'Lolas and Buckys Allergies', 'fQav2zjaQUw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1887, 38, 'Our New Setup and Buckys Trip to NY', 'JIpcjBp6_fs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1888, 38, 'Buckys Thoughts on Dubstep', 'SUhg6Q2RhWY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1889, 38, 'Mac vs PC ', 'ABaK5mMxcIY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1890, 38, 'Creativity', 'teuGA0Cgkos');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1891, 38, 'Cell Phones', 'ugrRpbKUa4I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1892, 38, 'Buckys Thoughts on School', 'qiztuwFG5wE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1893, 38, 'Why Bucky Dropped Out of College', 'EDvE72Y4ckU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1894, 38, 'Getting Attacked', 'SuJIqzuUtRs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1895, 38, 'Buckys Sticky Car Ride', 'F25qeB23Ryo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1896, 38, 'Bad Cup-Holders and Infomercial Products', 'DsBfSPUs-n0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1897, 38, 'GPS for Life Advice', 'MpbAS7myNyQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1898, 38, 'Are Companies Really Trying to Cure Cancer?', 'pumTtL5BMU8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1899, 38, 'Buckys Theory on Habit', '-659rgTDoDU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1900, 38, 'Why do people behave different in groups?', 'bQzUVRderOQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1901, 38, 'Caller Talks About War', 'oEtLzZD0irw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1902, 38, 'Problems with Youth ', 'X72KB4W6QuY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1903, 38, 'Bribes and Online College', '948H4lx1Ia8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1904, 38, 'Paying Girls to Date You?', 'vmcMPAOKYlM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1905, 38, 'Deep Thoughts About Life', 'jm1SFLAw-wk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1906, 38, 'Ideas About Knowledge and Curiosity', 'kWC4LpHW-ck');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1907, 38, 'Little Kids and Babies', 'F48eXUIjcWc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1908, 38, 'Are Strange People More Interesting?', 'oNrMizk0zuE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1909, 38, 'Lolas Exciting Weekend', 'YzU9TtfBth8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1910, 38, 'Importance of Sleep', 'Hhzy1XxD0lw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1911, 38, 'Buckys Theory on Pregnancy', '5D2J9I7Ng6s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1912, 38, 'Lola Gives Girl Advice to Caller', '10QqDPkArSk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1913, 38, 'Is 2012 the end of the world?', 'TwCrJHj3MtA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1914, 38, 'Deja Vu and Weird Feelings', 'GkY9LQC4J_M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1915, 38, 'Nick and Emily Call In', 'qHwishtNemI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1916, 38, 'Grossest Video on the Internet?', 'UtJDeoXIxRE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1917, 38, 'Why do some girls become porn stars?', 'FXFwgMlJTsg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1918, 38, 'Occupy Wall Street', '9EARPS7KtEg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1919, 38, 'Regretting Asking Out Girls', 'RcXaLdBmpNg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1920, 38, 'Crazy English Class', '0vz7cjT1-y4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1921, 38, 'Girls Switched at Birth', 'v-EyOKWo3bI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1922, 38, 'Should sexting be considered cheating?', 'GC1hGZrl5J0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1923, 38, 'Caller on Weight Loss and P90X', 'qY4cEr1CzDk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1924, 38, 'Riddle for Bucky and Lola', 'rVERiDU60ug');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1925, 39, 'What Is Visual Basic', 'mM3zB3QWuv8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1926, 39, 'Installing The Visual Basic IDE', 'FM5AjudKHoE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1927, 39, 'Getting Familiar With The IDE', 'ozRPmJMy0KE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1928, 39, 'Hello World', '1mg3NHwGkas');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1929, 39, 'Primitive Data Types', 'IneVm5aY2nM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1930, 39, 'Comments And Whitespace', 'pojrX2CrNCw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1931, 39, 'Errors', 'UrXi6H8O05E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1932, 39, 'Variables', 'r8GHJyFOP18');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1933, 39, 'Math Operators', 'olCXCSIVzvk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1934, 39, 'More On Math Operators', 'i0wq8415hxw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1935, 39, 'Getting User Input', 'mvZjo1o0w9U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1936, 39, 'Creating A Basic Calculator', 'cj7gek_yw70');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1937, 39, 'If Statement', 'MRnlg_V_0BI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1938, 39, 'Else If And Else', 'T-J2dSPanGE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1939, 39, 'Nested If Statements', 'PqGYLQPPZsA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1940, 39, 'Conditional Operators', 'DavAWs79c9w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1941, 39, 'Logical Operators', 'yjJ4yMk6D2U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1942, 39, 'Concatenate Strings', 'RYPGlY0ZLSM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1943, 39, 'Get Length Of Strings', 'K5zbAzKJen4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1944, 39, 'SubStrings', 'sMOjG3wvdic');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1945, 39, 'Formatting Strings', 'fioDW_t8dnw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1946, 39, 'Replacing SubStrings', '3ARjJ7tO0WY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1947, 39, 'Comparing Strings', 'JvtESoRK8mQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1948, 39, 'Select Case', '3wvvD4Vfr4k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1949, 39, 'Select Case Else', 'o-LmyPNgY-o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1950, 39, 'For Next Loop', 'qRJGdPa9X24');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1951, 39, 'Step Operator', 'dO0V93u-0Kc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1952, 39, 'Exiting For Loop', 'ZW9PjIo_bcc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1953, 39, 'Continue For', '4h141dH9J2o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1954, 39, 'Do Until Loop', 'v4WSyJKWLXY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1955, 39, 'Do While Loop', 'mdP5mQmAXwg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1956, 39, 'Exit Do Loops', 'vu_i8lebKd0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1957, 39, 'More On Do Loops', '3ByynXMiJ2A    ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1958, 39, 'Nested Loops', 'jyp4ptojoh8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1959, 39, 'The Infinte Loop', 'oRlwQMDf1uE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1960, 39, 'Introduction To Windows Forms', 'nif7ViGaNrs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1961, 39, 'Form Properties', 's62fKwFakpQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1962, 39, 'ToolBox', 'VpQnqqURLOQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1963, 39, 'MessageBoxes', 'Kcrt7cofpWY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1964, 39, 'MessageBox Input', 'K37JMVKaVUw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1965, 39, 'Input Box', 'mgUGr6VFADs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1966, 39, 'User Defined Subs', 'l-nSLlDKp9A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1967, 39, 'Functions', 'MTXBCvEJdlc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1968, 39, 'ByVal', 'KpPulq8QMpE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1969, 39, 'ByRef', 'fJji7GHHejE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1970, 39, 'Optional ByVal', 'E-o3rxGur2g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1971, 39, 'Coercion', 'QEUZTB2vam8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1972, 39, 'Exit Subs', 'lLkWbsO52HI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1973, 39, 'Events', 'FZugcfyyOiM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1974, 39, 'Global Variables', 'PoxnLIUGhlE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1975, 39, 'Constants', 'sSwTjALT26A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1976, 39, 'Math Class', 'Y9vFbC8VSYI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1977, 39, 'CType', '5Wwv2QseY-o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1978, 39, 'Calculator Part 1', 'XvCg1YQnZwE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1979, 39, 'Calculator Part 2', 'hzj4I_906Hs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1980, 39, 'Calculator Part 3', 'EdIyMgP_SCg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1981, 39, 'Calculator Part 4', 'aa2qZRhgQxI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1982, 39, 'Calculator Part 5', 'W6t3t7h2K-k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1983, 39, 'Introduction To Arrays', 'eG_eUsqaPtk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1984, 39, 'Sorting And Reversing Arrays', 'M3QgKh5xcEM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1985, 39, 'For Each Loop', 'xAyjBq99ebE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1986, 39, 'Passing Arrays As Parameters', '7O6KsgWLAsI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1987, 39, 'Initialize Arrays With Values', 'pE21_V_OWOI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1988, 39, 'Enumerations', 'y7piI12pCK4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1989, 39, 'Introduction To Properties', 'GIG4ykPD78s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1990, 39, 'More On Properties', 'F2HzyItKnJQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1991, 39, 'Finishing The DayAction Program', 'SWmTSQf3mWA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1992, 39, 'Structures', 'Y_abLKMmkMo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1993, 39, 'More On Structures', 'jRPXpKuBMlA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1994, 39, 'ReadOnly Properties', '8FuRRVv5K2Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1995, 39, 'Passing Enumerations As Parameters', '51cMBKYIP3A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1996, 39, 'GetValues Of Enumerations', 'UnEgItXlvW0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1997, 39, 'GetNames and GetName Of Enumeration', 'XDoPUufputQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (1998, 39, 'IsDefined In Enumerations', 'pO8retHSVic');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (1999, 39, 'Dynamic Arrays', 'WTnkhUglDnQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2000, 39, 'Preserve', 'LUlLlEFjaIg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2001, 39, 'ArrayLists', 'dx_uGBrT0hM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2002, 39, 'Overriding Functions', 'VMAxVftkMWE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2003, 39, 'Finishing The Customer Application', '-lw8YDgGbkE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2004, 39, 'More On ArrayLists Part 1', 'nOC8gRovyu4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2005, 39, 'More On ArrayLists Part 2', 'D_Cr3bge5kc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2006, 39, 'More On ArrayLists Part 3', 'y2e3vFpXSrc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2007, 39, 'Queues', 'HhAIhQ-YJds');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2008, 39, 'Stacks', '_ZfL81rkkLI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2009, 39, 'StringCollections', '8Lben7DqKAw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2010, 39, 'Dates', 'SHIQrGvSG7I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2011, 39, 'Dates Part 2', 'UUAsBKaoCO4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2012, 39, 'Dates Part 3', 'zJVCRGtS9ps');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2013, 39, 'Random Number Generator', 'rMM6WIhlr3M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2014, 39, 'Multi Dimensional Arrays', '32ll3lc0Gw0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2015, 39, 'Introduction To Classes', 'ZAWzRm8lKNw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2016, 39, 'Person Part 1', 'rg0ru-edIVs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2017, 39, 'Person Part 2', 'K53i6GmD8DI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2018, 39, 'Person Part 3', '1gQFyWc2Bsk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2019, 39, 'Person Part 4', 'x1VFQyR3yZc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2020, 39, 'Person Part 5', 'b-Ny8pPlRaU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2021, 39, 'Constructors', 'ureP6lgCe48');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2022, 39, 'Showing Multiple Forms', 'MaOcLXjGHMo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2023, 39, 'More On Multiple Forms', 'EQA57zg_q44');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2024, 39, 'Introduction To IDisposable', 'RSAMloPCSyg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2025, 39, 'Using End Using', 'wsIH1nGb4gE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2026, 39, 'Introduction To Namespaces', 'QK44i4WXlx0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2027, 39, 'Accessing Classes in Namespaces', 'yBEow55n1Jc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2028, 39, 'Nested Namespaces', 'oirKzyqX_yw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2029, 39, 'More On Nested Namespaces', 'SE3ebsiXSzo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2030, 39, 'Car Part 1 Creating The Car Class', 'J3_Gw7cyVks');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2031, 39, 'Car Part 2 Using The Car Class', 'bjtl4tAhep4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2032, 39, 'Car Part 3 Adding To The Car Class', '3FHtdNniPNc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2033, 39, 'Car Part 4 Showing The Car Info', '39LuCJ9To38');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2034, 39, 'Car Part 5 Inheritance', '6vEQQl3vgGI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2035, 39, 'Car Part 6 More On Inheritance', 'cl0SI1xXtFg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2036, 39, 'Car Part 7 Using The SportsCar Class', 'b5T9pZ_kOs8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2037, 39, 'Car Part 8 Polymorphism', 'PseqITrEEPc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2038, 39, 'Car Part 9 Creating The Truck Class', '6JOY7Y9LFYw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2039, 39, 'Car Part 10 Adding The Cars To A List', 'GNYSsqLOM4I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2040, 39, 'Car Part 11 Showing Info Of Multiple Cars', 'EVxZQKUBS_c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2041, 39, 'Car Part 12 AddCar Dialog', 'i_ST2wN_N3g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2042, 39, 'Car Part 13 Adding Cars With AddCar', 'aVuje26yLAg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2043, 39, 'Car Part 14 Cancelling AddCar', '_Da6bt1eBjk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2044, 39, 'Car Part 15 Changing the selectedCar Attributes', 'u9lN3kjflig');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2045, 39, 'Car Part 16 Adding Different Types Of Cars', '78vhVN5XjUU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2046, 39, 'Car Part 17 Creating And Accessing Different Car Types', '5ZhFGqiaw3g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2047, 39, 'Car Part 18 Wrapping It Up', 'CDIblMQKDuM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2048, 39, 'StreamWriters', 'NGlY-X8iRLg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2049, 39, 'StreamReaders', 'ftESvgHg8Uw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2050, 39, 'More On FileStreams', 'Hu0ERUEnlRg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2051, 39, 'Special Directories And File Attributes', 'PZMzTNtFCVY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2052, 39, 'Shared', 'rF77aS2vI_g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2053, 39, 'OpenFileDialog', 'nMnQmiZ9H4s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2054, 39, 'SaveFileDialog', 'qVRIyV5IKsc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2055, 39, 'FontDialog', 'qVEu3Z9CW84');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2056, 39, 'OpenFolderDialog', 'xxX6EwvcV28');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2057, 39, 'Introduction To Try Catch', 'g5g-MuQ4rMI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2058, 39, 'Catching Specific Exception Types', 'J9n6BHd2ATA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2059, 39, 'Exit Try And Throw', '2LRgzgkkffA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2060, 39, 'Finally Statement', 'iMJo32jyW9E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2061, 39, 'When Keyword', 'RaRyZSQ3C3c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2062, 39, 'Timers', 'UTyO6KiPJDw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2063, 39, 'Recursion', 'G1T8QnaVscw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2064, 39, 'Keeping Letters Out Of TextBoxes', 'CEsn1bwsi9Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2065, 39, 'SMTP Client Part 1 Building The Interface', 'kQ94fFJZfp4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2066, 39, 'SMTP Client Part 2 Creating The Message And Credentials', 'IBlEKPmsRF8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2067, 39, 'SMTP Client Part 3 Finishing The Email Sender', 'qfGvHzUTuvo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2068, 39, 'Threading', 'KK5D4Y2fnl4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2069, 39, 'Game Part 1 Class Libraries', 'OU01sGXoDz0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2070, 39, 'Game Part 2 Creating The Classes', 'dCOVLAXM9ns');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2071, 39, 'Game Part 3 Building The GUI', 'xJfYsyZMckA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2072, 39, 'Game Part 4 More On GUI', 'fuQ_UeeG5EA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2073, 39, 'Game Part 5 Creating New Enemies', 'pQ34UWkIYxc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2074, 39, 'Game Part 6 Cleaning Up The Enemy Generator', 'mdwdaiVTq5s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2075, 39, 'Game Part 7 Creating Popeye', 'MB608nSG-rQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2076, 39, 'Game Part 8 Popeye Attack', 'bshGPDD0KHI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2077, 39, 'Game Part 9 Enemy Attacks Back', '99lHfk2mxyM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2078, 39, 'Game Part 10 Health Label', '28q3C0_TAh4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2079, 39, 'Game Part 11 Fixing The Health Logic Error', 'xg_0QiAErVk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2080, 39, 'Game Part 12 Creating The Event Log', 'EUCYrNLKauI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2081, 39, 'Game Part 13 Creating Log Events', 'kZVEfd8M28k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2082, 39, 'Game Part 14 Damage Arrays', 'gv2pYpFt09M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2083, 39, 'Game Part 15 Adding Events To The Log', 'lW2beD6msik');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2084, 39, 'Game Part 16 OH NO! LOGIC ERRORS', 'VMNt7aMGaxg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2085, 39, 'Game Part 17 Attaching The Log To The Game', '7oNdJCeIdYY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2086, 39, 'Game Part 18 Hiding And Showing The Log', 'IOfHUYflF54');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2087, 39, 'Game Part 19 Adding The Spinach Multiplier To The Log', 'E054Y1SmGiE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2088, 39, 'Introduction To Graphics', '5LBb1LrN95s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2089, 39, 'Drawing More Squares', 'xHBQx51MasI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2090, 39, 'Animating Graphics', 'thN6vuEitRI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2091, 39, 'Graphics Points', 'woJlvvNbfYs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2092, 39, 'Paint Part 1 Custom Controls', 'P1xurirxUck');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2093, 39, 'Paint Part 2 Building GraphicsItem', 'DCuAm7nkyUI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2094, 39, 'Paint Part 3 Building GraphicsCircle', 'QpZ7R5VUR8g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2095, 39, 'Paint Part 4 Building PaintCanvas', '97v1EnHY9NE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2096, 39, 'Paint Part 5 Finishing PaintCanvas', 'O19CT_sy-g0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2097, 39, 'Paint Part 6 Fixing The Screen Flicker', 'DC8GnNUUPSg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2098, 39, 'Paint Part 7 Creating The Options Form', '8i_oLcMbFiQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2099, 39, 'Paint Part 8 Changing The Brush Size', '9IPjAjXHxHA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2100, 39, 'Paint Part 9 Changing The Brush Color', 'hRHmaWFxkcU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2101, 39, 'Paint Part 10 Clearing The Canvas', 'vKnPXnOLZuE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2102, 39, 'FTP Downloader Part 1 Creating The GUI', 'N1WFoWlbko0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2103, 39, 'FTP Downloader Part 2 Referencing A Class Library', 'kGjv5VSPxWk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2104, 39, 'FTP Downloader Part 3 Showing The Files In The Home Directory', 'FQYzR-gW42Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2105, 39, 'FTP Downloader Part 4 Downloading Files', 'f0R-irmnEZc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2106, 39, 'FTP Downloader Part 5 Opening Folders', 'ZA01Bhtqqfc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2107, 39, 'FTP Downloader Part 6 Changing The Server', 'DDu1lgi4uCg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2108, 39, 'FTP Downloader Part 7 Uploading Files', 'JjD-y3kF3UY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2109, 39, 'FTP Downloader Part 8 Deleting Files', 'xhlmNDfER-c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2110, 39, 'FTP Downloader Part 9 Refreshing, Clearing, And Checking', 'jejspSA4AIc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2111, 39, 'FTP Downloader Part 10 Checking Timer And Notifications ', '7RRqkgovb08');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2112, 39, 'Favorites Part 1 Creating The GUI', 'ZfEXKmqb__o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2113, 39, 'Favorites Part 2 Creating The WebFavorite Class', 'Xp9PRV7SWDU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2114, 39, 'Favorites Part 3 Creating The WebFavoriteCollection', '2fd0K6Je8rE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2115, 39, 'Favorites Part 4 Creating The Favorites Class', '2rNwKjFXKcA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2116, 39, 'Favorites Part 5 Adding The Favorites To The List', 'JZgYiBOofwE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2117, 39, 'Favorites Part 6 Opening The Favorites Link', 'MWjT4W95PkM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2118, 39, 'Favorites Part 7 Startup Link And Refreshing', 'OviiJpTX8eM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2119, 39, 'Creating The Favorites DLL', 'PmxsrCj0qe8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2120, 39, 'Favorites Tray Part 1 Creating The UI', '6xxQNLkdTpc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2121, 39, 'Favorites Tray Part 2 Creating The MenuItem Classes', 'mRkCzvhutrU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2122, 39, 'Favorites Tray Part 3 Exit MenuItem And ContextMenus', 'XnU1L1BNM8M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2123, 39, 'Tray Part 4 Adding Our Favorites To The ContextMenu', 'FKr8648Cs0w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2124, 39, 'Combining The Favorites Tray And Favorites Window', 'CZ1CQJ-ODiw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2125, 40, 'Downloading a Text Editor', 'cqszz_OfAFQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2126, 40, 'Creating our First Webpage', 'k3dJKtQmyd0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2127, 40, 'body and headers', 'JEacEPCxjl4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2128, 40, 'Paragraphs and Line Breaks', '3R3QXXnF7FM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2129, 40, 'Bold, Italics, and Comments', 'r7HHAdP44qM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2130, 40, 'Adding Links to our Webpage', '01rd3zmSm_Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2131, 40, 'Creating a Link Within a Web Page', 'tUemovUZHOo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2132, 40, 'Email Links and Tool Tips', 't_L6GPushfw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2133, 40, 'Adding Images to the Webpage', 'wOdIYPMFhsY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2134, 40, 'Resizing Images', 'bcO7-5zYY-4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2135, 40, 'Tables', 'bhcnHsrP42U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2136, 40, 'Table Headers and Movie Stars!', '08sa1JEc9-U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2137, 40, 'colspan & Annoying People', 'Zv4nn8ikGoc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2138, 40, 'Table width, cellpadding, and cellspacing', 'rdFJmCVnDGQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2139, 40, 'Lists', 'QLXFwzHvxak');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2140, 40, 'Intro to CSS', '-psgK1hrNNk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2141, 40, 'RGB Color and Line Spacing', 'ZzyFj4BItFc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2142, 40, 'font-weight & font-style', 'sW6CRoJaaoI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2143, 40, 'text-align and Changing Background Color', '4IYs-B0lwhw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2144, 40, 'Background Images', 'jWn1nWIFbV0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2145, 40, 'Padding', 'tOkQKpb7CVY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2146, 40, 'Border', '5NSchEMGW-k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2147, 40, 'Margin', 'veKHw125UJs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2148, 40, 'Width & Height', 'ykAyT_wKXZ0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2149, 40, 'Styling Links', '9NwvMak3x1k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2150, 40, 'Styling Tables', 'ZCurFMtOPKI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2151, 40, 'Background Images', '8vsaVX7Yg4Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2152, 40, 'Style More Than One Elements & Span!', 'RRSjALnurmA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2153, 40, 'div', 'e0ONAShY53w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2154, 40, 'Styling Using Classes', 'YLFSWqWxvtU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2155, 40, 'IDs', 'fg6PMJDvR4I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2156, 40, 'Child Selectors', 'OnS6_XSsi8Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2157, 40, 'Pseudo Elements', 'vzW9zD5yZoE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2158, 40, 'External Style Sheets', 'BtAQsk2UYks');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2159, 40, 'Overriding Styles', '-z6kay70cYI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2160, 40, 'Absolute Positioning', 'f7nzTlj2KxY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2161, 40, 'Relative Positioning', '8BZS--kcMZ0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2162, 40, 'Fixed Positioning', 'ugrO4oV5-oI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2163, 40, 'Max Width & Height', '7-pBOx38umo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2164, 40, 'Introduction to Forms', 'guBd82TM8Vs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2165, 40, 'Check Boxes & Radio Buttons', 'JXlIRdIhMyI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2166, 40, 'Drop Down Lists', 'lkAJGhpnPLw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2167, 40, 'Text Areas', 'bcE6XOr1N2c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2168, 40, 'Passwords & Upload Buttons', 'FjnjGwZnPOI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2169, 40, 'Submitting Forms', 'v2HjsFllYk8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2170, 40, 'How to Publish Your Website!', 'q_8i8EBweT8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2171, 41, 'The Multimeter', 'p9Tv08CPMnM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2172, 41, 'More on Multimeters', 'MI2kFDhLo5o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2173, 41, 'Choosing a Battery', 'CNF8xFz6xb8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2174, 41, 'Testing the Battery', 'FYcGTeXZIlM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2175, 41, 'Alligator Clips', 'rRwE45XleBw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2176, 41, 'Intro to Resistors', '4g-DBXlB-mU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2177, 41, 'Testing Resistors', 'v78tOTBUnro');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2178, 41, 'Resistor Color Bands', 'Dz4TSZTI6p4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2179, 41, 'Choosing LEDs', 'gM3wyOxutok');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2180, 41, 'Building a Circuit', 'MI2SS5qaPqk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2181, 41, 'LEDs Gone Bad', 'r8bEUuGXvnc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2182, 41, 'Measuring Voltage', 'pIAmIfXQtGA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2183, 41, 'Measuring Current', 'KLkge0X_vDM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2184, 41, 'Intro to Breadboard', 'BE2R2GYt-6k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2185, 41, 'More on Breadboard', 'PRUX8cSX9n8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2186, 41, 'Breadboard Circuit', 'j3fKd4hK91E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2187, 41, 'Potentiometers', '5d1P_ly1-AY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2188, 41, 'Testing a Trimpot', '9Bsg6ITWHk8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2189, 41, 'Photoresistors', 'faP8MiHUfDg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2190, 42, 'Creating a Basic Frame', 'RHvhfjVpSdE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2191, 42, 'Creating Buttons', 'cp1ZeMisTNo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2192, 42, 'Creating a Menu Bar', '8v52QIP4L9Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2193, 42, 'Using Message Dialog', 'ar1KSBo1z7c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2194, 42, 'Text Boxes for Input', '5SJO9dk9uOQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2195, 42, 'List for Input', 'AE5cEqcWhMM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2196, 42, 'Static Text', 'qYVf09MVY14');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2197, 42, 'Simple Text Program', 'MsPuEvjh86Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2198, 42, 'Custom Bitmap Buttons', 'Y7f0a7xbWHI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2199, 42, 'Sliders', 'R5sxImX3gog');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2200, 42, 'Spinners', 'I6j-KiQeIYY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2201, 42, 'Check Boxes', 'aEeUAXnz6ak');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2202, 42, 'List Boxes', 'f8rk74r83R8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2203, 42, 'Choice List Dialog', 'KXBobnBKSSk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2204, 43, 'Introduction', 'Mp0f0zTPLec');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2205, 43, 'Creating a Basic Template', 'qseNjA-73Fw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2206, 43, 'Setting up the body', 'eDR7zpVfX_4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2207, 43, 'Adding the Meat!', 'go5U9wfM9h4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2208, 43, 'Attribute Selectors', 'a5KD47HDRho');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2209, 43, 'Introduction to pseudo-classes', '0pb81VdSO_E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2210, 43, 'negation pseudo-class', 'JaLebQ-QDVo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2211, 43, 'Sweet New CSS3 Selectors', 'tIznbrsfQZQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2212, 43, 'Laying Out the Website', 'Q7eoOSZ7JdY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2213, 43, 'Starting the Styling', 'P71U-doyzNg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2214, 43, 'Styling the Navigation Menu', '8uTNq7fs5-s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2215, 43, 'Making Everything Pretty', 'yNtIO4X6cag');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2216, 43, 'Finishing the Layout', 'tzAEGnBNAn0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2217, 43, 'Flexible Box Model', 'xgYmccJ61eA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2218, 43, 'Styling the Header and Navigation', 'bi7ccKky8JU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2219, 43, 'Finishing the Flexible Box Model Layout', 'F1uzS6PAjuc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2220, 43, 'Reversing the Box Order', 'iTEgQP87IhQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2221, 43, 'More Flexible Box Model Tricks!', '6L2DQkf0oR8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2222, 43, 'Finishing up the Flexible Box Model', 's_4zvAMU4BY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2223, 43, 'Rounded Corners and Shadows!', 'fCU641pu6ys');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2224, 43, 'Text Shadows, Gradients, and Alpha', 'ritFiWDm08g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2225, 43, 'Crazy Transformations', 'jRWGqBUNk_c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2226, 43, 'Animating with Transitions', 'Ie1h8KgoDtg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2227, 43, 'Making Awesome Rollover Buttons', 'WCsuxaqpQP8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2228, 43, 'Working with JavaScript in HTML5', 'L-FM97j7MyY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2229, 43, 'querySelectorAll', 'f15cVPPbjMI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2230, 43, 'Playing Video on Your Website', 'Gas8f7dJfWc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2231, 43, 'How to Customize Your Video Player', '_JbFcQF5OR4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2232, 43, 'Making Your Skin Look Pretty!', 'p1bTTHVhlfM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2233, 43, 'Styling the Default and Progress Bars', 'd8PRA5kqL9s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2234, 43, 'Programming the Video Player', 'M9dUfcmpuJY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2235, 43, 'Playing and Pausing the Movie', 'wX0CdtO_1T0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2236, 43, 'How to Update the Progress Bar', '6Ag9Gnv0o_8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2237, 43, 'Finishing Up the Video Player!', 'FtvGVpSg4wA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2238, 43, 'The Canvas Element', 'wyaEthRt330');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2239, 43, 'Drawing Shapes on the Canvas', 't51omnjifl0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2240, 43, 'Gradients on the Canvas', 'FWB7SF9TM-A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2241, 43, 'Making Sweet Custom Shapes!', '1RdNGbfT_ok');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2242, 43, 'Working with Text and Shadows', 'Pa9ASGA3m8U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2243, 43, 'Transformations', 'vU_wNPd3R_Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2244, 43, 'Saving and Restoring the Canvas', 'mqP8aWI758Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2245, 43, 'Images on the Canvas', 'HM112U8pOWk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2246, 43, 'Animation for Games!', '4nRg5ljNpsc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2247, 43, 'Drag and Drop', 'Kfi3uRJS6hA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2248, 43, 'Working on the Drag and Drop Program', '-2qhd7uJkn8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2249, 43, 'Finishing the Drag and Drop Program!', 'SWR5ojeSmvM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2250, 43, 'Spice it Up', 'e6t-8EoT2HM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2251, 43, 'Web Storage API', 'PN0RgFnRxAQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2252, 43, 'Making the Web Storage Program Pretty', 'Xq9KKJfbzg4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2253, 43, 'Saving Data', 'AUOe6E7GgP8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2254, 43, 'Retrieving and Displaying Stored Data', '1pz9zExrj5o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2255, 43, 'Making Something Useful', 'zG-mivHf1_I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2256, 43, 'Saving Data While Visiting Other Websites', 'Kn_AIiV6Cp0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2257, 44, 'How the Internet Works', '3q4xQss3fRY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2258, 44, 'Parts of a Network', 'A7_BSqR2Le4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2259, 44, 'WAN', '1AUJctaLmKE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2260, 44, 'MAN', 'Ziypn8hVxMU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2261, 44, 'Types of Networks', 'EcbyD_YycPA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2262, 44, 'What is a Computer Network?', 'ueVnSz_lXEs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2263, 44, 'Servers', '8PgOSG_z2dc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2264, 44, 'Clients and Hosts', 'CwfTpGVa2wE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2265, 44, 'Network Interface Card NIC', '778rS_FMb10');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2266, 44, 'What is a Protocol?', 'VlKks__ZhI0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2267, 44, 'Protocols', 'BfZ0zZGT0_k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2268, 44, 'Bus Topology', 'Awt4ikvFYyI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2269, 44, 'Ring Topology', 'OSnnJNTa5cU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2270, 44, 'Star Topology', 'EQ3rW22-Py0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2271, 44, 'Mesh Topology', 'yLzo36EQmr8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2272, 44, 'OSI Model', 'CG8O_CVbosE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2273, 44, 'More on OSI Model', '4203P7ahWI8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2274, 45, 'Introduction to Flash', 'o2tsxb71r_Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2275, 45, 'Finding Our Way Around Flash', 'EFEWZke5uxs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2276, 45, 'The Basic Tools', 'aA-d0-sFTJk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2277, 45, 'Basic Animation', '55lAPH8Mdyg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2278, 45, 'Motion Guide Layers', 'owojvNuuOxg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2279, 45, 'Layers', 'YyUJLCrjsAg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2280, 46, 'Introduction and Basic Tools', 'xS5uh5TCXcU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2281, 46, 'More Basic Tools', 'SlI8LS4h73M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2282, 46, 'Finding Your Way Around Photoshop', '2Jl_nsD7sGs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2283, 46, 'Colors', 's41xHEhpGWQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2284, 46, 'Brush Settings', 'PQ88jh89dmc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2285, 46, 'Brush Modes', 'sKnpo1su56o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2286, 46, 'Fills and Gradients', 'YRHrjC_C94I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2287, 46, 'Simple Image Repairs', 'NdZiBzR4Ei8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2288, 46, 'Magic Wand and Quick Selection Tools', '8PBhP3G2nqg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2289, 46, 'Masks', 'RF_nCVpDvYY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2290, 46, 'Smart Filters', 'jRLkiEbiVmQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2291, 46, 'Smart Filter Masks', 'd6obHbNf958');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2292, 46, 'Unsharp Mask', 'HsuT4NZzSTc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2293, 46, 'Blur', 'XDDlc0byWNU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2294, 47, 'Elementary School', 'sCZI1zGO5KI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2295, 47, 'Pokemon and Yoyos', 'y0pMnI8-kCk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2296, 47, 'Riding Bikes as Kids and Fighting', 'bqgb0YwZnz8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2297, 47, 'Dirty Pictures at the Park', 'mhftQBaqUC0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2298, 47, 'Chatrooms and Hacking the Brain', 'nvMmMvfeMog');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2299, 47, 'Dennys Waitress and Christmas Shopping', 'CWRjDvx00J0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2300, 47, 'Crazy Christmas Traditions', 'pF6nwkW8CZ8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2301, 47, 'Weird Foods and Crazy Diets', '0SrwB1SvS1U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2302, 47, 'New Age Medicines', 'z89g66HCL-8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2303, 47, 'Schizophrenia with a Minor in Algebra', 'liei7GddAAE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2304, 47, 'How People Act in Groups and Celebrities', 'DmGoWhZJWbE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2305, 47, 'Rich People and thenewboston shirts', '5zH9PZHYgqs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2306, 47, 'Teenage Girl Detained for Design on Purse', 'hsp0rPHndbg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2307, 47, 'Girl Forced to Sword Fight Her Dad', 'H3XdtIVnOvU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2308, 47, 'Dumb People Breeding', '5OXes9lWvC4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2309, 47, 'Is spanking child abuse?', 'CCzDx8niMBg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2310, 47, 'Should Horse Slaughterhouse be Legal?', 'KIz3wc4HK3c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2311, 47, 'End of the World Predictions', 'fUHgyiP9kUQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2312, 47, 'T.V. in the Shower', 'bUI-CQs7EvM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2313, 47, 'The Impact of the Internet', 'tEvZhM8s1OA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2314, 47, 'Weird T.V. Shows and Websites', 'TOIDwU7R6po');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2315, 47, 'Gas, Cows, and More!', 'uI2izt5J0Ik');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2316, 47, 'Jobys Zoo Experience', 'Q3iFX30eJZ0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2317, 47, 'Crappy Careers', 'C1ataUnz4rI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2318, 47, 'T-Shirt Giveaway Contest', 'xDjcXQBKiKY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2319, 47, 'Siri for the iPhone', '0J3hasdHcLk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2320, 47, 'Texting and Cell Phones', 'RtiXOOtzFak');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2321, 47, 'Dead Deer in Mitchs Car', 'hd5HxoUyak0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2322, 47, 'Gambling, Pirates, and More!', 'I5TmaBf4we8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2323, 47, 'Video Game Addictions', 'MEtt5-MSXN8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2324, 47, 'Lucid Dreaming', 'ZDKf5tAGlqE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2325, 47, 'T-shirt Giveaway and Life Statistics', 'Zc_PlsR-ZYA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2326, 47, 'Old People vs Babies', '2gXYRhQ_Ouw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2327, 47, 'Science', 'YpyTvz18XlM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2328, 47, 'Why Not to Date Your Dream Girl', 'mSGQoQvHl9U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2329, 47, 'Education', 'ja7KcSd_hwY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2330, 47, 'Books and Movies', 'gZVMC0ant70');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2331, 47, 'Wife and Kids', 'hLnUdCfPNUc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2332, 47, 'Blame It on the Dog!', 'DXFhlc5tPGc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2333, 47, 'Joby Hates Hot Shirts', 'XixItTt6q74');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2334, 47, 'Pet Peeves', '-8SoT8voZFY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2335, 47, 'Cheating and More Embarrassing Moments', 'ZinjqG3OXQs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2336, 47, 'Pooping and Sneezing', 'vLelCeROUk0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2337, 47, 'Pooping in School', '7jdkKlM9jPQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2338, 47, 'Showing in Gym Class', 'C-a0HtGrhgk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2339, 47, 'First Time Making Out', '7H08RCAUOT0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2340, 47, 'Orange Gatorade', '7oA71goSsIM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2341, 47, 'Buckys Crazy Babysitter', 'cBqyaKpzxPs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2342, 47, 'Strip Club', 'F7F533fVOb0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2343, 47, 'Life in the Next 100 Years', '4EqIYyLIMhk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2344, 47, 'Time Travel', 'w8NqifAQCK4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2345, 47, 'How Did Something Come From Nothing?', 'HnB-9ZPn86I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2346, 48, 'Introduction to the Project', '-hvuXvWfz0U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2347, 48, 'Database and User', '-AjzMrcsFxI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2348, 48, 'Connecting to the Database', '7Ub8uHHTTwo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2349, 48, 'How to Get Free Stock Data', 'ov4PERxEUVo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2350, 48, 'Creating a Custom URL', '3lAfER6vi4Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2351, 48, 'Downloading and Saving Data', 'WgE-PdJUVsg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2352, 48, 'Text File to Database', 'Z8eJ0fMi4UI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2353, 48, 'Breaking Up the Array', 'cd7_VCjM6wM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2354, 48, 'Creating Tables for the Database', 'y2ORSO0mpBg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2355, 48, 'Inserting Data Into Tables', 'OLlKkcNywuA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2356, 48, 'Creating the main Function', 'l-OdtQZrnSw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2357, 48, 'Debugging and Testing', 'Ll3gc2tfzUo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2358, 48, 'Beginning Analysis', 'qdNClirOioE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2359, 48, 'Starting to Crunch the Numbers', 'AEgC1_Kcojs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2360, 48, 'dEWNTqEr0lQ', 'dEWNTqEr0lQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2361, 48, 'Counting the Days', 'HpXDHzvJYX4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2362, 48, 'Finishing Analyzing Data', 'rvq2-9Z69Po');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2363, 48, 'Inserting Into a Result Table', '_ENNifG4mtM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2364, 48, 'Creating the Results Table', 'F2OT3KGO40M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2365, 48, 'The Final Product', 'bLBsu1-Fu78');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2366, 49, 'Introduction to Databases', 'KgiCxe-ZW8o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2367, 49, 'Getting a MySQL Server', 'qgdKbmxR--w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2368, 49, 'Creating a Database', 'O4SIpJMH7po');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2369, 49, 'SHOW and SELECT', 'HQQ_hDCUUuI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2370, 49, 'Basic Rules for SQL Statements', 'evvg1h2ivDo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2371, 49, 'Getting Multiple Columns', 'TKbKAW0Fspc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2372, 49, 'DISTINCT and LIMIT', 'djXXk7bQJoQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2373, 49, 'Sorting Results', 'hNN--F2STjw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2374, 49, 'Sort Direction', 'lpur97grL8M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2375, 49, 'Basic Data Filtering and WHERE', 'jK66G_hL7LU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2376, 49, 'Advanced Filtering Using AND and OR', 'YqIpbA08jUY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2377, 49, 'Are you IN or are you NOT IN?', '1e_zEVlh_xc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2378, 49, 'How Search Engines Work', 'rMkBEC6ngog');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2379, 49, 'More on Wildcards', 'cMDzleJ5z_Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2380, 49, 'Regular Expressions', 'oSlVsbDYqrY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2381, 49, 'Creating Custom Columns', '0wNf95gYWi0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2382, 49, 'Functions', 'lQx7qZ7XApI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2383, 49, 'More on Aggregate Functions', '0pfKXxB6aD8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2384, 49, 'GROUP BY', '_uyyc5fc3J8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2385, 49, 'Subqueries', 'I4wk67fkZNw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2386, 49, 'Another Subquery Example', 'GjjU6gdfXzc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2387, 49, 'How to Join Tables', '6BfofgkrI3Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2388, 49, 'Outer Joins', 'cXQOSQo_RDI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2389, 49, 'UNION', 'crj8x1PevcY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2390, 49, 'Full-Text Searching', 'd--v0NhjIfc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2391, 49, 'INSERT INTO', 'jsCvvSQwtMA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2392, 49, 'How to Insert Multiple Rows', '6L8zs2rk3DY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2393, 49, 'UPDATE and DELETE', '_Sy21asK2iw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2394, 49, 'CREATE TABLE', 'cQjyBDF2MF4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2395, 49, 'NOT NULL and AUTO INCREMENT', 'WVDhofE2haE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2396, 49, 'ALTER / DROP / RENAME TABLE', 'ELI2-pEk1FY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2397, 49, 'Views', 'luO2MWjUqe4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2398, 49, 'Final Video!', 'DOLL20iUUXg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2399, 50, 'Installing Ruby', 'WJlfVjGt6Hg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2400, 50, 'Writing a Simple Program', 'RDqJUU7XmLs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2401, 50, 'Math and Variables', 'B8ud8VlODok');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2402, 50, 'Classes', 'a6pFTOPablg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2403, 50, 'Creating Objects', 'NmfS7DJ-o2k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2404, 50, 'Inheritance', 'mKXGMdWa1Ow');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2405, 50, 'Adding More Attributes', 'jy3Tqy_kEFQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2406, 50, 'Methods', 'cBeGRWX0Nvw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2407, 50, 'Everything is an Object!', 'F75wFJIa368');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2408, 50, 'Arguements', 'CEOdjDDvEbs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2409, 50, 'String Functions', 'eSQCTWSCrso');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2410, 50, 'More About Variables & Methods!', 'waD9vpzT8k0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2411, 50, 'Expressions and Shortcuts', 'DmLTKTxVS_M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2412, 50, 'Decision Making', '-P_GS40CcGA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2413, 50, 'Comparison Operators', 'to_wbMDD34s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2414, 50, 'unless', '2iysMciUQpw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2415, 50, 'Loops', 'sNBC8TewzpA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2416, 50, 'Extracting the Value From Loops', 'xj22v2dZ_LI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2417, 50, 'Changing Data Types', 'iYGZeDhkeZY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2418, 50, 'Constants', 'qAqGIMKIMcA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2419, 50, 'Multiple Line String Variables', '-nx89Dpw0oE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2420, 50, 'Interpolation', 'S-7JSa22JFY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2421, 50, 'Beginning Regular Expressions', 'q70q-QyIios');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2422, 50, 'Regular Expressions in Loops', 'YRs3XQjaSe0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2423, 50, 'Extracting Numbers and Character', 'PsH6uOuZsKY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2424, 50, 'Decision Making with Regular Expressions', 'LrtuTTusX1E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2425, 50, 'Beginning Arrays', 'dZNQhmbwgKc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2426, 50, 'push and pop', 'rwExwPy_FFk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2427, 50, 'each and length', 'm_H8lxpZrdQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2428, 50, 'Cool Array Tricks', 'bxZE4k1ORrc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2429, 50, 'Hashes', 'imns9_XncQU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2430, 50, 'Methods for Hashes', 'tFhFbj_JZ14');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2431, 51, 'Introduction', 'sithxUuUQaw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2432, 51, 'Creating a FTP Account', '98RsJH9_sno');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2433, 51, 'Setting Up the Database', 'fcvak7436tw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2434, 51, 'Connecting to the Database', '1KxH8gqsmvI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2435, 51, 'Beginning User Registration', 'D9Vp0H8jYhE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2436, 51, 'Main CSS File', 'GuxuDcrCtfQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2437, 51, 'Styling the Headings', 'NMVJUiA4-cY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2438, 51, 'Styling Tables and Links', 'AOaUrujUfPA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2439, 51, 'Styling Random Classes', 'Lu7zfKsZo0w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2440, 51, 'Working on the Main Layout', 'TPo5injsmyI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2441, 51, 'Finishing the Main Layout', 'MGOn-Zqt64w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2442, 51, 'Interaction Satisfaction', 'X7awlV7FWP8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2443, 51, 'How to Make Awesome Looking Forms', 'dSAsvIBAVZ8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2444, 51, 'Working on Forms CSS', 'A5r515lSXgQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2445, 51, 'Finishing Styling Forms', 'ozffV0N8994');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2446, 51, 'Wrapping Up CSS (for now)', 'UeFslCB8dk8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2447, 51, 'Logo and Top Links', 'bFB5g9qaWUo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2448, 51, 'Top Search Bar', 'ejq64aiJMUg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2449, 51, 'Creating Cool Dynamic Links', 'UMHOnPKbHBI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2450, 51, 'Finishing Up the Sweet Links', 'Sg_uj8SqKjo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2451, 51, 'Smart Drop Down Menu', 'w20_eJ3yNso');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2452, 51, 'Finishing the Smart Drop Down Menu', 'TuJNtnsil3Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2453, 51, 'Creating the Registration Form', 'NRgLPxj__QM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2454, 51, 'Finishing the Register Form', 'oOZIht8uXkQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2455, 51, 'Validating User Data', 'm41nrcVZgwI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2456, 51, 'Validating Email and Password', 'pf_ofDymeII');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2457, 51, 'Outputting Error Messages', 'Lh_ucrOv5KE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2458, 51, 'Checking if email and username are available', 'Ndo5FZ5p9nI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2459, 51, 'Finishing the Registration Page!', 'K0D2-J1JDIE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2460, 51, 'Styling the Prompt Page', 'srzgvJvyeC0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2461, 51, 'Finishing the Prompt Page', 'ivXA3_XeFDk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2462, 51, 'Activating User Accounts', 'E3B4mLG8kEY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2463, 51, 'Retrieving Users Temporary information', 'qsXZ0K_tqSg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2464, 51, 'Finishing the Activation Script', 'Mpu_zJNMcsM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2465, 51, 'Log In Script', 'e6d3m0rByDM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2466, 51, 'Querying the Users Information', 'V0wwlPFV8Kc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2467, 51, 'Setting Users Session Variables', 'ipeTUOyN-0w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2468, 51, 'Logging Out', '-jMrhRB1mDQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2469, 51, 'Adding New Items to the Website', 'E-qf2NvKhjM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2470, 51, 'Calculating Users Statistics', '4aGZmXs3UD0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2471, 51, 'Finishing Calculating Users Statistics', 'vO4lpY9CQ3o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2472, 51, 'Cleaning Up the Messy Stats', '6gL3AvE47KE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2473, 51, 'How to Make Awesome Colored Tabs', 'YhczAH66zv4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2474, 51, 'Special Panels for Moderators and Admins', 'YIxzRfvucoc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2475, 51, 'Someone help me, I have too many variables!', 'N_3tuxOAI8o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2476, 52, 'Weird Chicken McNugget Shapes', 'lFUYhzbJt0s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2477, 52, 'Cheeseburgers, Walmart, and Turtles', 'yA7rjRBwfWA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2478, 52, 'Gas Guessing Game and Mailing T-Shirts', 'aREGOuEiUGc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2479, 52, 'Dirty Macaroni and Special Mashed Potatoes', '_7FLKoomADU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2480, 52, 'Golfing', 'Gow9T37hqOw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2481, 52, 'Launching Model Rockets', 'MfxJ55JSZxs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2482, 52, 'Grilling Chicken', 'oLBX-eqUj5k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2483, 52, 'Tour of My House (Part 1/2)', 'nSbJ-KkIANA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2484, 52, 'Tour of My House (Part 2/2)', 'MoaLPlh453Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2485, 52, 'Hotel in Myrtle Beach', 'L6dvdFED3w8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2486, 52, 'Boardwalk and Slingshot', 'h4Xkn5AcWvs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2487, 52, 'Firecrackers', 'PDRo3y_nkf4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2488, 52, 'What is a Sensory Deprivation Tank?', 'of_hC8OsVEw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2489, 52, 'The Sensory Deprivation Tank Experience', 'gn4tsZBOxnc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2490, 52, 'Sensory Deprivation Tank Hallucinations', 'A9pClPlAaAg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2491, 52, 'Pretzel Dogs and Light Bulbs', '1OJKOnlPqfs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2492, 52, 'Mitch is Drunk', 'DP9XRt0ovbI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2493, 52, 'Microscopes and Drugs', '6_3OPwgQht0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2494, 52, 'Bad Idea', 'C4ii-fMfPis');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2495, 52, 'Research', 'L6OfWA6N4nY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2496, 52, 'Deep Frying', 'Rd_0UYBpYyU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2497, 52, 'The Mannequin', 'psLl9-QL6_E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2498, 52, 'Hawaiian Punch Wine', 'znT6D4jhnUY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2499, 52, 'Making the Wine', 'k-p-gtP5E7s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2500, 53, 'Introduction', 'dPjWzyGmTLo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2501, 53, 'The Engine', '1i5oGqysSpM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2502, 53, 'Chain', 'yZ06WjbWK1U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2503, 53, 'Shifter Cable', 'bGyni6QHGbE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2504, 53, 'Front Suspension', 'NDi53F3wGtA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2505, 53, 'Front Struts', 'Vwl_8BPLM6o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2506, 53, 'Steering System Overview', 'P-_kyDCffHA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2507, 53, 'Steering', 'Ic6XCs8qHvY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2508, 53, 'Brake System Overview', 'flZD5cQFz4c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2509, 53, 'Brake Master Cylinder', 'i-I3R813QeA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2510, 53, 'Brake Caliper', 'kW9vV5Iwbmk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2511, 53, 'Parking Brake', '8rhtOq_OQ90');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2512, 53, 'Tires', '_-1jWlz3DEQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2513, 53, 'Carburetor Overview', 'qGOECLhaKDs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2514, 53, 'Carburetor', 'KLMjNt0vR_k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2515, 53, 'Starter', 'biCJjItAi7k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2516, 53, 'Gas Pedal', 'Kt--6i6F560');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2517, 53, 'Throttle Cable', 'vPTf-TFxz9s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2518, 53, 'Air Filter', 'OTlCPesdV4Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2519, 53, 'Rear Struts (the easy way)', 'm3XJhOf0Chg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2520, 53, 'PCV System', 'KRUNsnc0Log');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2521, 53, 'Gas Tank', '-dTacf38H90');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2522, 53, 'Wiring Overview', 'bSR9CKm9XAc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2523, 53, 'Dashboard Electronics', 'ct1idqWqCtY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2524, 53, 'Brake Light Sensor', 'bpxzU8M_mdw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2525, 53, 'Headlights', 'gorjefB84mQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2526, 53, 'Turn Signals', 'frxCsZzncwo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2527, 53, 'Preparing and Installing the Battery', '-tnlwmVjPz4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2528, 53, 'Reflectors and Mirrors', 'D_IKGiH_6Ns');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2529, 53, 'Mud Flaps', '2ZufA5me-6I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2530, 53, 'Main Roll Bar', 'aMtnui7LrLs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2531, 53, 'Finishing the Roll Bars', 'IEq3qOdkdUo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2532, 53, 'Front Bumper', 'sbuLDlMgLHA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2533, 53, 'Seats', 'TAXbfNJD9Yk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2534, 53, 'Seatbelts', 'sp4FoD_HFOc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2535, 54, 'Setting Up the Project', 'AXNDBQfCd08');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2536, 54, 'Downloading Slick and the LWJGL', 'cQWrhT7wypA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2537, 54, 'Finishing Setup', 'TfwcbMcT-Ig');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2538, 54, 'Beginning the Coding', 'njsXg8nBWpU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2539, 54, 'initStatesList Method', 'C_h1M8JKFEc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2540, 54, 'Creating the Main Window', '2WVYqkjx2a0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2541, 54, 'How to Make Screens', 'cLD4pm3V4Rw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2542, 54, 'Shapes, Text, and Titles!', '1GcgHpPHatE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2543, 54, 'Working with Images', 'ZDsGTiACqnw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2544, 54, 'Getting Mouse Input from the User', 'SEQdJF4sXPE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2545, 54, 'Grabbing Keyboard Input From the User', 'rLoJ8CySfgM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2546, 54, 'How to Change States', 'baVVv9wayJw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2547, 55, 'Working with Panels', 'jup9kMp681w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2548, 55, 'Working with Tools', 'XZe5DvQ5EV4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2549, 55, 'How to Create a New Document', 'S_chwGVEqfE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2550, 55, 'Opening and Inserting Images', 'SlKt3vY1Tlw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2551, 55, 'Changing Image and Canvas Size', 'JlN7yg7w9w0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2552, 55, 'Saving Images and Checking for Updates', 'Gm6z2BNnk2U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2553, 55, 'Navigation Panel and Zoom Tool', 'n5kXtNwcHC8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2554, 55, 'Hand Tool', '5lFFjAcyDPs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2555, 55, 'Working with Multiple Documents', 'cNGYuzUx9Ss');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2556, 55, 'Ruler Tool', 'HNgL2imGbc4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2557, 55, 'Ruler Guides', 'wq2RgCu8-oI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2558, 55, 'Rectangular Marquee Tool', 'wKXsReGnCLQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2559, 55, 'Elliptical Marquee Tool', 'f7MAtroEimY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2560, 55, 'Lasso Tool', '4kPaD852zJ8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2561, 55, 'Magnetic Lasso Tool', 'cQ8Bi-Hisq8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2562, 55, 'Magnetic Lasso Tool Settings', 'Sjlk0xU7dh0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2563, 56, 'The Beginning', 'dvQBh-8kCV4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2564, 56, 'Last Meal', '9JMmWi58YGc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2565, 56, 'Split in the River', '07yeNsLOKGY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2566, 56, 'My Supplies', 't5q6ay3wxLo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2567, 56, 'Talking by a Creepy Pond', 'd9dbMg_8Nxo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2568, 56, 'The Beach', 'pE-2DklQO4U');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2569, 56, 'Making a Spear for Fishing', 'K8MKF5v-Z5M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2570, 56, 'Looking for Fish in the River', 'mdnWJ6heO0g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2571, 56, 'Eating Minnows and Attempting to Make Fire', 'KXcoIY4c8B8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2572, 56, 'Boiling Water', 'J8xWQMch3j4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2573, 56, 'Drinking Water at the End of the Day', 'BHgTS91rtS8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2574, 56, 'Getting Soaked from the Rain', '4UyCEMHPorQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2575, 56, 'Climbing the Mountain', 'EhN7RJ4Q-Ng');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2576, 56, 'On Top of the Mountain', 'NkH0316sTgU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2577, 56, 'The Worm', '_4vt5uJrBv0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2578, 56, 'Discovering the Lake', 'cAl70On-GjU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2579, 56, 'Making A Frog Spear', 'a0fBULa3WPk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2580, 56, 'Frog Hunting', 'xio53TJ33vU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2581, 56, 'Fire by the Lake', 'ufllpe-3JLw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2582, 56, 'Climbing the Cliff', 'KysMgvcWEOI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2583, 56, 'The Compass', 'FS-TvkgRo_E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2584, 56, 'Trying to Reach the Pond', 'zkiXchBfnsA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2585, 56, 'Fishing Supplies', 'HFpoLW1xXjQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2586, 56, 'Fishing', 'Lnu471lOIbM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2587, 56, 'Washing Clothes in the River', 'ObYTpxeMScU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2588, 56, 'Meal from the Marsh', 'ctemidQUGiY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2589, 56, 'Gutting and Eating', 'yvm1cfu62Qg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2590, 56, 'Shelter', 'tttjZnDK26I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2591, 56, 'Losing Energy ', '8BzLt5Sg9dU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2592, 56, 'The Waterfall', 'fcyxpba_5Mg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2593, 56, 'Fishing with New Spear', 'O3KxT03bQ-g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2594, 56, 'Raw Fish', 'PfEp_BWMi3w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2595, 56, 'Hungry and Need Food', 'gDFuUQKGpMc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2596, 56, 'Fire Making Tools', '0DurPgCk9Qs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2597, 56, 'Smoking', 'uWsmBy4ibUI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2598, 56, 'Improving the Fire Making Tools', 'YWfAH0wxscM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2599, 56, 'Starving, Thirsty, and Feeling Hopeless', 'lwTQU0Kf1gU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2600, 56, 'The Trail', 'lmz_vbUCCDI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2601, 56, 'Late Afternoon on the Trail', 'zX_NROraWog');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2602, 56, 'Final Video', 'HaGxkckag98');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2603, 57, 'Downloading the Qt SDK', 'aMUh9DmFLto');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2604, 57, 'Creating a Simple Project', 'HiOOWDb4YjE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2605, 57, 'Qt Creator Modes', 'CRVwBNkn63s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2606, 57, 'Understanding a Basic Qt Application', 'HnuY7NhzLGM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2607, 57, 'Differences in Operators', 'ufnA4UOKAFE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2608, 57, 'Signals and Slots', 'swZNOKKkQiw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2609, 57, 'Spinners and Sliders', 'kg98E06wm1I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2610, 57, 'Syncing Widgets and Layouts', '7ZuSs27tQPA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2611, 57, 'Creating a Useful Program', 'HgyocPuO1Hk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2612, 57, 'Designing the User Interface', 'DUeMzXc2V_Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2613, 57, 'Coding the FindCrap Program', 'pQHFqp0NK4E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2614, 57, 'Finishing the getTextFile Function', '6GyrKryOVJY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2615, 57, 'Finishing up All the Code', 'mn4t2tqncoA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2616, 57, 'Running Our Awesome FindCrap Program!', '-A5S9ka5H9A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2617, 58, 'Introduction to Biology', '3w1fY67dnFI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2618, 58, 'What is Life?', 'zcHBT6QFIqk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2619, 58, 'Properties of Life', '1tWuDkrvJ6k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2620, 58, 'Acids and Bases', '5nOnxekmM6A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2621, 58, 'Why are Acids and Bases Important?', 'XZ6W-HowJ-c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2622, 58, 'pH Scale', 'NRNDzFCx4d0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2623, 58, 'Carbohydrates', '_WGD5UhqShI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2624, 58, 'Classifying Carbohydrates', 'fa9VMB33_7Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2625, 58, 'Sugars', 'r59has_1TRA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2626, 58, 'Why does your body need Carbohydrates?', 'V7DFfqTxrnY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2627, 58, 'Proteins', 'vUfTuEG5nDo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2628, 58, 'Nucleic Acids', 'K4dKFxSkr6w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2629, 58, 'DNA', 'xtnU9Izzwwo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2630, 58, 'Lipids', 'uI25g_0PjHk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2631, 58, 'The Cell', 'ho_5JlSv53I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2632, 58, 'Plasma Membrane', '4Ug5Vf_lxtI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2633, 58, 'Transporting Materials Through the Cell Membrane', 'VwnsFOc7s-0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2634, 58, 'Diffusion', '8CW2hX5oqaM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2635, 58, 'Osmosis', '9_6m0ShSrbc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2636, 58, 'Nucleus', 'lWIrPppYNuU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2637, 58, 'Ribosomes', 'MiVqjxi0DfQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2638, 58, 'Endoplasmic Reticulum', 'YDNtgSfZyWs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2639, 58, 'Golgi Apparatus', 'w8hODkC88c8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2640, 58, 'Lysosome', '4ls5dUqj9IU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2641, 58, 'Peroxisome', 'z0CJZ9ulAdo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2642, 58, 'Mitochondria', 'AOxyFPoxITY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2643, 58, 'Enzymes', 'L_D1PX6oOog');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2644, 58, 'Anabolic and Catabloic Reactions', 'fvs9uAZIVbk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2645, 58, 'ATP', 'mAHEGZL-gwA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2646, 58, 'Autotrophs vs Heterotrophs', 'UYkY08N22YI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2647, 58, 'Photosynthesis and Cellular Respiration', 'GRNDPYEuT8c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2648, 58, 'Glycolysis (Investment Phase)', 'tOspvlza-HM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2649, 58, 'More on Glycolysis', 'WVwUAz4BE5E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2650, 58, 'Glycolysis (Payoff Phase)', 'kXsF09SYuro');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2651, 58, 'Preparing for the Krebs Cycle', 'DtRrKKvnH6o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2652, 58, 'Krebs Cycle / Citric Acid Cycle', 'M4XWItbcxoY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2653, 58, 'More on the Krebs Cycle', 'iou_uKKT_R4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2654, 58, 'Finishing the Krebs Cycle', 'wy12uCJia_A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2655, 58, 'Krebs Cycle Summary', '2V8mbl4C5uY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2656, 58, 'Electron Transport Chain', 'IFT3BLWdme4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2657, 58, 'More on the Electron Transport Chain', 'P_I-m0qQa6k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2658, 58, 'Creating ATP with ATP Synthase', 'qnUucAXrzR8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2659, 58, 'Electron Transport Chain Summary', '4qXI1zwMrqs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2660, 58, 'Intro to DNA Replication and Cell Division', 'MkBmyiK10HE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2661, 58, 'DNA Replication', '0rTuye-dVqE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2662, 58, 'DNA Leading and Lagging Strand', 'TudeT0-Lves');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2663, 58, 'Cell Division and Interphase', 'pYpBNWIG1yk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2664, 58, 'What is a Chromosome?', 'T_sy765tyb0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2665, 58, 'Mitosis and Prophase', '-Hs2vmlo6ts');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2666, 58, 'Mitosis Metaphase, Anaphase, and Telophase', '-FC7oJnPQjs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2667, 58, 'Cytokinesis', 'tSLdzYsKNw8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2668, 58, 'Meiosis', 'rJVrcPTPuMA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2669, 58, 'Stages of Meiosis', '9Cu5OOqLRSA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2670, 58, 'Prophase 1', 'DQWnB72AX1Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2671, 58, 'Metaphase 1 and Anaphase 1', 'Y8ieDANkDe4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2672, 58, 'Meiosis 2', 'IaI6KI1r3Co');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2673, 58, 'Finishing Meiosis', '_woWlcyDCNw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2674, 58, 'Genetics', 'D3QxmGumgpA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2675, 58, 'Gregor Mendel and Genetics', 'RxFeBsxRei8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2676, 58, 'Pea Plant Experiment and Genes', 'FvYo3ZgaQ1c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2677, 58, 'Genes, Traits, and Alleles', 'niHns546FFs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2678, 59, 'Potassium Chlorate and Gummy Bear ', '46AdVDtSV6c');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2679, 59, 'Grape Microwave Plasma', 'JWrxrjAefq8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2680, 59, 'Sulfuric Acid and Sugar', 'zg9wmU7Z-6s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2681, 60, 'Safety', 'M3Eyo-Im3x0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2682, 60, 'Test Tubes', 'HQGIr89aGFQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2683, 60, 'Beakers', '71l1u9FBAr0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2684, 60, 'Erlenmeyer Flasks', 'SaOWaR95YoU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2685, 60, 'Florence Flask / Boiling Flask', 'GdNpvDJnjjU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2686, 60, 'Filtering Flask', 'VHAURJD7X7M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2687, 60, 'Funnels', 'Y48tmRhvI-s');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2688, 60, 'Storing Chemicals', 'wZwIGeAVgTo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2689, 60, 'Barnes Bottles', 'eY-rVI1AxQI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2690, 60, 'Wash Bottles', 'XVqaezU4g4E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2691, 61, 'Introduction to AJAX', 'tp3Gw-oWs2k');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2692, 61, 'Some Examples of AJAX', '-1RLW7a8Gr4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2693, 61, 'Creating the Beautiful User Interface', 'bW3Ys2pcfug');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2694, 61, 'Generating the XML File', 'Q1xJ4m7fPSg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2695, 61, 'Creating the Content for the XML File', 'AlZbs693EmM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2696, 61, 'XMLHttpRequest', 'r80S2CnCjLs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2697, 61, 'Communicating with the Server', 'vQV8Pyoe0ng');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2698, 61, 'Sending Requests to the Server', 'tR0RpM2IDmw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2699, 61, 'Handling Responses from the Server', '0YyTrxAMC34');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2700, 61, 'Changing the Users HTML', 'hq0Yp8dQ2DM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2701, 61, 'Running our Awesome Program!', 'masMZc3J03I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2702, 61, 'The Best Practices', 'p2mjNESHlh8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2703, 61, 'Setting up the Web Page', 'UR23-9tu0hU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2704, 61, 'Jamaican Me Crazy', 'UpNx1W2UmHY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2705, 61, 'All About Nodes', 'SXA05qwTr6Q');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2706, 61, 'Sticking Children Inside Things', 'N_jfOUAvBsc');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2707, 61, 'Finishing Our Favorite Things Program', 'dmx51lMnuSE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2708, 61, 'Dudes and Chicks', 'oJiMYnYgjhs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2709, 61, 'Creating Themes with CSS', 'OVOngbevN2o');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2710, 61, 'Sweet Dynamic HTML Program', 'N7TguRvvNBo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2711, 61, 'XMLHttpRequest Object in Detail', 'Sz2_B4ezDW8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2712, 61, 'Creating XMLHttpRequest Objects Correctly', 'gpx2yNivuUY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2713, 61, 'Setting up the Process Function', 'tr7Brsc1U1Y');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2714, 61, 'Configuring and Connecting to a Server', 'qKWgpbCjhGU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2715, 61, 'Handle a Response from a Server', 'sgoNJjsYQrg');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2716, 61, 'Different States in AJAX', 'NY9rAI_Mxuk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2717, 61, 'Holy Carp!', 'hLrlATNa6nE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2718, 61, 'Working with XML Structures', 'VHAEEPs0fpE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2719, 61, 'Little Ann Farted', 'freOtjLldsw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2720, 61, 'tuna', 'Kd-ZS0NCAJw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2721, 61, 'I Have Black Lung', 'vL_V-rUeW98');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2722, 61, 'Getting the Data from the XML File', 'ItfXcrHXZq0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2723, 61, 'Looping Through and Displaying Employee Information', '6Mo2iDFXfnE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2724, 62, 'Introduction', '1l-FJFL3zcE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2725, 62, 'Brew Kettles and Carboys', 'kgbLeGEBsgI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2726, 62, 'Bungs, Airlocks, and Bottling Buckets', 'dLVbkVWIo8I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2727, 62, 'Wort Chillers, Sanitizer, and More!', 'KyoElkNGv0w');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2728, 62, 'Preparation', 'qsHUPQ2P8nk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2729, 62, 'Preparing the Yeast', 'wb2hmEQZn1M');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2730, 62, 'Adding the Malt Extract ', 'eGAqNePG2F0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2731, 62, 'Adding the Hops', 'hq2PGNjG_QE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2732, 62, 'Chilling the Wort', 'K_j5l-wtkAE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2733, 62, 'Fermentation', 'JooziYpPufI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2734, 63, 'Setting up the Project', 'GnQX230vU4E');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2735, 63, 'General Styling', 'kPudqWw6vGY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2736, 63, 'Creating the Transparent Effect', 'xI4jNaruFjs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2737, 63, 'Layering Shadows for Glare', 'N7-LoQSyJKw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2738, 63, 'Styling Headers and Paragraphs', 'STUv7JoHXh4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2739, 63, 'My Sisters First Boyfriend', 'nOS8fjkoiaQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2740, 63, 'Layouts and Clearing Rows', 'rgoRQbgNjqM');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2741, 63, 'Black Boxes', 'EENF7HNS1co');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2742, 63, 'Notification Icons', 'sPTGB33TUu8');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2743, 63, 'Cool Pop-up on Mouse Hover', 'iatC8RRd5Ys');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2744, 63, 'My Girlfriends Mom', 'WRa2SHLBKwk');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2745, 63, 'Glowing Text', 'W3txw0UHP0I');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2746, 63, 'Styling the Home Button', 'LMV-5wM5Y48');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2747, 63, 'Styling the Drop-up Menus', 'RHGCigylp4g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2748, 63, 'Making the Drop-up Gorgeous', 'lbRmni5OvHI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2749, 63, 'Styling the Programs Items', 'QQQsEl5bUkQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2750, 63, 'Creating Sexy Glowing Links', 'BVMwltyq5mQ');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2751, 63, 'Moving Crap to the Right ', '37Sset7erZs');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2752, 63, 'Creating the Layouts', 'fl5oyWyklOw');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2753, 63, 'Making the Columns That Go Inside', 'ZloSHkj_GBY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2754, 63, 'Creating the Home Button', 'dZBgZ7GpgfE');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2755, 63, 'Single Column Menus', 'YFh1OxiCWtI');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2756, 63, 'Working with Three Column Layouts', '0DiGDgTfK5A');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2757, 63, 'Finishing the Three Column Layout', 'QX5amrZ0XfU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2758, 63, 'Programs and Log Out Buttons', 'iO8t5nGaZ1g');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2759, 63, 'Creating the Notification Icons', 'UGVcEtaUbng');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2760, 63, 'Final Video', 'y2Pak1zMo88');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2761, 64, 'Introduction', 'nG2YaC3unCo');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2762, 64, 'Creating the Chat Table', '3q8o5Iix6iY');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2763, 64, 'Adding the Table to the Database', '08nfW2Ji5-4');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2764, 64, 'Creating a Custom Error Handler', 'vcq5U8852tA');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2765, 64, 'Connecting to the Database', 'lWaHTjEMyew');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`) VALUES (2766, 64, 'Deleting Messages', 'nJFNXDiQyC0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2767, 64, 'Posting New Messages', 'OHfFByRFCpU');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2768, 64, 'Getting New Messages', 'tAKc-TyyKg0');
INSERT INTO `videos` (`videoID`, `categoryID`, `title`, `code`)
VALUES (2769, 64, 'Getting Messages for New Users', 'Usvwj-p7XFA');

CREATE TABLE `video_comments` (
  `commentID`   INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `videoID`     INT(11)                   DEFAULT '0',
  `userID`      INT(11)                   DEFAULT NULL,
  `content`     VARCHAR(5000)             DEFAULT NULL,
  `createdDate` DATETIME                  DEFAULT NULL,
  PRIMARY KEY (`commentID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;