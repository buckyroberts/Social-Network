<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}


$forumTopicData = null;

if($view['action_type'] == 'create'){
    $view['action_url'] = '/forum/create_topic.php';
    $view['action_name'] = 'create-topic';
    $view['page_title'] = 'Start a New Topic';
}else if($view['action_type'] == 'edit'){
    $view['action_url'] = '/forum/edit_topic.php';
    $forumTopicData = $view['forum_data'];
    $view['page_title'] = 'Edit Topic';
    $view['action_name'] = 'edit-topic';
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
            <div class="breadcrumb"></div>
            <?php render_result_messages() ?>
            <h2 class="titles"><?php echo $view['page_title']; ?></h2>

            <form name="newtopicform" id="newtopicform" action="<?php echo $view['action_url']; ?>" method="post"
                style="margin-top:10px;">
                <input type="hidden" name="action" value="<?php echo $view['action_name']; ?>"/> <input type="hidden"
                    name="category" id="category" value="<?php echo $category['categoryID'] ?>"/>
                <?php if($forumTopicData) : ?>
                    <input type="hidden" name="id" value="<?php echo $forumTopicData['topicID'] ?>"/>
                <?php endif; ?>

                <table cellpadding="0" cellspacing="0" class="forumentry">
                    <tr>
                        <td class="label">Title:</td>
                        <td><input type="text" id="title" name="title" maxlength="500" value="<?php if($forumTopicData)
                                echo $forumTopicData['topicTitle']; ?>" autocomplete="off" class="input"
                                placeholder="Title of topic should be clear and descriptive..."/>
                        </td>

                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <textarea cols="20" id="topic-content" name="content" rows="12"
                                class="textarea"><?php if($forumTopicData)
                                    echo $forumTopicData['topicContent']; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <input type="submit" value="Submit" class="forum-action-button"
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
        jQuery('#topic-content').sceditor({
            plugins: 'bbcode',
            emoticonsRoot: '/images/',
            height: 300,
            width: 710,
            enablePasteFiltering: true,
            style: "/css/sceditor/jquery.sceditor.default.css"
        });

        var topicEditor = jQuery('#topic-content').sceditor('instance');


        jQuery('#newtopicform').submit(function (){
            var isValid = true;
            if(jQuery.trim(jQuery('#newtopicform #title').val()) == ''){
                jQuery('#newtopicform #title').addClass('input-error');
                isValid = false;
            }
            if(jQuery.trim(jQuery('#newtopicform #category').val()) == ''){
                jQuery('#newtopicform #category').addClass('select-error');
                isValid = false;
            }

            if(!isValid){
                showMessage(jQuery(this), 'All fields are required.', true);
                return false;
            }

            text = topicEditor.getWysiwygEditorValue();

            if(text == ''){
                showMessage(jQuery(this), 'All fields are required.', true)
                topicEditor.focus();
                isValid = false;
            }

            return isValid;
        })

    })
</script>