<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>
    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <h2 class="titles">Links</h2>
            <!-- User Links -->
            <div id="sub_section" class="noborder" style="border-bottom:none;">
                <form id="linksform" method="post" class="user-info" onsubmit="return false">
                    <?php foreach($userData as $idx => $row){ ?>
                        <div class="row">
                            <label>Link:</label>
                        <span class="inputholder">
                            <input type="text" name="title[]" placeholder="Title" maxlength="60"
                                class="input link-title" value="<?php echo $row['title']; ?>"/>
                            <input type="text" name="url[]" placeholder="URL" class="input link-url"
                                value="<?php echo $row['url']; ?>"/>
                        </span>
                            <?php render_visibility_options('links_visibility' . $idx, $row['visibility']); ?>
                            <a href="#" class="remove-row" data-label="Link" data-id="link">Remove</a>

                            <div class="clear"></div>
                        </div>
                    <?php } ?>
                    <div class="btn-row">
                        <a href="javascript: void(0)" id="add-new-link" class="add-new-row" data-label="Link"
                            data-id="link" data-new-row="new-link-row">Add New</a> <span class="inputholder"><input
                                type="submit" id="submit" name="submit" class="redButton" value="Submit"/></span>

                        <div class="clear"></div>
                    </div>
                    <input type="hidden" name="userID" id="userID" value="<?php echo $userID ?>"/>
                    <?php render_loading_wrapper(); ?>
                </form>
                <div style="display: none;" id="new-link-row">
                    <label>Link:</label>
                        <span class="inputholder">
                            <input type="text" placeholder="Title" name="title[]" maxlength="60"
                                class="input link-title" value=""/>
                            <input type="text" placeholder="URL" name="url[]" class="input link-url" value=""/>
                        </span>
                    <?php render_visibility_options('links_visibility' . (isset($idx) ? $idx : 1), 1); ?>
                    <a href="#" class="remove-row" data-label="Link" data-id="link">Remove</a>

                    <div class="clear"></div>
                </div>
            </div>
        </section>
    </section>
</section>
