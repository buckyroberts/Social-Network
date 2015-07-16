<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');
$userID = buckys_is_logged_in();
if($_POST['page'] == 'account'){
    if(!$userID)
        exit;
    $stream = BuckysPost::getUserPostsStream($userID, $_POST['lastDate']);

    foreach($stream as $post){
        echo buckys_get_single_post_html($post, $userID);
    }
}else if($_POST['page'] == 'post'){
    $profileID = $_POST['user'];

    $canViewPrivate = $userID == $profileID || BuckysFriend::isFriend($userID, $profileID) || BuckysFriend::isSentFriendRequest($profileID, $userID);

    $postType = isset($_POST['type']) ? $_POST['type'] : 'all';
    if(!in_array($postType, ['all', 'user', 'friends'])){
        $postType = 'all';
    }

    $posts = BuckysPost::getPostsByUserID($profileID, $userID, BuckysPost::INDEPENDENT_POST_PAGE_ID, $canViewPrivate, isset($_GET['post']) ? $_GET['post'] : null, $_POST['lastDate'], $postType);

    foreach($posts as $post){
        echo buckys_get_single_post_html($post, $userID);
    }
}else if($_POST['page'] == 'page-post'){
    $paramPageID = $_POST['pageID'];

    $pageIns = new BuckysPage();
    $postIns = new BuckysPost();
    $pageData = $pageIns->getPageByID($paramPageID);

    if($pageData){

        $posts = $postIns->getPostsByUserID($pageData['userID'], null, $paramPageID, false, isset($_GET['post']) ? $_GET['post'] : null, $_POST['lastDate']);

        foreach($posts as $post){
            echo buckys_get_single_post_html($post, $userID, false, $pageData);
        }

    }

}else if($_POST['page'] == 'page-photo'){
    $paramPageID = $_POST['pageID'];

    $pageIns = new BuckysPage();
    $postIns = new BuckysPost();
    $pageData = $pageIns->getPageByID($paramPageID);

    if($pageData){
        $photos = $postIns->getPhotosByUserID($pageData['userID'], null, $paramPageID, false, null, null, 5, $_POST['lastDate']);

        foreach($photos as $row){
            ?>
            <a href="/page.php?pid=<?php echo $row['pageID']?>&post=<?php echo $row['postID']?>" class="photo"><img
                    src="<?php echo DIR_WS_PHOTO ?>users/<?php echo $row['poster']?>/thumbnail/<?php echo $row['image']?>"
                    data-posted-date='<?php echo $row['post_date']?>'/></a>
        <?php
        }
    }

}else if($_POST['page'] == 'photo'){
    $profileID = $_POST['user'];

    $canViewPrivate = $userID == $profileID || BuckysFriend::isFriend($userID, $profileID) || BuckysFriend::isSentFriendRequest($profileID, $userID);

    $photos = BuckysPost::getPhotosByUserID($profileID, $userID, BuckysPost::INDEPENDENT_POST_PAGE_ID, $canViewPrivate, null, isset($_POST['albumID']) ? $_POST['albumID'] : null, 5, $_POST['lastDate']);

    foreach($photos as $row){
        ?>
        <a href="/posts.php?user=<?php echo $row['poster']?>&post=<?php echo $row['postID']?>" class="photo"><img
                src="<?php echo DIR_WS_PHOTO ?>users/<?php echo $row['poster']?>/thumbnail/<?php echo $row['image']?>"
                data-posted-date='<?php echo $row['post_date']?>'/></a>
    <?php
    }
}