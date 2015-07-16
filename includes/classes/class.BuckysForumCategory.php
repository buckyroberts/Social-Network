<?php

/**
 * Forum Categories
 */
class BuckysForumCategory {

    public static $COUNT_PER_PAGE = 30;

    /**
     * Getting All Categories
     *
     * @param null $categoryID
     * @return array
     */
    public static function getAllCategories($categoryID = null){
        global $db;

        if($categoryID == null)
            $query = "SELECT c.*, t.topicTitle AS lastPostTitle, IF(t.lastReplyID = 0, t.creatorID, t.lastReplierID) AS lastPosterID, IF(t.lastReplyID = '0', t.createdDate, t.lastReplyDate) AS lastPostDate, CONCAT(u.firstName, ' ', u.lastName) AS lastPosterName FROM " . TABLE_FORUM_CATEGORIES . " AS c " . "LEFT JOIN " . TABLE_FORUM_TOPICS . " AS t ON c.lastTopicID=t.topicID AND t.status='publish' " . "LEFT JOIN " . TABLE_USERS . " AS u ON IF(t.lastReplyID = 0, t.creatorID, t.lastReplierID)=u.userID " . "ORDER BY parentID, sortOrder";else
            $query = $db->prepare("SELECT c.*, t.topicTitle AS lastPostTitle, IF(t.lastReplyID = 0, t.creatorID, t.lastReplierID) AS lastPosterID, IF(t.lastReplyID = '0', t.createdDate, t.lastReplyDate) AS lastPostDate, CONCAT(u.firstName, ' ', u.lastName) AS lastPosterName FROM " . TABLE_FORUM_CATEGORIES . " AS c " . "LEFT JOIN " . TABLE_FORUM_TOPICS . " AS t ON c.lastTopicID=t.topicID AND t.status='publish' " . "LEFT JOIN " . TABLE_USERS . " AS u ON IF(t.lastReplyID = 0, t.creatorID, t.lastReplierID)=u.userID " . "WHERE c.categoryID=%d OR c.parentID=%d " . "ORDER BY parentID, sortOrder", $categoryID, $categoryID);
        $rows = $db->getResultsArray($query);

        $result = [];
        foreach($rows as $row){
            if($row['parentID'] == 0){
                $result[$row['categoryID']] = $row;
            }else{
                if(!isset($result[$row['parentID']]['children']))
                    $result[$row['parentID']]['children'] = [];
                $result[$row['parentID']]['children'][] = $row;
            }
        }

        return $result;
    }

    /**
     * Get Categories
     *
     * @param mixed $parentID
     * @return Indexed
     */
    public function getCategories($parentID = 0){
        global $db;

        $query = $db->query("SELECT * FROM " . TABLE_FORUM_CATEGORIES . " WHERE parentID=%d ORDER BY sortOrder", $parentID);
        $rows = $db->getResultsArray($query);

        return $rows;
    }

    /**
     * Update Category Last Topic ID
     *
     * @param Int $catID
     */
    public static function updateCategoryLastTopicID($catID){
        global $db;

        $query = $db->prepare("SELECT topicID FROM " . TABLE_FORUM_TOPICS . " WHERE categoryID=%d AND STATUS='publish' ORDER BY lastReplyID DESC LIMIT 1", $catID);
        $lastID = $db->getVar($query);

        if(!$lastID)
            $lastID = 0;

        $db->updateFromArray(TABLE_FORUM_CATEGORIES, ['lastTopicID' => $lastID], ['categoryID' => $catID]);

        return;
    }

    /**
     * Update Category Topics count
     *
     * @param Int $catID
     */
    public function updateCategoryTopicsCount($catID){
        global $db;

        $query = $db->prepare("SELECT count(1) FROM " . TABLE_FORUM_TOPICS . " WHERE categoryID=%d AND STATUS='publish'", $catID);
        $count = $db->getVar($query);

        $db->updateFromArray(TABLE_FORUM_CATEGORIES, ['topics' => $lastID], ['categoryID' => $catID]);

        return;
    }

    /**
     * Get Category By ID
     *
     * @param Int $id
     * @return Array
     */
    public static function getCategory($id){
        global $db;

        $query = $db->prepare("SELECT * FROM " . TABLE_FORUM_CATEGORIES . " WHERE categoryID=%d", $id);
        $row = $db->getRow($query);

        //Getting Links
        if($row){
            $query = $db->prepare("SELECT * FROM " . TABLE_FORUM_CATEGORIES_LINKS . " WHERE categoryID=%d", $id);
            $links = $db->getResultsArray($query);
            $row['links'] = $links;
        }

        return $row;
    }

