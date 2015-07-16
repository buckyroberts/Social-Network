<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>

    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <h2 class="titles">
                Advertisements
            </h2>

            <form method="post" id="manageAdsform" action="/manage_ads.php" style="padding-top:0px;">
                <?php render_result_messages() ?>
                <?php
                if(count($objects) == 0){
                    ?>
                    <div class="tr noborder">
                        Nothing to see here.
                    </div>
                <?php
                }else{
                    ?>
                    <?php $pagination->renderPaginate('/manage_ads.php?', count($objects)); ?>
                    <div class="table">
                        <div class="thead">
                            <div class="td td-chk"><input type="checkbox" id="chk_all" name="objectID[]"/></div>
                            <div class="clear"></div>
                        </div>
                        <?php
                        foreach($objects as $i => $row){
                            ?>
                            <div class="tr <?php echo $i == count($objects) - 1 ? 'noborder' : ''?>">
                                <div class="td td-chk">
                                    <input type="checkbox" id="chk<?php echo $row['id']?>" name="adID[]"
                                        value="<?php echo $row['id']?>"/>
                                </div>
                                <div class="td td-ad-fields">
                                    <?php if($row['type'] == 'Image'): ?>
                                        <div class="ad-image">
                                            <img
                                                src="<?php echo DIR_WS_IMAGE ?>user_ads/<?php echo $row['fileName'] ?>"/>
                                        </div>
                                    <?php endif; ?>
                                    <div class="row">
                                        <label>ID:</label> <span><?php echo $row['id']?></span>
                                    </div>
                                    <div class="row">
                                        <label>User:</label> <span><a
                                                href="/profile.php?user=<?php echo $row['ownerID']?>"><?php echo $row['creatorName']?></a></span>
                                    </div>
                                    <?php if($row['type'] == 'Text'): ?>
                                        <div class="row">
                                            <label>Title:</label> <span><?php echo $row['title'] ?></span>
                                        </div>
                                        <div class="row">
                                            <label>Description:</label> <span><?php echo $row['description'] ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <div class="row">
                                        <label>Url:</label> <span><a
                                                href="<?php echo $row['url']?>"><?php echo $row['url']?></a></span>
                                    </div>
                                    <?php if($row['type'] == 'Text'): ?>
                                        <div class="row">
                                            <label>Display Url:</label> <span><?php echo $row['display_url'] ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="clear"></div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="btn-row">
                        <input type="button" class="redButton" value="Approve" id="approve-ads"
                            style="margin-right: 5px;"/> <input type="button" class="redButton" value="Reject"
                            id="reject-ads"/>
                    </div>
                    <input type="hidden" name="action" value=""/>
                    <?php render_form_token(); ?>
                <?php } ?>
            </form>
        </section>
    </section>
</section>