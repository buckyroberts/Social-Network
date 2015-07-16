<?php
/**
 * Profile Detail Page
 */

if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section" class="tinted">

    <!-- Left Side -->
    <?php buckys_get_panel('profile_left_sidebar') ?>

    <!-- 752px -->
    <section id="right_side" class="profile-contr">
        <?php render_result_messages(); ?>
        <div class="info-box" id="friends-box">
            <h3 style="margin-bottom:5px;"><?php echo number_format($totalFriendsCount) ?> friend<?php echo $totalFriendsCount != 1 ? 's' : '' ?>
                <a href="/friends.php?user=<?php echo $userData['userID'] ?>" class="view-all">(view all)</a></h3>
            <?php
            foreach($friends as $row){
                render_profile_link($row, 'friendThumbnails');
            }
            ?>
        </div>
        <br/>

        <?php if($userID == $profileID || BuckysFriend::isFriend($userID, $profileID)): ?>
            <div class="info-box">
                <h3>
                    <?php if($userID == $profileID) : ?>
                        New Post
                    <?php else: ?>
                        Posts on <?php echo $userData['firstName'] ?>'s Profile
                    <?php endif; ?>

                </h3>
                <a href="/profile.php?user=<?php echo $userID ?>"><img
                        src="<?php echo BuckysUser::getProfileIcon($userID) ?>" class="postIcons"/></a>

                <div class="new-post-row">
                    <form method="post" id="newpostform" action="/manage_post.php">
                        <div id="new-post-nav">
                            <a href="#" class="post-text selected">Text</a> <span>|</span> <a href="#"
                                class="post-image">Photo</a> <span>|</span> <a href="#" class="post-video">Video</a>
                        </div>
                        <textarea name="content" class="newPost" placeholder="Create a new post..."></textarea>

                        <div id="new-video-url">
                            <label style="font-weight:bold;font-size:11px;" for="video-url">YouTube URL:</label> <input
                                type="text" name="youtube_url" id="youtube_url" class="input" value=""/></div>
                        <div class='privacy-row'>
                        <span class="publicPrivatePost">
                            <label for="post_visibility_public"><input type="radio" name="post_visibility"
                                    id="post_visibility_public" value="1" checked="checked"/> Public</label>
                            <?php if($userID == $profileID) : ?>
                                <label for="post_visibility_private"><input type="radio" name="post_visibility"
                                        id="post_visibility_private" value="0"/> Private</label>
                                <label for="post_visibility_profile" style="display: none;"><input type="radio"
                                        name="post_visibility" id="post_visibility_profile"
                                        value="2"/> Use as Profile Photo</label>
                            <?php endif; ?>
                        </span>

                            <input type="submit" id="save-btn" class="redButton" value="Post"/>

                            <div class="file-row">
                                <input type="button" id="file_upload" name="file_upload" type="file"/>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div id="jcrop-row-wrapper">
                            <a href="#" class="cancel-photo"></a>

                            <div id="jcrop-row"></div>
                        </div>
                        <div id="preview-photo-row"><a href="#" class="cancel-photo"></a></div>
                        <input type="hidden" name="action" value="submit-post"/> <input type="hidden" name="x1" id="x1"
                            value="0"/> <input type="hidden" name="x2" id="x2" value="0"/> <input type="hidden"
                            name="y1" id="y1" value="0"/> <input type="hidden" name="y2" id="y2" value="0"/> <input
                            type="hidden" name="width" id="width" value="0"/> <input type="hidden" name="type" id="type"
                            value="text"/>
                        <?php if($profileID != $userID): ?>
                            <input type="hidden" name="profileID" id="profileID" value="<?php echo $profileID ?>"/>
                        <?php endif; ?>
                        <input type="hidden" name="return"
                            value="<?php echo base64_encode('/profile.php?user=' . $profileID) ?>"/>
                        <?php render_form_token(); ?>
                        <?php render_loading_wrapper(); ?>
                    </form>
                </div>
                <div class="clear"></div>
            </div>
            <br/>
        <?php endif; ?>

        <div class="info-box" id="posts-box">
            <h3 style="margin-bottom:5px;  margin-right:10px; border-bottom: 1px solid #ddd; position: relative;">
                <span>Posts</span>
                <ul class="profile-nav">
                    <li <?php echo $postType == 'all' ? 'class="current"' : '' ?>>
                        <a href="/profile.php?user=<?php echo $userData['userID'] ?>" class="view-all">All</a></li>
                    <li <?php echo $postType == 'user' ? 'class="current"' : '' ?>>
                        <a href="/profile.php?user=<?php echo $userData['userID'] ?>&type=user"
                            class="view-all"><?php echo $userData['firstName'] ?>'s</a>
                    </li>
                    <li <?php echo $postType == 'friends' ? 'class="current"' : '' ?>>
                        <a href="/profile.php?user=<?php echo $userData['userID'] ?>&type=friends"
                            class="view-all"><?php echo $userData['firstName'] ?>'s friends</a>
                    </li>
                </ul>
            </h3>
            <?php
            foreach($posts as $post){
                echo buckys_get_single_post_html($post, $userID);
            }
            ?>
            <!-- View More Stream -->
            <div class="clear"></div>
            <div id="more-stream" data-page="post" post-type="<?php echo $postType ?>"
                data-user-id="<?php echo $profileID ?>">
                <img src="<?php echo DIR_WS_IMAGE ?>loading1.gif" height="15"/></div>
        </div>

    </section>
</section>