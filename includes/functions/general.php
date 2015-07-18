<?php
/**
 * Including Common functions that will be used whole site
 */

/**
 * Add Javascript to $TNB_GLOBAL['javascripts']
 *
 * @param String  $script
 * @param Boolean $is_absolute_path
 * @param Int     $position
 */
function buckys_enqueue_javascript($script, $is_absolute_path = false, $is_footer = true, $position = null){
    global $TNB_GLOBALS;

    if(!isset($TNB_GLOBALS['javascripts']))
        $TNB_GLOBALS['javascripts'] = [];

    if(!$is_absolute_path)
        $script = DIR_WS_JS . $script;

    //Check already added or not
    foreach($TNB_GLOBALS['javascripts'] as $row){
        if($row['src'] == $script)
            return;
    }

    if($position === null || $position >= count($TNB_GLOBALS['javascripts'])){
        array_push($TNB_GLOBALS['javascripts'], ['src' => $script, 'is_footer' => $is_footer]);
    }else{
        $js = [];
        for($i = 0; $i < count($TNB_GLOBALS['javascripts']); $i++){
            if($i == $position)
                $js[] = ['src' => $script, 'is_footer' => $is_footer];
            $js[] = $TNB_GLOBALS['javascripts'][$i];
        }
        $TNB_GLOBALS['javascripts'] = $js;
    }
}

/**
 * Add Stylesheet to $TNB_GLOBAL['stylesheets']
 *
 * @param String  $stylesheet
 * @param Boolean $is_absolute_path
 * @param Int     $position
 */
function buckys_enqueue_stylesheet($stylesheet, $is_absolute_path = false, $position = null){
    global $TNB_GLOBALS;

    if(!isset($TNB_GLOBALS['stylesheets']))
        $TNB_GLOBALS['stylesheets'] = [];

    if(!$is_absolute_path)
        $stylesheet = DIR_WS_CSS . $stylesheet;

    if($position === null || $position >= count($TNB_GLOBALS['stylesheets'])){
        array_push($TNB_GLOBALS['stylesheets'], $stylesheet);
    }else{
        $sh = [];
        for($i = 0; $i < count($TNB_GLOBALS['stylesheets']); $i++){
            if($i == $position)
                $sh[] = $stylesheet;
            $sh[] = $TNB_GLOBALS['stylesheets'][$i];
        }
        $TNB_GLOBALS['stylesheets'] = $sh;
    }
}

/**
 * Render Scripts from $TNB_GLOBALS['javascripts'] variable

 */
function buckys_render_javascripts($is_footer = true){
    global $TNB_GLOBALS;

    if(isset($TNB_GLOBALS['javascripts'])){
        if(!is_array($TNB_GLOBALS['javascripts']))
            $TNB_GLOBALS['javascripts'] = [$TNB_GLOBALS['javascripts']];
        //        $TNB_GLOBALS['javascripts'] = array_unique($TNB_GLOBALS['javascripts']);

        foreach($TNB_GLOBALS['javascripts'] as $row){
            if($row['is_footer'] != $is_footer)
                continue;

            echo "<script type='text/javascript' src='" . $row['src'] . "' ></script>" . PHP_EOL;
        }
    }
}

/**
 *
 */
function buckys_render_stylesheet(){
    global $TNB_GLOBALS;

    if(isset($TNB_GLOBALS['stylesheets'])){
        if(!is_array($TNB_GLOBALS['stylesheets']))
            $TNB_GLOBALS['stylesheets'] = [$TNB_GLOBALS['stylesheets']];
        $TNB_GLOBALS['stylesheets'] = array_unique($TNB_GLOBALS['stylesheets']);
        foreach($TNB_GLOBALS['stylesheets'] as $src){
            echo "<link rel='stylesheet' type='text/css' href='" . $src . "' >" . PHP_EOL;
        }
    }
}

/**
 * Check if current user is logged in
 *
 * @return loggedin = true, else false
 */
function buckys_is_logged_in(){
    global $db;

    if(isset($_SESSION['userID'])){
        $userID = $_SESSION['userID'];
        //Check the UserId exits in the database
        $query = $db->prepare("SELECT userID, status FROM users WHERE userID=%s AND `status` != " . BuckysUser::STATUS_USER_DELETED, $userID);
        $urow = $db->getRow($query);

        if(!$urow) //If userid doesn't exist in the database, remove it from the session
        {
            $_SESSION['userID'] = null;
            unset($_SESSION['userID']);
            return false;
        }else if($urow['status'] != 1){
            $_SESSION['userID'] = null;
            unset($_SESSION['userID']);
            buckys_add_message(MSG_ACCOUNT_BANNED, MSG_TYPE_ERROR);
            return false;
        }
        return $urow['userID'];
    }else{
        return buckys_check_cookie_for_login();

    }
}