    /**
     * @param $categoryID
     * @return string
     */
    public function getCategoryDescription($categoryID){
        $catDesc = '';

        switch($categoryID){
            case 43:
                $catDesc = 'Chat about anything non-computer related including, music, movies, tuna sandwiches, and more!';
                break;
            case 45:
                $catDesc = 'Just joined the website? Feel free to introduce yourself here. Oh, by the way, welcome to ' . TNB_SITE_NAME . '!';
                break;
            case 6:
                $catDesc = 'Create website animations, games, and other interactive applications for Flash.';
                break;
            case 7:
                $catDesc = 'Language that is commonly used in operating systems, compilers, and other low level programs.';
                break;
            case 8:
                $catDesc = 'One of the most popular languages of all time.';
                break;
            case 9:
                $catDesc = 'C# is an object-oriented language designed for improving the development of web applications.';
                break;
            case 44:
                $catDesc = 'Used in many types of software including music players, video games, and many large scale applications.';
                break;
            case 10:
                $catDesc = 'Very popular language used to create desktop applications, website applets, and Android apps.';
                break;
            case 11:
                $catDesc = 'A scripting language that is added to standard HTML to create interactive effects, apps, games for the browser.';
                break;
            case 12:
                $catDesc = 'The core language behind iPhone, iPad, and iPod Touch Development.';
                break;
            case 13:
                $catDesc = 'Used for graphics, system administration, network programming, finance, and other applications.';
                break;
            case 14:
                $catDesc = 'Server-side, HTML embedded scripting language used to create dynamic Web pages.';
                break;
            case 15:
                $catDesc = 'This section is all about snakes! Just kidding.';
                break;
            case 16:
                $catDesc = 'Write web apps quickly and easily with this easy to learn language.';
                break;
            case 17:
                $catDesc = 'One of the first products to provide a graphical environment and a paint metaphor for developing user interfaces.';
                break;
            case 18:
                $catDesc = 'Think of a good description later.';
                break;
            case 19:
                $catDesc = 'Everything SQL and Databases related in here!';
                break;
            case 20:
                $catDesc = 'I think it is pretty obvious what this section is for.';
                break;
            case 21:
                $catDesc = 'Talk about 3Ds Max, Blender, or any other 3D software here.';
                break;
            case 22:
                $catDesc = 'The area for Apple news, rumors, and discussions.';
                break;
            case 46:
                $catDesc = 'Discuss, learn, and share stories about Bitcoin, the worlds most popular digital currency.';
                break;
            case 23:
                $catDesc = 'For all game design discussion including Unity and the Unreal Development Kit.';
                break;
            case 24:
                $catDesc = 'Section for all video gaming related discussion. PS3, Xbox 360, and PC gamers are all welcome here!';
                break;
            case 25:
                $catDesc = 'For news, announcements and discussion related to all Google services and products.';
                break;
            case 26:
                $catDesc = 'A place for hardware news, reviews and intelligent discussion.';
                break;
            case 27:
                $catDesc = 'Discuss, share, ask, learn and teach HTML5 and CSS3.';
                break;
            case 28:
                $catDesc = 'Linux is a free and open source software operating system for computers.';
                break;
            case 29:
                $catDesc = 'Apple fanboys not allowed.';
                break;
            case 30:
                $catDesc = 'Chat about routers, switches and firewalls, and more!';
                break;
            case 31:
                $catDesc = 'Questions about video editing? Looking for some editing tips? Discuss editing and share your ideas here.';
                break;
            case 32:
                $catDesc = 'Anything else technology related including search engines, social networking, marketing, and more!';
                break;
            case 33:
                $catDesc = 'Were here to help with your After Effects problems, critique your pieces, and sometimes provide a spot of inspiration.';
                break;
            case 34:
                $catDesc = 'Too lazy to code by hand? Then Dreamweaver is perfect for you!';
                break;
            case 35:
                $catDesc = 'When you want to make cartoons and annoying banner ads.';
                break;
            case 36:
                $catDesc = 'Learn to create vector graphic such as cartoons, logos, and more!';
                break;
            case 37:
                $catDesc = 'Used to create works such as posters, flyers, brochures, magazines, newspapers and books.';
                break;
            case 38:
                $catDesc = 'How could we ever get a distorted image of celebrities without it?';
                break;
            case 39:
                $catDesc = 'The best programs out there for editing digital video.';
                break;
            case 40:
                $catDesc = 'For discussion on all other Adobe related products.';
                break;
            case 41:
                $catDesc = 'Found a bug on the site? Report it here. For all security related bugs, please send me a private message.';
                break;
            case 42:
                $catDesc = 'Tell me what you like about the forum and what sucks about it here.';
                break;
            default:
                $catDesc = 'Description';
        }

        return $catDesc;
    }

