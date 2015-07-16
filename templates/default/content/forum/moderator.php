<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section" class="forum-main-section">
    <ul id="forum-nav">
        <li class="current"><a href="/forum">Home</a></li>
        <li><a href="/forum/search_topics.php">Search Topics</a></li>
        <li><a href="/forum/search_forums.php">Browse Forums</a></li>
    </ul>

    <!-- Forum Left Menu Bar -->
    <?php buckys_get_panel('forum_left_panel', ['category' => $category]) ?>

    <section id="forum-content-wrapper">
        <section id="main_content">
            <?php render_result_messages() ?>
            <h2 class="titles"><?php echo $category['categoryName'] ?> Moderator Panel</h2>

            <?php if(buckys_is_admin() || buckys_is_moderator() || buckys_is_forum_admin($category['categoryID'])){ ?>
                <h4>Applicants</h4>
                <form action="/forum/moderator.php" method="post">
                    <table class="moderate-list" cellpadding="0" cellspacing="0">
                        <?php if(!$applicants){ ?>
                            <tbody>
                            <tr>
                                <td colspan="2">Nothing to see here.</td>
                            </tr>
                            </tbody>
                        <?php }else{ ?>
                            <thead>
                            <tr>
                                <th width="30px"><input type="checkbox" class="check-all"/></th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" name="action" value="Accept" class="redButton"/> &nbsp; <input
                                        type="submit" name="action" value="Decline" class="redButton"/>
                                </td>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php foreach($applicants as $row): ?>
                                <tr>
                                    <td><input type="checkbox" name="applicant[]" value="<?php echo $row['userID'] ?>"/>
                                    </td>
                                    <td>
                                        <a href="/profile.php?user=<?php echo $row['userID'] ?>" class="left">
                                            <?php if(buckys_not_null($row['thumbnail'])){ ?>
                                                <img
                                                    src="<?php echo DIR_WS_PHOTO . 'users/' . $row['userID'] . '/resized/' . $row['thumbnail']; ?>"
                                                    class="user-icon"/>
                                            <?php }else{ ?>
                                                <img src="<?php echo DIR_WS_IMAGE . 'defaultProfileImage.png'; ?>"
                                                    class="user-icon"/>
                                            <?php } ?>
                                        </a> <a href="/profile.php?user=<?php echo $row['userID'] ?>" class="user-name">
                                            <b><?php echo $row['applicantName']; ?></b> </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        <?php } ?>
                    </table>
                    <?php render_form_token(); ?>
                    <input type="hidden" name="id" value="<?php echo $category['categoryID'] ?>"/>
                </form>
            <?php } ?>

            <div class="divider"></div>
            <h4>Reported Posts</h4>

            <form action="/forum/moderator.php" method="post">
                <table class="moderate-list" cellpadding="0" cellspacing="0">
                    <?php if(!$reported_posts){ ?>
                        <tbody>
                        <tr>
                            <td>Nothing to see here.</td>
                        </tr>
                        </tbody>
                    <?php }else{ ?>
                        <thead>
                        <tr>
                            <th width="30px"><input type="checkbox" class="check-all"/></th>
                            <th>Reported user</th>
                            <th>Item</th>
                            <th>Reported by</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <td colspan="5">
                                <input type="submit" name="action" value="Approve" class="redButton"/> &nbsp; <input
                                    type="submit" name="action" value="Delete" class="redButton"/>
                            </td>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach($reported_posts as $row): ?>
                            <tr>
                                <td><input type="checkbox" name="reportID[]" value="<?php echo $row['reportID'] ?>"/>
                                </td>
                                <td>
                                    <a href="/profile.php?user=<?php echo $row['ownerID'] ?>" class="left">
                                        <?php if(buckys_not_null($row['ownerThumb'])){ ?>
                                            <img
                                                src="<?php echo DIR_WS_PHOTO . 'users/' . $row['ownerID'] . '/resized/' . $row['ownerThumb']; ?>"
                                                class="user-icon"/>
                                        <?php }else{ ?>
                                            <img src="<?php echo DIR_WS_IMAGE . 'defaultProfileImage.png'; ?>"
                                                class="user-icon"/>
                                        <?php } ?>
                                    </a> <a href="/profile.php?user=<?php echo $row['ownerID'] ?>" class="user-name">
                                        <b><?php echo $row['ownerName']; ?></b> </a>
                                </td>
                                <td>
                                    <?php
                                    if($row['objectType'] == 'topic'){
                                        echo '<a href="/forum/topic.php?id=' . $row['topicID'] . '" target="_blank">Forum Topic - ' . $row['topicID'] . '</a>';
                                    }else{
                                        echo '<a href="/forum/topic.php?id=' . $row['topicID'] . '" target="_blank">Forum Reply - ' . $row['topicID'] . '</a>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="/profile.php?user=<?php echo $row['reporterID'] ?>" class="left">
                                        <?php if(buckys_not_null($row['reporterThumb'])){ ?>
                                            <img
                                                src="<?php echo DIR_WS_PHOTO . 'users/' . $row['reporterID'] . '/resized/' . $row['reporterThumb']; ?>"
                                                class="user-icon"/>
                                        <?php }else{ ?>
                                            <img src="<?php echo DIR_WS_IMAGE . 'defaultProfileImage.png'; ?>"
                                                class="user-icon"/>
                                        <?php } ?>
                                    </a> <a href="/profile.php?user=<?php echo $row['reporterID'] ?>" class="user-name">
                                        <b><?php echo $row['reporterName']; ?></b> </a>
                                </td>
                                <td>
                                    <span
                                        class="post-date"><?php echo buckys_format_date($row['reportedDate']) ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    <?php } ?>
                </table>
                <?php render_form_token(); ?>
                <input type="hidden" name="id" value="<?php echo $category['categoryID'] ?>"/>
            </form>

            <div class="divider"></div>
            <h4>Blocked Users</h4>

            <form action="/forum/moderator.php" method="post">
                <select name="blocked_user[]" class="select" id="blocked_users" multiple="multiple" size="10">
                    <?php
                    foreach($blockedUsers as $brow){
                        ?>
                        <option
                            value="<?php echo $brow['userID'] ?>"><?php echo $brow['firstName'] . " " . $brow['lastName'] ?></option>
                    <?php
                    }
                    ?>
                </select><br/>
                <?php render_form_token(); ?>
                <input type="hidden" name="id" value="<?php echo $category['categoryID'] ?>"/> <input type="hidden"
                    name="action" value="unblock-users"/> <br/> <input type="submit" value="Unblock" class="redButton"/>
            </form>

            <?php if(buckys_is_admin() || buckys_is_forum_admin($category['categoryID'])){ ?>
                <div class="divider"></div>
                <h4>Delete <?php echo $category['categoryName'] ?> Forum</h4>
                <form action="/forum/moderator.php" method="post" id="deleteForumForm">
                    <label>Password: </label> <input type="password" class="input" name="pwd" value=""
                        autocomplete="off" size="30"/>
                    <?php render_form_token(); ?>
                    <input type="hidden" name="id" value="<?php echo $category['categoryID'] ?>"/> <input type="hidden"
                        name="action" value="delete-forum"/> <br/> <br/> <input type="submit" value="Delete"
                        class="redButton"/>
                </form>
            <?php } ?>
        </section>
        <!-- Forum Right Panel -->
        <section id="forum-right-bar">
            <?php buckys_get_panel('forum_right_panel', ['category' => $category]); ?>
        </section>
    </section>

</section>
<script type="text/javascript">
    jQuery(document).ready(function (){
        jQuery('.check-all').click(function (){
            if(this.checked)
                jQuery(this).parents('table').find('tbody').find('input[type="checkbox"]').prop("checked", true);else
                jQuery(this).parents('table').find('tbody').find('input[type="checkbox"]').prop("checked", false);
        })

        jQuery('#deleteForumForm').submit(function (){
            if(jQuery(this).find('input[name="pwd"]').val() == ''){
                alert('Please enter your password.')
                jQuery(this).find('input[name="pwd"]').focus();
                return false;
            }

            return confirm('Are you sure that you want to delete the forum?');
        })
    })
</script>