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
            <h2 class="titles">Pending Topics
                <?php if($pagination->total_page > 1){ ?>
                    - Page <?php echo $pagination->getCurrentPage() ?>
                <?php } ?>
            </h2>

            <form name="pendingtopicsform" id="pendingtopicsform" action="/forum/pending_topics.php" method="post">
                <input type="hidden" name="action" value=""/>
                <table cellpadding="0" cellspacing="0" class="pending-items">
                    <?php if(count($topics) > 0){ ?>
                        <thead>
                        <tr style="vertical-align:middle;">
                            <th width="20"><input type="checkbox" id="chk_all"/></th>
                            <th style="padding-left:10px;">Topic</th>
                            <th>Category</th>
                            <th class="no-shrink">User</th>
                            <th class="no-shrink">Created</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <td colspan="6"><?php echo $pagination->renderPaginate('/forum/pending_topics.php?', count($topics)) ?></td>
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
                        <?php foreach($topics as $row){ ?>
                            <tr style="vertical-align:middle;">
                                <td class="td-chk">
                                    <input type="checkbox" name="tid[]" value="<?php echo $row['topicID'] ?>"/></td>
                                <td style="width:60%; padding:3px 10px;">
                                    <a href="/forum/topic.php?id=<?php echo $row['topicID'] ?>"
                                        target="_blank"><?php echo $row['topicTitle'] ?></a>
                                </td>
                                <td><?php echo $row['categoryName'] ?></td>
                                <td>
                                    <a style="font-weight:bold;"
                                        href="/profile.php?user=<?php echo $row['creatorID'] ?>"><?php echo $row['creatorName'] ?></a>
                                </td>
                                <td style="color:#999999;"><?php echo buckys_format_date($row['createdDate']) ?></td>
                                <td><a href="#" class="approve-topic">Approve</a> | <a href="#"
                                        class="delete-topic">Delete</a></td>
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
    </section>
    <!-- Right ADs Side -->
    <section id="forum-right-bar">
    </section>
</section>
<script type="text/javascript">
    jQuery(document).ready(function (){
        var formObj = jQuery('#pendingtopicsform');
        //Approve Topic
        formObj.find('.approve-topic').click(function (){
            formObj.find('input[type="checkbox"]').prop('checked', false);
            jQuery(this).parent().parent().find('.td-chk input[type="checkbox"]').prop('checked', true);
            formObj.find('input[name="action"]').val('approve-topic');
            formObj.submit();

            return false;
        })

        formObj.find('#approve-btn').click(function (){
            if(jQuery('#pendingtopicsform .td-chk input[type="checkbox"]:checked').size() < 1){
                showMessage(formObj, 'No data selected!', true);
                return false;
            }
            formObj.find('input[name="action"]').val('approve-topic');
            formObj.submit();
        })

        //Delete Topic
        formObj.find('.delete-topic').click(function (){
            formObj.find('input[type="checkbox"]').prop('checked', false);
            jQuery(this).parent().parent().find('.td-chk input[type="checkbox"]').prop('checked', true);
            formObj.find('input[name="action"]').val('delete-topic');
            if(confirm('Are you sure that you want to delete this topic?'))
                formObj.submit();

            return false;
        })

        formObj.find('#delete-btn').click(function (){
            if(jQuery('#pendingtopicsform .td-chk input[type="checkbox"]:checked').size() < 1){
                showMessage(formObj, 'No data selected!', true);
                return false;
            }
            if(confirm('Are you sure that you want to delete the selected topics?')){
                formObj.find('input[name="action"]').val('delete-topic');
                formObj.submit();
            }
        })

    })
</script>