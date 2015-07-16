<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>
    <section id="right_side" class="tinted">

        <section id="stream">
            <span class="titles">Stream</span><br/>
            <?php render_result_messages(); ?>
            <div style="border-bottom:1px solid #cccccc; margin-top:5px; margin-bottom:10px; float:left;">
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
                                    <label for="post_visibility_private"><input type="radio" name="post_visibility"
                                            id="post_visibility_private" value="0"/> Private</label>
                                    <label for="post_visibility_profile" style="display: none;"><input type="radio"
                                            name="post_visibility" id="post_visibility_profile"
                                            value="2"/> Use as Profile Photo</label>
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
                        <?php render_form_token(); ?>
                        <?php render_loading_wrapper(); ?>
                    </form>
                </div>
            </div>
            <?php
            foreach($stream as $post){
                echo buckys_get_single_post_html($post, $userID);
            }
            ?>
            <!-- View More Stream -->
            <div class="clear"></div>
            <div id="more-stream" data-page="account"><img src="<?php echo DIR_WS_IMAGE ?>loading1.gif" height="15"/>
            </div>
        </section>

        <section id="activity_feed">
            <h2 class="activityHeader">My Notifications</h2>

            <div id="notifications" data-count="15">
                <?php
                foreach($notifications as $row){
                    echo BuckysActivity::getActivityHTML($row, $userID);
                }
                ?>
                <?php if(count($notifications) == 15){ ?>
                    <div class="clear"></div>
                    <a href="#" class="view-more">view more</a>
                <?php } ?>
            </div>

            <div class="clear"></div>
            <br/>

            <h2 class="activityHeader" style="background-color: #2980B9;">Friend Activity</h2>

            <div id="activities" data-count="15">
                <?php
                foreach($activities as $row){
                    echo BuckysActivity::getActivityHTML($row, $userID);
                }
                ?>
                <?php if(count($activities) == 15){ ?>
                    <div class="clear"></div>
                    <a href="#" class="view-more">view more</a>
                <?php } ?>
            </div>
        </section>

    </section>
</section>
