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
    <?php buckys_get_panel('forum_left_panel') ?>
    <section id="forum-content-wrapper">
        <section id="main_content">
            <?php if(isset($hierarchical)){ ?>
                <div id="breadcrumbs">
                    <a href="/forum">Forum Home</a>
                    <?php foreach($hierarchical as $cr){ ?>
                        &gt;
                        <a href="/forum/<?php echo $cr['parentID'] == 0 ? 'index.php' : 'category.php' ?>?id=<?php echo $cr['categoryID'] ?>"><?php echo $cr['categoryName'] ?></a>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php render_result_messages() ?>
            <table cellpadding="0" cellspacing="0" class="forumlist">
                <?php foreach($categories as $cat){ ?>
                    <thead>
                    <tr>
                        <th style="padding:0px;padding-bottom:5px;"
                            class="titles"><?php echo $cat['categoryName'] ?></th>
                        <th style="padding:0px;">Last Post</th>
                        <th style="padding:0px;" class="td-counts">Topics</th>
                        <th style="padding:0px;" class="td-counts">Replies</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($cat['children'] as $idx => $subCat){
                        $categoryDescription = BuckysForumCategory::getCategoryDescription($subCat['categoryID']);
                        ?>
                        <tr <?php echo $idx == count($cat['children']) - 1 ? 'class="last-tr"' : '' ?>>
                            <td class="first-column" style="padding-left:0px; font-size:12px;" width="50%">
                                <a href="/forum/category.php?id=<?php echo $subCat['categoryID'] ?>"><img
                                        src="/images/forum/icons/<?php echo $subCat['categoryID'] ?>.png"
                                        class="poster-icon"></a> <a
                                    href="/forum/category.php?id=<?php echo $subCat['categoryID'] ?>"
                                    style="font-weight:bold;"><?php echo $subCat['categoryName'] ?></a> <br/> <span
                                    style="color:#999999;font-size:11px;"><?php echo $categoryDescription; ?></span>
                            </td>
                            <td>
                                <?php
                                if($subCat['lastTopicID'] > 0){
                                    echo '<a href="/profile.php?user=' . $subCat['lastPosterID'] . '"><img src="' . BuckysUser::getProfileIcon($subCat['lastPosterID']) . '" class="poster-icon" /></a>';
                                    echo "<a href='/forum/topic.php?id=" . $subCat['lastTopicID'] . "'>";
                                    if(strlen($subCat['lastPostTitle']) > 200)
                                        echo substr($subCat['lastPostTitle'], 0, 195) . "...";else
                                        echo $subCat['lastPostTitle'];
                                    echo "</a><br />";
                                    ?>
                                    <a style="font-weight:bold;"
                                        href="/profile.php?user=<?php echo $subCat['lastPosterID']?>"><?php echo $subCat['lastPosterName']?></a>
                                    <?php
                                    echo '<span style="color: #999999;">';
                                    echo buckys_format_date($subCat['lastPostDate']);
                                    echo '</span>';
                                }else{
                                    echo "-";
                                }
                                ?>
                            </td>
                            <td class="td-counts"><?php echo $subCat['topics'] ?></td>
                            <td class="td-counts"><?php echo $subCat['replies'] ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                <?php } ?>
            </table>
        </section>
        <!-- Right ADs Side -->
        <section id="forum-right-bar">
            <?php buckys_get_panel('forum_ad_panel') ?>
        </section>
    </section>
</section>
