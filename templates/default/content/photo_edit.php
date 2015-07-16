<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>

    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <h2 class="titles">Edit Photo</h2><br/>

            <form method="post" id="editphotoform" action="/photo_edit.php" class="user-info">
                <?php render_result_messages() ?>
                <div class="img-row" id="jcrop-row">
                    <img
                        src="<?php echo DIR_WS_PHOTO ?>users/<?php echo $photo['poster'] ?>/resized/<?php echo $photo['image'] ?>?<?php echo mt_rand(0, 9999) ?>"/>
                </div>
                <div class="row" <?php echo $set_profile ? "style='display: none'" : "" ?>>
                    <div
                        class="date-row">Date Posted: <?php echo date("F j, Y", strtotime($photo['post_date'])) ?></div>
                    <div class="album-row"  <?php echo count($albums) == 0 ? 'style="visibility: hidden"' : '' ?>>
                        <label for="album">Album: </label> <select name="album" id="album" class="select">
                            <option value=""> --</option>
                            <?php foreach($albums as $row){ ?>
                                <option
                                    value="<?php echo $row['albumID'] ?>" <?php echo isset($photoAlbums[$row['albumID']]) ? 'selected="selected"' : '' ?>><?php echo $row['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row" <?php echo $set_profile ? "style='display: none'" : "" ?>>
                    <textarea name="content" id="content" class="newPost"
                        placeholder="Create a new post..."><?php echo $photo['content'] ?></textarea>
                </div>
                <div class="visibility-row" <?php echo $set_profile ? "style='display: none'" : "" ?>>
                    <input type="radio" name="photo_visibility" id="photo_visibility_public"
                        value="1" <?php echo !$set_profile && $photo['visibility'] ? 'checked="checked"' : '' ?> />
                    <label for="photo_visibility_public">Public</label> <input type="radio" name="photo_visibility"
                        id="photo_visibility_private"
                        value="0" <?php echo !$set_profile && !$photo['visibility'] ? 'checked="checked"' : '' ?> />
                    <label for="photo_visibility_private">Private</label> <input type="radio" name="photo_visibility"
                        id="photo_visibility_profile"
                        value="2" <?php echo $set_profile || $photo['image'] == $userData['thumbnail'] ? 'checked="checked"' : '' ?>  />
                    <label for="photo_visibility_profile">Set as Profile Photo</label>
                </div>
                <div style="position: absolute; left: -9999px" id="original-image">
                    <img
                        src="<?php echo DIR_WS_PHOTO ?>users/<?php echo $photo['poster'] ?>/original/<?php echo $photo['image'] ?>"/>
                </div>
                <div class="btn-row">
                    <input type="submit" id="save-photo-button" class="redButton" value="Submit Changes"/>

                    <div class="clear"></div>
                </div>
                <input type="hidden" name="action" value="save-photo"/> <input type="hidden" name="photoID"
                    value="<?php echo $photo['postID'] ?>"/> <input type="hidden" name="userID"
                    value="<?php echo $userID ?>"/>
                <?php render_loading_wrapper() ?>
                <script type="text/javascript">
                    var set_profile = "<?php echo $set_profile ? 1 : 0?>";
                </script>
            </form>
        </section>
    </section>
</section>
