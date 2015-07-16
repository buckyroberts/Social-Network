<?php
/**
 * Profile Detail Page
 */

if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}


$pageData = $view['pageData'];
$followerCount = $pageFollowerIns->getNumberOfFollowers($pageData['pageID']);
?>

<section id="main_section" class="tinted">

    <!-- Left Side -->
    <?php buckys_get_panel('page_left_sidebar'); ?>

    <!-- 752px -->
    <section id="right_side" class="profile-contr page-content-container">
        <?php render_result_messages(); ?>

        <?php if($view['show_only_post'] == false && $view['show_all_post'] == false) : ?>
            <div class="info-box" id="friends-box">
                <h3 style="margin-bottom:5px;"><?php echo $followerCount; ?> follower<?php if($followerCount != 1)
                        echo 's'; ?>
                    <a href="/followers.php?pid=<?php echo $pageData['pageID']; ?>" class="view-all">(view all)</a></h3>
                <?php
                foreach($view['followers'] as $row){
                    render_profile_link($row, 'friendThumbnails');
                }
                ?>
            </div>



            <?php if($view['isMyPage']): ?>

                <div class="info-box" id="post-edit-box">
                    <h3>New Post</h3>

                    <div class="new-post-box">
                        <?php render_pagethumb_link($pageData, 'postIcons'); ?>
                        <div class="new-post-row">
                            <form method="post" id="newpostform" action="/manage_post.php">
                                <div id="new-post-nav">
                                    <a href="#" class="post-text selected">Text</a> <span>|</span> <a href="#"
                                        class="post-image">Photo</a> <span>|</span> <a href="#"
                                        class="post-video">Video</a>
                                </div>
                                <textarea name="content" class="newPost" placeholder="Create a new post..."></textarea>

                                <div id="new-video-url">
                                    <label style="font-weight:bold;font-size:11px;" for="video-url">YouTube URL:</label>
                                    <input type="text" name="youtube_url" id="youtube_url" class="input" value=""/>
                                </div>
                                <div class='privacy-row'>                                 
                                    <span class="publicPrivatePost">
                                        <label for="post_visibility_public"><input type="radio" name="post_visibility"
                                                id="post_visibility_public" value="1" checked="checked"/> Public</label>
                                        <?php /*<label for="post_visibility_private"><input type="radio" name="post_visibility" id="post_visibility_private" value="0" /> Private</label>*/ ?>
                                        <label for="post_visibility_profile" style="display: none;"><input type="radio"
                                                name="post_visibility" id="post_visibility_profile"
                                                value="2"/> Use as Page Logo</label>
                                    </span>

                                    <input type="submit" id="save-btn" class="redButton" value="Post"
                                        style="display:block;"/>

                                    <div class="file-row">
                                        <input type="button" id="file_upload" name="file_upload" type="file"/>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div id="jcrop-row"></div>
                                <input type="hidden" name="action" value="submit-post"/> <input type="hidden"
                                    name="pageID" value="<?php echo $pageData['pageID'] ?>"> <input type="hidden"
                                    name="pageIDHash" value="<?php echo buckys_encrypt_id($pageData['pageID']) ?>">
                                <input type="hidden" name="x1" id="x1" value="0"/> <input type="hidden" name="x2"
                                    id="x2" value="0"/> <input type="hidden" name="y1" id="y1" value="0"/> <input
                                    type="hidden" name="y2" id="y2" value="0"/> <input type="hidden" name="width"
                                    id="width" value="0"/> <input type="hidden" name="type" id="type" value="text"/>
                                <?php render_form_token(); ?>
                                <?php render_loading_wrapper(); ?>
                            </form>
                        </div>
                        <div class="clear"></div>
                    </div>

                </div>

            <?php endif; ?>

        <?php endif; ?>


        <div class="info-box" id="posts-box">
            <?php if($view['show_all_post']): ?>
                <h3>Posts <a href="/page.php?pid=<?php echo $pageData['pageID'] ?>" class="view-all">(back to page)</a>
                </h3>
            <?php else: ?>
                <h3>Posts <a href="/page.php?pid=<?php echo $pageData['pageID'] ?>&postsonly=1"
                        class="view-all">(view all)</a>
                </h3>
            <?php endif; ?>
            <?php
            foreach($view['posts'] as $post){
                echo buckys_get_single_post_html($post, $userID, false, $pageData);
            }
            ?>
            <!-- View More Stream -->
            <div class="clear"></div>

            <?php if($view['show_only_post'] == false) : ?>
                <div id="more-stream" data-page="page-post" data-page-id="<?php echo $pageData['pageID'] ?>">
                    <img src="<?php echo DIR_WS_IMAGE ?>loading1.gif" height="15"/></div>
            <?php endif; ?>

        </div>

    </section>
</section>