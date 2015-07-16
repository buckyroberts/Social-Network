<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section" class="forum-main-section">
    <ul id="forum-nav">
        <li><a href="/forum">Home</a></li>
        <li class="current"><a href="/forum/search_topics.php">Search Topics</a></li>
        <li><a href="/forum/search_forums.php">Browse Forums</a></li>
    </ul>

    <!-- Forum Left Menu Bar -->
    <?php buckys_get_panel('forum_left_panel', isset($category) ? ['category' => $category] : null) ?>

    <section id="forum-content-wrapper">
        <section id="main_content">
            <?php render_result_messages() ?>
            <h2 class="titles">Search Topics</h2>

            <div class="search-wrap">
                <form name="mainsearchform" id="mainsearchform">
                    <input type="text" class="input" name="s" value="<?php echo $keyword ?>" autocomplete="off"/> <input
                        type="submit" class="redButton" value="Search"/>
                    <?php if($categoryID){ ?>
                        <input type="hidden" name="id" value="<?php echo $categoryID ?>"/>
                    <?php } ?>
                </form>
            </div>
            <?php if($results['total'] > 0){ ?>
                <h5><?php echo number_format($results['total']) ?> results</h5>
                <form name="sortForm" method="get" action="/forum/search_topics.php">
                    <?php if($keyword){ ?>
                        <input type="hidden" name="s" value="<?php echo $keyword ?>"/>
                    <?php } ?>
                    <?php if($categoryID){ ?>
                        <input type="hidden" name="id" value="<?php echo $categoryID ?>"/>
                    <?php } ?>
                    <div id="topic-sort">
                        <select name="orderby" class="select right" onchange="document.sortForm.submit();">
                            <option
                                value="best-match" <?php echo $orderBy == 'best-match' ? 'selected="selected"' : '' ?>>Best Match
                            </option>
                            <option
                                value="recent" <?php echo $orderBy == 'recent' ? 'selected="selected"' : '' ?>>Most Recent
                            </option>
                            <option
                                value="rating" <?php echo $orderBy == 'rating' ? 'selected="selected"' : '' ?>>Rating
                            </option>
                            <option
                                value="replies" <?php echo $orderBy == 'replies' ? 'selected="selected"' : '' ?>>Number of Replies
                            </option>
                        </select>
                    </div>
                </form>
                <table cellpadding="0" cellspacing="0" class="forumlist">
                    <tfoot>
                    <tr>
                        <td colspan="3"><?php echo $pagination->renderPaginate('/forum/search_topics.php?s=' . $keyword . '&orderby=' . $orderBy . '&', $results['total']) ?></td>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($results['topics'] as $row){ ?>
                    <tr>
                        <td <?php echo !BuckysForumTopic::isVoted($row['topicID']) ? 'class="post-votes"' : ('class="post-votes voted votedStatus1" title="' . MSG_ALREADY_CASTED_A_VOTE . '"') ?>>
                            <a href="#" class="thumb-up" data-type='topic' data-id="<?php echo $row['topicID'] ?>"
                                data-hashed="<?php echo buckys_encrypt_id($row['topicID']) ?>">
                                <?php
                                if($row['votes'] > 0){
                                    echo '+';
                                }
                                echo $row['votes'];
                                ?>
                            </a>
                        </td>
                        <td class="icon-column">
                            <a style="float: left;" href="/profile.php?user=<?php echo $row['creatorID'] ?>">
                                <?php if(buckys_not_null($row['creatorThumbnail'])){ ?>
                                    <img
                                        src="<?php echo DIR_WS_PHOTO . 'users/' . $row['creatorID'] . '/resized/' . $row['creatorThumbnail']; ?>"
                                        class="poster-icon"/>
                                <?php }else{ ?>
                                    <img src="<?php echo DIR_WS_IMAGE . 'defaultProfileImage.png'; ?>"
                                        class="poster-icon"/>
                                <?php } ?>
                            </a>
                        </td>
                        <td style="width:100%;" class="post-content">
                            <a href="/forum/topic.php?id=<?php echo $row['topicID'] ?>"
                                class="post-title"><?php echo $row['topicTitle'] ?></a> <br/> <a
                                href="/profile.php?user=<?php echo $row['creatorID'] ?>"
                                class="poster-name"><?php echo $row['creatorName'] ?></a> &gt;&gt; <a
                                href="/forum/category.php?id=<?php echo $row['categoryID'] ?>"
                                class="category-name"><?php echo $row['categoryName'] ?></a> <br/>

                            <a href="/forum/topic.php?id=<?php echo $row['topicID'] ?>"
                                class="postdate"><?php echo buckys_format_date($row['lastReplyDate']); ?></a>
                            &middot;
                            <a href="/forum/topic.php?id=<?php echo $row['topicID'] ?>"
                                class="post-replies"><?php echo $row['replies'] . ($row['replies'] != 1 ? ' replies' : ' reply') ?></a>

                        </td>
                        <?php } ?>
                    </tbody>
                </table>
            <?php }else{ ?>
                <p>Nothing to see here</p>
            <?php } ?>
        </section>
        <!-- Forum Right Panel -->
        <section id="forum-right-bar">
            <?php
            if(isset($category))
                buckys_get_panel('forum_right_panel', ['category' => $category]);else
                buckys_get_panel('forum_ad_panel');
            ?>
        </section>
    </section>

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
                    link.parent().find('.loading-wrapper').hide();
                }
            })
            return false;
        })
    })
</script>