/**
 * Check Cookie values for keep me signed in

 */
function buckys_check_cookie_for_login(){
    global $db;

    if(isset($_COOKIE['COOKIE_KEEP_ME_NAME1']) && isset($_COOKIE['COOKIE_KEEP_ME_NAME2']) && isset($_COOKIE['COOKIE_KEEP_ME_NAME3'])){
        $token1 = base64_decode($_COOKIE['COOKIE_KEEP_ME_NAME1']);
        $token3 = base64_decode($_COOKIE['COOKIE_KEEP_ME_NAME2']);
        $token2 = base64_decode($_COOKIE['COOKIE_KEEP_ME_NAME3']);

        $login_token = md5($token1 . $token2 . $token3);

        if(($userID = BuckysUsersToken::checkTokenValidity($login_token, "auth"))){
            $query = $db->prepare("SELECT userID FROM users WHERE userID=%s AND status=1", $userID);
            $userID = $db->getVar($query);

            if($userID){
                $_SESSION['userID'] = $userID;
                //Init Some Session Values
                $_SESSION['converation_list'] = [];
                return $userID;
            }
        }

        //Remove Cookies
        setcookie('COOKIE_KEEP_ME_NAME1', null, time() - 1000, "/", TNB_DOMAIN);
        setcookie('COOKIE_KEEP_ME_NAME2', null, time() - 1000, "/", TNB_DOMAIN);
        setcookie('COOKIE_KEEP_ME_NAME3', null, time() - 1000, "/", TNB_DOMAIN);

    }

    return false;
}

/**
 * Redirect to the url
 * If $msg is not null, set the message to the session
 *
 * @param String $url
 * @param String $msg
 * @param int    $msg_type : MSG_TYPE_SUCCESS(1)=success, MSG_TYPE_ERROR(0)=error, MSG_TYPE_NOTIFY(2)=notification
 */
function buckys_redirect($url, $msg = null, $msg_type = MSG_TYPE_SUCCESS){
    if($msg){
        buckys_add_message($msg, $msg_type);
    }
    header("Location: " . $url);
    exit;
}

/**
 * check the value is null or not
 *
 * @param mixed $value
 * @return bool
 */
function buckys_not_null($value){
    if(is_array($value)){
        if(sizeof($value) > 0){
            return true;
        }else{
            return false;
        }
    }else{
        if((is_string($value) || is_int($value)) && ($value != '') && (strlen(trim($value)) > 0)){
            return true;
        }else{
            return false;
        }
    }
}

/**
 * Get User Full Info By Email
 *
 * @param mixed $email
 * @return array
 */
function buckys_get_user_by_email($email){
    global $db;

    $query = $db->prepare('SELECT * FROM users WHERE email=%s AND `status` != ' . BuckysUser::STATUS_USER_DELETED, $email);
    $row = $db->getRow($query);

    return $row;
}

/**
 * Save the message to the session
 *
 * @param String $msg
 * @param int    $msg_type : MSG_TYPE_SUCCESS(1)=success, MSG_TYPE_ERROR(0)=error, MSG_TYPE_NOTIFY(2)=notification
 */
function buckys_add_message($msg, $msg_type = MSG_TYPE_SUCCESS){
    if(!isset($_SESSION['message'])){
        $_SESSION['message'] = [];
    }
    $_SESSION['message'][] = ['type' => $msg_type, 'message' => htmlentities($msg, ENT_QUOTES)];
}

//Getting Result Messages 
/**
 * @return string
 */
function buckys_get_messages(){
    ob_start();
    render_result_messages();
    $msg = ob_get_contents();
    ob_end_clean();
    return $msg;
}

/**
 * Getting pure message string from session
 * This will be used on API section

 */
function buckys_get_pure_messages(){
    $message_string = "";

    if(isset($_SESSION['message']) && buckys_not_null($_SESSION['message'])){
        for($i = 0; $i < sizeof($_SESSION['message']); $i++){
            if($message_string)
                $message_string .= "\n\r";

            $message_string .= $_SESSION['message'][$i]['message'];
        }
        unset($_SESSION['message']);
    }

    return $message_string;
}

//Create Image Object
/**
 * @param $file
 * @param $type
 * @return bool
 */