    /**
     * @param $catID
     * @return array
     */
    public static function getCategoryHierarchical($catID){
        global $db;

        $result = [];

        $cCat = BuckysForumCategory::getCategory($catID);
        $result[] = $cCat;
        while($cCat && $cCat['parentID'] != 0){
            $cCat = BuckysForumCategory::getCategory($cCat['parentID']);
            $result[] = $cCat;
        }

        $result = array_reverse($result);

        return $result;
    }

    /**
     * @param     $categoryID
     * @param int $limit
     * @return Indexed
     */
    public function getRecentPosts($categoryID, $limit = 5){
        global $db;

        $query = $db->prepare("SELECT t.topicID, t.topicTitle, IF(t.lastReplyID = 0, t.creatorID, t.lastReplierID) AS lastPosterID, IF(t.lastReplyID = '0', t.createdDate, t.lastReplyDate) AS lastPostDate, CONCAT(u.firstName, ' ', u.lastName) AS lastPosterName, u.thumbnail AS lastPosterThumbnail FROM " . TABLE_FORUM_TOPICS . " AS t " . "LEFT JOIN " . TABLE_USERS . " AS u ON IF(t.lastReplyID = 0, t.creatorID, t.lastReplierID)=u.userID " . "WHERE  t.status='publish' AND t.categoryID=%d " . "ORDER BY lastPostDate DESC LIMIT %d", $categoryID, $limit);

        $results = $db->getResultsArray($query);

        return $results;
    }

    /**
     * @return Indexed
     */
    public function getAllChildCategories(){
        global $db;

        $results = $db->getResultsArray("SELECT * FROM " . TABLE_FORUM_CATEGORIES . " WHERE parentID != 0 ORDER BY categoryName ASC");

        return $results;
    }

    /**
     * @return Indexed
     */
    public static function getDefaultCategories(){
        global $db;

        $results = $db->getResultsArray("SELECT * FROM " . TABLE_FORUM_CATEGORIES . " WHERE parentID IN(1,2,3,4,5) ORDER BY categoryName ASC");

        return $results;
    }

    /**
     * @return Indexed
     */
    public static function getFollowingCategories(){
        global $db, $TNB_GLOBALS;

        $userID = buckys_is_logged_in();

        $results = $db->getResultsArray($db->prepare("SELECT c.* FROM " . TABLE_FORUM_FOLLOWERS . " AS cf LEFT JOIN " . TABLE_FORUM_CATEGORIES . " AS c ON c.categoryID=cf.categoryID WHERE cf.userID = %d ORDER BY categoryName ASC", $userID));

        return $results;
    }

    /**
     * @param $id
     * @param $name
     * @param $description
     * @return bool|int|null|string
     */
    public static function saveCategory($id, $name, $description){
        global $db;

        $userID = buckys_is_logged_in();

        if(!$id){ //New Category
            //Getting Sort Order
            $query = "SELECT max(sortOrder) FROM " . TABLE_FORUM_CATEGORIES . " WHERE parentID=" . USER_FORUM_CATEGORY;
            $sortOrder = $db->getVar($query);

            $sortOrder = !$sortOrder ? 1 : ($sortOrder + 1);

            $query = $db->prepare("INSERT INTO " . TABLE_FORUM_CATEGORIES . "(`categoryName`, `description`,`sortOrder`, `creatorID`, `parentID`, `createdDate`)VALUES(%s, %s, %d, %d, %d, %s)", $name, $description, $sortOrder, $userID, USER_FORUM_CATEGORY, date("Y-m-d H:i:s"));
            $id = $db->insert($query);

            if(!$id){
                buckys_add_message($db->last_error, MSG_TYPE_ERROR);
                return false;
            }

            //Make the user to follow this forum
            BuckysForumFollower::followForum($userID, $id);
        }else{
            $query = $db->prepare("UPDATE " . TABLE_FORUM_CATEGORIES . " SET `categoryName`=%s, `description`=%s  WHERE `categoryID`=%d", $name, $description, $id);
            $db->query($query);
        }

        return $id;
    }

