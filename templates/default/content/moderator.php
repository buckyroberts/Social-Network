<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>
    <section id="right_side">
        <section id="right_side_padding">
            <?php render_result_messages() ?>
            <div id="current-moderator-box">
                <h2 class="titles">Current Moderators</h2>
                <?php if($currentModerators){ ?>
                    <?php foreach($currentModerators as $m): ?>
                        <p>
                            <a href="/profile.php?user=<?php echo $m['userID']; ?>"><img
                                    src="<?php echo BuckysUser::getProfileIcon($m) ?>"/></a> <a
                                href="/profile.php?user=<?php echo $m['userID']; ?>"
                                style="font-weight:bold;"><?php echo $m['firstName'] . " " . $m['lastName'] ?></a>
                            <?php if(buckys_check_user_acl(USER_ACL_ADMINISTRATOR)){ ?>
                                <span>&middot;</span>
                                <a href="/moderator.php?action=delete-moderator&id=<?php echo $m['userID']; ?>&idHash=<?php echo buckys_encrypt_id($m['userID']); ?>"
                                    class="remove-link"
                                    onclick="return confirm('<?php echo MSG_CONFIRM_DELETE_MODERATOR ?>')">Delete</a>
                            <?php } ?>
                            <br clear="all"/>
                        </p>
                    <?php endforeach; ?>
                <?php } ?>
            </div>
            <div id="apply-moderator-box">
                <?php if(buckys_check_user_acl(USER_ACL_ADMINISTRATOR)){ ?>
                    <form id="addmoderator" name="addmoderator" action="/moderator.php" method="post">
                        <h2 class="titles">Add Moderator</h2>
                        <label>User ID:</label> <input type="text" name="new_moderator_id" id="new_moderator_id"
                            value="" class="input"/>

                        <div class="clear"></div>
                        <input type="submit" value="Add Moderator" class="redButton"/> <input type="hidden"
                            name="action" value="add-moderator"/>
                    </form>
                <?php }else{ ?>
                    <form id="applymoderator" name="applymoderator" action="/moderator.php" method="post">
                        <h2 class="titles">Job Description</h2>

                        <p>Community Moderators are responsible for handling all reported content. This content includes all messages, comments, and posts that have been reported by users. Responsibilities include deciding whether or not to delete or approve reported content, as well as banning users that have abused the site.<br/>
                        </p>
                        <br/>
                        <?php if($myCandidate){ ?>
                            <input type="submit" value="Edit Application" class="redButton"/>
                            <a href="/moderator.php?action=delete-candidate&id=<?php echo $myCandidate['candidateID'] ?>&idHash=<?php echo buckys_encrypt_id($myCandidate['candidateID']) ?>"
                                id="delete-candidate-btn" class="redButton">Delete Application</a>
                            <textarea cols="10" name="moderator_text" id="moderator_text" rows="5"
                                placeholder="Tell us why you would make a good moderator..."><?php echo $myCandidate['candidateText'] ?></textarea>
                            <input type="hidden" name="candidate_id" value="<?php echo $myCandidate['candidateID'] ?>"/>
                        <?php }else{ ?>
                            <input type="submit" value="Apply Now" class="redButton"/><br/>
                            <textarea cols="10" name="moderator_text" id="moderator_text" rows="5"
                                placeholder="Tell us why you would make a good moderator..."></textarea>
                        <?php } ?>
                        <input type="hidden" name="action" value="apply_candidate"/>
                    </form>
                <?php } ?>
            </div>
            <div class="clear"></div>
            <div id="candidates-box">
                <h2 class="titles left">Vote for the Next Moderator</h2>
                <?php if(buckys_check_user_acl(USER_ACL_ADMINISTRATOR)){ ?>
                    <a href="/moderator.php?action=reset-voting" id="reset-voting-link">Reset Voting</a>
                <?php } ?>
                <div class="clear"></div>
                <?php foreach($candidates as $row){ ?>
                    <div class="candidate-row" id="candidate-row<?php echo $row['candidateID'] ?>">
                        <div class="votes  <?php echo $row['voteID'] ? 'voted' : '' ?>">
                            <span
                                class="votes-count"><?php echo $row['votes'] > 0 ? '+' : '' ?><?php echo $row['votes'] ?></span>
                            <a href="#" class="thumb-up" data-id="<?php echo $row['candidateID'] ?>"
                                data-hashed="<?php echo buckys_encrypt_id($row['candidateID']) ?>"></a>
                            <!-- <a href="#" class="thumb-down" data-id="<?php echo $row['candidateID'] ?>" data-hashed="<?php echo buckys_encrypt_id($row['candidateID']) ?>"></a> -->
                            <div class="loading-wrapper"></div>
                        </div>
                        <a href="/profile.php?user=<?php echo $row['userID'] ?>"><img
                                src="<?php echo BuckysUser::getProfileIcon($row) ?>" class="candidateImg"/></a>

                        <div class="candidate-detail">
                            <a style="font-weight:bold;" href="/profile.php?user=<?php echo $row['userID'] ?>">
                                <?php echo $row['firstName'] . " " . $row['lastName'] ?>
                                <?php if(buckys_check_user_acl(USER_ACL_ADMINISTRATOR)){ ?>
                                    (ID: <?php echo $row['userID'] ?>)
                                <?php } ?>
                            </a>

                            <p><?php echo $row['candidateText'] ?></p>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php } ?>
            </div>
            <br/> <br/>
            <?php $pagination->renderPaginate('/moderator.php?', count($candidates)); ?>
        </section>
    </section>
</section>
