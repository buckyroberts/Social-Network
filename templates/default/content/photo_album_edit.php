<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>

    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <h2 class="titles">Edit Album</h2><br/>
            <!-- Old Album List -->

            <form method="post" id="albumform" action="/photo_album_edit.php" class="user-info">
                <?php render_result_messages() ?>
                <div class="new-album-title-row">
                    <input type="text" id="album_name" name="album_name" class="input" placeholder="Album title..."
                        value="<?php echo $album['name'] ?>"/> <input type="submit" id="create_new_album_submit"
                        name="create_new_album_submit" class="redButton" value="Save Album"/>
                    <span style="display: none;">
                        Privacy: 
                        <input type="radio" name="visibility" id="visibility_public" value="1"
                            autocomplete="off" <?php echo $album['visibility'] ? 'checked="checked"' : '' ?> /> <label
                            for="visibility_public">Public</label>
                        <input type="radio" name="visibility" id="visibility_private" value="0"
                            autocomplete="off" <?php echo !$album['visibility'] ? 'checked="checked"' : '' ?> /> <label
                            for="visibility_private">Private</label>
                    </span>
                </div>
                <div id="myphotos">
                    <?php
                    foreach($myphotos as $p){
                        ?>
                        <label class="photo <?php if(isset($albumPhotos[$p['postID']])){ ?>photo-checked<?php } ?>"
                            for="photo<?php echo $p['postID']?>"
                            title="<?php echo isset($albumPhotos[$p['postID']]) ? "Remove from Album" : "Add to Album" ?>">
                            <input type="checkbox" name="photos[]" id="photo<?php echo $p['postID']?>"
                                value="<?php echo $p['postID']?>"
                                <?php if (isset($albumPhotos[$p['postID']])){ ?>checked="checked"<?php } ?> /> <img
                                src="<?php echo DIR_WS_PHOTO?>users/<?php echo $p['poster']?>/<?php echo $p['is_profile'] ? 'resized' : 'thumbnail' ?>/<?php echo $p['image']?>"/>
                            <?php if(isset($albumPhotos[$p['postID']])){ ?>
                                <a href="#" class="remove-from-album" data-id="<?php echo $p['postID'] ?>"
                                    title="Remove from Album">Remove</a>
                            <?php }else{ ?>
                                <a href="#" class="add-to-album" data-id="<?php echo $p['postID'] ?>"
                                    title="Add to Album">Add</a>
                            <?php } ?>
                            <span class="loading-wrapper"><span></span><img alt="Loading..." src="/images/loading.gif"></span>
                        </label>
                    <?php
                    }
                    ?>
                    <div class="clear"></div>
                </div>
                <input type="hidden" name="action" value="save-album"/> <input type="hidden" name="userID"
                    value="<?php echo $userID ?>"/> <input type="hidden" name="albumID" id="albumID"
                    value="<?php echo $albumID ?>"/>
            </form>
        </section>
    </section>
</section>