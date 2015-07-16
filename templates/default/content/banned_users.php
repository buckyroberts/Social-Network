<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>

    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <h2 class="titles">
                Banned Users
            </h2>

            <form method="post" id="bannedusersform" action="/banned_users.php" style="padding-top:0px;">
                <?php render_result_messages() ?>
                <?php
                if(count($users) == 0){
                    ?>
                    <div class="tr noborder">
                        Nothing to see here.
                    </div>
                <?php
                }else{
                    ?>
                    <?php $pagination->renderPaginate('/banned_users.php?', count($users)); ?>
                    <div class="table">
                        <div class="thead">
                            <div class="td td-chk"><input type="checkbox" id="chk_all"/></div>
                            <div class="td td-user">User</div>
                            <div class="td td-content">Banned Date</div>
                            <div class="td td-action">Actions</div>
                            <div class="td td-reporter">Banned By</div>
                            <div class="clear"></div>
                        </div>
                        <?php
                        foreach($users as $i => $row){
                            ?>
                            <div class="tr <?php echo $i == count($users) - 1 ? 'noborder' : ''?>">
                                <div class="td td-chk">
                                    <input type="checkbox" id="chk<?php echo $row['bannedID']?>" name="bannedID[]"
                                        value="<?php echo $row['bannedID']?>"/>
                                </div>
                                <div class="td td-user">
                                    <a href="/profile.php?user=<?php echo $row['bannedUserID']?>"> <img
                                            src="<?php echo BuckysUser::getProfileIcon(['thumbnail' => $row['ownerThumb'], 'userID' => $row['ownerID']])?>"/>

                                        <?php
                                        echo $row['bannedUserName'];
                                        ?>
                                    </a>
                                </div>
                                <div class="td td-content">
                                    <?php echo buckys_format_date($row['bannedDate']); ?>
                                    &nbsp;
                                </div>
                                <div class="td td-action">
                                    <a href="/banned_users.php?action=unban&bannedID=<?php echo $row['bannedID']?>">Unban User</a><br/>
                                    <a href="/banned_users.php?action=delete&bannedID=<?php echo $row['bannedID']?>">Delete User</a><br/>
                                </div>
                                <div class="td td-reporter">
                                    <a href="/profile.php?user=<?php echo $row['moderatorID']?>"> <img
                                            src="<?php echo BuckysUser::getProfileIcon(['thumbnail' => $row['moderatorThumb'], 'userID' => $row['moderatorID']])?>"/>
                                        <?php
                                        echo $row['moderatorName'];
                                        ?>
                                    </a>
                                </div>
                                <div class="clear"></div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="btn-row">
                        <input type="button" class="redButton" value="Delete Users" id="delete-users"/> <input
                            type="button" class="redButton" value="Unban Users" id="unban-users"/>
                    </div>
                    <input type="hidden" name="action" value=""/>
                    <input type="hidden" name="type" value="<?php echo $reportType?>"/>
                <?php } ?>
            </form>
        </section>
    </section>
</section>