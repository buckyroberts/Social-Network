<?php
/**
 * Posts Page
 */

if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section" class="tinted">

    <!-- Left Side -->
    <?php buckys_get_panel('profile_left_sidebar') ?>

    <!-- 752px -->
    <section id="right_side">
        <div class="info-box" id="posts-box">
            <h3 style="margin-bottom:5px;">
                Posts
                <span class="sub-links">
					<a href="/profile.php?user=<?php echo $userData['userID'] ?>"
                        class="view-all">(back to <?php echo $userData['firstName'] ?>'s profile)</a>
                </span>
            </h3>
            <?php

            foreach($posts as $post){
                echo buckys_get_single_post_html($post, $userID);
            }
            ?>
            <?php if(!isset($_GET['post'])){ ?>
                <!-- View More Stream -->
                <div class="clear"></div>
                <div id="more-stream" data-page="post" post-type="<?php echo $postType ?>"
                    data-user-id="<?php echo $profileID ?>">
                    <img src="<?php echo DIR_WS_IMAGE ?>loading1.gif" height="15"/></div>
            <?php } ?>
        </div>
    </section>
</section>