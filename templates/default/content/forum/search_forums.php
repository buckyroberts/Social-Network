<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section" class="forum-main-section">
    <ul id="forum-nav">
        <li><a href="/forum">Home</a></li>
        <li><a href="/forum/search_topics.php">Search Topics</a></li>
        <li class="current"><a href="/forum/search_forums.php">Browse Forums</a></li>
    </ul>

    <!-- Forum Left Menu Bar -->
    <?php buckys_get_panel('forum_left_panel', isset($category) ? ['category' => $category] : null) ?>

    <section id="forum-content-wrapper">
        <section id="main_content">
            <?php render_result_messages() ?>
            <h2 class="titles">Search Forums</h2>

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
                <form name="sortForm" method="get" action="/forum/search_forums.php">
                    <?php if($keyword){ ?>
                        <input type="hidden" name="s" value="<?php echo $keyword ?>"/>
                    <?php } ?>
                    <?php if($categoryID){ ?>
                        <input type="hidden" name="id" value="<?php echo $categoryID ?>"/>
                    <?php } ?>
                    <div id="topic-sort">
                        <select name="orderby" class="select right" onchange="document.sortForm.submit();">
                            <option
                                value="popular" <?php echo $orderBy == 'recent' ? 'selected="selected"' : '' ?>>Most Popular
                            </option>
                            <option
                                value="recent" <?php echo $orderBy == 'recent' ? 'selected="selected"' : '' ?>>Most Recent
                            </option>
                        </select>
                    </div>
                </form>
                <table cellpadding="0" cellspacing="0" class="forumlist">
                    <tfoot>
                    <tr>
                        <td colspan="3"><?php echo $pagination->renderPaginate('/forum/search_forums.php?s=' . $keyword . '&orderby=' . $orderBy . '&', $results['total']) ?></td>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($results['categories'] as $row){ ?>
                    <tr>
                        <td class="icon-column">
                            <a style="float:left;" href="/forum/category.php?id=<?php echo $row['categoryID'] ?>"> <img
                                    src="<?php echo DIR_WS_IMAGE . '/forum/logos/' . $row['image']; ?>"
                                    class="poster-icon" style="margin-left:11px; width:60px;"/> </a>
                        </td>
                        <td style="width:100%;" class="category-content">
                            <a href="/forum/category.php?id=<?php echo $row['categoryID'] ?>"
                                class="category-title"><?php echo $row['categoryName'] ?></a><br/>

                            <p><?php echo $row['description'] ?></p>
                            <span
                                class="post-replies"><?php echo number_format($row['followers']) . ($row['followers'] > 1 ? ' followers' : ' follower') ?></span>
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