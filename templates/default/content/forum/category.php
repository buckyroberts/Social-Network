<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section" class="forum-main-section">
    <ul id="forum-nav">
        <li class="current"><a href="/forum">Home</a></li>
        <li><a href="/forum/search_topics.php">Search Topics</a></li>
        <li><a href="/forum/search_forums.php">Browse Forums</a></li>
    </ul>

    <!-- Forum Left Menu Bar -->
    <?php buckys_get_panel('forum_left_panel', ['category' => $category]) ?>

    <section id="forum-content-wrapper">

        <div id="bread-crumbs">
            <a href="/forum">Home</a> &gt; <a href="/forum/category.php?id=<?php echo $category['categoryID'] ?>"
                class="bread-crumbs"><?php echo $category['categoryName'] ?></a>
        </div>

        <section id="main_content">
            <!--            <div id="breadcrumbs">
                <a href="/forum">Forum Home</a>
                <?php foreach($hierarchical as $cr){ ?>
                    &gt;
                    <a href="/forum/<?php echo $cr['parentID'] == 0 ? 'index.php' : 'category.php' ?>?id=<?php echo $cr['categoryID'] ?>"><?php echo $cr['categoryName'] ?></a>
                <?php } ?>
            </div>-->
            <?php render_result_messages() ?>
            <h2 class="titles left">
                <?php echo $category['categoryName'] ?>
                <?php if($pagination->total_page > 1){ ?>
                    - Page <?php echo $pagination->getCurrentPage() ?>
                <?php } ?>
            </h2>

            <form method="get" action="/forum/category.php" name="sortForm">
                <select name="orderby" id="topic-sort" class="right" onchange="document.sortForm.submit()">
                    <option
                        value="recent" <?php echo $orderby == 'recent' ? 'selected="selected"' : "" ?>>Recently Activity
                    </option>
                    <option value="rating" <?php echo $orderby == 'rating' ? 'selected="selected"' : "" ?>>Rating
                    </option>
                    <option
                        value="replies" <?php echo $orderby == 'replies' ? 'selected="selected"' : "" ?>>Number of Replies
                    </option>
                </select> <input type="hidden" name="id" value="<?php echo $categoryID ?>"/>
            </form>
            <br/>
            <table cellpadding="0" cellspacing="0" class="forumlist">
                <?php if(count($topics) > 0){ ?>
                    <tfoot>
                    <tr>
                        <td colspan="3"><?php echo $pagination->renderPaginate('/forum/category.php?id=' . $categoryID . '&orderby=' . $orderby . '&', count($topics)) ?></td>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($topics as $row){ ?>
                    <tr>
                        <td class="post-votes <?php echo !$row['voteID'] ? '' : ('voted votedStatus' . $row['voteStatus']) ?>" <?php echo !$row['voteID'] ? '' : 'title="' . MSG_ALREADY_CASTED_A_VOTE . '"' ?>>
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
                                class="post-title"><?php echo $row['topicTitle'] ?></a><br/> <a
                                href="/profile.php?user=<?php echo $row['creatorID'] ?>"
                                class="poster-name"><?php echo $row['creatorName'] ?></a> &gt;&gt; <a
                                href="/forum/category.php?id=<?php echo $row['categoryID'] ?>"
                                class="category-name"><?php echo $row['categoryName'] ?></a> <br/> <a
                                href="/forum/topic.php?id=<?php echo $row['topicID'] ?>"
                                class="postdate"><?php echo buckys_format_date($row['lastReplyDate']); ?></a>
                            &middot;
                            <a href="/forum/topic.php?id=<?php echo $row['topicID'] ?>"
                                class="post-replies"><?php echo $row['replies'] . ($row['replies'] != 1 ? ' replies' : ' reply') ?></a>
                        </td>
                        <?php } ?>
                    </tbody>
                <?php }else{ ?>
                    <tbody>
                    <tr>
                        <td colspan="3" style="padding-left:10px;">Nothing to see here</td>
                    </tr>
                    </tbody>
                <?php } ?>
            </table>
        </section>
        <!-- Forum Right Panel -->
        <section id="forum-right-bar">
            <?php buckys_get_panel('forum_right_panel', ['category' => $category]); ?>
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