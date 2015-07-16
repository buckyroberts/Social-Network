<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>

    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <h2 class="titles">Add Photo</h2><br/>

            <form method="post" id="addphotoform" action="/photo_add.php" class="user-info"
                enctype="multipart/form-data">
                <?php render_result_messages() ?>
                <div class="row">
                    <textarea name="content" id="content" class="newPost" placeholder="Create a new post..."></textarea>
                </div>
                <div class="row">
                    <div class="album-row" <?php echo count($albums) == 0 ? 'style="visibility: hidden"' : '' ?>>
                        <label for="album">Album: </label> <select name="album" id="album" class="select">
                            <option value=""> --</option>
                            <?php foreach($albums as $row){ ?>
                                <option
                                    value="<?php echo $row['albumID'] ?>" <?php echo isset($photoAlbums[$row['albumID']]) ? 'selected="selected"' : '' ?>><?php echo $row['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="visibility-row">
                        <input type="radio" name="post_visibility" id="post_visibility_public" value="1"
                            checked="checked"/> <label for="post_visibility_public">Public</label> <input type="radio"
                            name="post_visibility" id="post_visibility_private" value="0"/> <label
                            for="post_visibility_private">Private</label> <input type="radio" name="post_visibility"
                            id="post_visibility_profile" value="2"/> <label
                            for="post_visibility_profile">Use as Profile Photo</label>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="file-row">
                    <input type="button" id="file_upload" name="file_upload" type="file"/>

                    <div class="btn-row">
                        <input type="submit" id="add-photo-button" class="redButton" value="Add Photo"/>

                        <div class="clear"></div>
                    </div>
                </div>

                <div class="clear"></div>

                <div id="jcrop-row-wrapper">
                    <a href="#" class="cancel-photo"></a>

                    <div id="jcrop-row"></div>
                </div>

                <div id="preview-photo-row"><a href="#" class="cancel-photo"></a></div>
                <input type="hidden" name="action" value="create-photo"/> <input type="hidden" name="x1" id="x1"
                    value="0"/> <input type="hidden" name="x2" id="x2" value="0"/> <input type="hidden" name="y1"
                    id="y1" value="0"/> <input type="hidden" name="y2" id="y2" value="0"/> <input type="hidden"
                    name="width" id="width" value="0"/> <input type="hidden" name="userID"
                    value="<?php echo $userID ?>"/>
                <?php render_loading_wrapper() ?>
            </form>
        </section>
    </section>
</section>
