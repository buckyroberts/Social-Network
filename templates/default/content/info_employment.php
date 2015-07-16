<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>
    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <h2 class="titles">Employment History</h2>
            <!-- Employment History -->
            <div id="sub_section" class="noborder" style="border-bottom:none;">
                <form id="employmentform" method="post" class="user-info" onsubmit="return false">
                    <?php foreach($userData as $idx => $row){ ?>
                        <div class="row">
                            <label>Employer:</label>
                        <span class="inputholder">
                            <input type="text" name="employer[]" maxlength="60" class="input"
                                value="<?php echo $row['employer']; ?>"/>
                            <?php echo render_year_selectbox('from[]', $row['start']); ?>
                            to
                            <?php echo render_year_selectbox('to[]', $row['end']); ?>
                        </span>
                            <?php render_visibility_options('employment_visibility' . $idx, $row['visibility']); ?>
                            <a href="#" class="remove-row" data-label="Employer" data-id="employment">Remove</a>

                            <div class="clear"></div>
                        </div>
                    <?php } ?>
                    <div class="btn-row">
                        <a href="javascript: void(0)" id="add-new-employment" class="add-new-row" data-label="Employer"
                            data-id="employment" data-new-row="new-employment-row">Add New</a> <span
                            class="inputholder"><input type="submit" id="submit" name="submit" class="redButton"
                                value="Submit"/></span>

                        <div class="clear"></div>
                    </div>
                    <input type="hidden" name="userID" id="userID" value="<?php echo $userID ?>"/>
                    <?php render_loading_wrapper(); ?>
                </form>
                <div style="display: none;" id="new-employment-row">
                    <label>School Name:</label>
                        <span class="inputholder">
                            <input type="text" name="employer[]" maxlength="30" class="input" value=""/>
                            <?php echo render_year_selectbox('from[]'); ?>
                            to
                            <?php echo render_year_selectbox('to[]'); ?>
                        </span>
                    <?php render_visibility_options('employment_visibility', 1); ?>
                    <a href="#" class="remove-row" data-label="Employer" data-id="employment">Remove</a>

                    <div class="clear"></div>
                </div>
            </div>
        </section>
    </section>
</section>
