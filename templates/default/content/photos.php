<?php
/**
 * Photos Page
 */

if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section" class="tinted">

    <!-- Left Side -->
    <?php

    if($view['photo_type'] == 'profile'){
        buckys_get_panel('profile_left_sidebar');
    }else{
        buckys_get_panel('page_left_sidebar');
    }

    ?>

    <!-- 752px -->
    <section id="right_side">
        <div class="info-box" id="photos-box">
            <?php if($view['photo_type'] == 'profile'): ?>
                <h3>View All Photos <a href="/profile.php?user=<?php echo $userData['userID'] ?>"
                        class="view-all">(back to profile)</a>
                </h3>
            <?php elseif($view['photo_type'] == 'page'): ?>
                <h3>View All Photos <a href="/page.php?pid=<?php echo $pageData['pageID'] ?>"
                        class="view-all">(back to page)</a></h3>
            <?php endif; ?>

            <?php if($albums && count($albums) > 0){ ?>
                <section id="albums-nav">
                    <form name="aform" method="get" action="/photos.php" style="padding-top:0px;">
                        <input type="hidden" name="user" value="<?php echo $profileID ?>"/> Select Album: <select
                            class="select" name="albumID" onchange="document.aform.submit()">
                            <option value="">All</option>
                            <?php foreach($albums as $row){ ?>
                                <option
                                    value="<?php echo $row['albumID'] ?>" <?php echo $row['albumID'] == $albumID ? 'selected="selected"' : '' ?>><?php echo $row['name'] ?></option>
                            <?php } ?>
                        </select>
                    </form>
                </section>
            <?php } ?>
            <?php
            foreach($photos as $row){
                if($view['photo_type'] == 'profile'){
                    echo sprintf('<a href="/posts.php?user=%d&post=%d" class="photo"><img src="%susers/%d/%s/%s" data-posted-date="%s" /></a>', $row['poster'], $row['postID'], DIR_WS_PHOTO, $row['poster'], $row['is_profile'] ? 'resized' : 'thumbnail', $row['image'], $row['post_date']);
                }else if($view['photo_type'] == 'page'){
                    echo sprintf('<a href="/page.php?pid=%d&post=%d" class="photo"><img src="%susers/%d/%s/%s" data-posted-date="%s" /></a>', $row['pageID'], $row['postID'], DIR_WS_PHOTO, $row['poster'], $row['is_profile'] ? 'resized' : 'thumbnail', $row['image'], $row['post_date']);
                }
            }
            ?>
            <div class="clear"></div>
            <?php if($view['photo_type'] == 'profile'): ?>
                <div id="more-stream" data-page="photo" data-user-id="<?php echo $profileID ?>"
                    data-album-id=<?php echo $albumID ?>>
                    <img src="<?php echo DIR_WS_IMAGE ?>loading1.gif" height="15"/></div>
            <?php elseif($view['photo_type'] == 'page'): ?>
                <div id="more-stream" data-page="page-photo" data-page-id="<?php echo $pageData['pageID'] ?>">
                    <img src="<?php echo DIR_WS_IMAGE ?>loading1.gif" height="15"/></div>
            <?php endif; ?>
        </div>

    </section>
</section>