<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>

    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <h2 class="titles">View Album - <?php echo $album['name'] ?></h2><br/>
            <?php if(count($albumPhotos) > 0){ ?>
                <div class="advanced-slider" id="responsive-slider">
                    <ul class="slides">
                        <?php foreach($albumPhotos as $p): ?>
                            <li class="slide">
                                <img class="image"
                                    src="<?php echo DIR_WS_PHOTO ?>users/<?php echo $p['poster'] ?>/resized/<?php echo $p['image'] ?>"/>
                                <img class="thumbnail" height="100"
                                    src="<?php echo DIR_WS_PHOTO ?>users/<?php echo $p['poster'] ?>/<?php echo $p['is_profile'] ? 'resized' : 'thumbnail' ?>/<?php echo $p['image'] ?>"/>
                                <?php if($p['content']){ ?>
                                    <div class="layer white" data-horizontal="100" data-vertical="122"
                                        data-transition="up" data-offset="20" data-delay="600">
                                        <?php echo buckys_process_post_content($p) ?>
                                    </div>
                                <?php } ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php }else{ ?>
                <p>There is no photo.</p>
            <?php } ?>
        </section>
    </section>
</section>
