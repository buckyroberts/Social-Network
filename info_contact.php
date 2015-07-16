<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//If the user is not logged in, redirect to the index page
if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php');
}

//Getting UserData from Id
$userData = BuckysUser::getUserContactInfo($userID);

//Goto Homepage if the userID is not correct
if(!buckys_not_null($userData)){
    buckys_redirect('/index.php');
}

if(isset($_POST['action'])){
    //Check the user id is same with the current logged user id
    if($_POST['userID'] != $userID){
        echo 'Invalid Request!';
        exit;
    }

    //Save Primary Email
    if($_POST['action'] == 'save_email'){
        //Check the email address is valid or not
        $pattern = '/^([a-zA-Z0-9_+\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/';
        /*if( !preg_match($pattern, $_POST['email']) )
        {
            echo 'Please input a valid e-mail address';
            exit;
        }
        //Check if the email is used or not
        if( BuckysUser::checkEmailDuplication($_POST['email'], $userID) )
        {
            echo 'The e-mail is already in use.';
            exit;
        }*/

        //Update User Email
        if(BuckysUser::updateUserFields($userID, ['email_visibility' => $_POST['email_visibility']])){
            echo 'Success';
        }else{
            echo $db->getLastError();
        }

        exit;

    }

    //Save Phone Numbers
    if($_POST['action'] == 'save_phone'){
        //Update User Phone numbers
        if(BuckysUser::updateUserFields($userID, ['cell_phone' => $_POST['cell_phone'], 'cell_phone_visibility' => $_POST['cell_phone_visibility'], 'home_phone' => $_POST['home_phone'], 'home_phone_visibility' => $_POST['home_phone_visibility'], 'work_phone' => $_POST['work_phone'], 'work_phone_visibility' => $_POST['work_phone_visibility']])
        ){
            echo 'Success';
        }else{
            echo $db->getLastError();
        }

        exit;

    }

    //Save Address
    if($_POST['action'] == 'save_address'){
        $data = ['address1' => $_POST['address1'], 'address2' => $_POST['address2'], 'city' => $_POST['city'], 'state' => $_POST['state'], 'zip' => $_POST['zip'], 'country' => $_POST['country'], 'address_visibility' => $_POST['address_visibility']];
        //Update User Phone numbers
        if(BuckysUser::updateUserFields($userID, $data)){
            echo 'Success';
        }else{
            echo $db->getLastError();
        }

        exit;

    }
    //Save Contact Info
    if($_POST['action'] == 'save_messenger'){
        $data = [];
        for($i = 0; $i < count($_POST['username']); $i++){
            $data[] = ['name' => $_POST['username'][$i], 'type' => $_POST['type'][$i], 'visibility' => $_POST['visibility'][$i]];
        }
        //Update User Phone numbers
        if(BuckysUser::updateUserMessengerInfo($userID, $data)){
            echo 'Success';
        }else{
            echo $db->getLastError();
        }

        exit;

    }

}

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('info.css');

buckys_enqueue_javascript('info.js');

$TNB_GLOBALS['content'] = 'info_contact';

$TNB_GLOBALS['title'] = "Contact Info - " . TNB_SITE_NAME;

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
