<?php
/**
 * Process all actions related with private messenger
 */
require(dirname(__FILE__) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    echo MSG_INVALID_REQUEST;
    die();
}

if(isset($_POST['action'])){
    if($_POST['action'] == 'get-users'){
        $users = BuckysPrivateMessenger::searchNonBlockedUsers($userID, $_POST['term']);
        $result = [];

        foreach($users as $row){
            $result[] = ["id" => $row['userID'], 'label' => $row['fullName'], 'value' => $row['fullName'], 'hash' => buckys_encrypt_id($row['userID'])];
        }

        echo json_encode($result);
        buckys_exit();
    }
    if($_POST['action'] == 'load-messenger'){
        echo loadMessenger();
        BuckysUser::updateUserFields($userID, ['show_messenger' => 1]);
        buckys_exit();
    }

    if($_POST['action'] == 'close-messenger'){
        BuckysPrivateMessenger::closeConversationBox();
        BuckysUser::updateUserFields($userID, ['show_messenger' => 0]);
        buckys_exit();
    }

    if($_POST['action'] == 'save-settings'){
        BuckysPrivateMessenger::updateMessenerSettings($userID, $_POST);

        //Getting New Messenger Lists        
        $newUserHTML = BuckysPrivateMessenger::getUserListHTML($userID);

        header('Content-type: application/xml');
        render_result_xml(['status' => 'success', 'html' => $newUserHTML]);

        buckys_exit();
    }

    if($_POST['action'] == 'block-user'){
        header('Content-type: application/xml');
        $uID = isset($_POST['blockedID']) ? $_POST['blockedID'] : null;
        $uIDHash = isset($_POST['blockedIDHash']) ? $_POST['blockedIDHash'] : null;

        if(!$uID || !$uIDHash || !buckys_check_id_encrypted($uID, $uIDHash)){
            render_result_xml(['status' => 'error', 'message' => MSG_INVALID_REQUEST]);
            exit;
        }

        $result = BuckysPrivateMessenger::blockUser($userID, $uID);
        if(is_array($result)) //Success
        {
            $newUserHTML = BuckysPrivateMessenger::getUserListHTML($userID);
            render_result_xml(['status' => 'success', 'id' => $result['userID'], 'name' => $result['firstName'] . " " . $result['lastName'], 'icon' => BuckysUser::getProfileIcon($result), 'html' => $newUserHTML]);
        }else{
            render_result_xml(['status' => 'error', 'message' => $result]);
        }
        buckys_exit();
    }

    if($_POST['action'] == 'unblock-user'){
        header('Content-type: application/xml');
        if(!isset($_POST['id']) || !buckys_not_null($_POST['id'])){
            render_result_xml(['status' => 'error', 'message' => MSG_INVALID_REQUEST]);
            buckys_exit();
        }

        $result = BuckysPrivateMessenger::unblockUser($userID, $_POST['id']);

        $newUserHTML = BuckysPrivateMessenger::getUserListHTML($userID);

        render_result_xml(['status' => 'success', 'html' => $newUserHTML]);
        buckys_exit();
    }

    if($_POST['action'] == 'open-conversation'){
        header('Content-type: application/xml');
        $cUserID = isset($_POST['userID']) ? $_POST['userID'] : null;
        $cUserIDHash = isset($_POST['idHash']) ? $_POST['idHash'] : null;
        if(!buckys_not_null($cUserID) || !buckys_not_null($cUserID) || !buckys_check_id_encrypted($cUserID, $cUserIDHash)){
            render_result_xml(['status' => 'error', 'message' => MSG_INVALID_REQUEST]);
        }else{
            $result = BuckysPrivateMessenger::openConversationBox($userID, $cUserID);
            if(is_array($result)) //Successfully Added
            {
                $history = BuckysPrivateMessenger::getMessagesHTML($userID, $cUserID, 'all');
                render_result_xml(['status' => 'success', 'id' => $result['userID'], 'encrypted' => buckys_encrypt_id($result['userID']), 'name' => $result['firstName'] . " " . $result['lastName'], 'icon' => BuckysUser::getProfileIcon($result), 'content' => $history]);
            }else if($result === true){ //Already exist
                render_result_xml(['status' => 'exist', 'id' => $result['userID'], 'encrypted' => buckys_encrypt_id($result['userID']), 'name' => $result['firstName'] . " " . $result['lastName'], 'icon' => BuckysUser::getProfileIcon($result)]);
            }else{
                render_result_xml(['status' => 'error', 'message' => $result]);
            }
        }

        buckys_exit();
    }

    if($_POST['action'] == 'close-conversation'){
        header('Content-type: application/xml');
        $cUserID = isset($_POST['userID']) ? $_POST['userID'] : null;
        $cUserIDHash = isset($_POST['idHash']) ? $_POST['idHash'] : null;
        if(!buckys_not_null($cUserID) || !buckys_not_null($cUserID) || !buckys_check_id_encrypted($cUserID, $cUserIDHash)){
            render_result_xml(['status' => 'error', 'message' => MSG_INVALID_REQUEST]);
        }else{
            $result = BuckysPrivateMessenger::closeConversationBox($cUserID);
            if($result === true){ //Already exist
                render_result_xml(['status' => 'success']);
            }
        }

        buckys_exit();
    }
    if($_POST['action'] == 'close-all-conversation'){

        $result = BuckysPrivateMessenger::closeConversationBox();
        if($result === true){ //Already exist
            render_result_xml(['status' => 'success']);
        }

        buckys_exit();
    }

    //Send Message
    if($_POST['action'] == 'send-message'){
        header('Content-type: application/xml');
        $receiverID = isset($_POST['userID']) ? $_POST['userID'] : null;
        $receiverIDEncrypted = isset($_POST['encrypted']) ? $_POST['encrypted'] : null;

        if(!$receiverID || !$receiverIDEncrypted || !buckys_check_id_encrypted($receiverID, $receiverIDEncrypted)){
            render_result_xml(['status' => 'error', 'message' => MSG_INVALID_REQUEST]);
            exit;
        }

        $result = BuckysPrivateMessenger::saveMessage($userID, $receiverID, trim($_POST['message']));
        if($result === true) //Success
        {
            render_result_xml(['status' => 'success', 'message' => BuckysPrivateMessenger::getMessagesHTML($userID, $receiverID, 'new')]);
        }else{
            render_result_xml(['status' => 'error', 'message' => $result]);
            exit;
        }
    }

    if($_POST['action'] == 'clear-history'){
        $uID = isset($_POST['userID']) ? $_POST['userID'] : null;
        $uIDHash = isset($_POST['idHash']) ? $_POST['idHash'] : null;

        if(!$uID || !$uIDHash || !buckys_check_id_encrypted($uID, $uIDHash)){
            render_result_xml(['status' => 'error', 'message' => MSG_INVALID_REQUEST]);
            exit;
        }

        $result = BuckysPrivateMessenger::clearHistory($userID, $uID);
        if($result === true) //Success
        {
            render_result_xml(['status' => 'success']);
        }else{
            render_result_xml(['status' => 'error']);
        }
        exit;
    }

    if($_POST['action'] == 'add-user-to-buddylist'){
        header('Content-type: application/xml');
        $cUserID = $_POST['added-id'];
        $cUserIDHash = $_POST['added-id-hash'];
        if(!$cUserID || !$cUserIDHash || !buckys_check_id_encrypted($cUserID, $cUserIDHash)){
            render_result_xml(['status' => 'error', 'message' => MSG_INVALID_REQUEST]);
            exit;
        }
        if(($result = BuckysPrivateMessenger::addUserToBuddylist($userID, $cUserID)) === true){
            //Getting New Messenger Lists        
            $newUserHTML = BuckysPrivateMessenger::getUserListHTML($userID);

            render_result_xml(['status' => 'success', 'html' => $newUserHTML]);
        }else{
            render_result_xml(['status' => 'error', 'message' => $result]);
        }

        exit;
    }

    //Remove user from the buddy list
    if($_POST['action'] == 'remove-user'){
        header('Content-type: application/xml');
        $cUserID = $_POST['userID'];
        $cUserIDHash = $_POST['userIDHash'];
        if(!$cUserID || !$cUserIDHash || !buckys_check_id_encrypted($cUserID, $cUserIDHash)){
            render_result_xml(['status' => 'error', 'message' => MSG_INVALID_REQUEST]);
            exit;
        }
        $userInfo = BuckysUser::getUserBasicInfo($userID);
        if($userInfo['messenger_privacy'] == 'all') //Block user
        {
            $result = BuckysPrivateMessenger::blockUser($userID, $cUserID);

            if(is_array($result)) //Success
            {
                render_result_xml(['status' => 'success', 'type' => 'block', 'id' => $result['userID'], 'name' => $result['firstName'] . " " . $result['lastName'], 'icon' => BuckysUser::getProfileIcon($result)]);
            }else{
                render_result_xml(['status' => 'error', 'message' => $result]);
            }
        }else{
            if(($result = BuckysPrivateMessenger::removeUserFromBuddylist($userID, $cUserID)) === true){
                //Getting New Messenger Lists                        
                render_result_xml(['status' => 'success', 'type' => 'remove']);
            }else{
                render_result_xml(['status' => 'error', 'message' => $result]);
            }
        }

        exit;
    }

    if($_POST['action'] == 'update-messenger'){
        $status = isset($_POST['status']) ? $_POST['status'] : '';

        if($status == 'closed'){
            //Just Get Total Unread Messages
            $newMessages = BuckysPrivateMessenger::getNewMessageCount($userID);
            echo '<result>';
            echo '<newmessages>' . $newMessages . '</newmessages>';
            echo '</result>';
            exit;
        }
        //Getting Chat Users
        $users = BuckysPrivateMessenger::getUserList($userID);

        //Getting User IDs on the Messenger List        
        $buddyIDs = [];

        $newUserHTML = '';
        foreach($users as $row){
            $newUserHTML .= '<a href="#" class="single_chat_user ' . (!$row['online'] || !$row['buddyStatus'] ? "single_chat_user_offline" : '') . '" data-id="' . $row['userID'] . '" data-hash="' . buckys_encrypt_id($row['userID']) . '"> <img src="' . BuckysUser::getProfileIcon($row) . '" /><span> ' . $row['name'] . '</span></a>';
            $buddyIDs[] = $row['userID'];
        }

        //Create Messages XML
        $result = [];

        if($newUserHTML != ''){
            $buddyIDs = array_unique($buddyIDs);

            $messages = BuckysPrivateMessenger::getMessages($userID, $buddyIDs, 'new');

            //Getting Conversation List
            $convList = isset($_SESSION['converation_list']) ? $_SESSION['converation_list'] : [];

            foreach($messages as $row){
                if(!isset($result[$row['userID']])){
                    //Init Array
                    $result[$row['userID']] = ['html' => '', 'count' => 0, 'name' => ''];
                }
                //If there is a user that has sent new message and is not on the conversation list, add him to the conversation list and get all old messages
                if(!in_array($row['userID'], $convList) && is_array(BuckysPrivateMessenger::openConversationBox($userID, $row['userID']))){
                    //Add to conversation list
                    $result[$row['userID']]['html'] = BuckysPrivateMessenger::getMessagesHTML($userID, $row['userID'], 'old');
                    //Update ConvList
                    $convList = isset($_SESSION['converation_list']) ? $_SESSION['converation_list'] : [];
                }else{
                    $result[$row['userID']]['html'] .= '<div class="single_private_message">
                                <img src="' . BuckysUser::getProfileIcon($row) . '" />
                                <div class="private_message_text"><span class="username">' . $row['fullName'] . '</span>' . $row['message'] . ' <span class="date">' . buckys_format_date($row['createdDate'], 'F j, Y h:i A') . '</span></div>
                              </div>';
                }
                $result[$row['userID']]['count']++;
                $result[$row['userID']]['name'] = $row['fullName'];
            }
        }

        echo '<result>';
        echo '<users><![CDATA[' . $newUserHTML . ']]></users>';
        echo '<messages>';
        foreach($result as $id => $row){
            echo '<message id="' . $id . '" encrypted="' . buckys_encrypt_id($id) . '" count="' . $row['count'] . '" name="' . $row['name'] . '"><![CDATA[' . $row['html'] . ']]></message>';
        }
        echo '</messages>';
        echo '</result>';
        exit;
    }
}

