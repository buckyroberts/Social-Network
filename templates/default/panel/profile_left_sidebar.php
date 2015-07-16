<?php
/**
 * Profile Left Sidebar
 */
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
global $userData, $profileID, $canViewPrivate, $userID;
$totalFriendsCount = BuckysFriend::getNumberOfFriends($profileID);
?>
<aside id="main_aside" style="overflow:visible;"> <!-- 241px -->
    <span class="titles"><?php echo $userData['firstName'] . " " . $userData['lastName']; ?></span> <br/>
    <?php render_profile_link($userData, 'mainProfilePic'); ?>
    <br/> <a
        href="/photos.php?user=<?php echo $userData['userID'] ?>">View All Photos (<?php echo BuckysPost::getNumberOfPhotosByUserID($userData['userID']) ?>)</a>
    <br/>

    <!-- Friend Links -->
    <?php
    if(buckys_not_null($userID) && $userID != $profileID){ //If this is not current logged user, Show Friends, Message Links
        //Show Friend Links
        if(($fid = BuckysFriend::isFriend($userID, $profileID))){
            ?>
            <a href="/myfriends.php?action=unfriend&friendID=<?php echo $profileID?><?php echo buckys_get_token_param()?>&return=<?php echo base64_encode("/profile.php?user=" . $profileID) ?>">Unfriend</a>
            <br/>
        <?php
        }else{
            //Check Friend Request
            if(($fid = BuckysFriend::isSentFriendRequest($userID, $profileID))){
                ?>
                <a href="/myfriends.php?action=delete&friendID=<?php echo $profileID?><?php echo buckys_get_token_param()?>&return=<?php echo base64_encode("/profile.php?user=" . $profileID) ?>">Delete Friend Request</a>
                <br/>
            <?php
            }else if(($fid = BuckysFriend::isSentFriendRequest($profileID, $userID))){
                ?>
                <a href="/myfriends.php?action=accept&friendID=<?php echo $profileID ?><?php echo buckys_get_token_param() ?>&return=<?php echo base64_encode("/profile.php?user=" . $profileID) ?>">Approve Friend Request</a>
                <br/>
                <a href="/myfriends.php?action=decline&friendID=<?php echo $profileID ?><?php echo buckys_get_token_param() ?>&return=<?php echo base64_encode("/profile.php?user=" . $profileID) ?>">Decline Friend Request</a>
                <br/>
            <?php
            }else{
                ?>
                <a href="/myfriends.php?action=request&friendID=<?php echo $profileID ?><?php echo buckys_get_token_param() ?>&return=<?php echo base64_encode("/profile.php?user=" . $profileID) ?>">Send Friend Request</a>
                <br/>
            <?php
            }
        }

        //Show Message
        ?>
        <a href="/messages_compose.php?to=<?php echo $profileID ?>">Send Message</a> <br/>
        <?php
        //For Community Moderator
        if(BuckysModerator::isModerator($userID) && !BuckysBanUser::isBannedUser($profileID)){
            ?>
            <a href="/profile.php?action=ban-user&userID=<?php echo $profileID?>"
                onclick="return confirm('<?php echo MSG_ARE_YOU_SURE_WANT_TO_BAN_THIS_USER ?>')">Ban User</a>
            <br/>
        <?php
        }
        //For Administrator
        if(buckys_check_user_acl(USER_ACL_ADMINISTRATOR)){
            ?>
            <a href="/banned_users.php?action=deletebyid&userID=<?php echo $profileID?>"
                onclick="return confirm('<?php echo MSG_ARE_YOU_SURE_WANT_TO_DELETE_THIS_ACCOUNT ?>')">Delete Account</a>
            <br/>
        <?php
        }
    }
    ?>

    <div id="badge_area">

        <?php if($userData['reputation'] > 10000){ ?>
            <div class="imgWrap">
                <img src="/images/badges/gold_shield.png" class="badge"/> <span
                    class="imgDescription">Respected Member<br/><span class="badge-details">10,000 points</span></span>
            </div>
        <?php }else if($userData['reputation'] > 2500){ ?>
            <div class="imgWrap">
                <img src="/images/badges/silver_shield.png" class="badge"/> <span class="imgDescription">Respected Member<br/><span
                        class="badge-details">2,500 points</span></span>
            </div>
        <?php }else if($userData['reputation'] > 1000){ ?>
            <div class="imgWrap">
                <img src="/images/badges/bronze_shield.png" class="badge"/> <span class="imgDescription">Respected Member<br/><span
                        class="badge-details">1,000 points</span></span>
            </div>
        <?php } ?>

        <?php if($userData['pageFollowers'] > 500){ ?>
            <div class="imgWrap">
                <img src="/images/badges/blue_wings.png" class="badge"/> <span class="imgDescription">Popular Page Creator<br/><span
                        class="badge-details">500 page followers</span></span>
            </div>
        <?php } ?>

        <?php if($userData['likes'] > 1000){ ?>
            <div class="imgWrap">
                <img src="/images/badges/gold_branches.png" class="badge"/> <span class="imgDescription">Exceptional Poster<br/><span
                        class="badge-details">1,000 likes received</span></span>
            </div>
        <?php } ?>

        <?php if($userData['comments'] > 1000){ ?>
            <div class="imgWrap">
                <img src="/images/badges/bronze_medal.png" class="badge"/> <span class="imgDescription">Social Stimulator<br/><span
                        class="badge-details">1,000 comments received</span></span>
            </div>
        <?php } ?>

        <?php if($userData['voteUps'] > 500){ ?>
            <div class="imgWrap">
                <img src="/images/badges/gold_coin.png" class="badge"/> <span
                    class="imgDescription">Giver of Wisdom<br/><span class="badge-details">500 forum +1s</span></span>
            </div>
        <?php } ?>

        <?php if($userData['replies'] > 500){ ?>
            <div class="imgWrap">
                <img src="/images/badges/gold_pin.png" class="badge"/> <span class="imgDescription">Captivating Contributor<br/><span
                        class="badge-details">500 forum replies received</span></span>
            </div>
        <?php } ?>

        <?php if($totalFriendsCount > 500){ ?>
            <div class="imgWrap">
                <img src="/images/badges/bronze_branches.png" class="badge"/> <span
                    class="imgDescription">Well-Loved<br/><span class="badge-details">500 friends</span></span>
            </div>
        <?php } ?>

    </div>

    <!-- About Section -->
    <?php
    //Check it has any data for About Section
    if((buckys_not_null($userData['gender']) && ($userData['gender_visibility'] || $canViewPrivate)) || (($userData['birthdate'] != '0000-00-00') && ($userData['birthdate_visibility'] || $canViewPrivate)) || (($userData['relationship_status'] > 0) && ($userData['relationship_status_visibility'] || $canViewPrivate)) || (buckys_not_null($userData['political_views']) && ($userData['political_views_visibility'] || $canViewPrivate)) || (buckys_not_null($userData['religion']) && ($userData['religion_visibility'] || $canViewPrivate)) || (buckys_not_null($userData['birthplace']) && ($userData['birthplace_visibility'] || $canViewPrivate)) || (buckys_not_null($userData['current_city']) && ($userData['current_city_visibility'] || $canViewPrivate)) || (buckys_not_null($userData['timezone']) && ($userData['timezone_visibility'] || $canViewPrivate))
    ){
        ?>
        <h4>About <?php if($userData['userID'] == $userID){ ?><a href="/info_basic.php">(edit)</a><?php } ?> </h4>
        <div id="infoDisplay">
            <table>
                <tr>
                    <td class="left">Points:</td>
                    <td><span style="color:#16A085;"><?php echo number_format($userData['reputation'])?></span></td>
                </tr>
                <?php if(buckys_not_null($userData['gender']) && ($userData['gender_visibility'] || $canViewPrivate)){ ?>
                    <tr>
                        <td class="left">Gender:</td>
                        <td><?php echo $userData['gender'] ?></td>
                    </tr>
                <?php } ?>
                <?php if(buckys_not_null($userData['birthdate']) && $userData['birthdate'] != '0000-00-00' && ($userData['birthdate_visibility'] || $canViewPrivate)){ ?>
                    <tr>
                        <td class="left">Birthday:</td>
                        <td><?php echo date("F j, Y", strtotime($userData['birthdate'])) ?></td>
                    </tr>
                <?php } ?>
                <?php if($userData['relationship_status'] > 0 && ($userData['relationship_status_visibility'] || $canViewPrivate)){ ?>
                    <tr>
                        <td class="left">Relationship:</td>
                        <td>
                            <?php
                            switch($userData['relationship_status']){
                                case 1:
                                    echo 'Single';
                                    break;
                                case 2:
                                    echo 'In a Relationship';
                                    break;
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                <?php if(buckys_not_null($userData['religion']) && ($userData['religion_visibility'] || $canViewPrivate)){ ?>
                    <tr>
                        <td class="left">Religion:</td>
                        <td><?php echo $userData['religion'] ?></td>
                    </tr>
                <?php } ?>
                <?php if(buckys_not_null($userData['political_views']) && ($userData['political_views_visibility'] || $canViewPrivate)){ ?>
                    <tr>
                        <td class="left">Political Views:</td>
                        <td><?php echo $userData['political_views'] ?></td>
                    </tr>
                <?php } ?>
                <?php if(buckys_not_null($userData['birthplace']) && ($userData['birthplace_visibility'] || $canViewPrivate)){ ?>
                    <tr>
                        <td class="left">Birthplace:</td>
                        <td><?php echo $userData['birthplace'] ?></td>
                    </tr>
                <?php } ?>
                <?php if(buckys_not_null($userData['current_city']) && ($userData['current_city_visibility'] || $canViewPrivate)){ ?>
                    <tr>
                        <td class="left">Current City:</td>
                        <td><?php echo $userData['current_city'] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>

    <?php
    }else{
        ?>
        <h4>About <?php if($userData['userID'] == $userID){ ?><a href="/info_basic.php">(edit)</a><?php } ?> </h4>
        <div id="infoDisplay">
            <table>
                <tr>
                    <td class="left">Points:</td>
                    <td><span style="color:#16A085;"><?php echo number_format($userData['reputation'])?></span></td>
                </tr>
            </table>
        </div>
    <?php
    }
    ?>

    <!-- Education Section -->
    <?php
    //Check the user has educations
    $hasEducations = false;
    foreach($userData['educations'] as $e){
        if($canViewPrivate || $e['visibility']){
            $hasEducations = true;
            break;
        }
    }
    ?>
    <?php if($hasEducations){ ?>
        <h4>Education <?php if($userData['userID'] == $userID){ ?><a href="/info_education.php">(edit)</a><?php } ?>
        </h4>
        <div id="infoDisplay">
            <table>
                <?php
                foreach($userData['educations'] as $e){
                    if($canViewPrivate || $e['visibility']){
                        ?>
                        <tr>
                            <td class="left"><?php echo $e['school']?>:</td>
                            <td class="right-date-col"><?php echo $e['start']?> - <?php echo $e['end']?></td>
                        </tr>
                    <?php
                    }
                }
                ?>
            </table>
        </div>
    <?php } ?>

    <!-- Employment Section -->
    <?php
    //Check the user has employments
    $hasEmployments = false;
    foreach($userData['employments'] as $e){
        if($canViewPrivate || $e['visibility']){
            $hasEmployments = true;
            break;
        }
    }
    ?>
    <?php if($hasEmployments){ ?>
        <h4>Employment <?php if($userData['userID'] == $userID){ ?><a href="/info_employment.php">(edit)</a><?php } ?>
        </h4>
        <div id="infoDisplay">
            <table>
                <?php
                foreach($userData['employments'] as $e){
                    if($canViewPrivate || $e['visibility']){
                        ?>
                        <tr>
                            <td class="left"><?php echo $e['employer']?>:</td>
                            <td class="right-date-col"><?php echo $e['start']?> - <?php echo $e['end']?></td>
                        </tr>
                    <?php
                    }
                }
                ?>
            </table>
        </div>
    <?php } ?>


    <!-- Followed Page Section-->
    <?php

    $pageFollowerIns = new BuckysPageFollower();
    $followedPageData = $pageFollowerIns->getPagesByFollowerID($profileID, 1, 10);

    if(count($followedPageData) > 0){
        ?>
        <h4 style="margin-bottom:10px;">Pages <a href="/follows.php?user=<?php echo $profileID; ?>">(view all)</a></h4>
        <div id="user-following-box" class="info-box">
            <?php
            foreach($followedPageData as $data){
                render_pagethumb_link($data, 'followPageIcons');
            }
            ?>
            <div class="clear"></div>
        </div>

    <?php
    }
    ?>

    <!-- User Links Section -->
    <?php
    //Check the user has links
    $hasLinks = false;
    foreach($userData['links'] as $row){
        if($canViewPrivate || $row['visibility']){
            $hasLinks = true;
            break;
        }
    }
    ?>
    <?php if($hasLinks){ ?>
        <div id="user-links-box" class="info-box">
            <h4 style="margin-bottom:5px;">Links <?php if($userData['userID'] == $userID){ ?>
                    <a href="/info_links.php">(edit)</a><?php } ?> </h4>
            <?php
            foreach($userData['links'] as $row){
                if($canViewPrivate || $row['visibility']){
                    if(strpos($row['url'], "http://") === false && strpos($row['url'], "https://") === false)
                        $row['url'] = "//" . $row['url'];
                    ?>
                    <p><a href='<?php echo $row['url']?>' target="_blank"><?php echo $row['title']?></a></p>
                <?php
                }
            }
            ?>
        </div>
    <?php } ?>

    <!-- User Contact Information Section -->
    <div id="user-contact-box" class="info-box">
        <h4>Contact <?php if($userData['userID'] == $userID){ ?><a href="/info_contact.php">(edit)</a><?php } ?> </h4>
        <?php if($userData['email_visibility'] != -1 && ($canViewPrivate || $userData['email_visibility'] == 1)){ ?>
            <p><label>E-mail:</label> <?php echo $userData['email'] ?></p>
        <?php } ?>
        <!-- Show Phone Numbers -->
        <?php
        if((buckys_not_null($userData['home_phone']) && ($userData['home_phone_visibiltiy'] || $canViewPrivate)) || (buckys_not_null($userData['cell_phone']) && ($userData['cell_phone_visibiltiy'] || $canViewPrivate)) || (buckys_not_null($userData['work_phone']) && ($userData['work_phone_visibiltiy'] || $canViewPrivate))

        ){
            echo "<br />";
            //Display Cell Phone
            if((buckys_not_null($userData['cell_phone']) && ($userData['cell_phone_visibility'] || $canViewPrivate))){
                ?>
                <p><label>Cell Phone:</label> <?php echo $userData['cell_phone']?></p>
            <?php
            }
            //Display Cell Phone
            if((buckys_not_null($userData['home_phone']) && ($userData['home_phone_visibility'] || $canViewPrivate))){
                ?>
                <p><label>Home Phone:</label> <?php echo $userData['home_phone']?></p>
            <?php
            }
            //Display Cell Phone
            if((buckys_not_null($userData['work_phone']) && ($userData['work_phone_visibility'] || $canViewPrivate))){
                ?>
                <p><label>Work Phone:</label> <?php echo $userData['work_phone']?></p>
            <?php
            }

            ?>
        <?php
        }
        ?>
        <!-- Show Messenger Account -->
        <?php
        //Check the user has messenger accounts
        $hasMessenger = false;
        foreach($userData['contact'] as $row){
            if($canViewPrivate || $row['visibility']){
                $hasMessenger = true;
                break;
            }
        }
        if($hasMessenger){
            ?>
            <br/>
            <?php
            foreach($userData['contact'] as $row){
                if($canViewPrivate || $row['visibility']){
                    ?>
                    <p><label><?php echo $row['contact_type']?>:</label> <?php echo $row['contact_name']?></p>
                <?php
                }
            }
        }
        ?>
        <!-- Show User Address -->
        <?php if((buckys_not_null($userData['address1']) || buckys_not_null($userData['address2']) || buckys_not_null($userData['city']) || buckys_not_null($userData['state']) || buckys_not_null($userData['zip']) || buckys_not_null($userData['country'])) && ($userData['address_visibility'] || $canViewPrivate)){
            echo "<br />";
            echo '<p>' . $userData['firstName'] . " " . $userData['lastName'] . '</p>';
            if(buckys_not_null($userData['address1']))
                echo '<p>' . $userData['address1'] . '</p>';
            if(buckys_not_null($userData['address2']))
                echo '<p>' . $userData['address2'] . '</p>';
            if(buckys_not_null($userData['city']) && buckys_not_null($userData['state']))
                echo '<p>' . $userData['city'] . ', ' . $userData['state'] . '</p>';else if(buckys_not_null($userData['city']))
                echo '<p>' . $userData['city'] . '</p>';else if(buckys_not_null($userData['state']))
                echo '<p>' . $userData['state'] . '</p>';
            if(buckys_not_null($userData['zip']))
                echo '<p>' . $userData['zip'] . '</p>';
            if(buckys_not_null($userData['country']))
                echo '<p>' . $userData['country'] . '</p>';

        }
        ?>
    </div>

    <br/>

</aside>