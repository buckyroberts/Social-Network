<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>
    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <h2 class="titles">Basic Information</h2>

            <form id="basicform" method="post" name="infoForm" class="user-info" onsubmit="return false">
                <!-- First Name -->
                <div class="row">
                    <label for="firstName">First Name:</label> <span class="inputholder"><input type="text"
                            id="firstName" name="firstName" class="input"
                            value="<?php echo $userData['firstName']; ?>"/></span>

                    <div class="clear"></div>
                </div>

                <!-- Last Name -->
                <div class="row">
                    <label for="lastName">Last Name:</label> <span class="inputholder"><input type="text" id="lastName"
                            name="lastName" class="input" value="<?php echo $userData['lastName']; ?>"/></span>

                    <div class="clear"></div>
                </div>

                <!-- Gender -->
                <div class="row">
                    <label>Gender:</label>
                        <span class="selectholder">
                            <?php render_gender_selectbox($userData['gender']) ?>
                        </span>
                    <?php render_visibility_options('gender_visibility', $userData['gender_visibility']); ?>
                    <div class="clear"></div>
                </div>

                <!-- Birthday -->
                <div class="row">
                    <label>Birthday:</label>
                        <span class="selectholder">
                            <?php render_birthdate_selectboxes($userData['birthdate']); ?>
                        </span>
                    <?php render_visibility_options('birthdate_visibility', $userData['birthdate_visibility']); ?>
                    <div class="clear"></div>
                </div>

                <!-- Relationship Status -->
                <div class="row">
                    <label for="relationship_status">Relationship&nbsp;Status:</label>
                        <span class="selectholder">
                            <?php echo render_relationship_status_selectbox($userData['relationship_status']) ?>
                        </span>
                    <?php render_visibility_options('relationship_status_visibility', $userData['relationship_status_visibility']); ?>
                    <div class="clear"></div>
                </div>

                <!-- Religion -->
                <div class="row">
                    <label for="religion">Religion:</label> <span class="inputholder"><input type="text" id="religion"
                            name="religion" class="input" value="<?php echo $userData['religion']; ?>"/></span>
                    <?php render_visibility_options('religion_visibility', $userData['religion_visibility']); ?>
                    <div class="clear"></div>
                </div>

                <!-- Political Views -->
                <div class="row">
                    <label for="political_views">Political&nbsp;Views:</label> <span class="inputholder"><input
                            type="text" id="political_views" name="political_views" class="input"
                            value="<?php echo $userData['political_views']; ?>"/></span>
                    <?php render_visibility_options('political_views_visibility', $userData['political_views_visibility']); ?>
                    <div class="clear"></div>
                </div>

                <!-- Birthplace -->
                <div class="row">
                    <label for="birthplace">Birthplace:</label> <span class="inputholder"><input type="text"
                            id="birthplace" name="birthplace" class="input"
                            value="<?php echo $userData['birthplace']; ?>"/></span>
                    <?php render_visibility_options('birthplace_visibility', $userData['birthplace_visibility']); ?>
                    <div class="clear"></div>
                </div>

                <!-- Current City -->
                <div class="row">
                    <label for="current_city">Current&nbsp;City:</label> <span class="inputholder"><input type="text"
                            id="current_city" name="current_city" class="input"
                            value="<?php echo $userData['current_city']; ?>"/></span>
                    <?php render_visibility_options('current_city_visibility', $userData['current_city_visibility']); ?>
                    <div class="clear"></div>
                </div>

                <!-- Timezone -->
                <div class="row timezone-row">
                    <label for="relationship_status">Timezone:</label>
                        <span class="selectholder">
                            <?php echo render_timezone_selectbox($userData['timezone']) ?>
                        </span>
                    <?php //render_visibility_options('timezone_visibility', $userData['timezone_visibility']); ?>
                    <div class="clear"></div>
                </div>

                <!-- Submit Button -->
                <div class="btn-row">
                    <span class="inputholder"><input type="submit" id="submit" name="submit" class="redButton"
                            value="Submit"/></span>

                    <div class="clear"></div>
                </div>

                <input type="hidden" name="userID" id="userID" value="<?php echo $userData['userID'] ?>"/>
                <?php render_loading_wrapper(); ?>
            </form>

        </section>
    </section>
</section>
