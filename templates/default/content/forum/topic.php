<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}

//Check Permissions
if(buckys_is_admin() || buckys_is_moderator() || buckys_is_forum_admin($topic['categoryID']) || buckys_is_forum_moderator($topic['categoryID'])){
    $can_block_user = true;
    $currentUserID = buckys_is_logged_in();
}else{
    $can_block_user = false;
    $currentUserID = null;
}

?>

<!-- Go to www.addthis.com/dashboard to customize your tools 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53c94706485ac73e"></script>
-->

<section id="main_section" class="forum-main-section">
    <ul id="forum-nav">
        <li class="current"><a href="/forum">Home</a></li>
        <li><a href="/forum/search_topics.php">Search Topics</a></li>
        <li><a href="/forum/search_forums.php">Browse Forums</a></li>
    </ul>

    <!-- Forum Left Menu Bar -->
    <?php buckys_get_panel('forum_left_panel', ['category' => $category]) ?>

    <!-- style="height:initial;" -->
    <section id="forum-content-wrapper">

        <div id="bread-crumbs">
            <a href="/forum">Home</a> &gt; <a href="/forum/category.php?id=<?php echo $category['categoryID'] ?>"
                class="bread-crumbs"><?php echo $category['categoryName'] ?></a> &gt;
            <?php echo $topic['topicTitle'] ?>
        </div>

        <section id="main_content">
            <?php render_result_messages() ?>

            <!-- Top Header -->
            <?php if($page == 1){ ?>
                <h2 class="titles" style="float:left;"><?php echo $topic['topicTitle'] ?></h2>
                <div class="addthis_sharing_toolbox"></div>
                <br/>
            <?php } ?>

            <table cellpadding="0" cellspacing="0" class="postentry forumlist"  <?php if($page != 1)
                echo ' style="border-top:none;margin-top:0px; " '; ?>>
                <tbody>

                <!-- Main Topic -->
                <?php if($page == 1){ ?>
                    <tr>
                        <td class="post-votes <?php echo !$topic['voteID'] ? '' : ('voted votedStatus' . $topic['voteStatus']) ?>" <?php echo !$topic['voteID'] ? '' : 'title="' . MSG_ALREADY_CASTED_A_VOTE . '"' ?>
                            style="width:75px; background: #fff;">
                            <a href="#" class="thumb-up" style="margin-left:10px; margin-top:10px;" data-type='topic'
                                data-id="<?php echo $topic['topicID'] ?>"
                                data-hashed="<?php echo buckys_encrypt_id($topic['topicID']) ?>">
                                <?php
                                if($topic['votes'] > 0){
                                    echo '+';
                                }
                                echo $topic['votes'];
                                ?>
                            </a>
                        </td>
                        <td class="icon-column" style="background:#fff;">
                            <a href='/profile.php?user=<?php echo $topic['creatorID'] ?>'> <img
                                    class="profileIcon topic-icon"
                                    src="<?php echo BuckysUser::getProfileIcon(['thumbnail' => $topic['thumbnail'], 'userID' => $topic['creatorID']]) ?>"
                                    class="poster-icon"/> </a>
                        </td>
                        <td class="post-content" style="width:100%;background:#fff;">
                            <a style="font-weight:bold;"
                                href='/profile.php?user=<?php echo $topic['creatorID'] ?>'><?php echo $topic['creatorName']; ?></a>
                            &middot;
                            <span class="post-date"><?php echo buckys_format_date($topic['createdDate']); ?></span>

                            <div class="clear"></div>
                            <div class="buckys-bbcode-content" style="padding-top:5px;">
                                <?php
                                $bbcodeParser = new BuckysBBCodeNodeContainerDocument();
                                $t_content = utf8_decode($topic['topicContent']);
                                echo $bbcodeParser->parse($t_content)->detect_links()->detect_emails()->detect_emoticons()->get_html();
                                ?>
                            </div>
                            <span class="actions-span">
                                
                                <?php if($can_block_user && $currentUserID != $topic['creatorID']){ ?>
                                    <a href="/forum/moderator.php?action=block-user&id=<?php echo $topic['categoryID'] ?>&userID=<?php echo $topic['creatorID'] ?>&<?php echo buckys_get_form_token() ?>=1&return=<?php echo base64_encode($_SERVER['REQUEST_URI']) ?>"
                                        class="block-link"
                                        onclick="return confirm('Are you sure that you want to block this user?')">Block User</a> &middot;
                                <?php } ?>


                                <?php if($currentUserID == $topic['creatorID'] || $userID == $topic['creatorID']){ ?>
                                    <a href="/forum/edit_topic.php?id=<?php echo $topic['topicID'] ?>"
                                        class="block-link">Edit</a> &middot;
                                    <a href="/forum/topic.php?action=delete&id=<?php echo $topic['topicID'] ?>"
                                        class="block-link">Delete</a>
                                <?php } ?>


                                <?php if(buckys_is_logged_in() && $userID != $topic['creatorID']){ ?>
                                    <a href="/report_object.php" data-type="topic"
                                        data-id="<?php echo $topic['topicID'] ?>"
                                        data-idHash="<?php echo buckys_encrypt_id($topic['topicID']) ?>"
                                        class="report-link">
                                        <?php echo !$topic['reportID'] ? 'Report' : 'You reported this.' ?>
                                    </a>
                                <?php } ?>
								
                            </span>
                        </td>
                    </tr>
                <?php } ?>

                <!-- Replies -->
                <?php if(count($replies) > 0){ ?>
                    <tr>
                        <td colspan="3" class="replies-header"
                            <?php if($page != 1){
                                echo ' style="padding-top:0px;" ';
                            }else{
                                echo ' style="background: white;" ';
                            } ?> >
                            <h2 class="titles left" <?php if($page != 1)
                                echo ' style="margin-top:0px;" '; ?> >Replies - Page <?php echo $page ?></h2>

                            <div class="post-sort-nav" style="margin-right:-10px;">
                                <form name="postReplySortForm" action="/forum/topic.php" method="get">
                                    <input type="hidden" name="page" value="<?php echo $page ?>"/> <input type="hidden"
                                        name="id" value="<?php echo $topic['topicID'] ?>"/> <label>Sort by:</label>
                                    <select name="orderby" class="select"
                                        onchange="document.postReplySortForm.submit()">
                                        <option
                                            value="oldest" <?php echo $orderBy == 'oldest' ? 'selected="selected"' : '' ?>>Oldest
                                        </option>
                                        <option
                                            value="newest" <?php echo $orderBy == 'newest' ? 'selected="selected"' : '' ?>>Newest
                                        </option>
                                        <option
                                            value="highrated" <?php echo $orderBy == 'highrated' ? 'selected="selected"' : '' ?>>Highest Rated
                                        </option>
                                    </select>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <?php
                    foreach($replies as $row){
                        ?>
                        <tr class="reply-tr">
                            <td class="post-votes <?php echo !$row['voteID'] ? '' : ('voted votedStatus' . $row['voteStatus']) ?>" <?php echo !$row['voteID'] ? '' : 'title="' . MSG_ALREADY_CASTED_A_VOTE . '"' ?>
                                style="width:75px;">
                                <!-- <a href="#" class="thumb-up" style="margin-left:10px; margin-top: 10px;" data-type='topic' data-id="<?php echo $row['topicID'] ?>" data-hashed="<?php echo buckys_encrypt_id($row['topicID']) ?>"> -->
                                <a href="#" class="thumb-up" style="margin-left:10px; margin-top: 10px;"
                                    data-type='reply' data-id="<?php echo $row['replyID'] ?>"
                                    data-hashed="<?php echo buckys_encrypt_id($row['replyID']) ?>">
                                    <?php
                                    if($row['votes'] > 0){
                                        echo '+';
                                    }
                                    echo $row['votes'];
                                    ?>
                                </a>
                            </td>
                            <td class="icon-column">
                                <a href='/profile.php?user=<?php echo $row['creatorID'] ?>'> <img
                                        class="profileIcon topic-icon"
                                        src="<?php echo BuckysUser::getProfileIcon(['thumbnail' => $row['thumbnail'], 'userID' => $row['creatorID']]) ?>"
                                        class="poster-icon"/> </a>
                            </td>
                            <td class="post-content" style="width:100%">
                                <a style="font-weight:bold;"
                                    href='/profile.php?user=<?php echo $row['creatorID'] ?>'><?php echo $row['creatorName']; ?></a>
                                &middot;
                                <span class="post-date"><?php echo buckys_format_date($row['createdDate']); ?></span>

                                <div class="clear"></div>
                                <div class="buckys-bbcode-content" style="padding-top:5px;">
                                    <?php
                                    $bbcodeParser = new BuckysBBCodeNodeContainerDocument();
                                    $t_content = utf8_decode($row['replyContent']);

                                    $html = $bbcodeParser->parse($t_content)->detect_links()->detect_emails()->detect_emoticons()->get_html();
                                    echo $html;
                                    ?>
                                </div>
                            <span class="actions-span">
                                <?php if($can_block_user && $currentUserID != $row['creatorID']){ ?>
                                    <a href="/forum/moderator.php?action=block-user&id=<?php echo $topic['categoryID'] ?>&userID=<?php echo $row['creatorID'] ?>&<?php echo buckys_get_form_token() ?>=1&return=<?php echo base64_encode($_SERVER['REQUEST_URI']) ?>"
                                        class="block-link"
                                        onclick="return confirm('Are you sure that you want to block this user?')">Block User</a>
                                    &middot;
                                <?php } ?>

                                <?php if($currentUserID == $row['creatorID'] || $userID == $row['creatorID']){ ?>
                                    <a href="/forum/post_reply.php?id=<?php echo $row['topicID'] ?>&replyID=<?php echo $row['replyID'] ?>&action=edit"
                                        class="block-link">Edit</a> &middot;
                                    <a href="/forum/post_reply.php?id=<?php echo $row['topicID'] ?>&replyID=<?php echo $row['replyID'] ?>&action=delete"
                                        class="block-link">Delete</a>
                                <?php } ?>


                                <?php if(buckys_is_logged_in() && $userID != $row['creatorID']){ ?>
                                    <a href="/report_object.php" data-type="reply"
                                        data-id="<?php echo $row['replyID'] ?>"
                                        data-idHash="<?php echo buckys_encrypt_id($row['replyID']) ?>"
                                        class="report-link">
                                        <?php echo !$row['reportID'] ? 'Report' : 'You reported this.' ?>
                                    </a>
                                <?php } ?>
								
                            </span>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                <?php } ?>

                <!-- Reply form at bottom -->
                <tr class="post-reply-btm">
                    <td colspan="3" class="replies-header" style="background:#fff;">
                        <?php if(buckys_check_user_acl(USER_ACL_REGISTERED) && !BuckysForumModerator::isBlocked($TNB_GLOBALS['user']['userID'], $topic['categoryID'])){ ?>
                            <h2 class="titles left" style="margin-top:6px;">Reply</h2>
                        <?php } ?>
                        <?php
                        if(count($replies) > 0){
                            echo $pagination->renderPaginate('/forum/topic.php?id=' . $topic['topicID'] . '&orderby=' . $orderBy . '&');
                        }
                        ?>
                    </td>
                </tr>
                <?php if(buckys_check_user_acl(USER_ACL_REGISTERED) && !BuckysForumModerator::isBlocked($TNB_GLOBALS['user']['userID'], $topic['categoryID'])){ ?>
                    <tr>
                        <td style="background:#fff;">&nbsp;</td>
                        <td class="icon-column" style="background:#fff;">
                            <a href='/profile.php?user=<?php echo $TNB_GLOBALS['user']['userID'] ?>'> <img
                                    class="profileIcon topic-icon"
                                    src="<?php echo BuckysUser::getProfileIcon(['thumbnail' => $TNB_GLOBALS['user']['thumbnail'], 'userID' => $TNB_GLOBALS['user']['userID']]) ?>"
                                    class="poster-icon"/> </a>
                        </td>
                        <td class="post-content" style="width:100%;background:#fff">
                            <form name="postreplyform" id="postreplyform"
                                action="/forum/post_reply.php?id=<?php echo $topic['topicID']; ?>" method="post">
                                <input type="hidden" name="action" value="post-reply"/> <input type="hidden"
                                    name="topicID" value="<?php echo $topic['topicID'] ?>"/> <textarea cols="20"
                                    id="reply-content" name="content" rows="12" class="textarea"></textarea> <br/>
                                <input type="submit" value="Submit" class="forum-action-button"
                                    style="margin-left:1px;margin-top:2px;"/>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </section>
        <!-- Forum Right Panel -->
        <section id="forum-right-bar">
            <?php buckys_get_panel('forum_right_panel', ['category' => $category]); ?>
        </section>
    </section>
    <div class="afs_ads">&nbsp;</div>
    <script>
        (function (){
            var message = "Your AdBlocker is causing problems with this site. Please select the \"Don't run on pages on this domain\" AdBlock option to fix the issues.";

            // Define a function for showing the message (set a timeout of 1.5 seconds to give adblocker a chance to do its thing)
            var tryMessage = function (){
                setTimeout(function (){
                    if(!document.getElementsByClassName) return;
                    var ads = document.getElementsByClassName('afs_ads'), ad = ads[ads.length - 1];

                    if(!ad || ad.innerHTML.length == 0 || ad.clientHeight === 0){
                        alert(message);
                        // window.location.href = '[URL of the donate page. Remove the two slashes at the start of this line to enable.]';
                    }else{
                        ad.style.display = 'none';
                    }

                }, 1500);
            }

            // Attach a listener for page load, then show the message
            if(window.addEventListener){
                window.addEventListener('load', tryMessage, false);
            }else{
                window.attachEvent('onload', tryMessage); //IE
            }
        })();
    </script>

</section>
<script type="text/javascript">
    jQuery(document).ready(function (){
        $('.post-votes a.thumb-up,.post-votes a.thumb-down').click(function (){
            if($(this).parent().hasClass('voted'))
                return false;
            var link = jQuery(this);
            /*link.parent().find('.loading-wrapper').show();*/
            jQuery.ajax({
                url: '/forum/topic.php', data: {
                    'objectID': link.attr('data-id'),
                    'objectIDHash': link.attr('data-hashed'),
                    'objectType': link.attr('data-type'),
                    'action': link.attr('class')
                }, type: 'post', dataType: 'xml', success: function (rsp){
                    if(jQuery(rsp).find('status').text() == 'success'){
                        link.html(jQuery(rsp).find('votes').text());
                        link.parent().addClass('voted votedStatus' + (link.attr('class') == 'thumb-up' ? '1' : '-1'));
                    }else{
                        alert(jQuery(rsp).find('message').text());
                    }
                }, complete: function (){
                    //                    link.parent().find('.loading-wrapper').hide();
                }
            })
            return false;
        })
        jQuery('#reply-content').sceditor({
            plugins: 'bbcode',
            emoticonsRoot: '/images/',
            height: 250,
            width: 706,
            enablePasteFiltering: true,
            style: "/css/sceditor/jquery.sceditor.default.css"
        });

        var postEditor = jQuery('#reply-content').sceditor('instance');

        jQuery('#postreplyform').submit(function (){
            var isValid = true;

            text = postEditor.getWysiwygEditorValue();

            if(text == ''){
                showMessage(jQuery(this), 'Please write something hoss.', true)
                postEditor.focus();
                isValid = false;
            }

            return isValid;
        })

    })
</script>