<?php
/**
 * Footer Menu for logged users
 */
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}

$notificationLimit = 5; //only 5 requests.

if($userID = buckys_is_logged_in()){
    $userBasicInfo = BuckysUser::getUserBasicInfo($userID);
    ?>
    <div id="fixed_footer">
        <ul id="footer_menu"><!-- Begin Footer Menu -->

            <div class="centered-navigation">
                <li class="home_button" style="border-left:1px solid rgba(0,0,0,0.4); height:auto;"><a href="/"></a>
                </li>
                <!-- This Item is an Image Home-->

                <li class="has-submenu"><a href="/account.php" class="p_menu">My Account</a><!-- 1 Columns Menu Item -->
                    <div class="submenu">
                        <a href="/account.php" class="redLinks">Stream</a> <br/> <a href="/messages_inbox.php"
                            class="redLinks">Messages</a>
                        <?php
                        $newMsgNum = BuckysMessage::getNumOfNewMessages($userID);
                        ?>
                        <a href="/messages_inbox.php"
                            class="<?php echo $newMsgNum > 0 ? 'highlighted' : ''?>">Inbox<?php echo $newMsgNum > 0 ? ' (' . $newMsgNum . ')' : ''?></a>
                        <a href="/messages_sent.php">Sent</a> <a href="/messages_trash.php">Trash</a> <a
                            href="/messages_compose.php">Compose</a> <br/> <a href="/photo_manage.php"
                            class="redLinks">Pictures</a> <a href="/photo_add.php">Add Photo</a> <a
                            href="/photo_albums.php">Manage Albums</a> <a href="/photo_manage.php">Manage Photos</a> <a
                            href="/photos.php?user=<?php echo $userID?>">View All</a> <br/> <a href="/info_basic.php"
                            class="redLinks">Information</a> <a href="/info_basic.php">Basic Info</a> <a
                            href="/info_contact.php">Contact</a> <a href="/info_education.php">Education</a> <a
                            href="/info_employment.php">Employment</a> <a href="/info_links.php">Links</a> <br/>
                        <?php
                        $newFriendRequestsNum = BuckysFriend::getNewFriendRequests($userID);
                        ?>
                        <a href="/myfriends.php" class="redLinks">Friends</a> <a href="/myfriends.php">All</a> <a
                            href="/myfriends.php?type=requested"
                            class="<?php echo $newFriendRequestsNum > 0 ? 'highlighted' : ''?>">Requests<?php echo $newFriendRequestsNum > 0 ? ' (' . $newFriendRequestsNum . ')' : ''?></a>
                        <a href="/myfriends.php?type=pending">Pending</a> <br/> <a href="/notify.php"
                            class="redLinks">Settings</a>
                        <!-- <a href="/wallet.php">Bitcoin</a> -->                        <!-- <a href="/credits.php">Credits</a> -->
                        <a href="/change_password.php">Change Password</a> <a
                            href="/delete_account.php">Delete Account</a> <a href="/faq.php">FAQ's</a> <a
                            href="/notify.php">Notification Settings</a>
                        <!-- <a href="/shipping_info.php">Shipping Information</a> -->
                    </div>
                </li>

                <?php
                $newMessages = BuckysPrivateMessenger::getNewMessageCount($userID);
                ?>
                <li id="private_messenger_li" class="has-submenu">
                    <a href="#" class="privateMessengerButtonText p_menu">Chat</a><?php if($newMessages > 0){ ?>
                        <span id="total-new-msg-count" class="new-msg-count"><?php echo $newMessages ?></span><?php } ?>
                    <span id="messenger_minimized">Messenger <a href="#"></a></span></li>

                <!-- Forum -->
                <li>
                    <a href="/forum" class="p_menu">Forum</a>
                </li>
                <!-- End Forum -->

                <!-- Popular -->
                <li class="has-submenu"><a href="/tops.php?type=image&period=this-month" class="p_menu">Popular</a><!-- 1 Columns Menu Item -->
                    <div class="submenu">
                        <a href="/tops.php?type=image&period=this-month" class="redLinks">Most Popular</a> <a
                            href="/tops.php?type=text&period=this-month">Posts</a> <a
                            href="/tops.php?type=image&period=this-month">Images</a> <a
                            href="/tops.php?type=video&period=this-month">Videos</a>
                    </div>
                </li>
                <!-- End Popular -->

                <li class="has-submenu"><a href="/profile.php?user=<?php echo $userID?>" class="p_menu">Profile</a>

                    <div class="submenu" id="profile-submenu">
                        <a href="/profile.php?user=<?php echo $userID?>"><img class="viewProfileImg"
                                src="<?php echo BuckysUser::getProfileIcon($userBasicInfo) ?>"></a>
						<span>
							<a class="highlighted"
                                href="/profile.php?user=<?php echo $userID?>"><?php echo $userBasicInfo['firstName'] . " " . $userBasicInfo['lastName']?></a>
							<br/>
							<a href="/profile.php?user=<?php echo $userID?>">view profile...</a>
						</span>
                    </div>
                </li>

                <!-- Search (1 Columns Menu Item) -->
                <li>
                    <a href="/search.php?type=0&sort=reputation" class="p_menu">Search</a>
                </li>
                <!-- End Search -->

                <!-- Videos -->
                <li class="has-submenu" id="lft-last-li"><a href="/videos.php" class="p_menu">Videos & Tutorials</a>

                    <div class="submenu">
                        <a href="/videos.php" class="redLinks">Subjects</a> <a href="/videos_beauty.php">Beauty</a> <a
                            href="/videos_business.php">Business</a> <a href="/videos.php">Computer Science</a> <a
                            href="/videos_food.php">Cooking</a> <a href="/videos_humanities.php">Humanities</a> <a
                            href="/videos_math.php">Math</a> <a href="/videos_science.php">Science</a> <a
                            href="/videos_social.php">Social Sciences</a>
                    </div>
                </li>
                <!-- End Videos -->
            </div>

            <li class="right">
                <a href="/logout.php" class="p_menu">Log Out</a>
            </li>

            <!-- notifications Icons -->
            <li class="rightIcons">
                <?php
                $newMsgFlag = 1;
                $notifications = BuckysActivity::getNumberOfNotifications($userID, $newMsgFlag);
                if($notifications == 0){
                    $newMsgFlag = 0;
                    $notifications = BuckysActivity::getNumberOfNotifications($userID, $newMsgFlag);
                }

                if($notifications > 0){
                    $notificationsList = BuckysActivity::getNotifications($userID, $notificationLimit, $newMsgFlag);
                    ?>
                    <span class="notificationLinks <?php if($newMsgFlag == 0)
                        echo 'inactive-notify';?>" id="my-notifications-icon">
                        <span class="notification-count"><?php if($newMsgFlag != 0)
                                echo '+' . $notifications;else echo 0; ?></span>
                        <span class="dropDownNotificationList">
                            <?php render_footer_link_content('my', $notificationsList); ?>
                        </span>
                    </span>
                <?php
                }else{
                    echo '<span class="notificationLinks inactive-notify no-data" id="my-notifications-icon"><span class="notification-count">0</span><span class="dropDownNotificationList"><span class="nodata">Nothing to see here</span></span></span>';
                }

                ?>

                <!-- Start Friend Request Notification -->
                <?php
                $objFriend = new BuckysFriend();
                $friendRequestsNum = $objFriend->getNewFriendRequests($userID);
                if($friendRequestsNum > 0){
                    $friendRequests = $objFriend->getReceivedRequests($userID);
                    ?>
                    <span class="notificationLinks" id="friend-notifications-icon">
                        <span class="dropDownNotificationList">                    
                            <?php render_footer_link_content('friend', $friendRequests); ?>
                        </span>
                    </span>
                <?php
                }else{
                    echo '<span class="notificationLinks inactive-notify no-data" id="friend-notifications-icon"><span class="dropDownNotificationList"><a href="/myfriends.php?type=requested" class="nodata">No one wants to be your friend</a></span></span>';
                }
                ?>
                <!-- End Friend Request Notification -->

                <!-- Start Forum Notifications -->
                <?php
                $objForumNotify = new BuckysForumNotification();

                $newMsgFlag = 1;
                $newNoticeCount = $objForumNotify->getNumOfNewNotifications($userID, $newMsgFlag);
                if($newNoticeCount == 0){
                    $newMsgFlag = 0;
                    $newNoticeCount = $objForumNotify->getNumOfNewNotifications($userID, $newMsgFlag);
                }
                if($newNoticeCount > 0){
                    $newNotices = $objForumNotify->getNewNotifications($userID, $newMsgFlag, $notificationLimit);
                    ?>
                    <span class="notificationLinks <?php if($newMsgFlag == 0)
                        echo 'inactive-notify';?>" id="forum-notifications-icon">
                        <span class="dropDownNotificationList">                    
                            <?php render_footer_link_content('forum', $newNotices); ?>
                        </span>
                    </span>
                <?php
                }else{
                    echo '<span class="notificationLinks inactive-notify no-data" id="forum-notifications-icon"><span class="dropDownNotificationList"><span class="nodata">Nothing to see here</span></span></span>';
                }
                ?>
                <!-- End Forum Notifications -->

                <?php
                $newMsgNum = BuckysMessage::getNumOfNewMessages($userID);
                if($newMsgNum && $newMsgNum > 0){
                    $newMails = BuckysMessage::getReceivedMessages($userID, 1, 'unread');
                    ?>
                    <span class="notificationLinks <?php echo $newMsgNum > 0 ? "new-mails" : "no-mails" ?>"
                        id="emails-notifications-icon">
                        <span class="dropDownNotificationList">
                            <?php render_footer_link_content('mail', $newMails); ?>
                        </span>
                    </span>
                <?php
                }else{
                    echo '<span class="notificationLinks no-mails inactive-notify no-data" id="emails-notifications-icon"><span class="dropDownNotificationList"><a href="/messages_inbox.php" class="nodata">No new messages</a></span></span>';
                }
                ?>

                <?php
                $tradeNotiIns = new BuckysTradeNotification();

                $newMsgFlag = 1;
                $newMsgNum = $tradeNotiIns->getNumOfNewMessages($userID, null, $newMsgFlag);
                if($newMsgNum == 0){
                    $newMsgFlag = 0;
                    $newMsgNum = $tradeNotiIns->getNumOfNewMessages($userID, null, $newMsgFlag);
                }

                if($newMsgNum && $newMsgNum > 0){
                    $newTradeNotify = $tradeNotiIns->getReceivedMessages($userID, null, $newMsgFlag, $notificationLimit);

                    ?>
                    <span class="notificationLinks <?php if($newMsgFlag == 0)
                        echo 'inactive-notify';?>" id="trade-notify-icon">
                        <span class="dropDownNotificationList">
                            <?php render_footer_link_content('trade', $newTradeNotify); ?>
                        </span>
                    </span>
                <?php
                }else{
                    echo '<span class="notificationLinks inactive-notify no-data" id="trade-notify-icon"><span class="dropDownNotificationList"><span class="nodata">Nothing to see here</span></span></span>';
                }
                ?>

                <?php
                $shopNotiIns = new BuckysShopNotification();

                $newMsgFlag = 1;
                $newMsgNum = $shopNotiIns->getNumOfNewMessages($userID, null, $newMsgFlag);
                if($newMsgNum == 0){
                    $newMsgFlag = 0;
                    $newMsgNum = $shopNotiIns->getNumOfNewMessages($userID, null, $newMsgFlag);
                }

                if($newMsgNum && $newMsgNum > 0){
                    $newShopNotify = $shopNotiIns->getReceivedMessages($userID, null, $newMsgFlag, $notificationLimit);

                    ?>
                    <span class="notificationLinks <?php if($newMsgFlag == 0)
                        echo 'inactive-notify';?>" id="shop-notify-icon">
                        <span class="dropDownNotificationList">
                            <?php render_footer_link_content('shop', $newShopNotify); ?>
                        </span>
                    </span>
                <?php
                }else{
                    echo '<span class="notificationLinks inactive-notify no-data" id="shop-notify-icon"><span class="dropDownNotificationList"><span class="nodata">Nothing to see here</span></span></span>';
                }
                ?>

            </li>

        </ul>
    </div>
    <div id="messenger_settings_wrapper">
        <div id="messenger_settings_box">
            <div class="box_nav_row">
                <a href="#" class="close_box_link">&#935;</a>
            </div>
            <form name="messenger_settings_form" id="messenger_settings_form" method="post" action="/">
                <h3>Who can message me:</h3>
                <label for="messenger_privacy_all"><input type="radio" name="messenger_privacy"
                        id="messenger_privacy_all"
                        <?php if ($userBasicInfo['messenger_privacy'] == 'all'){ ?>checked="checked"<?php }?>
                        value="all"/> Everyone except the people on my blocklist</label>

                <div id="block-lists">
                    <label>Block List:</label> <span class="btn-row" id="blocked-users"><input type="text"
                            id="block-username" class="input"/><input type="submit" value="Add"
                            class="redButton"/></span>
                    <?php
                    $blockList = BuckysPrivateMessenger::getBlockLists($userID);
                    ?>
                    <ul id="block_list">
                        <?php foreach($blockList as $row){ ?>
                            <li data-id="<?php echo $row['userID'] ?>">
                                <img src="<?php echo BuckysUser::getProfileIcon($row) ?> "/> <?php echo $row['name'] ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <a href="#" class="remove-from-blocklist">Remove</a> <label for="messenger_privacy_buddy"><input
                        type="radio" name="messenger_privacy" id="messenger_privacy_buddy"
                        <?php if ($userBasicInfo['messenger_privacy'] == 'buddy'){ ?>checked="checked"<?php }?>
                        value="buddy"/> Only the people on my buddy list</label>
                <?php render_loading_wrapper(); ?>
            </form>
        </div>
    </div>
<?php
}else{
    ?>
    <div id="fixed_footer">
        <div class="centered-navigation">
            <ul id="footer_menu"><!-- Begin Footer Menu -->
                <li class="home_button" style="border-left:1px solid rgba(0,0,0,0.4); height:auto;"><a href="/"></a>
                </li>
                <li><a href="/register.php" class="p_menu">Create an Account</a>
                <li><a href="/forum" class="p_menu">Forum</a>
                <li class="has-submenu"><a href="/tops.php?type=image&period=this-month" class="p_menu">Popular</a><!-- 1 Columns Menu Item -->
                    <div class="submenu">
                        <a href="/tops.php?type=image&period=this-month" class="redLinks">Most Popular</a> <a
                            href="/tops.php?type=text&period=this-month">Posts</a> <a
                            href="/tops.php?type=image&period=this-month">Images</a> <a
                            href="/tops.php?type=video&period=this-month">Videos</a>
                    </div>
                </li>
                <li><a href="/search.php?type=0&sort=reputation" class="p_menu">Search</a></li>
                <!-- Videos -->
                <li class="has-submenu" id="lft-last-li"><a href="/videos.php" class="p_menu">Videos & Tutorials</a>

                    <div class="submenu">
                        <a href="/videos.php" class="redLinks">Subjects</a> <a href="/videos_beauty.php">Beauty</a> <a
                            href="/videos_business.php">Business</a> <a href="/videos.php">Computer Science</a> <a
                            href="/videos_food.php">Cooking</a> <a href="/videos_humanities.php">Humanities</a> <a
                            href="/videos_math.php">Math</a> <a href="/videos_science.php">Science</a> <a
                            href="/videos_social.php">Social Sciences</a>
                    </div>
                </li>
                <!-- End Videos -->
                <li id="rightAlign">
                    <?php if($TNB_GLOBALS['content'] != 'register' && $TNB_GLOBALS['headerType'] != 'forum'){ ?>
                        <form class="topLoginForm" method="post" action="/login.php">
                            <input type="text" name="email" maxlength="60" class="inputHeader"
                                placeholder="email"/> &nbsp; <input type="password" name="password" maxlength="20"
                                class="inputHeader" placeholder="password" autocomplete="off"/> &nbsp; <input
                                type="submit" name="login_submit" class="redButton"
                                style="font-family:Roboto,Arial; padding: 1px 5px;" value="Log In"/>
                        </form>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>
<?php
}
?>