function buckys_image_open($file, $type){
    // @rule: Test for JPG image extensions
    if(function_exists('imagecreatefromjpeg') && (($type == 'image/jpg') || ($type == 'image/jpeg') || ($type == 'image/pjpeg'))){
        $im = @imagecreatefromjpeg($file);

        if($im !== false){
            return $im;
        }
    }

    // @rule: Test for png image extensions
    if(function_exists('imagecreatefrompng') && (($type == 'image/png') || ($type == 'image/x-png'))){
        $im = @imagecreatefrompng($file);

        if($im !== false){
            return $im;
        }
    }

    // @rule: Test for png image extensions
    if(function_exists('imagecreatefromgif') && (($type == 'image/gif'))){
        $im = @imagecreatefromgif($file);

        if($im !== false){
            return $im;
        }
    }

    if(function_exists('imagecreatefromgd')){
        # GD File:
        $im = @imagecreatefromgd($file);
        if($im !== false){
            return true;
        }
    }

    if(function_exists('imagecreatefromgd2')){
        # GD2 File:
        $im = @imagecreatefromgd2($file);
        if($im !== false){
            return true;
        }
    }

    if(function_exists('imagecreatefromwbmp')){
        # WBMP:
        $im = @imagecreatefromwbmp($file);
        if($im !== false){
            return true;
        }
    }

    if(function_exists('imagecreatefromxbm')){
        # XBM:
        $im = @imagecreatefromxbm($file);
        if($im !== false){
            return true;
        }
    }

    if(function_exists('imagecreatefromxpm')){
        # XPM:
        $im = @imagecreatefromxpm($file);
        if($im !== false){
            return true;
        }
    }

    // If all failed, this photo is invalid
    return false;
}

//Resize Image
/**
 * @param     $srcPath
 * @param     $destPath
 * @param     $destType
 * @param     $destWidth
 * @param     $destHeight
 * @param int $sourceX
 * @param int $sourceY
 * @param int $currentWidth
 * @param int $currentHeight
 * @return bool
 */
function buckys_resize_image($srcPath, $destPath, $destType, $destWidth, $destHeight, $sourceX = 0, $sourceY = 0, $currentWidth = 0, $currentHeight = 0){
    $imgQuality = 320;
    $pngQuality = ($imgQuality - 100) / 11.111111;
    $pngQuality = round(abs($pngQuality));

    // See if we can grab image transparency
    $image = buckys_image_open($srcPath, $destType);
    $transparentIndex = imagecolortransparent($image);

    // Create new image resource
    $image_p = ImageCreateTrueColor($destWidth, $destHeight);
    $background = ImageColorAllocate($image_p, 255, 255, 255);

    // test if memory is enough
    if($image_p == false){
        echo 'Image resize fail. Please increase PHP memory';
        return false;
    }

    // Set the new image background width and height
    $resourceWidth = $destWidth;
    $resourceHeight = $destHeight;

    if(empty($currentHeight) && empty($currentWidth)){
        list($currentWidth, $currentHeight) = getimagesize($srcPath);
    }
    // If image is smaller, just copy to the center
    $targetX = 0;
    $targetY = 0;

    // If the height and width is smaller, copy it to the center.
    if($destType != 'image/jpg' && $destType != 'image/jpeg' && $destType != 'image/pjpeg'){
        if(($currentHeight < $destHeight) && ($currentWidth < $destWidth)){
            $targetX = intval(($destWidth - $currentWidth) / 2);
            $targetY = intval(($destHeight - $currentHeight) / 2);

            // Since the 
            $destWidth = $currentWidth;
            $destHeight = $currentHeight;
        }
    }
    $targetX = floor($targetX);
    $targetY = floor($targetY);
    $sourceX = floor($sourceX);
    $sourceY = floor($sourceY);
    $destWidth = floor($destWidth);
    $destHeight = floor($destHeight);
    $currentWidth = floor($currentWidth);
    $currentHeight = floor($currentHeight);
    // Resize GIF/PNG to handle transparency
    if($destType == 'image/gif'){
        $colorTransparent = imagecolortransparent($image);
        imagepalettecopy($image, $image_p);
        imagefill($image_p, 0, 0, $colorTransparent);
        imagecolortransparent($image_p, $colorTransparent);
        imagetruecolortopalette($image_p, true, 256);
        imagecopyresized($image_p, $image, $targetX, $targetY, $sourceX, $sourceY, $destWidth, $destHeight, $currentWidth, $currentHeight);
    }else if($destType == 'image/png' || $destType == 'image/x-png'){
        // Disable alpha blending to keep the alpha channel
        imagealphablending($image_p, false);
        imagesavealpha($image_p, true);
        $transparent = imagecolorallocatealpha($image_p, 255, 255, 255, 127);

        imagefilledrectangle($image_p, 0, 0, $resourceWidth, $resourceHeight, $transparent);
        imagecopyresampled($image_p, $image, $targetX, $targetY, $sourceX, $sourceY, $destWidth, $destHeight, $currentWidth, $currentHeight);
    }else{
        // Turn off alpha blending to keep the alpha channel
        imagealphablending($image_p, false);
        imagecopyresampled($image_p, $image, $targetX, $targetY, $sourceX, $sourceY, $destWidth, $destHeight, $currentWidth, $currentHeight);
    }

    // Output

    // Test if type is png
    if($destType == 'image/png' || $destType == 'image/x-png'){
        imagepng($image_p, $destPath);
    }elseif($destType == 'image/gif'){
        imagegif($image_p, $destPath);
    }else{
        // We default to use jpeg
        imagejpeg($image_p, $destPath, $imgQuality);
    }

}

