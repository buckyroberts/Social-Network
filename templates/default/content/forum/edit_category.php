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
    <?php buckys_get_panel('forum_left_panel') ?>

    <section id="forum-content-wrapper">
        <section id="main_content">
            <div class="breadcrumb"></div>
            <?php render_result_messages() ?>
            <h2 class="titles"><?php echo isset($category) ? 'Edit Forum' : 'Create a New Forum Category'; ?></h2>
            <?php
            if($TNB_GLOBALS['user']['reputation'] < 10){
                echo '<br />Sorry Hoss, but you need 10 points before you can create a new forum category.<br /><br />If you are trying to create a new topic, first select a category from the left hand side. From there, click on the "create new topic" button on the right.';
            }
            ?>
            <form name="editforumform" id="editforumform" action="/forum/add_forum.php" method="post"
                style="margin-top:10px;<?php if($TNB_GLOBALS['user']['reputation'] < 10){
                    echo 'display:none;';
                } ?>">
                <?php
                render_form_token();
                ?>
                <input type="hidden" name="action" value="save"/>
                <?php if(isset($category)) : ?>
                    <input type="hidden" name="id" value="<?php echo $category['categoryID'] ?>"/>
                <?php endif; ?>

                <table cellpadding="0" cellspacing="0" class="forumentry">
                    <tr>
                        <td class="label">Name:</td>
                        <td>
                            <input type="text" id="category-name" name="category-name" maxlength="500"
                                value="<?php if(isset($category))
                                    echo $category['categoryName']; ?>" autocomplete="off" class="input"/></td>

                    </tr>
                    <tr>
                        <td class="label">Image:</td>
                        <td>
                            <?php if(isset($category)){ ?>
                                <div id="preview-photo-row">
                                    <img src="/images/forum/logos/<?php echo $category['image'] ?>"/> <a href="#"
                                        class="cancel-photo"></a>
                                </div>
                                <input type="hidden" name="categoryFile" value="<?php echo $category['image'] ?>"/>
                            <?php }else{ ?>
                                <div id="preview-photo-row" style="display: none;">
                                    <div class="has-cropped-img"></div>
                                    <a href="#" class="cancel-photo"></a>
                                </div>
                            <?php } ?>
                            <div
                                class="file-row <?php echo isset($category) && !empty($category['image']) ? 'hide' : '' ?>">
                                <input type="button" id="file_upload" name="file_upload" type="file"/>
                            </div>
                            <div id="jcrop-row-wrapper">
                                <a href="#" class="cancel-photo"></a>

                                <div id="jcrop-row"></div>
                            </div>
                            <a href="javascript: void(0)" id="done-crop-btn"
                                class="forum-action-button">Done cropping</a>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td class="grey-tip">
                            use square images for best results
                        </td>
                    </tr>
                    <tr>
                        <td class="label">About:</td>
                        <td>
                            <textarea cols="20" id="description" name="description" rows="12"
                                class="textarea"><?php if(isset($category))
                                    echo $category['description']; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Links:</td>
                        <td>
                            <?php if(isset($category) && is_array($category['links'])){ ?>
                                <?php foreach($category['links'] AS $lrow){ ?>
                                    <div class="link-row">
                                        <input type="text" name="link_title[]" id="link_title[]"
                                            value="<?php echo $lrow['linkTitle'] ?>" class="input link_title" size="30"
                                            placeholder="Link Title"/> <input type="text" name="link_url[]"
                                            id="link_url[]" value="<?php echo $lrow['linkUrl'] ?>"
                                            class="input link_url" placeholder="URL"/> <a href="javascript: void(0)"
                                            class="remove-link">Remove</a>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <a href="javasscript: void(0)" class="add-link">Add New</a>
                        </td>
                    </tr>
                    <?php if(!isset($category)){ ?>
                        <tr>
                            <td class="label">&nbsp; </td>
                            <td class="grey-tip">
                                After creating a new forum category, you will be responsible for moderating all topics and replies, appointing new forum moderators, and managing new followers. Failure to moderate your forum regularly may result in the deletion of the forum and/or the ability to create new forums in the future.
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <input type="submit" value="Submit" id="save-btn" class="forum-action-button"
                                style="margin-left:1px;margin-top:2px;"/>
                        </td>
                    </tr>
                </table>
                <?php render_loading_wrapper(); ?>
                <input type="hidden" name="x1" id="x1" value="0"/> <input type="hidden" name="x2" id="x2" value="0"/>
                <input type="hidden" name="y1" id="y1" value="0"/> <input type="hidden" name="y2" id="y2" value="0"/>
                <input type="hidden" name="width" id="width" value="0"/>
            </form>
        </section>
        <!-- Forum Right Panel -->
        <section id="forum-right-bar">
            <?php buckys_get_panel('forum_ad_panel'); ?>
        </section>
    </section>
</section>
<script type="text/javascript">
    jQuery(document).ready(function (){
        jQuery('#editforumform').on('click', '.add-link', function (){
            jQuery(this).before('<div class="link-row">' + '<input type="text" name="link_title[]" id="link_title[]" value="" class="input link_title" size="30" placeholder="Link Title" />' + '<input type="text" name="link_url[]" id="link_url[]" value="" class="input link_url" placeholder="URL" />' + '<a href="javascript: void(0)" class="remove-link">Remove</a>' + '</div>');
            return false;
        })
        jQuery('#editforumform').on('click', '.remove-link', function (){
            jQuery(this).parent().fadeOut('fast', function (){
                jQuery(this).remove();
            })
        });
        jQuery('#editforumform').submit(function (){
            var isValid = true;
            if(jQuery.trim(jQuery('#editforumform #category-name').val()) == ''){
                jQuery('#editforumform #category-name').addClass('input-error');
                isValid = false;
            }
            if(jQuery.trim(jQuery('#editforumform #description').val()) == ''){
                jQuery('#editforumform #description').addClass('input-error');
                isValid = false;
            }

            if(!isValid){
                showMessage(jQuery(this), 'Please complete the fields in red.', true);
                return false;
            }

            if(jQuery(this).find('input[name="categoryFile"]').size() < 1){
                showMessage(jQuery(this), 'Please select an image for forum.', true);
                return false;
            }

            return isValid;
        })

    })
</script>