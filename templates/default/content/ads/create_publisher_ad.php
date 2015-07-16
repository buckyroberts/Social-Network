<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <section id="main_content">
        <?php render_result_messages(); ?>
        <div id="create-publish-ad-contr">
            <h2 class="titles">Create a Publisher Ad</h2>

            <form id="publisherAdForm" action="" class="edit-ad-form" method="post">
                <div class="row">
                    <label>Ad Size:</label> <select class="select" name="size" id="size" style="margin-left: 10px">
                        <?php foreach($adSizes as $s): ?>
                            <option value="<?php echo $s['id'] ?>"
                                data-width="<?php echo $s['width'] ?>"
                                data-height="<?php echo $s['height'] ?>"
                                ads="<?php echo $s['ads'] ?>"
                                custom_css="<?php echo $s['class'] ?>"
                                type="<?php echo $s['type'] ?>"
                                ><?php echo $s['size'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php $s['class'] = 'small-rectangle'; //sets the initial preview to the first item in the list ?>
                </div>
                <div class="row">
                    <label>Name of Ad:</label> <span class="inputholder" style="margin-left: 10px"><input type="text"
                            class="input" name="name" id="name" autocomplete="off" value=""/></span>

                    <div class="clear"></div>
                </div>

                <div class="row">
                    <label>Border: </label> <span class="desc">#&nbsp;</span>

                    <div class="colorpickerholder-wrap">
                        <input class="colorpicker-input input" id="border-color" name="border-color" value="006699"/>

                        <div class="colorselect"></div>
                        <div class="colorpickerholder"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row">
                    <label>Background: </label> <span class="desc">#&nbsp;</span>

                    <div class="colorpickerholder-wrap">
                        <input class="colorpicker-input input" id="bg-color" name="bg-color" value="FFFFFF"/>

                        <div class="colorselect"></div>
                        <div class="colorpickerholder"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row">
                    <label>Title: </label> <span class="desc">#&nbsp;</span>

                    <div class="colorpickerholder-wrap">
                        <input class="colorpicker-input input" id="title-color" name="title-color" value="006699"/>

                        <div class="colorselect"></div>
                        <div class="colorpickerholder"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row">
                    <label>Description: </label> <span class="desc">#&nbsp;</span>

                    <div class="colorpickerholder-wrap">
                        <input class="colorpicker-input input" id="description-color" name="description-color"
                            value="999999"/>

                        <div class="colorselect"></div>
                        <div class="colorpickerholder"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row">
                    <label>URL: </label> <span class="desc">#&nbsp;</span>

                    <div class="colorpickerholder-wrap">
                        <input class="colorpicker-input input" id="url-color" name="url-color" value="CC0000"/>

                        <div class="colorselect"></div>
                        <div class="colorpickerholder"></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="btn-row">
                    <input type="submit" value="Create" class="redButton" style="margin-left: 10px"/>
                </div>
                <?php render_form_token(); ?>
                <?php render_loading_wrapper(); ?>
                <input type="hidden" name="type" value="Text"/> <input type="hidden" name="action"
                    value="create-publisher-ad"/> <br/>
            </form>
            <div class="clear"></div>
        </div>

        <div>
            <h2 class="titles">Preview</h2>

            <div class="buckysroom-ad-banner" style="margin-top:10px;">
                <table cellpadding="0" cellspacing="0"
                    style="width: <?php echo $adSizes[0]['width'] ?>px; height: <?php echo $adSizes[0]['height'] ?>px;">
                    <tr>
                        <td valign="middle">
                            <div class="buckysroom-ad <?php echo $s['class'] ?>">
                                <p class="bsroom-ad-title">Buy New Laptops</p>

                                <p class="bsroom-ad-desc">Buy laptops, desktops, iPads and more for low prices!</p>
                                <a href="#" class="bsroom-ad-link">www.amazon.com/laptops</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
</section>
