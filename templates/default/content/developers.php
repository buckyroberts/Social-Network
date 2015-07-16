<?php
/**
 * Index Page Layout
 */

if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <section id="main_content">
        <?php render_result_messages(); ?>
        <h2 class="titles">Developers</h2>
        <br/>

        <table style="border:1px solid #CCCCCC; width:30%;">
            <tr style="color:#999999;">
                <td>Version</td>
                <td>Size</td>
                <td style="text-align:right;">Download</td>
            </tr>
            <tr>
                <td>1.0</td>
                <td>19.4 MB</td>
                <td style="text-align:right;">Coming Soon!</td>
            </tr>
        </table>

        <br/><br/>

        <div class="clear"></div>
    </section>
</section>