<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
	buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

//Action Process
if(isset($_POST['action']) && $_POST['action'] == 'submit-post'){

	//Check Token
	if(!buckys_check_form_token()){
		buckys_redirect("/account.php", MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
	}

	//Save Post
	BuckysPost::savePost($userID, $_POST);

	if(isset($_POST['return'])){
		buckys_redirect(base64_decode($_POST['return']));
	}else{
		if(isset($_POST['pageID']) && is_numeric($_POST['pageID'])){
			buckys_redirect('/page.php?pid=' . $_POST['pageID']);
		}else{
			buckys_redirect('/account.php');
		}
	}

}else if(isset($_GET['action']) && $_GET['action'] == 'delete-post'){
	//Delete Post
	if($userID != $_GET['userID'] || !BuckysPost::deletePost($userID, $_GET['postID'])){
		echo 'Invalid Request';
	}else{
		echo 'success';
	}
	exit;
}else if(isset($_GET['action']) && ($_GET['action'] == 'unlikePost' || $_GET['action'] == 'likePost')){
	$post = BuckysPost::getPostById($_GET['postID']);
	if($post['post_status'] != 1){
		render_result_xml(['status' => 'error', 'message' => MSG_INVALID_REQUEST]);
		exit;
	}

	$r = BuckysPost::likePost($userID, $_GET['postID'], $_GET['action']);
	$likes = BuckysPost::getPostLikesCount($_GET['postID']);

	render_result_xml(['status' => $r ? 'success' : 'error', 'message' => buckys_get_messages(), 'likes' => $likes . " like" . ($likes >= 2 ? "s" : ""), 'postID' => $_GET['postID']]);
	exit;
}