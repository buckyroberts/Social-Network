<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}

if(isset($view['action_type']) && $view['action_type'] == 'create'){
    $view['page_title'] = 'Post a Reply';
    $view['action_url'] = '/forum/post_reply.php?id=' . $topic['topicID'];
    $view['action'] = 'post-reply';
}else if(isset($view['action_type']) && $view['action_type'] == 'edit'){
    $view['page_title'] = 'Edit Post Reply';
    $view['action_url'] = '/forum/post_reply.php?id=' . $topic['topicID'];
    $view['action'] = 'edit-post-reply';
}else{
    $view['action_type'] = null;
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
        <section id="main_content">
            <?php render_result_messages() ?>
            <h2 class="titles"><?php echo $view['page_title']; ?></h2>

            <form name="postreplyform" id="postreplyform" action="<?php echo $view['action_url']; ?>" method="post"
                style="margin-top:10px;">
                <input type="hidden" name="action" value="<?php echo $view['action']; ?>"/> <input type="hidden"
                    name="topicID" value="<?php echo $topic['topicID'] ?>"/>
                <?php if($view['action_type'] == 'edit'): ?>
                    <input type="hidden" name="replyID" value="<?php echo $view['replyID']; ?>"/>
                <?php endif; ?>

                <table cellpadding="0" cellspacing="0" class="forumentry">
                    <tr>
                        <td class="label">Topic:</td>
                        <td><?php echo $topic['topicTitle'] ?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <textarea cols="20" id="reply-content" name="content" rows="12"
                                class="textarea"><?php if(isset($view['replyData']))
                                    echo $view['replyData']['replyContent']; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <input type="submit" value="Post" class="redButton"
                                style="margin-left:1px;margin-top:2px;"/>
                        </td>
                    </tr>
                </table>
            </form>
        </section>
        <!-- Forum Right Panel -->
        <section id="forum-right-bar">
            <?php buckys_get_panel('forum_right_panel', ['category' => $category]); ?>
        </section>
    </section>
</section>
<script type="text/javascript">
    jQuery(document).ready(function (){
        jQuery('#reply-content').sceditor({
            plugins: 'bbcode',
            emoticonsRoot: '/images/',
            height: 500,
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