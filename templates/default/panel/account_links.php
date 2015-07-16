<?php
/**
 * User Account Links
 */
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
//Getting Current User ID if $userID is not set  
if(!isset($userID)){
    $userID = buckys_is_logged_in();
}
//If the user is logged in, show account links
if($userID){
    ?>
    <aside id="main_aside">
        <span class="titles">My Account</span>

        <a href="/account.php" class="accountSubLinks" style="margin-top:10px;">Stream</a><br/>

        <h6>Messages</h6>
        <?php
        $newMsgNum = BuckysMessage::getNumOfNewMessages($userID);
        ?>
        <a href="/messages_inbox.php"
            class="accountSubLinks<?php echo $newMsgNum > 0 ? 'Bold' : ''?>">Inbox<?php echo $newMsgNum > 0 ? ' (' . $newMsgNum . ')' : ''?></a><br/>
        <a href="/messages_sent.php" class="accountSubLinks">Sent</a> <br/> <a href="/messages_trash.php"
            class="accountSubLinks">Trash</a> <br/> <a href="/messages_compose.php" class="accountSubLinks">Compose</a>
        <br/>

        <h6>Pictures</h6>
        <a href="/photo_add.php" class="accountSubLinks">Add Photo</a> <br/> <a href="/photo_albums.php"
            class="accountSubLinks">Manage Albums</a> <br/> <a href="/photo_manage.php"
            class="accountSubLinks">Manage Photos</a> <br/> <a href="/photos.php?user=<?php echo $userID?>"
            class="accountSubLinks">View All</a> <br/>

        <h6>Information</h6>
        <a href="/info_basic.php" class="accountSubLinks">Basic Info</a> <br/> <a href="/info_contact.php"
            class="accountSubLinks">Contact</a> <br/> <a href="/info_education.php"
            class="accountSubLinks">Education</a> <br/> <a href="/info_employment.php"
            class="accountSubLinks">Employment</a> <br/> <a href="/info_links.php" class="accountSubLinks">Links</a>
        <br/>

        <h6>Friends</h6>
        <a href="/myfriends.php" class="accountSubLinks">All</a> <br/>
        <?php
        $newFriendRequestsNum = BuckysFriend::getNewFriendRequests($userID);
        ?>
        <a href="/myfriends.php?type=requested"
            class="accountSubLinks<?php echo $newFriendRequestsNum > 0 ? 'Bold' : ''?>">Requests<?php echo $newFriendRequestsNum > 0 ? ' (' . $newFriendRequestsNum . ')' : ''?></a>
        <br/> <a href="/myfriends.php?type=pending" class="accountSubLinks">Pending</a> <br/>

        <!-- <a href="/moderator.php" class="accountLinks">Vote</a> -->

        <?php

        ?>
        <h6>Page Manager</h6>
        <!-- <a href="/follows.php?user=<?php echo $userID?>" class="accountLinks">Groups</a> -->
        <a href="/page_add.php" class="accountSubLinks">Create New Page</a><br/>
        <?php
        //Get my created pages link
        $pageIns = new BuckysPage();
        $pageList = $pageIns->getPagesByUserId($userID);

        if(count($pageList) > 0){
            foreach($pageList as $pageD){
                echo sprintf('<a href="/page.php?pid=%d" class="accountSubLinks">%s</a><br/>', $pageD['pageID'], $pageD['title']);
            }
        }


        ?>

        <!-- Control Panel-->
        <?php if(buckys_check_user_acl(USER_ACL_MODERATOR)){ ?>
            <?php
            $reportedItems = BuckysReport::getReportedObjectCount();
            $pendingAds = BuckysAds::getPendingAdsCount();
            ?>
            <h6>Moderator Panel</h6>
            <a href="/reported.php"
                class="accountSubLinks<?php echo $reportedItems > 0 ? 'Bold' : '' ?>">Reported Items<?php echo $reportedItems > 0 ? ' (' . $reportedItems . ')' : '' ?></a>
            <br/>
            <a href="/manage_ads.php"
                class="accountSubLinks<?php echo $pendingAds > 0 ? 'Bold' : '' ?>">Advertisements<?php echo $pendingAds > 0 ? ' (' . $pendingAds . ')' : '' ?></a>
        <?php } ?>

        <?php if(buckys_check_user_acl(USER_ACL_ADMINISTRATOR)){ ?>
            <h6>Control Panel</h6>
            <?php
            $bannedUsers = BuckysBanUser::getBannedUsersCount();
            ?>
            <a href="/banned_users.php"
                class="accountSubLinks<?php echo $bannedUsers > 0 ? 'Bold' : '' ?>">Banned Users<?php echo $bannedUsers > 0 ? ' (' . $bannedUsers . ')' : '' ?></a>
            <br/>
        <?php } ?>

        <h6>Settings</h6>
        <!-- <a href="/wallet.php" class="accountSubLinks">Bitcoin</a> <br/> -->        <!-- <a href="/credits.php" class="accountSubLinks">Credits</a> <br/> -->
        <a href="/change_password.php" class="accountSubLinks">Change Password</a> <br/> <a href="/delete_account.php"
            class="accountSubLinks">Delete Account</a> <br/> <a href="/faq.php" class="accountSubLinks">FAQ's</a> <br/>
        <a href="/notify.php" class="accountSubLinks">Notification Settings</a> <br/>
        <!-- <a href="/shipping_info.php" class="accountSubLinks">Shipping Information</a> <br/> -->

    </aside>
<?php
}
?>