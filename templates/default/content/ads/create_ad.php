<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <section id="main_content">
        <?php render_result_messages(); ?>
        <div id="create-ad-contr">
            <h2 class="titles">Create a New Ad</h2>

            <div id="ad-form-nav">
                <a href="javascript: void(0)" <?php echo $adType == 'Text' ? 'class="selected"' : '' ?>
                    onclick="showTextAdForm()">Text Ad</a>
                &middot;
                <a href="javascript: void(0)" <?php echo $adType == 'Image' ? 'class="selected"' : '' ?>
                    onclick="showImageAdForm()">Image Ad</a>
            </div>
            <form id="textAdForm" action="" class="edit-ad-form"
                method="post"  <?php echo $adType == 'Image' ? 'style="display: none"' : '' ?>>
                <div class="row">
                    <label>Title: </label> <span class="inputholder"><input type="text" class="input" name="title"
                            id="title" autocomplete="off" value="" maxlength="35"/></span>

                    <div class="clear"></div>
                </div>
                <div class="row">
                    <label>Description: </label> <span class="inputholder"><input type="text" class="input"
                            name="description" id="description" autocomplete="off" value="" maxlength="70"/></span>

                    <div class="clear"></div>
                </div>
                <div class="row">
                    <label>URL: </label> <span class="inputholder"><input type="text" class="input" name="url" id="url"
                            autocomplete="off" value=""/></span>

                    <div class="clear"></div>
                </div>
                <div class="row">
                    <label>Display URL: </label> <span class="inputholder"><input type="text" class="input"
                            name="display_url" id="display_url" autocomplete="off" value="" maxlength="35"/></span>

                    <div class="clear"></div>
                </div>
                <div class="row">
                    <label>Name of Ad: </label> <span class="inputholder"><input type="text" class="input" name="name"
                            id="name" autocomplete="off" value="" maxlength="50"/></span>

                    <div class="clear"></div>
                </div>
                <div class="row">
                    <label>Budget: </label> <span class="inputholder"><input type="text" class="input" name="budget"
                            id="budget" autocomplete="off" value="0"/></span> <span class="desc">&nbsp;BTC</span>

                    <div class="clear"></div>
                </div>
                <div class="row impressions-row">
                    <label>Impressions: </label> <span class="desc">0</span>

                    <div class="clear"></div>
                </div>
                <div class="btn-row">
                    <input type="submit" value="Create" class="redButton"/>
                </div>
                <?php render_form_token(); ?>
                <?php render_loading_wrapper(); ?>
                <input type="hidden" name="type" value="Text"/> <input type="hidden" name="action" value="create-ad"/>
            </form>
            <form id="imageAdForm" action="" class="edit-ad-form"
                method="post" <?php echo $adType == 'Text' ? 'style="display: none"' : '' ?>>
                <div class="row">
                    <label>Ad Size:</label> <select class="select" name="size" id="size">
                        <?php foreach($adSizes as $s): ?>
                            <option value="<?php echo $s['id'] ?>"><?php echo $s['size'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="row">
                    <label>Name of Ad: </label> <span class="inputholder"><input type="text" class="input" name="name"
                            id="name" autocomplete="off" value=""/></span>

                    <div class="clear"></div>
                </div>
                <div class="row">
                    <label>URL: </label> <span class="inputholder"><input type="text" class="input" name="url" id="url"
                            autocomplete="off" value=""/></span>

                    <div class="clear"></div>
                </div>
                <div class="row">
                    <label>Image:</label>
                    <span class="file-row">
                        <input type="file" name="image" id="ad_image"/>
                    </span>

                    <div class="clear"></div>
                </div>
                <div class="row">
                    <label>Budget: </label> <span class="inputholder"><input type="text" class="input" name="budget"
                            id="budget" autocomplete="off" value=""/></span> <span class="desc">&nbsp;BTC</span>

                    <div class="clear"></div>
                </div>
                <div class="row impressions-row">
                    <label>Impressions: </label> <span class="desc">0</span>

                    <div class="clear"></div>
                </div>
                <div class="btn-row">
                    <input type="submit" value="Create" class="redButton"/>
                </div>
                <?php render_form_token(); ?>
                <?php render_loading_wrapper(); ?>
                <input type="hidden" name="type" value="Image"/> <input type="hidden" name="file_name" id="file_name"
                    value=""/> <input type="hidden" name="action" value="create-ad"/>
            </form>
        </div>
        <div id="preview-ad-contr">
            <h2 class="titles">Preview</h2>

            <div class="text-ad" style="display: none;"></div>
            <div class="img-ad" style="display: none;"></div>
        </div>
        <div class="clear"></div>
    </section>
</section>