    /**
     * @param     $id
     * @param     $file
     * @param int $x
     * @param int $y
     * @param     $size
     * @return bool|void
     */
    public static function saveForumImage($id, $file, $x = 0, $y = 0, $size){
        global $db;

        $sourceFile = DIR_FS_PHOTO_TMP . $file;
        $destFile = DIR_FS_ROOT . "images/forum/logos/" . $file;
        $destFile1 = DIR_FS_ROOT . "images/forum/icons/" . $file;

        list($width, $height, $type, $attr) = getimagesize(DIR_FS_PHOTO_TMP . $file);

        if($width > MAX_IMAGE_WIDTH || $height > MAX_IMAGE_HEIGHT){
            buckys_add_message(MSG_PHOTO_MAX_SIZE_ERROR, MSG_TYPE_ERROR);
            return false;
        }

        $destType = image_type_to_mime_type($type);

        //Create Logo File
        buckys_resize_image($sourceFile, $destFile, $destType, 350, 350, $x, $y, $size, $size);
        buckys_resize_image($sourceFile, $destFile1, $destType, 30, 30, $x, $y, $size, $size);

        //Update Category
        $query = $db->prepare("UPDATE " . TABLE_FORUM_CATEGORIES . " SET `image`=%s WHERE categoryID=%d", $file, $id);
        $db->query($query);

        return;
    }

    /**
     * @param $id
     */
    public static function removeAllLinks($id){
        global $db;

        $query = $db->prepare("DELETE FROM " . TABLE_FORUM_CATEGORIES_LINKS . " WHERE  categoryID=%d", $id);
        $db->query($query);
    }

    /**
     * @param $id
     * @param $title
     * @param $url
     * @return int|null|string
     */
    public static function saveCategoryLink($id, $title, $url){
        global $db;

        $query = $db->prepare("INSERT INTO " . TABLE_FORUM_CATEGORIES_LINKS . "(`categoryID`, `linkTitle`, `linkUrl`)VALUES(%d, %s, %s)", $id, $title, $url);
        return $db->insert($query);

    }

    /**
     * @param $keyword
     * @param $page
     * @param $orderBy
     * @param $limit
     * @return array
     */
    public static function searchCategories($keyword, $page, $orderBy, $limit){
        global $db;

        global $db, $TNB_GLOBALS;

        $where = '';

        if($keyword != '')
            $where = $db->prepare(" WHERE MATCH(c.categoryName, c.description) AGAINST ('%s' IN BOOLEAN MODE) AND parentID!=0 ", $keyword);else
            $where = $db->prepare(" WHERE parentID!=0 ", $keyword);

        $query = "SELECT count(*) FROM " . TABLE_FORUM_CATEGORIES . " AS c " . $where;
        $total = $db->getVar($query);

        $query = "SELECT c.* FROM " . TABLE_FORUM_CATEGORIES . " AS c " . $where . " ORDER BY " . $orderBy;
        if($limit != null)
            $query .= " LIMIT " . ($page - 1) * $limit . ", " . $limit;

        $rows = $db->getResultsArray($query);

        return ['total' => $total, 'categories' => $rows];
    }

    /**
     * @param $categoryID
     */
    public static function deleteCategory($categoryID){
        global $db;

        //Delete Category Links
        $query = $db->prepare("DELETE FROM " . TABLE_FORUM_CATEGORIES_LINKS . " WHERE categoryID=%d", $categoryID);
        $db->query($query);

        //Remove Followers
        $query = $db->prepare("DELETE FROM " . TABLE_FORUM_FOLLOWERS . " WHERE categoryID=%d", $categoryID);
        $db->query($query);

        //Remove Moderators
        $query = $db->prepare("DELETE FROM " . TABLE_FORUM_MODERATORS . " WHERE categoryID=%d", $categoryID);
        $db->query($query);

        //Remove Blocked Users
        $query = $db->prepare("DELETE FROM " . TABLE_FORUM_BLOCKED_USRES . " WHERE categoryID=%d", $categoryID);
        $db->query($query);

        //Remove Topics
        $query = $db->prepare("SELECT topicID FROM " . TABLE_FORUM_TOPICS . " WHERE categoryID=%d", $categoryID);
        $topics = $db->getResultsArray($query);
        foreach($topics as $tRow){
            BuckysForumTopic::deleteTopic($tRow['topicID']);
        }

        //Remove Forum
        $query = $db->prepare("DELETE FROM " . TABLE_FORUM_CATEGORIES . " WHERE categoryID=%d", $categoryID);
        $db->query($query);

        return;

    }
}
