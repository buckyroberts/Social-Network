<?php
/**
* Manage Topic
*/

class BuckysForumTopic
{
    public static $COUNT_PER_PAGE = 30;

    /**
     * @param $data
     * @return bool|int|string
     */
    public static function createTopic($data)
    {
        global $db, $TNB_GLOBALS;
        
        $title = trim($data['title']);
        $category = trim($data['category']);
        $content = $data['content'];
        
        if(!$title || !$category || !$content)
        {
            return MSG_ALL_FIELDS_REQUIRED;
        }
        
        //Check Category ID is valid or not
        $query = $db->prepare("SELECT categoryID FROM " . TABLE_FORUM_CATEGORIES . " WHERE categoryID=%d", $category);
        $categoryID = $db->getVar($query);
        if(!$categoryID)
        {
            return MSG_INVALID_REQUEST;
        }
        
        $content = buckys_remove_tags_inside_code($content);
        
        //Remove Invalid Image URLs
        $content = buckys_remove_invalid_image_urls($content);

        $query = "INSERT INTO " . TABLE_FORUM_TOPICS . "(
                    `topicTitle`, 
                    `topicContent`, 
                    `categoryID`, 
                    `creatorID`, 
                    `createdDate`, 
                    `replies`, 
                    `lastReplyID`, 
                    `lastReplyDate`, 
                    `lastReplierID`, 
                    `views`, 
                    `status`
                 )VALUES(
                    '" . $db->escapeInput($title) . "',
                    '" . $db->escapeInput($content, false) . "',
                    '" . $db->escapeInput($categoryID) . "',
                    '" . $TNB_GLOBALS['user']['userID'] . "',
                    '" . date("Y-m-d H:i:s") . "',
                    '0',
                    '0',
                    '0000-00-00 00:00:00',
                    '0',
                    '0',
                    'pending'
                 )";
        $db->query($query);
        
        $newID = $db->getLastInsertId();
        
        if(!$newID)
        {            
            buckys_add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }
            
        //If the user has more than 5 actived posts(topics or replies), update the topic status to 1
        $count1 = $db->getVar("SELECT count(1) FROM " . TABLE_FORUM_TOPICS . " WHERE creatorID=" . $TNB_GLOBALS['user']['userID'] . " AND `status`='publish'");
        $count2 = $db->getVar("SELECT count(1) FROM " . TABLE_FORUM_REPLIES . " WHERE creatorID=" . $TNB_GLOBALS['user']['userID'] . " AND `status`='publish'");
        if($count1 + $count2 >= 5){
            $db->updateFromArray(TABLE_FORUM_TOPICS, ['status' => 'publish'], ['topicID' => $newID]);
            //Update Category Table
            $db->query("UPDATE " . TABLE_FORUM_CATEGORIES . " SET lastTopicID=" . $newID . ", `topics`=`topics` + 1 WHERE categoryID=" . $categoryID);
            
            //Increase user posts count
            $db->query("UPDATE " . TABLE_USERS . " SET `posts_count`=`posts_count` + 1 WHERE userID=" . $TNB_GLOBALS['user']['userID']);
            
            buckys_add_message(MSG_TOPIC_POSTED_SUCCESSFULLY, MSG_TYPE_SUCCESS);
            
            return $newID;
        }
        
        buckys_add_message(MSG_POST_IS_UNDER_PREVIEW, MSG_TYPE_SUCCESS);
        
