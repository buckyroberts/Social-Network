<?php
/**
 * Index Page Layout
 */

if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <section id="main_content" class="tops_content">
        <?php render_result_messages(); ?>
        <!-- Top Images -->
        <h2 class="titles">
            Popular
            <?php
            switch($type){
                case 'image':
                    echo 'Images';
                    break;
                case 'video':
                    echo 'Videos';
                    break;
                case 'text':
                default:
                    echo 'Posts';
                    break;

            }
            ?>
        </h2>

        <div class="index_selectDates">
            <a href="/tops.php?type=<?php echo $type ?>&period=today"
                class="select-period-link <?php echo $period == 'today' ? "currentDateSelection" : "" ?>">Today</a> &middot;<a
                class="select-period-link <?php echo $period == 'this-week' ? "currentDateSelection" : "" ?>"
                href="/tops.php?type=<?php echo $type ?>&period=this-week">This Week</a> &middot;
            <a href="/tops.php?type=<?php echo $type ?>&period=this-month"
                class="select-period-link  <?php echo $period == 'this-month' ? "currentDateSelection" : "" ?>">This Month</a> &middot;
            <a href="/tops.php?type=<?php echo $type ?>"
                class="select-period-link  <?php echo $period == 'all' ? "currentDateSelection" : "" ?>">All Time</a>
        </div>
        <?php if($type == 'image'): ?>
            <div class="top-images">
                <?php render_top_images($results); ?>
            </div>
        <?php elseif($type == 'video'): ?>
            <div class="top-videos">
                <?php render_top_videos($results); ?>
            </div>
        <?php elseif($type == 'text'): ?>
            <div class="top-posts">
                <?php render_top_posts($results); ?>
            </div>
        <?php endif; ?>
        <div class="clear"></div>
        <?php $pagination->renderPaginate("/tops.php?type=" . $type . "&period=" . $period . "&", count($results)); ?>
    </section>
</section>