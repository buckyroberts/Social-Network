<?php
/**
 * Show All Videos
 */

require(dirname(__FILE__) . '/includes/bootstrap.php');

$videoClass = new BuckysVideo();

$subjectID = isset($_GET['subject']) ? buckys_escape_query_string($_GET['subject']) : 0;

$categoryID = isset($_GET['cat']) ? buckys_escape_query_integer($_GET['cat']) : null;

$videoID = isset($_GET['video']) ? buckys_escape_query_integer($_GET['video']) : null;

if($videoID){
    $video = $videoClass->getVideo($videoID);
    if(!$video){
        buckys_redirect("/videos.php", MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        exit;
    }

    $categoryID = $video['categoryID'];
}

if($categoryID){
    $category = $videoClass->getCategory($categoryID);
    $categoryVideos = $videoClass->getVideos($categoryID);
    if(!$videoID){
        $video = $categoryVideos[0];
    }

    //Getting Forum Recent Posts    
    $topics = BuckysForumTopic::getTopics(1, 'publish', $category['forumCategoryID'], 'lastReplyDate DESC', 10);
    $forumCategory = BuckysForumCategory::getCategory($category['forumCategoryID']);

    //Get Prev, Next Video
    $prevVideoId = null;
    $nextVideoId = null;
    foreach($categoryVideos as $idx => $v){
        if($v['videoID'] == $video['videoID']){
            $nextVideoId = isset($categoryVideos[$idx + 1]) ? $categoryVideos[$idx + 1]['videoID'] : null;
            break;
        }
        $prevVideoId = $v['videoID'];
    }

    $subjectID = $category['subjectID'];
}

$videoSubject = $videoClass->getSubject($subjectID);

$videoCategories = $videoClass->getVideoCategories($subjectID);

if(isset($video))
    $videoInfo = $videoClass->getVideoInfo($video['code']);

buckys_enqueue_stylesheet('index.css');
buckys_enqueue_stylesheet('sceditor/themes/default.css');
buckys_enqueue_stylesheet('postlist.css');
buckys_enqueue_stylesheet('videos.css');

buckys_enqueue_javascript('sceditor/jquery.sceditor.bbcode.js');
buckys_enqueue_javascript('videos.js');

$TNB_GLOBALS['content'] = "videos";

/* Page title
if(isset($videoInfo))
    $TNB_GLOBALS['title'] = $videoInfo['entry']['title']['$t'];
else
*/
$TNB_GLOBALS['title'] = TNB_SITE_NAME . " Videos and Tutorials - Free Educational Video Tutorials on Computer Programming, Adobe Software, Computer Science and More!";

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");


