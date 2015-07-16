<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>
    <section id="right_side" class="create-page-section">
        <h2 class="titles">Create a New Page</h2>

        <form id="newPageForm" method="post" name="newPageForm" class="page-form" action="/page_add.php">
            <!-- First Name -->
            <div class="row">
                <label for="pageName">Name:</label> <span class="inputholder"><input type="text" id="pageName"
                        name="pageName" class="input" value=""/></span>

                <div class="clear"></div>
            </div>

            <div class="row">
                <label for="pageLogo">Image:</label>

                <div class="file-row">
                    <input type="file" name="pageLogo" id="pageLogo"/>
                    <small>use square images for best results</small>
                </div>

                <div id="jcrop-row-wrapper">
                    <a href="#" class="cancel-photo"></a>

                    <div id="jcrop-row"></div>
                </div>
                <div class="clear"></div>

                <div id="jcrop-row-wrapper">
                    <a href="#" class="cancel-photo"></a>

                    <div id="jcrop-row"></div>
                </div>
            </div>

            <div class="clear"></div>
            <div class="row">
                <label for="pageDescrition">About:</label>
                    <span class="textareaholder">
                        <textarea cols="10" rows="5" class="textarea" name="pageDescription"
                            id="pageDescription"></textarea>
                    </span>

                <div class="clear"></div>
            </div>

            <div class="row">
                <label>Link:</label>

                <div class="links">
                    <a href="javascript: void(0)" id="add-new-link" class="add-new-row" data-label="Link" data-id="link"
                        data-new-row="new-link-row"><b>Add New</b></a>
                </div>
                <div class="clear"></div>
            </div>
            <!-- Submit Button -->
            <div class="btn-row">
                <span class="inputholder"><input type="submit" id="submit" name="submit" class="action-button"
                        value="Submit"/></span>

                <div class="clear"></div>
            </div>
            <input type="hidden" name="x1" id="x1" value="0"/> <input type="hidden" name="x2" id="x2" value="0"/> <input
                type="hidden" name="y1" id="y1" value="0"/> <input type="hidden" name="y2" id="y2" value="0"/> <input
                type="hidden" name="width" id="width" value="0"/> <input type="hidden" name="userID" id="userID"
                value="<?php echo $userID ?>"/> <input type="hidden" name="action" value="create"/>
            <?php render_form_token(); ?>
            <?php render_loading_wrapper(); ?>
        </form>

    </section>
</section>
