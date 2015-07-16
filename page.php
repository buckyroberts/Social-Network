<?php

require(dirname(__FILE__) . '/includes/bootstrap.php');

$userID = buckys_is_logged_in();

//Read Parameters (common)
$paramAction = 'view';

if(isset($_REQUEST['action'])){
    $paramAction = get_secure_string($_REQUEST['action']);
}

$pageIns = new BuckysPage();
$pageFollowerIns = new BuckysPageFollower();

//Capture Ajax requests (such as save title, ... here)

if(is_numeric($userID)){

    switch($paramAction){

        //============ Update About Content By Ajax =================//
        case 'updateAbout':

            $paramPageID = get_secure_integer($_REQUEST['pageID']);
            $paramContent = get_secure_string($_REQUEST['content']);

            $pageData = $pageIns->getPageByID($paramPageID);
            if($pageData && $pageData['userID'] == $userID){

                $data['about'] = $paramContent;
                $pageIns->updateData($paramPageID, $data);

                echo json_encode(['success' => 1, 'msg' => MSG_CONTENT_UPDATED_SUCCESS, 'content' => $paramContent, 'content_display' => render_enter_to_br($paramContent)]);

            }else if(empty($pageData)){
                //No such page exists
                echo json_encode(['success' => 0, 'msg' => MSG_NO_SUCH_PAGE]);
            }else{
                //You don't have permission to update content
                echo json_encode(['success' => 0, 'msg' => MSG_NO_PERMISSION_TO_EDIT_PAGE]);
            }

            exit;

        //=============== Update Page Title by Ajax ===================//    
        case 'updatePageTitle':

            $paramPageID = get_secure_integer($_REQUEST['pageID']);
            $paramContent = get_secure_string($_REQUEST['content']);

            $pageData = $pageIns->getPageByID($paramPageID);
            if($pageData && $pageData['userID'] == $userID){

                $data['title'] = $paramContent;
                $pageIns->updateData($paramPageID, $data);

                echo json_encode(['success' => 1, 'msg' => MSG_CONTENT_UPDATED_SUCCESS, 'content' => strip_tags($paramContent)]);

            }else if(empty($pageData)){
                //No such page exists
                echo json_encode(['success' => 0, 'msg' => MSG_NO_SUCH_PAGE]);
            }else{
                //You don't have permission to update content
                echo json_encode(['success' => 0, 'msg' => MSG_NO_PERMISSION_TO_EDIT_PAGE]);
            }

            exit;

        //================== Update Page Lins By Ajax ======================//
        case 'updatePageLinks':

            $paramPageID = get_secure_integer($_REQUEST['pageID']);
            $paramContent = $_REQUEST['content'];

            $pageData = $pageIns->getPageByID($paramPageID);
            if($pageData && $pageData['userID'] == $userID){

                $resultSerialized = '';
                $newLinkList = [];
                if(is_array($paramContent) && count($paramContent) > 0){

                    foreach($paramContent as $linkD){
                        if(buckys_not_null($linkD['title']) && buckys_not_null($linkD['link'])){
                            $linkD['title'] = trim(strip_tags($linkD['title']));
                            $linkD['link'] = trim(strip_tags($linkD['link']));
                            $newLinkList[] = $linkD;
                        }
                    }

                    $resultSerialized = serialize($newLinkList);
                }

                $data['links'] = $resultSerialized;
                $pageIns->updateData($paramPageID, $data);

                $outputHtml = '';
                if(count($newLinkList) > 0){
                    foreach($newLinkList as $linkD){
                        $outputHtml .= sprintf('<a href="%s">%s</a> <br/>', $linkD['link'], $linkD['title']);
                    }

                }

                echo json_encode(['success' => 1, 'msg' => MSG_CONTENT_UPDATED_SUCCESS, 'html' => $outputHtml, 'jsonLinks' => $newLinkList]);

            }else if(empty($pageData)){
                //No such page exists
                echo json_encode(['success' => 0, 'msg' => MSG_NO_SUCH_PAGE]);
            }else{
                //You don't have permission to update content
                echo json_encode(['success' => 0, 'msg' => MSG_NO_PERMISSION_TO_EDIT_PAGE]);
            }

            exit;

        //==================== Delete this page ====================//
        case 'delete':

            $paramPageID = get_secure_integer($_REQUEST['pid']);

            //Check if this user has rights to delete this one
            if($pageIns->deletePageByID($paramPageID, $userID)){
                //Deleted successfully
                buckys_redirect('/account.php', MSG_DELETE_PAGE_SUCCESS, MSG_TYPE_SUCCESS);
            }else{
                //You don't have rights to delete this page
                buckys_redirect('/account.php', MSG_NO_PERMISSION_TO_DELETE_PAGE, MSG_TYPE_ERROR);
            }

            exit;

        //==================== Follow This Page ====================//
        case 'follow':
            $isAjax = isset($_REQUEST['buckys_ajax']) ? true : false;

            if($isAjax)
                header('Content-type: application/xml');

            if(!buckys_check_form_token('request')){
                if($isAjax){
                    $resultXML = ['status' => 'error', 'message' => MSG_INVALID_REQUEST,];
                    render_result_xml($resultXML);
                    exit;
                }else{
                    buckys_add_message(MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
                }
            }

            $paramPageID = get_secure_integer($_REQUEST['pid']);
            $result = $pageFollowerIns->addFollower($paramPageID, $userID);

            if($result){
                if($isAjax){
                    $resultXML = ['status' => 'success', 'message' => 'MSG_FOLLOW_PAGE_SUCCESS', 'html' => 'Unfollow', 'link' => '/page.php?action=unfollow&pid=' . $paramPageID . buckys_get_token_param()];
                    render_result_xml($resultXML);
                    exit;
                }else{
                    buckys_redirect('/page.php?pid=' . $paramPageID, MSG_FOLLOW_PAGE_SUCCESS, MSG_TYPE_SUCCESS);
                }
            }else{
                if($isAjax){
                    $resultXML = ['status' => 'error', 'message' => MSG_FOLLOW_PAGE_FAIL,];
                    render_result_xml($resultXML);
                    exit;
                }else{
                    buckys_redirect('/page.php?pid=' . $paramPageID, MSG_FOLLOW_PAGE_FAIL, MSG_TYPE_ERROR);
                }
            }

            break;

        //==================== Add New Page ====================//
        case 'unfollow':
            $isAjax = isset($_REQUEST['buckys_ajax']) ? true : false;
            $paramPageID = get_secure_integer($_REQUEST['pid']);

            if($isAjax)
                header('Content-type: application/xml');

            if(!buckys_check_form_token('request')){
                if($isAjax){
                    $resultXML = ['status' => 'error', 'message' => MSG_INVALID_REQUEST,];
                    render_result_xml($resultXML);
                    exit;
                }else{
                    buckys_redirect('/page.php?pid=' . $paramPageID, MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
                }
            }

            $result = $pageFollowerIns->removeFollower($paramPageID, $userID);

            if($result){
                if($isAjax){
                    $resultXML = ['status' => 'success', 'message' => 'MSG_FOLLOW_PAGE_SUCCESS', 'html' => 'follow', 'link' => '/page.php?action=follow&pid=' . $paramPageID . buckys_get_token_param()];
                    render_result_xml($resultXML);
                    exit;
                }else{
                    buckys_redirect('/page.php?pid=' . $paramPageID, MSG_UNFOLLOW_PAGE_SUCCESS, MSG_TYPE_SUCCESS);
                }
            }else{
                $resultXML = ['status' => 'error', 'message' => MSG_INVALID_REQUEST,];
                render_result_xml($resultXML);
                exit;
            }

            break;

        //==================== Add New Page ====================//
        case '':
            break;

    }

}

if(isset($_REQUEST['pid']) && is_numeric($_REQUEST['pid'])){

    //Display page info

    $paramPageID = get_secure_integer($_REQUEST['pid']);
    $paramPostID = isset($_REQUEST['post']) ? get_secure_integer($_REQUEST['post']) : null;
    $paramPostsOnly = isset($_REQUEST['postsonly']) ? get_secure_integer($_REQUEST['postsonly']) : null;

    $view['show_all_post'] = false;
    if($paramPostsOnly)
        $view['show_all_post'] = true;

    //View page by ID

    buckys_enqueue_stylesheet('account.css');
    buckys_enqueue_stylesheet('stream.css');
    buckys_enqueue_stylesheet('posting.css');
    buckys_enqueue_stylesheet('uploadify.css');
    buckys_enqueue_stylesheet('jquery.Jcrop.css');
    buckys_enqueue_stylesheet('page.css');
    buckys_enqueue_stylesheet('publisher.css');

    buckys_enqueue_javascript('uploadify/jquery.uploadify.js');
    buckys_enqueue_javascript('jquery.Jcrop.js');
    buckys_enqueue_javascript('jquery.color.js');

    buckys_enqueue_javascript('posts.js');
    buckys_enqueue_javascript('add_post.js');
    buckys_enqueue_javascript('page.js');

    //Get Page Data
    $pageData = $pageIns->getPageByID($paramPageID, false);
    $view['pageData'] = $pageData;

    if(!isset($pageData) || ($pageData['userID'] != $userID && $pageData['status'] == BuckysPage::STATUS_INACTIVE)){
        //This page doesn't exist or inactive
        buckys_redirect('/index.php', MSG_NO_SUCH_PAGE, MSG_TYPE_ERROR);
    }

    //Get Posts Belonged to this page
    $postIns = new BuckysPost();
    if(!$paramPostID){
        $view['posts'] = $postIns->getPostsByUserID($pageData['userID'], $userID, $pageData['pageID']);
        $view['show_only_post'] = false;
    }else{
        $onePostData = $postIns->getPostById($paramPostID, $paramPageID);
        if(!buckys_not_null($onePostData)){
            buckys_redirect('/index.php');
        }

        $view['posts'][] = $onePostData;
        $view['show_only_post'] = true;
    }

    //Get followers
    $pageFollowerIns = new BuckysPageFollower();
    $view['followers'] = $pageFollowerIns->getFollowers($pageData['pageID'], 1, 18, true);

    //Is this my page?
    $view['isMyPage'] = $pageData['userID'] == $userID;

    $TNB_GLOBALS['title'] = $pageData['title'] . ' - ' . TNB_SITE_NAME;
    $TNB_GLOBALS['content'] = 'page';

    require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");

}else{
    //No such action here;
    buckys_redirect('/index.php', MSG_NO_SUCH_PAGE, MSG_TYPE_ERROR);

}



