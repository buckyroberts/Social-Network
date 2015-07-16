<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}

$userIns = new BuckysUser();
$pageIns = new BuckysPage();
$pageFollowerIns = new BuckysPageFollower();

$searchResult = $view['search_result'];
$ranking = 1;

?>

<script type="text/javascript">

</script>

<section id="main_section">

    <?php buckys_get_panel('top_search'); ?>


    <section id="main_content" class="search-result-panel">

        <?php render_result_messages(); ?>

        <div class="search-result-list">
            <?php
            if(count($searchResult) > 0){
                foreach($searchResult as $data){
                    if($data['type'] == 'user'){
                        //Display user
                        $userData = $userIns->getUserData($data['userID']);

                        if(empty($userData))
                            continue;

                        $profileLink = '/profile.php?user=' . $userData['userID'];
                        $sendMessageLink = '/messages_compose.php?to=' . $userData['userID'];
                        ?>
                        <div class="node">

                            <?php if(isset($_GET['sort']) && $_GET['sort'] == 'reputation'){ ?>
                                <div class="ranking">
                                    <?php
                                    if($page > 1){
                                        echo $ranking + (30 * ($page - 1));
                                        $ranking++;
                                    }else{
                                        echo $ranking;
                                        $ranking++;
                                    }
                                    echo ".";
                                    ?>
                                </div>
                            <?php } ?>

                            <div class="img-cont"><?php render_profile_link($userData, 'thumbIcon'); ?></div>
                            <div class="desc">
                                <a href="<?php echo $profileLink; ?>"
                                    class="desc-title"><?php echo $userData['firstName'] . ' ' . $userData['lastName']; ?></a>
                                <br/>
                                <?php // if ($userData['gender_visibility'] == 1) echo $userData['gender'] . '<br/>';
                                ?>
                                <?php if($userData['birthdate_visibility'] == 1 && $userData['birthdate'] != '0000-00-00' && strtotime($userData['birthdate']) !== false)
                                    echo date('F j, Y', strtotime($userData['birthdate'])) . '<br/>'; ?>
                                <?php echo number_format($data['PPFollowers']) ?> friend<?php if($data['PPFollowers'] != 1)
                                    echo 's'; ?>
                            </div>
                            <div class="profile-page-stats">
                                <span class="stat-title">Profile &amp; Page Stats</span><br/> <span
                                    class="stat-details">Page followers: <?php echo number_format($userData['pageFollowers']) ?></span><br/>
                                <span
                                    class="stat-details">Likes received: <?php echo number_format($userData['likes']) ?></span><br/>
                                <span
                                    class="stat-details">Comments received: <?php echo number_format($userData['comments']) ?></span>
                            </div>
                            <div class="forum-stats">
                                <span class="stat-title">Forum Stats</span><br/> <span
                                    class="stat-details">+1s received: <?php echo number_format($userData['voteUps']) ?></span><br/>
                                <span
                                    class="stat-details">Replies received: <?php echo number_format($userData['replies']) ?></span><br/>
                            </div>
                            <div class="reputation">
                                Points: <span
                                    style="color:#16A085;"><?php echo number_format($userData['reputation']) ?></span><br/>

                                <!-- Top 3 Trophies -->
                                <?php if(isset($_GET['sort']) && $_GET['sort'] == 'reputation' && ($page == 1 || !isset($page)) && !isset($_GET['q'])){ ?>

                                    <?php if($ranking == 2){ ?>
                                        <div class="imgWrap">
                                            <img src="/images/badges/first_trophy.png" class="badge"/> <span
                                                class="imgDescription">1st in Points</span>
                                        </div>
                                    <?php } ?>

                                    <?php if($ranking == 3){ ?>
                                        <div class="imgWrap">
                                            <img src="/images/badges/second_trophy.png" class="badge"/> <span
                                                class="imgDescription">2nd in Points</span>
                                        </div>
                                    <?php } ?>

                                    <?php if($ranking == 4){ ?>
                                        <div class="imgWrap">
                                            <img src="/images/badges/third_trophy.png" class="badge"/> <span
                                                class="imgDescription">3rd in Points</span>
                                        </div>
                                    <?php } ?>

                                <?php } ?>
                                <!-- End top 3 Trophies -->

                                <?php if($data['PPFollowers'] > 500){ ?>
                                    <div class="imgWrap">
                                        <img src="/images/badges/bronze_branches.png" class="badge"/> <span
                                            class="imgDescription">500 friends</span>
                                    </div>
                                <?php } ?>

                                <?php if($userData['reputation'] > 10000){ ?>
                                    <div class="imgWrap">
                                        <img src="/images/badges/gold_shield.png" class="badge"/> <span
                                            class="imgDescription">10,000 points</span>
                                    </div>
                                <?php }else if($userData['reputation'] > 2500){ ?>
                                    <div class="imgWrap">
                                        <img src="/images/badges/silver_shield.png" class="badge"/> <span
                                            class="imgDescription">2,500 points</span>
                                    </div>
                                <?php }else if($userData['reputation'] > 1000){ ?>
                                    <div class="imgWrap">
                                        <img src="/images/badges/bronze_shield.png" class="badge"/> <span
                                            class="imgDescription">1,000 points</span>
                                    </div>
                                <?php } ?>


                                <?php if($userData['likes'] > 1000){ ?>
                                    <div class="imgWrap">
                                        <img src="/images/badges/gold_branches.png" class="badge"/> <span
                                            class="imgDescription">1,000 likes</span>
                                    </div>
                                <?php } ?>

                                <?php if($userData['comments'] > 1000){ ?>
                                    <div class="imgWrap">
                                        <img src="/images/badges/bronze_medal.png" class="badge"/> <span
                                            class="imgDescription">1,000 comments</span>
                                    </div>
                                <?php } ?>

                                <?php if($userData['voteUps'] > 500){ ?>
                                    <div class="imgWrap">
                                        <img src="/images/badges/gold_coin.png" class="badge"/> <span
                                            class="imgDescription">500 forum +1s</span>
                                    </div>
                                <?php } ?>

                                <?php if($userData['replies'] > 500){ ?>
                                    <div class="imgWrap">
                                        <img src="/images/badges/gold_pin.png" class="badge"/> <span
                                            class="imgDescription">500 forum replies</span>
                                    </div>
                                <?php } ?>

                                <?php if($userData['pageFollowers'] > 500){ ?>
                                    <div class="imgWrap">
                                        <img src="/images/badges/blue_wings.png" class="badge"/> <span
                                            class="imgDescription">500 page followers</span>
                                    </div>
                                <?php } ?>

                            </div>

                            <div class="action">
                                    <span class="friend-actions">
                                    <?php
                                    if(($userID = buckys_is_logged_in()) && $userID != $userData['userID']):

                                        if(($fid = BuckysFriend::isFriend($userID, $userData['userID']))){
                                            ?>
                                            <a href="/myfriends.php?action=unfriend&friendID=<?php echo $userData['userID']?><?php echo buckys_get_token_param()?>&return=<?php echo base64_encode("/profile.php?user=" . $userData['userID']) ?>"
                                                data-type="buckys-ajax-link">Unfriend</a>
                                            <br/>
                                        <?php
                                        }else{
                                            //Check Friend Request
                                            if(($fid = BuckysFriend::isSentFriendRequest($userID, $userData['userID']))){
                                                ?>
                                                <a href="/myfriends.php?action=delete&friendID=<?php echo $userData['userID']?><?php echo buckys_get_token_param()?>&return=<?php echo base64_encode("/profile.php?user=" . $userData['userID']) ?>"
                                                    data-type="buckys-ajax-link">Delete Friend Request</a>
                                                <br/>
                                            <?php
                                            }else if(($fid = BuckysFriend::isSentFriendRequest($userData['userID'], $userID))){
                                                ?>
                                                <a href="/myfriends.php?action=accept&friendID=<?php echo $userData['userID'] ?><?php echo buckys_get_token_param() ?>&return=<?php echo base64_encode("/profile.php?user=" . $userData['userID']) ?>"
                                                    data-type="buckys-ajax-link">Approve Friend Request</a>
                                                <br/>
                                                <a href="/myfriends.php?action=decline&friendID=<?php echo $userData['userID'] ?><?php echo buckys_get_token_param() ?>&return=<?php echo base64_encode("/profile.php?user=" . $userData['userID']) ?>"
                                                    data-type="buckys-ajax-link">Decline Friend Request</a>
                                                <br/>
                                            <?php
                                            }else{
                                                ?>
                                                <a href="/myfriends.php?action=request&friendID=<?php echo $userData['userID'] ?><?php echo buckys_get_token_param() ?>&friendIDHash=<?php echo buckys_encrypt_id($userData['userID']) ?>&return=<?php echo base64_encode("/profile.php?user=" . $userData['userID']) ?>"
                                                    data-type="buckys-ajax-link">Send Friend Request</a>
                                                <br/>
                                            <?php
                                            }
                                        }

                                    endif;
                                    ?>
                                    </span> <a href="<?php echo $sendMessageLink; ?>">Send Message</a> <br/>
                            </div>

                            <div class="clear"></div>
                        </div>
                    <?php

                    }else{
                        //Display Page

                        $pageData = $pageIns->getPageByID($data['pageID']);
                        $followerCount = $pageFollowerIns->getNumberOfFollowers($data['pageID']);

                        if(empty($pageData))
                            continue;

                        $pageLink = '/page.php?pid=' . $pageData['pageID'];

                        ?>
                        <div class="node">
                            <div class="img-cont"><?php render_pagethumb_link($pageData, 'thumbIcon'); ?></div>
                            <div class="desc">
                                <a href="<?php echo $pageLink; ?>"
                                    class="desc-title"><?php echo $pageData['title']; ?></a><br/>
                                <span><?php echo number_format($data['PPFollowers']) ?> follower<?php if($data['PPFollowers'] != 1)
                                        echo 's'; ?></span>
                            </div>
                            <div class="about">
                                <?php
                                echo substr($pageData['about'], 0, 250);
                                if(strlen($pageData['about']) > 250){
                                    echo " ...";
                                }
                                ?>
                            </div>
                            <div class="action">
                                <?php if(($userID = buckys_is_logged_in())): ?>
                                    <?php
                                    if(BuckysPageFollower::isFollower($userID, $pageData['pageID'])){
                                        echo sprintf('<a href="/page.php?pid=%d&action=unfollow' . buckys_get_token_param() . '" data-type="buckys-ajax-link">Unfollow Page</a> <br/>', $pageData['pageID']);
                                    }else{
                                        echo sprintf('<a href="/page.php?pid=%d&action=follow' . buckys_get_token_param() . '" data-type="buckys-ajax-link">Follow Page</a> <br/>', $pageData['pageID']);
                                    }
                                    ?>
                                <?php else: ?>
                                    <a href="<?php echo $pageLink; ?>">View Page</a>
                                <?php endif; ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php

                    }
                }
            }else{
                echo '<div class="no-data">Nothing to see here.</div>';
            }

            ?>
        </div>

        <?php $pagination->renderPaginate($view['page_base_url'], count($searchResult)); ?>

    </section>
</section>