/**
 * Load Private Messenger

 */
function loadMessenger(){
    global $db, $userID;

    //Getting Friends from the Buddy List
    $messengerSettings = BuckysUser::getUserBasicInfo($userID);

    $uIDs = [];
    //Return HTML
    ob_start();

    ?>
    <div id="private_messenger_main_wrap">
        <div class="box_nav_row">
            <a href="#" class="close_box_link">&nbsp;</a>
            <!--            <a href="#" class="minimize_box_link">&nbsp;</a>-->
        </div>
        <h2>Chat</h2>

        <div class="chat_user_list" id="private_messenger_buddies_list">
            <?php echo BuckysPrivateMessenger::getUserListHTML($userID, $uIDs); ?>
        </div>
        <div
            class="below_chat_user_list <?php if($messengerSettings['messenger_privacy'] == 'all'){ ?>add-user-to-buddylist-hidden<?php } ?>"
            id="add-user-to-buddylist">
            <form name="adduserform" id="adduserform">
                <h2>Add Friends</h2>
                <span id="add-user-to-buddylist-inputholder">
                    <input type="text" class="input below_chat_user_list_input" id="add-user-to-buddylist-input"/>
                </span> <input type="submit" value="Add" class="redButton"/>
                <!--                <div id="selected-users-list"></div>-->
                <div class="clear"></div>
                <?php echo render_loading_wrapper(); ?>
            </form>
        </div>
        <div class="below_chat_user_list" id="messenger_btn_box">
            <span><input type="button" id="settings_messenger_btn" class="redButton" value="Settings"></span>
        </div>
    </div>
    <?php
    BuckysPrivateMessenger::updateConversationList($userID, $uIDs);
    $convList = isset($_SESSION['converation_list']) ? $_SESSION['converation_list'] : [];
    ?>
    <div id="private_messenger_conversation_wrap"
        <?php if (!buckys_not_null($convList)){ ?>style="display: none;"<?php } ?>>
        <div class="box_nav_row">
            <a href="#" class="close_box_link">&nbsp;</a> <a href="#" class="minimize_box_link">&nbsp;</a>

            <div href="#" class="options_link" id="private-messenger-options-link">
                Options
                <ul>
                    <li><a href="#" id="pm-box-clear-history-link">Clear history</a></li>
                    <li><a href="#" id="pm-box-block-user-link">Block User</a></li>
                </ul>
            </div>
        </div>
        <div id="private_messenger_conversation_lft">
            <div id="private_messenger_opened_chats">
                <?php
                foreach($convList as $i => $uID){
                    $tUInfo = BuckysUser::getUserBasicInfo($uID);
                    ?>
                    <a href="#" data-id="<?php echo $uID?>" <?php if($i == 0){ ?>class="actived"<?php } ?>
                    data-encrypted="<?php echo buckys_encrypt_id($uID)?>"><?php echo $tUInfo['firstName'] . " " . $tUInfo['lastName'] ?>
                    <span title="close" class="close-conversation">X</span></a><?php
                }
                ?>
            </div>
        </div>
        <div id="private_messenger_conversation_rgt">
            <?php
            foreach($convList as $i => $uID){
                $tUInfo = BuckysUser::getUserBasicInfo($uID);
                ?>
                <div class="private_messenger_conversation_contr" <?php if ($i > 0){ ?>style="display: none;"<?php } ?>
                    id="private_messenger_conversation_contr<?php echo $uID?>">
                    <?php
                    echo BuckysPrivateMessenger::getMessagesHTML($userID, $uID, 'all');
                    ?>
                </div>
            <?php
            }
            ?>
            <div id="private_messenger_send_message_contr">
                <form name="newmessageform" id="newmessageform" action="" method="post">
                    <input class="under_private_message_conversation_area_input" id="new_private_message" class="input"
                        type="text"/>
                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}