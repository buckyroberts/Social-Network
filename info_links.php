<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//If the user is not logged in, redirect to the index page
if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php');
}

//Getting UserData from Id
$userData = BuckysUser::getUserLinks($userID);

if(isset($_POST['action'])){
    //Check the user id is same with the current logged user id
    if($_POST['userID'] != $userID){
        echo 'Invalid Request!';
        exit;
    }

    //Save Address
    if($_POST['action'] == 'save_links'){
        $data = [];
        for($i = 0; $i < count($_POST['title']); $i++){
            $data[] = ['title' => $_POST['title'][$i], 'url' => $_POST['url'][$i], 'visibility' => $_POST['visibility'][$i]];
        }
        //Update User Phone numbers
        if(BuckysUser::updateUserLinks($userID, $data)){
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

$TNB_GLOBALS['content'] = 'info_links';

$TNB_GLOBALS['title'] = "Info Links - " . TNB_SITE_NAME;

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
