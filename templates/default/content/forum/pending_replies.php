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
    <?php buckys_get_panel('forum_left_panel') ?>
    <section id="forum-content-wrapper">
        <section id="main_content">
            <?php render_result_messages() ?>
            <h2 class="titles">
                Pending Replies
                <?php if($pagination->total_page > 1){ ?>
                    - Page <?php echo $pagination->getCurrentPage() ?>
                <?php } ?>
            </h2>

            <form name="pendingrepliesform" id="pendingrepliesform" action="/forum/pending_replies.php" method="post">
                <input type="hidden" name="action" value=""/>
                <table cellpadding="0" cellspacing="0" class="pending-items">
                    <?php if(count($replies) > 0){ ?>
                        <thead>
                        <tr>
                            <th width="20"><input type="checkbox" id="chk_all"/></th>
                            <th>Topic</th>
                            <th>Reply</th>
                            <th class="no-shrink">User</th>
                            <th class="no-shrink">Created</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <td colspan="6"><?php echo $pagination->renderPaginate('/forum/pending_replies.php?', count($replies)) ?></td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <input type="button" id="approve-btn" value="Approve" class="redButton"
                                    style="margin-right:5px;"/> <input type="button" id="delete-btn" value="Delete"
                                    class="redButton"/>
                            </td>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php
                        foreach($replies as $row){
                            $trow = BuckysForumTopic::getTopic($row['topicID']);
                            ?>
                            <tr>
                                <td class="td-chk">
                                    <input type="checkbox" name="rid[]" value="<?php echo $row['replyID']?>"/></td>
                                <td>
                                    <a href="/forum/topic.php?id=<?php echo $trow['topicID']?>"><?php echo $trow['topicTitle']?></a>
                                </td>
                                <td>
                                    <?php
                                    $bbcodeParser = new BuckysBBCodeNodeContainerDocument();
                                    echo $bbcodeParser->parse($row['replyContent'])->detect_links()->detect_emails()->detect_emoticons()->get_html();
                                    ?>
                                </td>
                                <td>
                                    <a href="/profile.php?user=<?php echo $row['creatorID']?>"
                                        style="font-weight:bold;"><?php echo $row['creatorName']?></a>
                                </td>
                                <td><?php echo buckys_format_date($row['createdDate'])?></td>
                                <td>
                                    <a href="#" class="approve-reply">Approve</a>&nbsp;|&nbsp;<a href="#"
                                        class="delete-reply">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    <?php }else{ ?>
                        <tbody>
                        <tr>
                            <td colspan="6">Nothing to see here</td>
                        </tr>
                        </tbody>
                    <?php } ?>
                </table>
            </form>
        </section>
        <!-- Right ADs Side -->
        <section id="forum-right-bar">
        </section>
    </section>
    <script type="text/javascript">
        jQuery(document).ready(function (){
            var formObj = jQuery('#pendingrepliesform');
            //Approve Topic
            formObj.find('.approve-reply').click(function (){
                formObj.find('input[type="checkbox"]').prop('checked', false);
                jQuery(this).parent().parent().find('.td-chk input[type="checkbox"]').prop('checked', true);
                formObj.find('input[name="action"]').val('approve-reply');
                formObj.submit();

                return false;
            })

            formObj.find('#approve-btn').click(function (){
                if(jQuery('#pendingrepliesform .td-chk input[type="checkbox"]:checked').size() < 1){
                    showMessage(formObj, 'No data selected!', true);
                    return false;
                }
                formObj.find('input[name="action"]').val('approve-reply');
                formObj.submit();
            })

            //Delete Topic
            formObj.find('.delete-reply').click(function (){
                formObj.find('input[type="checkbox"]').prop('checked', false);
                jQuery(this).parent().parent().find('.td-chk input[type="checkbox"]').prop('checked', true);
                formObj.find('input[name="action"]').val('delete-reply');
                if(confirm('Are you sure that you want to delete this reply?'))
                    formObj.submit();

                return false;
            })

            formObj.find('#delete-btn').click(function (){
                if(jQuery('#pendingrepliesform .td-chk input[type="checkbox"]:checked').size() < 1){
                    showMessage(formObj, 'No data selected!', true);
                    return false;
                }
                if(confirm('Are you sure that you want to delete the selected replies?')){
                    formObj.find('input[name="action"]').val('delete-reply');
                    formObj.submit();
                }
            })

        })
    </script>