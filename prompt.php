<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

$x = $_GET['x'];

function createMessage($x){
    if(is_numeric($x)){
        switch($x){
            case 0:
                $message = "Your account is now active. You may now Log In.";
                break;
            case 1:
                $message = "That e-mail is already in use.";
                break;
            case 2:
                $message = "Thank you for registering! A confirmation has been sent to your email. Please click on the activation link to activate your account.";
                break;
            case 3:
                $message = "Please enter your e-mail.";
                break;
            case 4:
                $message = "That  is not a valid e-mail.";
                break;
            case 5:
                $message = "Password can not be empty.";
                break;
            case 6:
                $message = "E-mail or password was incorrect.";
                break;
            case 7:
                $message = "You must be friends with a user to reply to their post.";
                break;
        }
        //		echo $message;
    }
}

buckys_enqueue_stylesheet('forms.css');
buckys_enqueue_stylesheet('tables.css');

$TNB_GLOBALS['content'] = 'prompt';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");