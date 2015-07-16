<?php
/**
 * Page Left Sidebar
 */
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
if(buckys_is_logged_in()){
    $followingCategories = BuckysForumCategory::getFollowingCategories();
}else{
    $followingCategories = BuckysForumCategory::getDefaultCategories();
}
?>
<aside id="forum-left-bar">
    <?php if(buckys_is_logged_in()) : ?>
        <h2 class="titles"><?php echo $TNB_GLOBALS['user']['firstName'] . " " . $TNB_GLOBALS['user']['lastName'] ?></h2>
        <div class="user-thumbnail">
            <a href="/profile.php?user=<?php echo $TNB_GLOBALS['user']['userID'] ?>">
                <?php if(!$TNB_GLOBALS['user']['thumbnail']){ ?>
                    <img src="<?php echo DIR_WS_IMAGE . 'defaultProfileImage.png' ?>"/>
                <?php }else{ ?>
                    <img
                        src="<?php echo DIR_WS_PHOTO . 'users/' . $TNB_GLOBALS['user']['userID'] . '/resized/' . $TNB_GLOBALS['user']['thumbnail'] ?>"/>
                <?php } ?>
            </a>
        </div>
    <?php else: ?>
        <h2 class="titles">Login</h2>
        <form id="loginform" action="/login.php" method="post">
            <div class="row">
                <input type="text" class="input" maxlength="60" name="email" id="email" placeholder='E-mail'/>
            </div>
            <div class="row">
                <input type="password" class="input" maxlength="20" name="password" id="password" placeholder='Password'
                    autocomplete="off"/>
            </div>
            <div class="row">
                <label></label> <input type="submit" value="Log In" class="redButton" name="login_submit"> <input
                    type="hidden" name="return" value="<?php echo base64_encode("/forum") ?>"/>
            </div>
        </form>
    <?php endif; ?>

    <dl  <?php if(buckys_is_logged_in()){
        echo ' style="margin-top:10px;" ';
    } ?> >
        <dt>My Feeds</dt>

        <?php if(buckys_is_logged_in()) : ?>
            <dd>
                <a href='/forum/index.php' <?php echo $TNB_GLOBALS['content'] == 'forum/home' ? 'class="current"' : '' ?>>My Forum Feed</a>

                <div class="menu-item-divider"></div>
            </dd>
        <?php endif; ?>
        <dd>
            <a href="/forum/recent_activity.php" <?php echo $TNB_GLOBALS['content'] == 'forum/recent_activity' ? 'class="current"' : '' ?>>All Activity</a>

            <div class="menu-item-divider"></div>
        </dd>
    </dl>

    <?php
    if(buckys_is_admin() || buckys_is_moderator()){
        $pendingTopics = BuckysForumTopic::getTotalNumOfTopics('pending');
        $pendingReplies = BuckysForumReply::getTotalNumOfReplies(null, 'pending');
        ?>
        <dl>
            <dt>Moderator</dt>
            <dd>
                <a href="/forum/pending_topics.php" <?php echo $TNB_GLOBALS['content'] == 'forum/pending_topics' ? 'class="current"' : '' ?>>Pending Topics</a>
                <?php if($pendingTopics > 0){ ?>
                    <span class="reported-items"><?php echo $pendingTopics ?></span>
                <?php } ?>
                <div class="menu-item-divider"></div>
            </dd>
            <dd>
                <a href="/forum/pending_replies.php" <?php echo $TNB_GLOBALS['content'] == 'forum/pending_replies' ? 'class="current"' : '' ?>>Pending Replies</a>
                <?php if($pendingReplies > 0){ ?>
                    <span class="reported-items"><?php echo $pendingReplies ?></span>
                <?php } ?>
                <div class="menu-item-divider"></div>
            </dd>
        </dl>

    <?php
    }
    ?>

    <?php if(buckys_is_logged_in()) : ?>
        <?php
        $listType = null;
        if($TNB_GLOBALS['content'] == 'forum/myposts'){
            $listType = isset($_GET['type']) ? $_GET['type'] : 'all';
            if(!in_array($listType, ['all', 'responded', 'started']))
                $listType = 'all';
        }
        ?>
        <dl>
            <dt>My Topics</dt>
            <dd>
                <a href="/forum/myposts.php?type=started" <?php echo $TNB_GLOBALS['content'] == 'forum/myposts' && $listType == 'started' ? 'class="current"' : '' ?>>Created</a>

                <div class="menu-item-divider"></div>
            </dd>
            <dd>
                <a href="/forum/myposts.php?type=responded" <?php echo $TNB_GLOBALS['content'] == 'forum/myposts' && $listType == 'responded' ? 'class="current"' : '' ?>>Replied</a>

                <div class="menu-item-divider"></div>
            </dd>
        </dl>
    <?php endif; ?>

    <dl>
        <dt>Following</dt>

        <?php if(buckys_is_logged_in()){ ?>
            <dd>
                <a href="/forum/add_forum.php"
                    style="font-family:OpenSans-Bold; color:#f2f2f2;" <?php echo $TNB_GLOBALS['content'] == 'forum/edit_category' && !isset($categoryID) ? 'class="current"' : '' ?>>Create a New Category +</a>
            </dd>
            <div class="menu-item-divider"></div>
        <?php } ?>

        <?php
        if(buckys_is_admin() || buckys_is_moderator() || (isset($category) && (buckys_is_forum_admin($category['categoryID']) || buckys_is_forum_moderator($category['categoryID'])))){
            $reportedItemsCount = BuckysForumModerator::getReportedItemsCount();
        }
        ?>
        <?php foreach($followingCategories as $crow) : ?>
            <?php
            if($crow['parentID'] == 0)
                continue;
            ?>
            <dd>
                <a href="/forum/category.php?id=<?php echo $crow['categoryID'] ?>"
                    <?php echo isset($category) && $crow['categoryID'] == $category['categoryID'] ? 'class="current"' : '' ?>><?php echo $crow['categoryName'] ?></a>

                <?php if(isset($reportedItemsCount) && isset($reportedItemsCount[$crow['categoryID']]) && $reportedItemsCount[$crow['categoryID']] > 0){ ?>
                    <span class="reported-items"><?php echo $reportedItemsCount[$crow['categoryID']] ?></span>
                <?php } ?>
                <div class="menu-item-divider"></div>
            </dd>
        <?php endforeach; ?>

    </dl>

</aside>