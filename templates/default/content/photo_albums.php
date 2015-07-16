<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>

    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <h2 class="titles">Photo Albums</h2><br/>

            <form method="post" id="newalbumform" action="/photo_albums.php" class="user-info">
                <?php render_result_messages() ?>
                <div class="new-album-title-row">
                    <input type="text" id="new_album_name" name="new_album_name" class="input"
                        placeholder="Album title..."/> <input type="submit" id="create_new_album_submit"
                        name="create_new_album_submit" class="redButton" value="Create New Album"/>
                    <span style="display: none;">
                        Privacy: 
                        <input type="radio" name="visibility" id="visibility_public" value="1" autocomplete="off"
                            checked="checked"/> <label for="visibility_public">Public</label>
                        <input type="radio" name="visibility" id="visibility_private" value="0"
                            autocomplete="off"/> <label for="visibility_private">Private</label>
                    </span>
                </div>
                <div id="all-photos">

                </div>
                <input type="hidden" name="action" value="create-album"/> <input type="hidden" name="userID"
                    value="<?php echo $userID ?>"/>
            </form>
            <!-- Old Album List -->
            <div class="table" id="album-list">
                <div class="thead">
                    <div class="td td-album-name">Album Name</div>
                    <div class="td td-num-photos"># of Photos</div>
                    <div class="td td-privacy">Privacy</div>
                    <div class="td td-created-date">Created Date</div>
                    <div class="td td-action">Action</div>
                    <div class="clear"></div>
                </div>
                <?php
                $idx = 1;
                foreach($albums as $i => $row){
                    ?>
                    <div class="tr <?php echo $idx++ == count($albums) ? 'noborder' : ''?>">
                        <div class="td td-album-name"><?php echo $row['name']?></div>
                        <div class="td td-num-photos"><?php echo $row['photos']?></div>
                        <div class="td td-privacy"><?php echo $row['visibility'] ? 'Public' : 'Private'?></div>
                        <div
                            class="td td-created-date"><?php echo date('F j, Y', strtotime($row['created_date']))?></div>
                        <div class="td td-action">
                            <a href="/photo_album_edit.php?albumID=<?php echo $row['albumID']?>">Edit</a> | <a href="#"
                                data-id="<?php echo $row['albumID'] ?>" class="delete-album-link">Delete</a>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php
                }
                if(count($albums) == 0){
                    ?>
                    <div class="tr noborder">Nothing to see here.</div>
                <?php
                }
                ?>
            </div>
        </section>
    </section>
</section>