<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>

    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <h2 class="titles">Manage Photos</h2>

            <form method="post" id="photoslist" action="/photo_manage.php" name="aform" class="user-info"
                style="padding-top:0px;">
                <?php render_result_messages() ?>
                <?php if($albums && count($albums) > 0){ ?>
                    <section id="albums-nav"
                        style="text-align:right; margin-top:5px; padding-bottom:10px; border-bottom:1px solid #cccccc;">
                        Select Album: <select class="select" name="albumID"
                            onchange="document.location.href='/photo_manage.php?albumID=' + this.value">
                            <option value="">All</option>
                            <?php foreach($albums as $row){ ?>
                                <option
                                    value="<?php echo $row['albumID'] ?>" <?php echo $row['albumID'] == $_GET['albumID'] ? 'selected="selected"' : '' ?>><?php echo $row['name'] ?></option>
                            <?php } ?>
                        </select>
                    </section>
                <?php } ?>
                <div class="table" style="margin-bottom:5px;">
                    <?php
                    foreach($photos as $i => $row){
                        ?>
                        <div class="tr <?php echo $i == count($photos) - 1 ? 'noborder' : ''?>">
                            <!--<div class="td td-chk"><input type="checkbox" id="chk_all" value="<?php echo $row['postID'] ?>" name="photoID[]"  /></div>-->
                            <div class="td td-img">
                                <a href="/photo_edit.php?photoID=<?php echo $row['postID']?>">
                                    <?php if($row['is_profile']){ ?>
                                        <img
                                            src="<?php echo DIR_WS_PHOTO ?>users/<?php echo $row['poster'] ?>/resized/<?php echo $row['image'] ?>"/>
                                    <?php }else{ ?>
                                        <img
                                            src="<?php echo DIR_WS_PHOTO ?>users/<?php echo $row['poster'] ?>/thumbnail/<?php echo $row['image'] ?>"/>
                                    <?php } ?>
                                </a>
                            </div>
                            <div class="td td-caption"><?php echo $row['content']?></div>
                            <div class="td td-album">
                                <br/> <br/>
                                <?php
                                if(!$row['album_id']){
                                    echo '-';
                                }else{
                                    echo $albums[$row['album_id']]['name'];
                                }
                                ?>
                            </div>
                            <div class="td td-visibility">
                                <br/> <br/>
                                <?php echo $row['visibility'] ? 'Public' : 'Private' ?>
                            </div>
                            <div class="td td-action">
                                <br/> <a href="/photo_edit.php?photoID=<?php echo $row['postID']?>">Edit Photo</a><br/>
                                <?php if($row['image'] == $userData['thumbnail']){ ?>
                                    <a href="/photo_manage.php?action=remove-profile-photo&photoID=<?php echo $row['postID'] ?>"
                                        class="remove-link">Remove from Profile Photo</a>
                                    <br/>
                                <?php }else{ ?>
                                    <a href="/photo_manage.php?action=set-profile-photo&photoID=<?php echo $row['postID'] ?>">Set as Profile Photo</a>
                                    <br/>
                                <?php } ?>
                                <?php //if($row['image'] != $userData['thumbnail']) {
                                ?>
                                <a href="/photo_manage.php?action=delete-photo&photoID=<?php echo $row['postID']?>">Delete Photo</a><br/>
                                <?php //}
                                ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php
                    }
                    if(count($photos) == 0){
                        ?>
                        <div class="tr noborder">
                            Nothing to see here.
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <?php $pagination->renderPaginate('/photo_manage.php?' . (!$albumID ? '' : ('albumID=' . $albumID . "&")), count($photos)); ?>
                <br/> <br/>
                <!--                <div class="btn-row"><input type="button" class="redButton" value="Delete" id="delete-messages" /></div>-->
                <input type="hidden" name="action" value="delete_photos"/> <input type="hidden" name="userID"
                    value="<?php echo $userID ?>"/>
            </form>
        </section>
    </section>
</section>