<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>
    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <h2 class="titles">Contact Information</h2>

            <div id="sub_section">
                <form id="emailform" method="post" class="user-info" onsubmit="return false">
                    <h3 class="sub_section_title">E-mail</h3>
                    <!-- Email -->
                    <div class="row">
                        <label for="email">E-mail:</label> <span class="inputholder"><input type="text" id="email"
                                name="email" disabled="disabled" class="input"
                                value="<?php echo $userData['email']; ?>"/></span>
                        <span class="visibility_options">
                            <label for="email_visibility_public"><input type="radio" name="email_visibility"
                                    id="email_visibility_public"
                                    value="1" <?php echo $userData['email_visibility'] ? 'checked="checked"' : '' ?>
                                    autocomplete="off"> Public</label>
                            <label for="email_visibility_private"><input type="radio" name="email_visibility"
                                    id="email_visibility_private"
                                    value="0" <?php echo !$userData['email_visibility'] ? 'checked="checked"' : '' ?>
                                    autocomplete="off"> Private</label>
                            <label for="email_visibility_not"><input type="radio" name="email_visibility"
                                    id="email_visibility_not"
                                    value="-1" <?php echo $userData['email_visibility'] == -1 ? 'checked="checked"' : '' ?>
                                    autocomplete="off"> Do Not Display</label>
                        </span>

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
            </div>
            <!-- Phone Numbers -->
            <div id="sub_section">
                <form id="phoneform" method="post" class="user-info" onsubmit="return false">
                    <h3 class="sub_section_title">Phone Numbers</h3>
                    <!-- Cell Phone -->
                    <div class="row">
                        <label for="cell_phone">Cell Phone:</label> <span class="inputholder"><input type="text"
                                id="cell_phone" name="cell_phone" class="input"
                                value="<?php echo $userData['cell_phone']; ?>"/></span>
                        <?php render_visibility_options('cell_phone_visibility', $userData['cell_phone_visibility']); ?>
                        <div class="clear"></div>
                    </div>
                    <!-- Home Phone -->
                    <div class="row">
                        <label for="home_phone">Home Phone:</label> <span class="inputholder"><input type="text"
                                id="home_phone" name="home_phone" class="input"
                                value="<?php echo $userData['home_phone']; ?>"/></span>
                        <?php render_visibility_options('home_phone_visibility', $userData['home_phone_visibility']); ?>
                        <div class="clear"></div>
                    </div>
                    <!-- Work Phone -->
                    <div class="row">
                        <label for="work_phone">Work Phone:</label> <span class="inputholder"><input type="text"
                                id="work_phone" name="work_phone" class="input"
                                value="<?php echo $userData['work_phone']; ?>"/></span>
                        <?php render_visibility_options('work_phone_visibility', $userData['work_phone_visibility']); ?>
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
            </div>
            <!-- Messenger Usernames -->
            <div id="sub_section" style="border-bottom: none">
                <form id="messengerform" method="post" class="user-info" onsubmit="return false">
                    <h3 class="sub_section_title">Usernames</h3>
                    <?php foreach($userData['contact'] as $idx => $row){ ?>
                        <div class="row">
                            <label>Username<?php // echo $idx + 1?>:</label>
                        <span class="inputholder">
                            <input type="text" name="user_messenger[]" maxlength="30" class="input"
                                value="<?php echo $row['contact_name']; ?>"/>
                            <?php render_messenger_type_selectbox('user_messenger_type[]', $row['contact_type']) ?>
                        </span>
                            <?php render_visibility_options('user_messenger_visibility' . $idx, $row['visibility']); ?>
                            <a href="#" class="remove-row" data-label="Username" data-id="user_messenger">Remove</a>

                            <div class="clear"></div>
                        </div>
                    <?php } ?>
                    <div class="btn-row">
                        <a href="javascript: void(0)" id="add-new-messenger-account" class="add-new-row"
                            data-label="Username" data-id="user_messenger" data-new-row="new-account-row">Add New</a>
                        <span class="inputholder"><input type="submit" id="submit" name="submit" class="redButton"
                                value="Submit"/></span>

                        <div class="clear"></div>
                    </div>
                    <input type="hidden" name="userID" id="userID" value="<?php echo $userData['userID'] ?>"/>
                    <?php render_loading_wrapper(); ?>
                </form>
                <div style="display: none;" id="new-account-row">
                    <label>Username:</label>
                    <span class="inputholder">
                        <input type="text" name="user_messenger[]" class="input" value="" autocomplete="off"/>
                        <?php render_messenger_type_selectbox('user_messenger_type[]') ?>
                    </span>
                    <?php render_visibility_options('user_messenger_visibility' . count($userData['contact']), 1); ?>
                    <a href="#" class="remove-row" data-label="Username" data-id="user_messenger">Remove</a>

                    <div class="clear"></div>
                </div>
            </div>

        </section>
    </section>
</section>
