<?php
/**
 * Page Left Sidebar
 */
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}

global $view;

$userID = null;
if(isset($TNB_GLOBALS['user']))
    $userID = $TNB_GLOBALS['user']['userID'];

$pageData = $view['pageData'];

//Get Number of photos
$postIns = new BuckysPost();
$numberOfPhotos = $postIns->getNumberOfPhotosByUserID($pageData['userID'], $pageData['pageID']);

//follower
$pageFollowerIns = new BuckysPageFollower();
$view['isMyPage'] = $pageData['userID'] == $userID;
$view['isFollowed'] = $pageFollowerIns->hasRelationInFollow($pageData['pageID'], $userID);

?>

<script type="text/javascript">
    var pageLinkList = <?php if ($pageData['links'] != '') {echo json_encode(unserialize($pageData['links']));} else echo json_encode([]);?>;
</script>

<!-- Left Side -->
<aside id="main_aside" style="overflow:auto"> <!-- 241px -->

    <input type="hidden" id="currentPageID" value="<?php echo $pageData['pageID']; ?>">

    <div class="info-box">
        <h3 id="page_title_display"><span><?php echo $pageData['title']; ?></span> <?php if($view['isMyPage']) : ?>
                <a href="javascript:void(0)" class="edit-info" id="edit_page_title_btn">(edit)</a><?php endif; ?></h3>

        <div class="page-title-edit-panel">
            <input type="text" id="page_title_input" value="<?php echo $pageData['title']; ?>" maxlength="200"> <input
                type="button" value="Save" id="save_page_title" class="redButton">
        </div>
    </div>
    <?php render_pagethumb_link($pageData, 'mainProfilePic'); ?>
    <br/>


    <?php if(!$view['isMyPage']): ?>
        <?php
        if($view['isFollowed']){
            echo sprintf('<a href="/page.php?pid=%d&action=unfollow' . buckys_get_token_param() . '">Unfollow Page</a> <br/>', $pageData['pageID']);
        }else{
            echo sprintf('<a href="/page.php?pid=%d&action=follow' . buckys_get_token_param() . '">Follow Page</a> <br/>', $pageData['pageID']);
        }
        ?>
    <?php endif; ?>

    <?php
    echo sprintf('<a href="/photos.php?pid=%d">View All Photos (%d)</a> <br/>', $pageData['pageID'], $numberOfPhotos);
    ?>

    <?php if($view['isMyPage'] || buckys_is_admin()) : ?>
        <a href="javascript:void(0)" class="delete-this-page-btn">Delete this Page</a> <br/>
    <?php endif ?>

    <div class="page-about-sidebox info-box">
        <!-- <h3>About <?php if($view['isMyPage']) : ?><a href="javascript:void(0)" class="edit-info" id="edit_about_btn">(edit)</a><?php endif; ?></h3> -->
        <h4>About <?php if($view['isMyPage']) : ?>
                <a href="javascript:void(0)" class="edit-info" id="edit_about_btn">(edit)</a><?php endif; ?> </h4>

        <div class="page-about-content">
            <div id="about_text_display"><?php echo render_enter_to_br($pageData['about']); ?></div>
            <div class="about-text-edit-panel">
                <textarea id="about_text_input" class="about-textarea"
                    maxlength="5000"><?php echo $pageData['about']; ?></textarea> <input type="button" value="Save"
                    id="save_about_text" class="redButton">
            </div>
        </div>
    </div>

    <div class="page-link-sidebox info-box">
        <!-- <h3>Links <?php if($view['isMyPage']) : ?><a href="javascript:void(0)" class="edit-info" id="edit_link_btn">(edit)</a><?php endif; ?></h3> -->
        <h4>Links <?php if($view['isMyPage']) : ?>
                <a href="javascript:void(0)" class="edit-info" id="edit_link_btn">(edit)</a><?php endif; ?> </h4>

        <div class="page-link-content">
            <div id="page_link_display">
                <?php
                if($pageData['links'] != ''){
                    $linkList = unserialize($pageData['links']);

                    if(is_array($linkList) && count($linkList) > 0){
                        foreach($linkList as $linkData){
                            echo sprintf('<a href="%s">%s</a> <br/>', $linkData['link'], $linkData['title']);
                        }
                    }
                }
                ?>
            </div>

            <div class="page-link-edit-panel">
                <div class="page-link-edit-panel-innner">
                    <div id="edit_link_node_panel">

                    </div>
                    <div class="btn-box">
                        <button class="redButton" value="Save" id="save_page_links">Save</button>
                        <a href="javascript:void(0)" id="add_new_link_btn">Add New</a>

                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
</aside>