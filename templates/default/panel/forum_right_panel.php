<?php
/**
 * Page Left Sidebar
 */
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<div class="forum-info">
    <h2 class="titles left">
        <?php echo $category['categoryName'] ?>

        <?php if(buckys_is_admin() || buckys_is_moderator() || buckys_is_forum_admin($category['categoryID']) || buckys_is_forum_moderator($category['categoryID'])){ ?>
            <a href="/forum/edit_forum.php?id=<?php echo $category['categoryID'] ?>" class="edit-link">(edit)</a>
        <?php } ?>
    </h2>

    <a href="/forum/category.php?id=<?php echo $category['categoryID'] ?>"><img
            src="<?php echo DIR_WS_IMAGE ?>forum/logos/<?php echo $category['image'] ?>" alt="" class="forum-logo"/></a>

    <p class="followers">
        <?php echo number_format($category['followers']) ?> follower<?php echo $category['followers'] > 1 ? "s" : "" ?>
    </p>

    <?php if(($userID = buckys_is_logged_in())){ ?>
        <?php if(BuckysForumFollower::isFollow($category['categoryID'])){ ?>
            <?php if($userID != $category['creatorID']){ ?>
                <a href="/forum/category.php?action=unfollow&id=<?php echo $category['categoryID'] ?>&<?php echo buckys_get_form_token() ?>=1&return=<?php echo base64_encode($_SERVER["REQUEST_URI"]) ?>"
                    class="forum-action-button forum-action-button-inactive" <?php if(buckys_is_admin() || buckys_is_moderator() || buckys_is_forum_admin($category['categoryID']) || buckys_is_forum_moderator($category['categoryID'])){
                    echo ' style="display:none;" ';
                } ?> >unfollow</a>
            <?php } ?>
        <?php }else{ ?>
            <a href="/forum/category.php?action=follow&id=<?php echo $category['categoryID'] ?>&<?php echo buckys_get_form_token() ?>=1&return=<?php echo base64_encode($_SERVER["REQUEST_URI"]) ?>"
                class="forum-action-button">follow</a>
        <?php } ?>
        <?php if(!BuckysForumModerator::isBlocked($userID, $category['categoryID'])){ ?>
            <a href="/forum/create_topic.php?category=<?php echo $category['categoryID'] ?>"
                class="forum-action-button">create new topic</a>
        <?php } ?>
    <?php } ?>

    <h4>
        About
        <?php if(buckys_is_admin() || buckys_is_moderator() || buckys_is_forum_admin($category['categoryID']) || buckys_is_forum_moderator($category['categoryID'])){ ?>
            <a href="/forum/edit_forum.php?id=<?php echo $category['categoryID'] ?>" class="edit-link">(edit)</a>
        <?php } ?>
    </h4>

    <p class="description">
        <?php echo $category['description']; ?>
    </p>

    <h4>
        Links
        <?php if(buckys_is_admin() || buckys_is_moderator() || buckys_is_forum_admin($category['categoryID']) || buckys_is_forum_moderator($category['categoryID'])){ ?>
            <a href="/forum/edit_forum.php?id=<?php echo $category['categoryID'] ?>" class="edit-link">(edit)</a>
        <?php } ?>
    </h4>

    <p class="links">
        <a href="https://www.thenewboston.com/forum/topic.php?id=5576">Official Forum Rules</a><br/>
        <?php foreach($category['links'] as $l){ ?>
            <a href="<?php echo $l['linkUrl'] ?>"><?php echo $l['linkTitle'] ?></a><br/>
        <?php } ?>
    </p>

    <?php
    $moderators = BuckysForumModerator::getForumModerators($category['categoryID']);
    ?>

    <h4>Moderators</h4>
    <table class="moderators">
        <tr>
            <td style="width: 35px;">
                <a href="/profile.php?user=<?php echo !$category['creatorID'] ? TNB_USER_ID : $category['creatorID'] ?>">
                    <img
                        src="<?php echo BuckysUser::getProfileIcon(!$category['creatorID'] ? TNB_USER_ID : $category['creatorID']) ?>"
                        class="poster-icon"/> </a>
            </td>
            <td>
                <a href="/profile.php?user=<?php echo !$category['creatorID'] ? TNB_USER_ID : $category['creatorID'] ?>">
                    <b><?php echo buckys_get_user_name(!$category['creatorID'] ? TNB_USER_ID : $category['creatorID']) ?></b>
                </a><br/> <span>Administrator</span>
            </td>
        </tr>
        <?php foreach($moderators as $mrow){ ?>
            <tr>
                <td style="width: 35px;">
                    <a href="/profile.php?user=<?php echo !$category['creatorID'] ? TNB_USER_ID : $category['creatorID'] ?>">
                        <?php if(buckys_not_null($mrow['thumbnail'])){ ?>
                            <img
                                src="<?php echo DIR_WS_PHOTO . 'users/' . $mrow['userID'] . '/resized/' . $mrow['thumbnail']; ?>"
                                class="poster-icon"/>
                        <?php }else{ ?>
                            <img src="<?php echo DIR_WS_IMAGE . 'defaultProfileImage.png'; ?>" class="poster-icon"/>
                        <?php } ?>
                    </a>
                </td>
                <td>
                    <a style="float: left;"
                        href="/profile.php?user=<?php echo $mrow['userID'] ?>"><b><?php echo $mrow['applicantName'] ?></b></a>
                    <?php if(buckys_is_admin() || buckys_is_moderator() || buckys_is_forum_admin($category['categoryID'])){ ?>
                        <br/>
                        <a href="/forum/moderator.php?action=delete-moderator&id=<?php echo $category['categoryID'] ?>&moderator=<?php echo $mrow['userID'] ?>&<?php echo buckys_get_form_token() ?>=1"
                            class="remove-moderator">Remove</a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>

    <!-- Moderator -->
    <?php if(($userID = buckys_is_logged_in())){ ?>
        <?php if(!(buckys_is_admin() || buckys_is_moderator() || buckys_is_forum_admin($category['categoryID']) || buckys_is_forum_moderator($category['categoryID']))){ ?>
            <?php if(BuckysForumModerator::isAppliedToModerate($category['categoryID'])){ ?> <!-- already applied to moderate -->
                <a href="javascript: void(0)" class="forum-action-button forum-action-button-inactive"
                    title="Already applied to moderate">apply to moderate</a>
            <?php }else{ ?>
                <a href="/forum/moderator.php?action=apply-moderate&<?php echo buckys_get_form_token() ?>=1&id=<?php echo $category['categoryID'] ?>"
                    class="forum-action-button">apply to moderate</a>
            <?php } ?>
        <?php }else{ ?>
            <a href="/forum/moderator.php?id=<?php echo $category['categoryID'] ?>"
                class="forum-action-button">moderator panel</a>
        <?php } ?>
    <?php } ?>

    <!-- Search Forum -->
    <h4>Search this forum</h4>

    <form name="searchForm" method="get" action="/forum/search_topics.php">
        <input type="text" name="s" value="" class="input" autocomplete="off"/> <input type="hidden" name="id"
            value="<?php echo $category['categoryID'] ?>"/>
    </form>
</div>