        return $newID;
    }

    /**
     * Edit topic
     *
     * @param mixed $data
     * @return bool|string
     */
    public function editTopic($data)
    {
        global $db, $TNB_GLOBALS;
        
        $title = get_secure_string($data['title']);
        $category = get_secure_string($data['category']);
        $content = $data['content'];
        
        if(!$title || !$category || !$content || !isset($data['id']))
        {
            return MSG_ALL_FIELDS_REQUIRED;
        }
        
        //Check Category ID is valid or not
        $query = $db->prepare("SELECT categoryID FROM " . TABLE_FORUM_CATEGORIES . " WHERE categoryID=%d", $category);
        $categoryID = $db->getVar($query);
        if(!$categoryID)
        {
            return MSG_INVALID_REQUEST;
        }
        
        $content = buckys_remove_tags_inside_code($content);
        
        //Remove Invalid Image URLs
        $content = buckys_remove_invalid_image_urls($content);

        $query = "UPDATE " . TABLE_FORUM_TOPICS . " SET 
                    `topicTitle`='" . $db->escapeInput($title) . "',
                    `topicContent`='" . $db->escapeInput($content, false) . "',
                    `categoryID`='" . $db->escapeInput($categoryID) . "'
                  WHERE
                     `topicID`='" . $db->escapeInput($data['id']) . "'";
        $db->query($query);
        
//        $db->updateFromArray(TABLE_FORUM_TOPICS, $updateData, array('topicID'=>$data['id']));
        
        return true;
    }

    /**
     * @param $topicID
     * @param $categoryID
     * @return bool
     */
    public function moveTopic($topicID, $categoryID)
    {
        global $db;
        
        $db->updateFromArray(TABLE_FORUM_TOPICS, ['categoryID' => $categoryID], ['topicID' => $topicID]);
        
        return true;
    }
    
    
    /**
    * Pending Topics
    * 
    */
    public static function getTopics($page = 1, $status = null, $category = null, $orderBy = null, $limit = null, $search = null)
    {
        global $db, $TNB_GLOBALS;
        
        $query = "SELECT 
                        t.topicID,
                        t.topicTitle,
                        t.topicContent,
                        t.categoryID,
                        t.creatorID,
                        t.createdDate,
                        t.replies,
                        t.lastReplyID,
                        If(t.lastReplyID = 0, t.createdDate, t.lastReplyDate) AS lastReplyDate,
                        t.lastReplierID,
                        t.views,
                        t.status,
                        t.votes,
                        CONCAT(u.firstName, ' ', u.lastName) AS creatorName,
                        u.thumbnail AS creatorThumbnail,
                        c.categoryName, 
                        c.image AS categoryImage, 
                        CONCAT(ul.firstName, ' ', ul.lastName) AS lastReplierName,
                        ul.thumbnail AS lastReplierThumbnail ,
                        v.voteID, v.voteStatus 
                  FROM " . TABLE_FORUM_TOPICS . " AS t " .
                 "LEFT JOIN " . TABLE_USERS . " AS u ON u.userID=t.creatorID " .      
                 "LEFT JOIN " . TABLE_USERS . " AS ul ON ul.userID=t.lastReplierID " .      
                 "LEFT JOIN " . TABLE_FORUM_VOTES . " AS v ON v.objectID=t.topicID AND v.objectType='topic' AND v.voterID=" . $TNB_GLOBALS['user']['userID'] . " " .
                 "LEFT JOIN " . TABLE_FORUM_CATEGORIES . " AS c ON c.categoryID=t.categoryID ";
                 
        
        if($status != null)
            $where[] = $db->prepare("t.status= %s", $status);
        if($category != null)
            $where[] = $db->prepare("t.categoryID= %d", $category);
        
        if(count($where) > 0)
            $query .= " WHERE " . implode(" AND ", $where);
        
        if($orderBy != null)
            $query .= " ORDER BY " . $orderBy . ", t.topicTitle, t.createdDate ";
        else
            $query .= " ORDER BY lastReplyDate DESC, t.topicTitle , t.createdDate ";
        
        if($limit != null)
            $query .= " LIMIT " . ($page - 1) * $limit . ", " . $limit;
        
        if ($search != null) {
            $where[] = $db->prepare(" t.topicTitle LIKE '%%s%' OR t.topicContent");
        }
        
        $rows = $db->getResultsArray($query);
        
        return $rows;
    }
    
    
    
    /**
    * Get The total number of Topics
    * 
    */
    public static function getTotalNumOfTopics($status = null, $category = null)
    {
        global $db;
        
        $query = "SELECT count(t.topicID) FROM " . TABLE_FORUM_TOPICS . " AS t ";
        $where = [];
        
        if($status != null)
            $where[] = $db->prepare("`status`= %s", $status);
        if($category != null)
            $where[] = $db->prepare("`categoryID`= %d", $category);
        
        if(count($where) > 0)
            $query .= " WHERE " . implode(" AND ", $where);
        
        $count = $db->getVar($query);
        
        return $count;
    }

    /**
     * @param      $userId
     * @param int  $page
     * @param null $orderBy
     * @param null $limit
     * @return Indexed
     */
    public static function getUserTopics($userId, $page = 1, $orderBy = null, $limit = null)
    {
        global $db, $TNB_GLOBALS;
        
        $query = "SELECT 
                        t.topicID,
                        t.topicTitle,
                        t.topicContent,
                        t.categoryID,
                        t.creatorID,
                        t.createdDate,
                        t.replies,
                        t.lastReplyID,
                        If(t.lastReplyID = 0, t.createdDate, t.lastReplyDate) AS lastReplyDate,
                        t.lastReplierID,
                        t.views,
                        t.status,
                        t.votes,
                        CONCAT(u.firstName, ' ', u.lastName) AS creatorName,
                        u.thumbnail AS creatorThumbnail,
                        c.categoryName, 
                        c.image AS categoryImage,
                        CONCAT(ul.firstName, ' ', ul.lastName) AS lastReplierName,
                        ul.thumbnail AS lastReplierThumbnail ,
                        v.voteID, v.voteStatus 
                  FROM " . TABLE_FORUM_TOPICS . " AS t " .
                 "LEFT JOIN " . TABLE_USERS . " AS u ON u.userID=t.creatorID " .      
                 "LEFT JOIN " . TABLE_USERS . " AS ul ON ul.userID=t.lastReplierID " .      
                 "LEFT JOIN " . TABLE_FORUM_VOTES . " AS v ON v.objectID=t.topicID AND v.objectType='topic' AND v.voterID=" . $TNB_GLOBALS['user']['userID'] . " " .
                 "LEFT JOIN " . TABLE_FORUM_CATEGORIES . " AS c ON c.categoryID=t.categoryID ";
                 
        $where = [];
                       
        $where[] = $db->prepare(" t.categoryID IN (SELECT categoryID FROM " . TABLE_FORUM_FOLLOWERS . " WHERE userID = %d) ", $userId);
        $where[] = "t.status='publish'";
        
        if(count($where) > 0)
            $query .= " WHERE " . implode(" AND ", $where);
        
        if($orderBy != null)
            $query .= " ORDER BY " . $orderBy . ", t.topicTitle, t.createdDate ";
        else
            $query .= " ORDER BY lastReplyDate DESC, t.topicTitle , t.createdDate ";
        
        if($limit != null)
            $query .= " LIMIT " . ($page - 1) * $limit . ", " . $limit;
        
        $rows = $db->getResultsArray($query);
                                          
        return $rows;
    }

    /**
     * @param $userId
     * @return one
     */
    public static function getTotalNumOfUserTopics($userId)
    {
        global $db, $TNB_GLOBALS;
        
        $query = "SELECT 
                       count(t.topicID)
                  FROM " . TABLE_FORUM_TOPICS . " AS t " .
                 "LEFT JOIN " . TABLE_FORUM_FOLLOWERS . " AS cf ON cf.categoryID=t.categoryID ";
        $where = [];
        
        $where[] = $db->prepare("cf.userID = %d", $userId);
        $where[] = "t.status='publish'";
                                              
        if(count($where) > 0)
            $query .= " WHERE " . implode(" AND ", $where);
        
        $total = $db->getVar($query);
                                           
        return $total;
    }

    /**
     * Approve Pending Topics
     *
     * @param mixed $ids
     * @return bool|string
     */
    public static function approvePendingTopics($ids)
    {
        global $db;
        
        if(!is_array($ids))
            $ids = [$ids];
        
        $ids = $db->escapeInput($ids);
        
        //Getting Topics for confirmation
        $query = "SELECT topicID, categoryID, creatorID FROM " . TABLE_FORUM_TOPICS . " WHERE STATUS='pending' AND topicID IN (" . implode(', ', $ids) . ")";
        $rows = $db->getResultsArray($query);
        
        if(!$rows)
            return MSG_INVALID_REQUEST;
           
        $forumNotification = new BuckysForumNotification();
                    
        foreach($rows as $row)
        {
            //Update Topic Status
            $db->updateFromArray(TABLE_FORUM_TOPICS, ['status' => 'publish', 'createdDate'=>date('Y-m-d H:i:s')], ['topicID' => $row['topicID']]);
            //Update Category Table
            $db->query("UPDATE " . TABLE_FORUM_CATEGORIES . " SET `topics`=`topics` + 1 WHERE categoryID=" . $row['categoryID']);
            $db->query("UPDATE " . TABLE_FORUM_CATEGORIES . " SET `lastTopicID`=" . $row['topicID'] . " WHERE categoryID=" . $row['categoryID'] . " AND lastTopicID < " . $row['topicID']);
            
            //Increase user posts count
            $db->query("UPDATE " . TABLE_USERS . " SET `posts_count`=`posts_count` + 1 WHERE userID=" . $row['creatorID']);
            
            $forumNotification->addNotificationsForPendingPost($row['creatorID'], $row['topicID']);
        }
        
        return true;
    }

    /**
     * Delete Pending Topics
     *
     * @param escaped $ids
     * @return bool|string
     */
    public static function deletePendingTopics($ids)
    {
        global $db;
        
        if(!is_array($ids))
            $ids = [$ids];
        
        $ids = $db->escapeInput($ids);
        
        //Getting Topics for confirmation
        $query = "SELECT topicID, categoryID FROM " . TABLE_FORUM_TOPICS . " WHERE STATUS='pending' AND topicID IN (" . implode(', ', $ids) . ")";
        $rows = $db->getResultsArray($query);
        
        if(!$rows)
            return MSG_INVALID_REQUEST;
                        
        foreach($rows as $row)
        {
            $db->query("DELETE FROM " . TABLE_FORUM_TOPICS . " WHERE topicID=" . $row['topicID']);
        }
        
        return true;
    }

    /**
     * Getting Topic
     *
     * @param Int $id
     * @return array
     */
    public static function getTopic($id)
    {
        global $db, $TNB_GLOBALS;
        
        if(!$TNB_GLOBALS['user']['userID'])
        {
            $query = $db->prepare("SELECT t.*, CONCAT(u.firstName, ' ', u.lastName) AS creatorName, u.thumbnail, u.posts_count, u.posts_rating, 0 AS reportID, 0 AS voteID, 0 AS voteSatus, us.reputation FROM " . TABLE_FORUM_TOPICS ." AS t " .
                                  "LEFT JOIN " . TABLE_USERS . " AS u ON t.creatorID=u.userID " . 
                                  "LEFT JOIN " . TABLE_USERS_STATS . " AS us ON t.creatorID=us.userID " . 
                                  "WHERE t.topicID=%d", $id);
        }else{
            $query = $db->prepare("SELECT t.*, CONCAT(u.firstName, ' ', u.lastName) AS creatorName, u.thumbnail, u.posts_count, u.posts_rating, r.reportID, v.voteID, v.voteStatus, us.reputation FROM " . TABLE_FORUM_TOPICS ." AS t " .
                                  "LEFT JOIN " . TABLE_USERS . " AS u ON t.creatorID=u.userID " .
                                  "LEFT JOIN " . TABLE_USERS_STATS . " AS us ON t.creatorID=us.userID " . 
                                  "LEFT JOIN " . TABLE_REPORTS . " AS r ON r.objectType='topic' AND r.objectID=t.topicID AND r.reporterID=%d " .                                  
                                  "LEFT JOIN " . TABLE_FORUM_VOTES . " AS v ON v.objectID=t.topicID AND v.objectType='topic' AND v.voterID=" . $TNB_GLOBALS['user']['userID'] . " " .
                                  "WHERE t.topicID=%d", $TNB_GLOBALS['user']['userID'], $id);
        }
        $row = $db->getRow($query);
        
        return $row;
    }

    /**
     * Delete Topic
     *
     * @param Int $topicID
     * @return bool
     */
    public static function deleteTopic($topicID)
    {
        global $db;
        
        $query = $db->prepare("SELECT * FROM " . TABLE_FORUM_TOPICS . " WHERE topicID=%d", $topicID);
        $topic = $db->getRow($query);
        
        if($topic)
        {
            //Update Stats
            $query = "UPDATE " . TABLE_USERS_STATS . " AS us
                        LEFT JOIN " . TABLE_FORUM_REPLIES . " AS r ON r.creatorID=us.userID
                      SET
                        us.`voteUps` = us.`voteUps` - r.`votes`,
                        us.`reputation` = us.`reputation` - r.`votes`
                      WHERE 
                        r.status='publish' AND r.topicID={$topic['topicID']}  
            ";
            $db->query($query);
            
            //Getting Published Replies count
            $query = "SELECT COUNT(1) FROM " . TABLE_FORUM_REPLIES . " WHERE `status`='publish' AND topicID=" . $topic['topicID'];
            $publishReplies = $db->getVar($query);
            
            BuckysUser::updateStats($topic['creatorID'], 'replies', -1 * $publishReplies);
            BuckysUser::updateStats($topic['creatorID'], 'voteUps', -1 * $topic['votes']);
            
            //Remove Reply Votes
            $query = "DELETE FROM " . TABLE_FORUM_VOTES . " WHERE objectID IN (SELECT replyID FROM " . TABLE_FORUM_REPLIES . " WHERE topicID=" . $topic['topicID'] . ")";
            $db->query($query);
            //Remove Replies
            $query = "DELETE FROM " . TABLE_FORUM_REPLIES . " WHERE topicID=" . $topic['topicID'];
            $db->query($query);
            
            //Delete Topics
            $query = "DELETE FROM " . TABLE_FORUM_TOPICS . " WHERE topicID=" . $topic['topicID'];
            $db->query($query);
            
            //Delete Frome Reports Table
            $query = "DELETE FROM " . TABLE_REPORTS . " WHERE objectType='topic' AND objectID=" . $topic['topicID'];
            $db->query($query);
            
            //Update Category Values
            $query = "UPDATE " . TABLE_FORUM_CATEGORIES . " SET `topics` = `topics` - 1, `replies` = `replies` - " . $publishReplies . " WHERE categoryID=" . $topic['categoryID'];
            $db->query($query);
            
            //If the topic status is publish, decrease user posts count
            if($topic['status'] == 'publish')
                $db->query("UPDATE " . TABLE_USERS . " SET `posts_count`=`posts_count` " . ($topic['votes'] > 0 ? '-' : '+' ) . abs($topic['votes'])  . " WHERE userID=" . $topic['creatorID']);
            
            //Update Last Topic ID of the category
            BuckysForumCategory::updateCategoryLastTopicID($topic['categoryID']);
            
            return true;
        }
        
        return false;
    }
    
    /**
    * Update Topic Last Reply Info
    * 
    * @param mixed $topicID
    */
    public static function updateTopicLastReplyID($topicID)
    {
        global $db;
        
        //Get Last Reply ID
        $query = $db->prepare("SELECT * FROM " . TABLE_FORUM_REPLIES . " WHERE topicID=%d AND `status`='publish' ORDER BY createdDate DESC LIMIT 1", $topicID);
        $reply = $db->getRow($query);
        
        if($reply)
        {
            $db->updateFromArray(TABLE_FORUM_TOPICS, ['lastReplyID' => $reply['replyID'], 'lastReplyDate' => $reply['createdDate'], 'lastReplierID' => $reply['creatorID']], ['topicID'=>$reply['topicID']]);
        } else {
            $db->updateFromArray(TABLE_FORUM_TOPICS, ['lastReplyID' => 0, 'lastReplyDate' => '0000-00-00 00:00:00', 'lastReplierID' => 0], ['topicID'=>$topicID]);
        }
        
        return;
    }

    /**
     * Convert HTML Tags to BBCode
     *
     * @param String $html
     * @return mixed|String
     */
    function _convertHTMLToBBCode($html)
    {
	
		//Gets rid of extra comment bug
		$html = str_replace('<!--?prettify lang=html linenums=true?-->', '', $html); 
	
        //Covert square brackets to html codes        
        $html = str_replace(['[', ']', '\\'], ['&#91;', '&#93;', '&#92;'], $html);
        
        $pattern = [
            '/[\r|\n]/',
            '/<br.*?>/i',
            '/<b.*?>/i',
            '/<\/b>/i',
            '/<strong.*?>/i',
            '/<\/strong>/i',
            '/<div(.*?)>/i',
            '/<\/div>/i',
            '/<pre(.*?)>/i',
            '/<\/pre>/i',
            '/<font(.*?)>/i',
            '/<\/font>/i',
            '/<span(.*?)>/i',
            '/<\/span>/i',
            '/<p(.*?)>/i',
            '/<\/p>/i',
            '/<ul>/i',
            '/<\/ul>/i',
            '/<ol>/i',
            '/<\/ol>/i',
            '/<li>/i',
            '/<\/li>/i',            
            '/<em.*?>/i',
            '/<\/em>/i',
            '/<u.*?>/i',
            '/<\/u>/i',
            '/<ins.*?>/i',
            '/<\/ins>/i',
            '/<strike>/i',
            '/<\/strike>/i',
            '/<del>/i',
            '/<\/del>/i',
            '/<a.*?href="(.*?)".*?>(.*?)<\/a>/i',
            '/<img(.*?)src="(.*?)"(.*?)>/i',     
            '/<i.*?>/i',
            '/<\/i>/i',
            '/<iframe.*>(.*?)<\/iframe>/i',
            '/<frameset.*>(.*?)<\/frameset>/i',
            '/<frame.*>/i',
            '/<([a-zA-Z0-9]+)([^<]*)>(.*?)<\/\1>/i'
        ];
        
        $replace = [
          "",
          '\n',
          '[b]',
          '[/b]',
          '[b]',
          '[/b]',
          '[div$1]',
          '[/div]',
          '[code$1]',
          '[/code]',
          '[font$1]',
          '[/font]',
          '[span$1]',
          '[/span]',
          '[p$1]',
          '[/p]',
          '[list]',
          '[/list]',
          '[list=1]',
          '[/list]',
          '[*]',
          '[/*]',
          '[i]',
          '[/i]',          
          '[u]',
          '[/u]',
          '[u]',
          '[/u]',
          '[s]',
          '[/s]',
          '[s]',
          '[/s]',
          '[url=$1]$2[/url]',
          '[img $1$3]$2[/img]',
          '[i]',
          '[/i]',
          '$1',
          '$1',
          '$1',
          '[$1 $2]$3[/$1]'
        ];
        foreach($pattern as $i=>$p)
        {
            while (preg_match($p, $html)) {
                $html = preg_replace($p, $replace[$i], $html);
            }
        }
        
        //Convert Single Quote to Double Quote for div, code, font, img and other html tags tags
        $html = preg_replace_callback('/\[code(.*?)\](.*?)\[\/code\]/i', create_function('$matches', 'return "[code" . str_replace(\'"\', ";squote;", $matches[1]) . "]" . $matches[2] . "[/code]";'), $html);
        $html = preg_replace_callback('/\[font(.*?)\](.*?)\[\/font\]/i', create_function('$matches', 'return "[font" . str_replace(\'"\', ";squote;", $matches[1]) . "]" . $matches[2] . "[/font]";'), $html);
        $html = preg_replace_callback('/\[span(.*?)\](.*?)\[\/span\]/i', create_function('$matches', 'return "[span" . str_replace(\'"\', ";squote;", $matches[1]) . "]" . $matches[2] . "[/span]";'), $html);
        $html = preg_replace_callback('/\[div(.*?)\](.*?)\[\/div\]/i', create_function('$matches', 'return "[div" . str_replace(\'"\', ";squote;", $matches[1]) . "]" . $matches[2] . "[/div]";'), $html);
        $html = preg_replace_callback('/\[p(.*?)\](.*?)\[\/p\]/i', create_function('$matches', 'return "[p" . str_replace(\'"\', ";squote;", $matches[1]) . "]" . $matches[2] . "[/p]";'), $html);
        $html = preg_replace_callback('/\[img(.*?)\](.*?)\[\/img\]/i', create_function('$matches', 'return "[img" . str_replace(\'"\', ";squote;", $matches[1]) . "]" . $matches[2] . "[/img]";'), $html);
        
        $html = preg_replace_callback('/\[([a-zA-Z0-9]+)([^\]]+)\]/i', create_function('$matches', 'return "[" . $matches[1] . str_replace(\'"\', ";squote;", $matches[2]) . "]";'), $html);
        
        return $html;
    }

    /**
     * Convert BBCode To HTML
     *
     * @param mixed $code
     * @return mixed|string
     */
    function _convertBBCodeToHTML($code)
    {		
        //For Prettyprint
        $code = str_replace('[code class=&quot;prettyprint&quot;', '<?prettify lang=html linenums=true?>[code class="prettyprint"', $code);
        $code = str_replace('[code class=;squote;prettyprint;squote;', '<?prettify lang=html linenums=true?>[code class="prettyprint"', $code);
        $code = str_replace('[code class=&#039;prettyprint&#039;', '<?prettify lang=html linenums=true?>[code class="prettyprint"', $code);
        //Process Single Quote
        $code = str_replace(';squote;', "'", $code);	

		//Tring to fix edit bug - works but breaks prettify
        //$code = str_replace('\n', '<br>', $code);		

        $pattern = [
            '/\\\r/',
            '/\\\n/',
            '/\[b\]/i',
            '/\[\/b\]/i',
            '/\[code(.*?)\]/i',
            '/\[\/code\]/i',
            '/\[font(.*?)\]/i',
            '/\[\/font\]/i',
            '/\[div(.*?)\]/i',            
            '/\[\/div\]/i',            
            '/\[span(.*?)\]/i',
            '/\[\/span\]/i',
            '/\[p(.*?)\]/i',
            '/\[\/p\]/i',
            '/\[i\]/i',
            '/\[\/i\]/i',
            '/\[u\]/i',
            '/\[\/u\]/i',
            '/\[s\]/i',
            '/\[\/s\]/i',
            '/\[url=(.*?)\](.*?)\[\/url\]/i',
            '/\[img(.*?)\](.*?)\[\/img\]/i',
            '/\[list\](.*?)\[\/list\]/i',
            '/\[list=1\](.*?)\[\/list\]/i',
            '/\[list\]/i',
            '/\[list=1\]/i',
            '/\[\*\](.*?)\[\/\*\]/',
            '/\[\*\]/',
            '/\[([a-zA-Z0-9]+)([^\]]*)\](.*?)\[\/\1\]/i'
        ];
        $replace = [
          "",
          '<br />',
          '<b>',
          '</b>',
          '<code><pre$1>',
          '</pre></code>',
          '<font$1>',
          '</font>',
          '<div$1>',          
          '</div>',          
          '<span$1>',
          '</span>',
          '<p$1>',
          '</p>',
          '<i>',
          '</i>',
          '<u>',
          '</u>',
          '<strike>',
          '</strike>',
          '<a href=\'$1\'>$2</a>',
          '<img $1 src=\'$2\'>',
          '<ul>$1</ul>',
          '<ol>$1</ol>',
          '<ul>',
          '<ol>',
          '<li>$1</li>',
          '<li>',
          '<$1 $2>$3</$1>'
        ];
           
        foreach($pattern as $i=>$p)
        {
            while (preg_match($p, $code)) {
                $code = preg_replace($p, $replace[$i], $code);
            }
        }
//        $code = preg_replace($pattern, $replace, $code);
        
        $pos = 0;
        //For PrettyPrint
        while( ($pos = strpos($code, '<?prettify lang=html linenums=true?>', $pos)) !== false)
        {
            $rpos = strpos($code, '</pre>', $pos);
            if($rpos !== false)
            {
                $subcode = substr($code, $pos, $rpos - $pos);
                $subcode = str_replace('<br />', PHP_EOL, $subcode);
                $code = substr($code, 0, $pos) . $subcode . substr($code, $rpos);
                $pos = strpos($code, '</pre>', $pos);
            }else{
                $subcode = substr($code, $pos);
                $subcode = str_replace('<br />', PHP_EOL, $subcode);
                $code = substr($code, 0, $pos) . $subcode;
                break;
            }
        }
        
        return $code;
    }
    
    
    
    /**
    * Get the total number of user's post
    * 
    * @param Int $userID
    * @param String $type : all, responded, started
    * @return Int
    */
    public static function getTotalNumberOfMyPosts($userID, $type = 'all')
    {
        global $db, $TNB_GLOBALS;
        
        if($type == 'all')
        {
            $query = $db->prepare("SELECT count(1) FROM 
                                    (SELECT topicID FROM " . TABLE_FORUM_TOPICS . " WHERE creatorID=%d 
                                    UNION DISTINCT
                                    SELECT topicID FROM " . TABLE_FORUM_REPLIES . " WHERE creatorID=%d ) AS tTable ", $userID, $userID);
        }else if($type == 'started'){
            $query = $db->prepare("SELECT count(DISTINCT(t.topicID)) FROM " . TABLE_FORUM_TOPICS . " AS t WHERE t.creatorID=%d", $userID);
        }else if($type == 'responded'){
            $query = $db->prepare("SELECT count(DISTINCT(t.topicID)) FROM " . TABLE_FORUM_TOPICS . " AS t LEFT JOIN " . TABLE_FORUM_REPLIES . " AS r ON t.topicID=r.topicID " .                     
                     "WHERE t.creatorID != %d AND r.creatorID=%d ", $userID, $userID);
        }
        
        $count = $db->getVar($query);
        
        return $count;
    }

    /**
     * @param        $userID
     * @param string $type
     * @param int    $page
     * @param null   $limit
     * @return Indexed
     */
    public static function getMyPosts($userID, $type = 'all', $page = 1, $limit = null)
    {
        global $db, $TNB_GLOBALS;
        
        if($type == 'all')
        { 
            $query = $db->prepare("SELECT
                                        t.topicID, 
                                        t.topicTitle, 
                                        t.categoryID, 
                                        c.categoryName, 
                                        c.image AS categoryImage,
                                        t.creatorID, 
                                        t.replies, 
                                        t.createdDate, 
                                        t.lastReplierID,
                                        t.lastReplyDate,
                                        t.votes,
                                        v.voteID, 
                                        v.voteStatus,                                        
                                        CONCAT(u.firstName, ' ', u.lastName) AS creatorName,
                                        CONCAT(lu.firstName, ' ', lu.lastName) AS lastReplierName,
                                        u.thumbnail AS creatorThumbnail,
                                        lu.thumbnail AS lastReplierThumbnail
                                   FROM " . TABLE_FORUM_TOPICS . " AS t " .                     
                                  "LEFT JOIN " . TABLE_FORUM_CATEGORIES . " AS c ON c.categoryID=t.categoryID " .
                                  "LEFT JOIN " . TABLE_USERS . " AS u ON u.userID=t.creatorID " .
                                  "LEFT JOIN " . TABLE_USERS . " AS lu ON lu.userID = t.lastReplierID " .
                                  "LEFT JOIN " . TABLE_FORUM_VOTES . " AS v ON v.objectID=t.topicID AND v.objectType='topic' AND v.voterID=" . $userID . " " .
                                  "WHERE t.creatorID=%d " .
                                  "UNION DISTINCT " .
                                  "SELECT  
                                        t.topicID, 
                                        t.topicTitle, 
                                        t.categoryID, 
                                        c.categoryName, 
                                        c.image AS categoryImage,
                                        t.creatorID, 
                                        t.replies, 
                                        t.createdDate, 
                                        t.lastReplierID,
                                        t.lastReplyDate,
                                        t.votes,
                                        v.voteID, 
                                        v.voteStatus,
                                        CONCAT(u.firstName, ' ', u.lastName) AS creatorName,
                                        CONCAT(lu.firstName, ' ', lu.lastName) AS lastReplierName,
                                        u.thumbnail AS creatorThumbnail,
                                        lu.thumbnail AS lastReplierThumbnail
                                    FROM " . TABLE_FORUM_REPLIES . " AS r " .
                                   "LEFT JOIN ". TABLE_FORUM_TOPICS . " AS t ON r.topicID=t.topicID " .                     
                                   "LEFT JOIN " . TABLE_FORUM_VOTES . " AS v ON v.objectID=t.topicID AND v.objectType='topic' AND v.voterID=" . $userID . " " .
                                   "LEFT JOIN " . TABLE_FORUM_CATEGORIES . " AS c ON c.categoryID=t.categoryID " .
                                   "LEFT JOIN " . TABLE_USERS . " AS u ON u.userID=t.creatorID " .
                                   "LEFT JOIN " . TABLE_USERS . " AS lu ON lu.userID = t.lastReplierID " .
                                   "WHERE r.creatorID=%d "
            , $userID, $userID, $userID);
            
        }else if($type == 'started'){
            $query = $db->prepare("SELECT
                                        t.topicID, 
                                        t.topicTitle, 
                                        t.categoryID, 
                                        c.categoryName, 
                                        c.image AS categoryImage, 
                                        t.creatorID, 
                                        t.replies, 
                                        t.createdDate, 
                                        t.lastReplierID,
                                        t.lastReplyDate,
                                        t.votes,
                                        v.voteID, 
                                        v.voteStatus,
                                        CONCAT(u.firstName, ' ', u.lastName) AS creatorName,
                                        CONCAT(lu.firstName, ' ', lu.lastName) AS lastReplierName,
										u.thumbnail AS creatorThumbnail,
                                        lu.thumbnail AS lastReplierThumbnail
                                   FROM " . TABLE_FORUM_TOPICS . " AS t " .                     
                                  "LEFT JOIN " . TABLE_FORUM_CATEGORIES . " AS c ON c.categoryID=t.categoryID " .
                                  "LEFT JOIN " . TABLE_USERS . " AS u ON u.userID=t.creatorID " .
                                  "LEFT JOIN " . TABLE_USERS . " AS lu ON lu.userID = t.lastReplierID " .
                                  "LEFT JOIN " . TABLE_FORUM_VOTES . " AS v ON v.objectID=t.topicID AND v.objectType='topic' AND v.voterID=" . $userID . " " .
                                  "WHERE t.creatorID=%d " 
                                  , $userID);
        }else if($type == 'responded'){
            $query = $db->prepare("SELECT  
                                        t.topicID, 
                                        t.topicTitle, 
                                        t.categoryID, 
                                        c.categoryName, 
                                        c.image AS categoryImage, 
                                        t.creatorID, 
                                        t.replies, 
                                        t.createdDate, 
                                        t.lastReplierID,
                                        t.lastReplyDate,
                                        t.votes,
                                        v.voteID, 
                                        v.voteStatus,
                                        CONCAT(u.firstName, ' ', u.lastName) AS creatorName,
                                        CONCAT(lu.firstName, ' ', lu.lastName) AS lastReplierName,
										u.thumbnail AS creatorThumbnail,
                                        lu.thumbnail AS lastReplierThumbnail
                                    FROM " . TABLE_FORUM_REPLIES . " AS r " .
                                   "LEFT JOIN ". TABLE_FORUM_TOPICS . " AS t ON r.topicID=t.topicID " .                     
                                   "LEFT JOIN " . TABLE_FORUM_VOTES . " AS v ON v.objectID=t.topicID AND v.objectType='topic' AND v.voterID=" . $userID . " " .
                                   "LEFT JOIN " . TABLE_FORUM_CATEGORIES . " AS c ON c.categoryID=t.categoryID " .
                                   "LEFT JOIN " . TABLE_USERS . " AS u ON u.userID=t.creatorID " .
                                   "LEFT JOIN " . TABLE_USERS . " AS lu ON lu.userID = t.lastReplierID " .
                                   "WHERE t.creatorID !=%d AND r.creatorID=%d GROUP BY topicID "
                                   ,$userID, $userID);
        }
        $query .= " ORDER BY lastReplyDate DESC, createdDate DESC, topicTitle ";
        $query .= " LIMIT " . ($page-1) * $limit . ', ' . $limit; 
        
        $rows = $db->getResultsArray($query);
        
        return $rows;
    }

    /**
     * Cast a vote on a topic
     *
     * @param Int $userID : voterID
     * @param $topicID
     * @param Int $voteType : 1: Thumb up, -1: Thumb Down
     * @return Int|null|string
     */
    public static function voteTopic($userID, $topicID, $voteType)
    {
        global $db, $TNB_GLOBALS;
        
        //Check Reply ID        
        $query = $db->prepare("SELECT topicID, votes, creatorID FROM " . TABLE_FORUM_TOPICS . " WHERE topicID=%d AND STATUS='publish'", $topicID);
        $topic = $db->getRow($query);
        
        if(!$topic)
            return MSG_INVALID_REQUEST;
        
        $topicID = $topic['topicID'];
        $votes = $topic['votes'];
        
        //Check the user already casted his vote or not
        $query = $db->prepare("SELECT voteID FROM " . TABLE_FORUM_VOTES . " WHERE objectID=%d AND voterID=%d AND objectType='topic'", $topicID, $userID);
        $voteID = $db->getVar($query);
        if($voteID)
            return MSG_ALREADY_CASTED_A_VOTE;
            
        //Add Vote
        $voteID = $db->insertFromArray(TABLE_FORUM_VOTES, ['objectID' => $topicID, 'voterID' => $userID, 'objectType' => 'topic', 'voteStatus' => $voteType, 'voteDate' => date('Y-m-d H:i:s')]);
        if(!$voteID)
            return $db->getLastError();
        
        $votes += $voteType;
        $db->update('UPDATE ' . TABLE_FORUM_TOPICS . ' SET `votes` = ' . $votes . ' WHERE topicID=' . $topicID);
        
        //Update user ragings        
        $db->query("UPDATE " . TABLE_USERS . " SET `posts_rating`=`posts_rating` " . ($voteType > 0 ? '+' : '-') . " 1 WHERE userID=" . $topic['creatorID']);
        
        if ($voteType > 0) {
            //Update User Stats
            BuckysUser::updateStats($topic['creatorID'], 'voteUps', 1);
        }
        
        return $votes;
    }
    
    /**
    * Search Topics
    * 
    * @param mixed $keyword
    * @param mixed $page
    * @param mixed $orderBy
    * @param mixed $limit
    * @return Indexed
    */
    public static function searchTopic($keyword,  $categoryID = null, $page = 1, $orderBy = null, $limit = null)
    {
        global $db, $TNB_GLOBALS;
        
        if ($keyword != '')
            $where = $db->prepare(" WHERE MATCH(t.topicTitle, t.topicContent) AGAINST ('%s' IN BOOLEAN MODE) AND t.status='publish' ",  $keyword);
        else
            $where = $db->prepare(" WHERE t.status='publish' ",  $keyword);
        
        if ($categoryID != null)
            $where .= $db->prepare(" AND t.categoryID=%d", $categoryID);
        
        //Getting Total Records        
        $query = "SELECT count(t.topicID) FROM " . TABLE_FORUM_TOPICS . " AS t " .  $where;
        
        $total = $db->getVar($query);
        
        if ($total > 0) {
            if ($keyword != "") {
                $query = $db->prepare("SELECT 
                        t.topicID,
                        t.topicTitle,
                        t.topicContent,
                        t.categoryID,
                        t.creatorID,
                        t.createdDate,
                        t.replies,
                        t.lastReplyID,
                        If(t.lastReplyID = 0, t.createdDate, t.lastReplyDate) AS lastReplyDate,
                        t.lastReplierID,
                        t.views,
                        t.status,
                        t.votes,
                        CONCAT(u.firstName, ' ', u.lastName) AS creatorName,
                        u.thumbnail AS creatorThumbnail,
                        c.categoryName, 
                        CONCAT(ul.firstName, ' ', ul.lastName) AS lastReplierName,
                        ul.thumbnail AS lastReplierThumbnail ,
                        MATCH(t.topicTitle, t.topicContent) AGAINST ('%s') AS relevance
                  FROM " . TABLE_FORUM_TOPICS . " AS t " .
                 "LEFT JOIN " . TABLE_USERS . " AS u ON u.userID=t.creatorID " .      
                 "LEFT JOIN " . TABLE_USERS . " AS ul ON ul.userID=t.lastReplierID " .      
                 "LEFT JOIN " . TABLE_FORUM_CATEGORIES . " AS c ON c.categoryID=t.categoryID ", $keyword);
            } else {
                $query = "SELECT 
                        t.topicID,
                        t.topicTitle,
                        t.topicContent,
                        t.categoryID,
                        t.creatorID,
                        t.createdDate,
                        t.replies,
                        t.lastReplyID,
                        If(t.lastReplyID = 0, t.createdDate, t.lastReplyDate) AS lastReplyDate,
                        t.lastReplierID,
                        t.views,
                        t.status,
                        t.votes,
                        CONCAT(u.firstName, ' ', u.lastName) AS creatorName,
                        u.thumbnail AS creatorThumbnail,
                        c.categoryName, 
                        CONCAT(ul.firstName, ' ', ul.lastName) AS lastReplierName,
                        ul.thumbnail AS lastReplierThumbnail ,
                        1 AS relevance
                  FROM " . TABLE_FORUM_TOPICS . " AS t " .
                 "LEFT JOIN " . TABLE_USERS . " AS u ON u.userID=t.creatorID " .      
                 "LEFT JOIN " . TABLE_USERS . " AS ul ON ul.userID=t.lastReplierID " .                       
                 "LEFT JOIN " . TABLE_FORUM_CATEGORIES . " AS c ON c.categoryID=t.categoryID ";
            }
            
        } else {
            return ['total' => 0, 'topics' => []];
        }
        
        $query .= $where;
        if($orderBy != null)
            $query .= " ORDER BY " . $orderBy . ", t.topicTitle, t.createdDate ";
        else
            $query .= " ORDER BY lastReplyDate DESC, t.topicTitle , t.createdDate ";
        
        if($limit != null)
            $query .= " LIMIT " . ($page - 1) * $limit . ", " . $limit;
        
        $rows = $db->getResultsArray($query);
        
        return ['total' => $total, 'topics' => $rows];
    }

    /**
     * @param      $topicID
     * @param null $userID
     * @return one
     */
    public function isVoted($topicID, $userID = null)
    {
        global $db;
        
        if (!$userID)
            $userID = buckys_is_logged_in();
        
        $query = $db->prepare("SELECT voteID FROM " . TABLE_FORUM_VOTES . " WHERE objectID=%d AND voterID=%d AND objectType='topic'", $topicID, $userID);
        $vid = $db->getVar($query);
        
        return $vid;
    }
}