/**
 * @param      $content
 * @param null $length
 * @return mixed|string
 */
function buckys_trunc_content($content, $length = null){
    //remove Youtube Url
    $pattern = "/\[youtube.*\](.*)\[\/youtube\]/i";
    $content = preg_replace($pattern, '$1', $content);
    if($length != null && strlen($content) > $length){
        return substr($content, 0, $length) . "...";
    }else{
        return $content;
    }
}

/**
 * @param $url
 * @return mixed
 */
function buckys_get_youtube_video_id($url){
    $url = str_replace('&amp;', '&', $url);
    if(strpos($url, 'http://www.youtube.com/embed/') !== false || strpos($url, 'https://www.youtube.com/embed/') !== false) // If Embed URL
    {
        return str_replace(['http://www.youtube.com/embed/', 'https://www.youtube.com/embed/'], ['', ''], $url);
    }

    parse_str(parse_url($url, PHP_URL_QUERY), $array_of_vars);
    return $array_of_vars['v'];
}

/**
 * @param $to
 * @param $toName
 * @param $subject
 * @param $body
 * @throws Exception
 * @throws phpmailerException
 */
function buckys_sendmail($to, $toName, $subject, $body){
    require_once(DIR_FS_INCLUDES . "phpMailer/class.phpmailer.php");

    $mail = new PHPMailer();

	
	//tls or ssl
	if(SITE_USING_SSL)
		$mail->SMTPSecure = 'ssl';
	else
		$mail->SMTPSecure = 'tls';

    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    
    $mail->Port = SMTP_PORT;
    $mail->Host = SMTP_HOST;
    $mail->Username = SMTP_USERNAME;
    $mail->Password = SMTP_PASSWORD;

    $mail->AddAddress($to, $toName);
    $mail->SetFrom(TNB_SUPPORT_EMAIL, TNB_SITE_NAME . ' - Support');
    $mail->Subject = $subject;
    $mail->Body = $body;

    $mail->Send();
}

/**
 * Include Panel
 *
 * @param String $panel
 */
function buckys_get_panel($panel, $params = []){
    global $TNB_GLOBALS;

    if(file_exists(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/panel/" . $panel . ".php")){
        if(!empty($params)){
            extract($params);
        }
        require_once(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/panel/" . $panel . ".php");
    }
}

/**
 * Validate the Youtube Video Id
 *
 * @param $youtubeURL
 * @return bool
 */
function buckys_validate_youtube_url($youtubeURL){
    $youtubeID = trim(buckys_get_youtube_video_id($youtubeURL));

    if(!$youtubeID)
        return false;

    $url = 'http://gdata.youtube.com/feeds/api/videos/' . $youtubeID;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    if(strtolower(trim($result)) == 'invalid id')
        return false;else
        return true;
}

/**
 * Store Session before redirect

 */
function buckys_exit(){
    buckys_session_close();
    exit;
}

/**
 * Encrypt ID for security

 */
function buckys_encrypt_id($gID){
    if(!isset($_SESSION['user_encrypt_salt'])){
        $salt = '';
        for($i = 0; $i < 20; $i++){
            $salt .= mt_rand() . time();
        }

        $salt = md5($salt);

        $_SESSION['user_encrypt_salt'] = $salt;
    }else{
        $salt = $_SESSION['user_encrypt_salt'];
    }

    $encrypted = md5($salt . $gID . $salt);

    return $encrypted;
}

/**
 * Check ID Encrypted Value
 */
function buckys_check_id_encrypted($gID, $encrypted){
    if(!isset($_SESSION['user_encrypt_salt'])){
        return false;
        /*if( $userID != $encrypted )
            return false;
        else
            return true;*/
    }else{
        if(buckys_encrypt_id($gID) == $encrypted)
            return true;else
            return false;
    }
}

/**
 * pagination
 *
 * @param array  $records
 * @param int    $currentPageNum
 * @param string $baseUrl
 * @param int    $recordPerPage
 * @return array
 */
function fn_buckys_pagination($records, $baseUrl, $currentPageNum, $recordPerPage){

    global $TNB_GLOBALS;

    $newRecords = [];

    if(!isset($currentPageNum) || !is_numeric($currentPageNum) || $currentPageNum <= 0)
        $currentPageNum = 1;

    if(count($records) > 0){

        $totalPages = intval(count($records) / $recordPerPage);

        if(count($records) % $recordPerPage > 0)
            $totalPages++;

        if($currentPageNum > $totalPages){
            $currentPageNum = $totalPages;

            if($currentPageNum == 0)
                $currentPageNum = 1;

            //=================== Page should be redirected ===================//
            $newPageUrl = $_SERVER['REQUEST_URI'];

            $newPageUrlArr = parse_url($newPageUrl);
            $newPageUrl = $newPageUrlArr['path'];
            $argStr = $newPageUrlArr['query'];

            parse_str($argStr, $outResult);
            $newArgList = [];
            if(count($outResult) > 0){
                foreach($outResult as $key => $val){
                    if($key != 'page')
                        $newArgList[] = $key . '=' . $val;
                }
                $newArgList[] = 'page=' . $currentPageNum;
            }

            $newPageUrl .= '?' . implode('&', $newArgList);

            buckys_redirect($newPageUrl); //redirect
            //-------------------------------------------------------------------//

        }

        $startIndex = ($currentPageNum - 1) * $recordPerPage;
        $endIndex = $currentPageNum * $recordPerPage;

        if(count($records) < $endIndex){
            $endIndex = count($records);
        }

        /* new index for records */
        foreach($records as $recData){
            $newRecords[] = $recData;
        }
        $records = $newRecords;
        $newRecords = [];

        for($idx = $startIndex; $idx < $endIndex; $idx++){
            $newRecords[] = $records[$idx];
        }

        $parsedUrl = parse_url($baseUrl);
        if($parsedUrl['query'] == ''){
            $baseUrl = rtrim($baseUrl, '?') . '?';
        }else{
            $baseUrl = rtrim($baseUrl, '&') . '&';
        }

        $TNB_GLOBALS['commonPagination'] = ['startIndex' => $startIndex + 1, 'endIndex' => $endIndex, 'totalRecords' => count($records), 'totalPages' => $totalPages, 'currentPage' => $currentPageNum, 'baseUrl' => $baseUrl, 'currentRecords' => count($newRecords)];

    }

    return $newRecords;

}

/**
 * Get trade item/shop product first image's thumb.
 *
 * @param string $imageString : formatted as follows /images/trade/ .... | ....| ....
 * @param        boolean      isTradeItem :true if it is trade item's thumb
 * @return string
 */
function fn_buckys_get_item_first_image_thumb($imageString, $isTradeItem = true){

    $imageList = [];
    if($imageString != '')
        $imageList = explode("|", $imageString);

    $thumbFileName = '';

    if(count($imageList) > 0){

        $thumbPathInfo = pathinfo($imageList[0]);

        if($isTradeItem)
            $thumbFileName = $thumbPathInfo['dirname'] . "/" . $thumbPathInfo['filename'] . TRADE_ITEM_IMAGE_THUMB_SUFFIX . "." . $thumbPathInfo['extension'];
        // testing this for new thumb images
        // $thumbFileName = $thumbPathInfo['dirname'] . "/" . $thumbPathInfo['filename'] . "." . $thumbPathInfo['extension'];
        else
            $thumbFileName = $thumbPathInfo['dirname'] . "/" . $thumbPathInfo['filename'] . SHOP_PRODUCT_IMAGE_THUMB_SUFFIX . "." . $thumbPathInfo['extension'];
    }else{
        $thumbFileName = '/images/trade/no-image-thumb.jpg';
    }

    return $thumbFileName;

}

/**
 * Get trade item/shop product first image, display normal ratio.
 *
 * @param string $imageString : formated as follows /images/trade/ .... | ....| ....
 * @param        boolean      isTradeItem :true if it is trade item's thumb
 * @return string
 */
function fn_buckys_get_item_first_image_normal($imageString, $isTradeItem = true){

    $imageList = [];

    if($imageString != '')
        $imageList = explode("|", $imageString);

    $thumbFileName = '';

    if(count($imageList) > 0){
        $thumbPathInfo = pathinfo($imageList[0]);
        if($isTradeItem)
            $thumbFileName = $thumbPathInfo['dirname'] . "/" . $thumbPathInfo['filename'] . "." . $thumbPathInfo['extension'];else
            $thumbFileName = $thumbPathInfo['dirname'] . "/" . $thumbPathInfo['filename'] . "." . $thumbPathInfo['extension'];
    }else{
        $thumbFileName = '/images/trade/no-image-thumb.jpg';
    }

    return $thumbFileName;
}

/**
 * Get time left in format of 5d 4h, trade item and shop products
 *
 * @param      $expiryTimeStr
 * @param bool $isTradeItem
 * @return string
 */
function fn_buckys_get_item_time_left($expiryTimeStr, $isTradeItem = true){

    $timeLeftStr = '';

    if($expiryTimeStr == '0000-00-00 00:00:00')
        return 'Unlimited';

    $timeLeft = strtotime($expiryTimeStr) - time();

    if($timeLeft > 0){
        $dayLeft = intval($timeLeft / 3600 / 24);

        if($dayLeft > 0){
            $timeLeftStr = $dayLeft . "d ";
            $timeLeft -= $dayLeft * 3600 * 24;
            $hourLeft = intval($timeLeft / 3600);

            $timeLeftStr .= $hourLeft . "h";
        }else{

            $hourLeft = intval($timeLeft / 3600);

            $timeLeftStr = $hourLeft . "h ";

            $timeLeft -= $hourLeft * 3600;
            $minLeft = intval($timeLeft / 60);
            $timeLeftStr .= $minLeft . "m ";
        }

    }else{
        $timeLeftStr = '0';
    }

    return $timeLeftStr;
}

/**
 * Get time past after creating.
 *
 * @param string $createdTimeStr : time
 * @return string
 */
function fn_buckys_get_item_time_past($createdTimeStr){

    $timePastStr = '';

    $timePast = time() - strtotime($createdTimeStr);

    if($timePast > 0){
        $dayPast = intval($timePast / 3600 / 24);

        if($dayPast > 0){
            $timePastStr = $dayPast . "d ";
            $timePast -= $dayPast * 3600 * 24;
            $hourPast = intval($timePast / 3600);

            $timePastStr .= $hourPast . "h";
        }else{

            $hourPast = intval($timePast / 3600);
            $timePastStr = $hourPast . "h ";

            $timePast -= $hourPast * 3600;
            $minPast = intval($timePast / 60);
            $timePastStr .= $minPast . "m ";
        }

    }else{
        $timePastStr = '0';
    }

    return $timePastStr;
}

/**
 * Get Trade Item Search URL
 *
 * @param string $query
 * @param string $catStr
 * @param string $locationStr
 * @param string $sort
 * @param mixed  $page
 * @return string
 */
function buckys_trade_search_url($query, $catStr, $locationStr, $sort, $userID, $page = null){

    $query = trim($query);
    $catStr = trim($catStr);
    $locationStr = trim($locationStr);
    $sort = trim($sort);

    $tmpParamList = [];
    if($query != ''){
        $tmpParamList[] = 'q=' . urlencode($query);
    }
    if($catStr != ''){
        $tmpParamList[] = 'cat=' . urlencode($catStr);
    }
    if($locationStr != ''){
        $tmpParamList[] = 'loc=' . urlencode($locationStr);
    }
    if($sort != ''){
        $tmpParamList[] = 'sort=' . urlencode($sort);
    }
    if($userID != ''){
        $tmpParamList[] = 'user=' . urlencode($userID);
    }

    $paginationUrlBase = '';

    if(count($tmpParamList) > 0)
        $paginationUrlBase = '/trade/search.php?' . implode('&', $tmpParamList);else
        $paginationUrlBase = '/trade/search.php';

    return $paginationUrlBase;

}

/**
 * Get Page & People Search URL
 *
 * @param string $query
 * @param string $type
 * @return string
 */
function buckys_pp_search_url($query, $type, $sort, $addLastSymFlag = true){

    $query = trim($query);
    $type = trim($type);

    $tmpParamList = [];
    if($query != ''){
        $tmpParamList[] = 'q=' . urlencode($query);
    }
    if($type != ''){
        $tmpParamList[] = 'type=' . urlencode($type);
    }
    if($sort != ''){
        $tmpParamList[] = 'sort=' . urlencode($sort);
    }

    if(count($tmpParamList) > 0){
        $paginationUrlBase = '/search.php?' . implode('&', $tmpParamList) . ($addLastSymFlag ? '&' : '');
    }else{
        $paginationUrlBase = '/search.php' . $addLastSymFlag ? '?' : '';
    }

    return $paginationUrlBase;

}

/**
 * Get Shop Product Search URL
 *
 * @param string $query
 * @param string $catStr
 * @param string $locationStr
 * @param string $sort
 * @param mixed  $page
 * @return string
 */
function buckys_shop_search_url($query, $catStr, $locationStr, $sort, $userID, $page = null){

    $query = trim($query);
    $catStr = trim($catStr);
    $locationStr = trim($locationStr);
    $sort = trim($sort);

    $tmpParamList = [];
    if($query != ''){
        $tmpParamList[] = 'q=' . urlencode($query);
    }
    if($catStr != ''){
        $tmpParamList[] = 'cat=' . urlencode($catStr);
    }
    if($locationStr != ''){
        $tmpParamList[] = 'loc=' . urlencode($locationStr);
    }
    if($sort != ''){
        $tmpParamList[] = 'sort=' . urlencode($sort);
    }
    if($userID != ''){
        $tmpParamList[] = 'user=' . urlencode($userID);
    }

    if(count($tmpParamList) > 0)
        $paginationUrlBase = '/shop/search.php?' . implode('&', $tmpParamList);else
        $paginationUrlBase = '/shop/search.php';

    return $paginationUrlBase;

}

/**
 * Get country by ID
 *
 * @param integer $countryID
 */
function fn_buckys_get_country_name($countryID){
    $countryIns = new BuckysCountry();
    $countryData = $countryIns->getCountryById($countryID);

    if($countryData){
        return $countryData['country_title'];
    }
    return;
}

/**
 * @param      $str
 * @param bool $urlDecode
 * @return string
 */
function get_secure_string($str, $urlDecode = false){

    if($urlDecode){
        return trim(urldecode(strip_tags($str)));
    }else{
        return trim(strip_tags($str));
    }

}

/**
 * @param $string
 * @return mixed
 */
function buckys_escape_query_string($string){
    global $db;

    $converts = ['<' => '&lt;', '>' => '&gt;', "'" => '&#039;', '"' => '&quot;'];

    $string = str_replace(array_keys($converts), array_values($converts), $string);

    return $string;

}

/**
 * @param $val
 * @return array|int|null
 */
function buckys_escape_query_integer($val){
    if(is_array($val)){
        $nVal = [];
        foreach($val as $i => $v){
            if(is_numeric($v))
                $nVal[] = intval($v);
        }
        return $nVal;
    }else{
        if(is_numeric($val))
            return intval($val);else
            return null;
    }

}

/**
 * @param $str
 * @return int|null
 */
function get_secure_integer($str){
    if(is_numeric($str))
        return intval($str);else
        return null;
}

/**
 * @param      $string
 * @param      $length
 * @param bool $stripHTML
 * @return string
 */
function buckys_truncate_string($string, $length, $stripHTML = true){
    if($stripHTML == true)
        $string = strip_tags($string);

    $offset = 3;

    if(strlen($string) < $length - $offset)
        return $string;

    return substr($string, 0, $length - $offset) . '...';
}

/**
 * It will find URL in string, and change them to be clickable (add them to <a> tag)
 *
 * @param string $text
 * @param string $targetWindow
 * @return mixed
 */
function buckys_make_links_clickable($text, $targetWindow = '_blank'){
    return preg_replace(['/(?(?=<a[^>]*>.+<\/a>)
             (?:<a[^>]*>.+<\/a>)
             |
             ([^="\']?)((?:https?|ftp|bf2|):\/\/[^<> \n\r]+)
         )/iex', '/<a([^>]*)target="?[^"\']+"?/i', '/<a([^>]+)>/i', '/(^|\s)(www.[^<> \n\r]+)/iex', '/(([_A-Za-z0-9-]+)(\\.[_A-Za-z0-9-]+)*@([A-Za-z0-9-]+)
       (\\.[A-Za-z0-9-]+)*)/iex'], ["stripslashes((strlen('\\2')>0?'\\1<a href=\"\\2\">\\2</a>\\3':'\\0'))", '<a\\1', '<a\\1 target="' . $targetWindow . '">', "stripslashes((strlen('\\2')>0?'\\1<a href=\"//\\2\">\\2</a>\\3':'\\0'))", "stripslashes((strlen('\\2')>0?'<a href=\"mailto:\\0\">\\0</a>':'\\0'))"], $text);
}

/**
 * @param int  $length
 * @param bool $complicated
 * @return string
 */
function buckys_generate_random_string($length = 8, $complicated = false){
    $alphabets = 'abcdefghijklmnopqrstuvwABCDEFGHIJKLMKOPQRSTUVW1234567890';
    if($complicated)
        $alphabets .= '!@#$%^&*()';

    $str = '';
    for($i = 0; $i < $length; $i++)
        $str .= $alphabets[mt_rand(0, strlen($alphabets) - 1)];

    return $str;
}

/**
 * @param      $price
 * @param bool $showToString
 * @return int|string
 */
function fn_buckys_get_btc_price_formated($price, $showToString = false){

    if($showToString == true){
        if(is_numeric($price)){
            $price = number_format($price, 4);

            if(strpos($price, '.') === false){
                $price = ltrim($price, '0');
            }else{
                //                $price = trim($price, '0');
            }

            return $price;
        }else
            return '.0000';
    }else{
        if(is_numeric($price))
            return number_format($price, 4);else
            return 0;
    }

}

/**
 * @param $buyerID
 * @param $productID
 * @return null
 */
function fn_buckys_get_available_shipping_price($buyerID, $productID){
    $shopProductIns = new BuckysShopProduct();
    $shippingInfoIns = new BuckysTradeUser();

    $myShippingData = $shippingInfoIns->getUserByID($buyerID);
    $productShippingInfo = $shopProductIns->getShippingPrice($productID);

    $availableShippingPrice = null;

    if($myShippingData){
        if(is_numeric($myShippingData['shippingCountryID']) && $myShippingData['shippingCountryID'] > 0){
            if(is_array($productShippingInfo) && count($productShippingInfo) > 0){
                foreach($productShippingInfo as $shippingData){
                    if($shippingData['locationID'] == $myShippingData['shippingCountryID']){
                        $availableShippingPrice = $shippingData['price'];
                    }else if($shippingData['locationID'] == BuckysShopProduct::SHIPPING_LOCATION_WORLDWIDE && $availableShippingPrice == null){
                        $availableShippingPrice = $shippingData['price'];
                    }
                }
            }
        }
    }

    return $availableShippingPrice;

}

/**
 * @param $password
 * @return bool
 */
function buckys_check_password_strength($password){
    //Password should be more than 8 characters
    if(strlen($password) < 8){
        return false;
    }

    //Should include at least 1 number
    if(!preg_match('/[0-9]+/', $password)){
        return false;
    }

    return true;
}

/**
 * Get Secure Token for the site security
 *
 * @param mixed $forceNew
 * @return null|string
 */
function buckys_get_form_token($forceNew = false){
    $token = isset($_SESSION['form.token']) ? $_SESSION['form.token'] : null;

    if($token === null || $forceNew){
        $token = buckys_generate_random_string(12);
        $session_name = session_name();
        $token = md5($token . $session_name);
        $_SESSION['form.token'] = $token;
    }

    return $token;
}

/**
 * Check token exists or not
 *
 * @param mixed $method
 * @return bool
 */
function buckys_check_form_token($method = 'post'){
    $token = buckys_get_form_token();
    if($method == 'post'){
        if(isset($_POST[$token]) && $_POST[$token] == 1)
            return true;
    }else if($method == 'get'){
        if(isset($_GET[$token]) && $_GET[$token] == 1)
            return true;
    }else if($method == 'request'){
        if(isset($_REQUEST[$token]) && $_REQUEST[$token] == 1)
            return true;
    }
    return false;
}

/**
 * Token URL Param
 *
 * @param bool $forceNew
 * @return string
 */
function buckys_get_token_param($forceNew = false){
    return '&' . buckys_get_form_token($forceNew) . "=1";
}

/**
 * @param $content
 * @return mixed
 */
function buckys_remove_tags_inside_code($content){
    $pattern = "/\[code\](((?!\[code\]).)+)\[\/code\]/ims";
    $content = preg_replace_callback($pattern, '_buckys_remove_html_tags', $content);

    return $content;
}

/**
 * @param $matches
 * @return string
 * @throws Exception
 */
function _buckys_remove_html_tags($matches){
    //Convert HTML Codes
    $bbcodeParser = new BuckysBBCodeNodeContainerDocument();
    $string = $matches[1];
    $html = $bbcodeParser->parse($string)->detect_links()->detect_emails()->detect_emoticons()->get_html();

    $string = _escape_brackets($string);

    return strip_tags('[code]' . $string . '[/code]');
}

/**
 * @param $content
 * @return mixed
 */
function _escape_brackets($content){
    $content = str_replace(["[", "]"], ["&#91;", "&#93;"], $content);
    return $content;
}

/**
 * @param $content
 * @return mixed
 */
function buckys_remove_invalid_image_urls($content){
    $pattern = "/\[img\](((?!\[img\]).)+)\[\/img\]/im";

    $content = preg_replace_callback($pattern, '_buckys_remove_invalid_image_urls', $content);

    return $content;
}

/**
 * @param $matches
 * @return string
 */
function _buckys_remove_invalid_image_urls($matches){
    global $TNB_GLOBALS;

    $info = pathinfo($matches[1]);
    //Check image or not
    if(!in_array(strtolower($info['extension']), $TNB_GLOBALS['imageTypes'])){
        return '';
    }else{
        return $matches[0];
    }
}

/**
 * @param      $userID
 * @param bool $first_only
 * @return string
 */
function buckys_get_user_name($userID, $first_only = false){
    global $db;

    $query = $db->prepare("SELECT firstName, lastName FROM " . TABLE_USERS . " WHERE userID=%d", $userID);
    $row = $db->getRow($query);

    if(!$row)
        return "";

    if($first_only)
        return $row['firstName'];

    return $row['firstName'] . " " . $row['lastName'];
}