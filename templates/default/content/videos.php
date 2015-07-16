<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>

<section id="main_section" class="videos-wrapper">

    <?php if(isset($category)): ?>
        <aside id="playlist">
            <div>

                <?php if(!$videoSubject){ ?>
                    <a href="/videos.php" class="back">&lt; All Computer Science Tutorials</a>
                <?php }else{ ?>
                    <a href="/videos_<?php echo $videoSubject['subjectName'] ?>.php"
                        class="back">&lt; All <?php echo $videoSubject['subjectTitle'] ?> Videos</a>
                <?php } ?>
            </div>
            <br/>
            <dl>
                <dt>
                <h4><?php echo $category['categoryName'] ?></h4>                </dt>
                <div class="video-count"><?php echo $category['videosCount'] ?> videos</div>
                <?php foreach($categoryVideos as $idx => $v): ?>
                    <dd>
                        <a href="/videos<?php echo isset($videoSubject) ? ("_" . $videoSubject['subjectName']) : "" ?>.php?cat=<?php echo $v['categoryID'] ?>&video=<?php echo $v['videoID'] ?>"
                            class="<?php echo $v['videoID'] == $video['videoID'] ? 'selected category-name' : 'category-name' ?>"><?php echo $idx + 1 ?> - <?php echo $v['title'] ?></a>
                    </dd>
                    <div class="menu-item-divider"></div>
                    <?php
                    if($v['videoID'] == $video['videoID']){
                        $currentVideoTitle = $v['title'];
                        $currentVideo = $idx + 1;
                    }
                    $totalVideos = $idx + 1;
                    ?>
                <?php endforeach; ?>
            </dl>
        </aside>
        <section id="right_side">

            <span
                class="titles"><?php //echo $videoInfo['entry']['title']['$t'] ?> <?php echo $currentVideoTitle; ?></span>

            <div id="youtube_video">
                <iframe width="640" height="360" src="//www.youtube.com/embed/<?php echo $video['code'] ?>"
                    frameborder="0" allowfullscreen></iframe>

                <div class="progress_container">
                    <div class="progress_container_bg">
                        <div class="progress_bar"
                            style="width: <?php echo $currentVideo / $totalVideos * 100; ?>%;"></div>
                    </div>
                </div>
                <div class="clear"></div>

                <div class="paginate">
                    <?php if($prevVideoId != null){ ?>
                        <a href="/videos.php?video=<?php echo $prevVideoId ?>" class="prev-next-button"
                            style="line-height:28px;">Prev</a>
                    <?php } ?>
                    <?php if($nextVideoId != null){ ?>
                        <a href="/videos.php?video=<?php echo $nextVideoId ?>" class="prev-next-button"
                            style="line-height:28px;">Next</a>
                    <?php } ?>
                </div>
                <div class="clear"></div>
            </div>

            <!-- Create Topic Directly -->
            <?php if(($userID = buckys_is_logged_in()) && isset($category) && !BuckysForumModerator::isBlocked($userID, $category['forumCategoryID'])){ ?>
                <div id="forum-above-editor">
                    <span class="video-section-subtitle">Have a question or comment? Start a new discussion here:</span>
                </div>
                <form name="newtopicform" id="newtopicform" action="/forum/create_topic.php" method="post"
                    style="padding-top:5px;">
                    <input type="hidden" name="action" value="create-topic"/> <input type="hidden" name="category"
                        id="category" value="<?php echo $category['forumCategoryID'] ?>"/> <input type="hidden"
                        name="return" id="return" value="<?php echo base64_encode($_SERVER['REQUEST_URI']) ?>"/>
                    <table cellpadding="0" cellspacing="0" class="forumentry">
                        <tr>
                            <td>
                                <input type="text" id="title" name="title" maxlength="500" value="" autocomplete="off"
                                    class="input"
                                    placeholder="Title (ex: Question about <?php echo $currentVideoTitle; ?>)"
                                    style="padding:3px; margin-bottom:1px; width:450px;"/>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <textarea cols="20" id="topic-content" name="content" rows="12" class="textarea"
                                    style="width: 90%;"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="Submit" class="action-button"
                                    style="margin-left:1px;margin-top:2px;"/>
                            </td>
                        </tr>
                    </table>
                    <div class="loading-wrapper">
                        <div></div>
                        <img src="/images/loading.gif" alt="Loading..."></div>

                </form>
                <script type="text/javascript">
                    jQuery(document).ready(function (){
                        jQuery('#topic-content').sceditor({
                            plugins: 'bbcode',
                            emoticonsRoot: '/images/',
                            height: 200,
                            width: 706,
                            enablePasteFiltering: true,
                            style: "/css/sceditor/jquery.sceditor.default.css"
                        });

                        var topicEditor = jQuery('#topic-content').sceditor('instance');

                        jQuery('#newtopicform').submit(function (){
                            var isValid = true;
                            if(jQuery.trim(jQuery('#newtopicform #title').val()) == ''){
                                jQuery('#newtopicform #title').addClass('input-error');
                                isValid = false;
                            }

                            if(!isValid){
                                showMessage(jQuery(this), 'All fields are required.', true);
                                return false;
                            }

                            text = topicEditor.getWysiwygEditorValue();

                            if(text == ''){
                                showMessage(jQuery(this), 'All fields are required.', true)
                                topicEditor.focus();
                                isValid = false;
                            }

                            if($isValid){
                                jQuery('#newtopicform .loading').show();
                            }

                            return isValid;
                        })

                        $('.post-votes a.thumb-up,.post-votes a.thumb-down').click(function (){
                            if($(this).parent().hasClass('voted'))
                                return false;
                            var link = jQuery(this);
                            /*link.parent().find('.loading-wrapper').show();*/
                            jQuery.ajax({
                                url: '/forum/topic.php', data: {
                                    'objectID': link.attr('data-id'),
                                    'objectIDHash': link.attr('data-hashed'),
                                    'objectType': link.attr('data-type'),
                                    'action': link.attr('class')
                                }, type: 'post', dataType: 'xml', success: function (rsp){
                                    if(jQuery(rsp).find('status').text() == 'success'){
                                        link.html(jQuery(rsp).find('votes').text());
                                        link.parent().addClass('voted votedStatus' + (link.attr('class') == 'thumb-up' ? '1' : '-1'));
                                    }else{
                                        alert(jQuery(rsp).find('message').text());
                                    }
                                }, complete: function (){
                                    link.parent().find('.loading-wrapper').hide();
                                }
                            })
                            return false;
                        })
                    })
                </script>
            <?php } ?>

            <?php if(!empty($topics)) : ?>
                <!-- Recent Posts -->
                <div id="forum-recent-posts">
                    <span
                        class="video-section-subtitle left">Recent <?php echo $forumCategory['categoryName']; ?> <?php //echo $category['categoryName']; ?> Forum Discussions</span>
                    <a href="/forum/category.php?id=<?php echo $forumCategory['categoryID'] ?>"
                        style="font-size:11px;">(view all)</a><br/>
                    <table cellpadding="0" cellspacing="0" class="postlist">
                        <tbody>
                        <?php foreach ($topics as $row){ ?>
                        <tr>
                            <td class="post-votes <?php echo !$row['voteID'] ? '' : ('voted votedStatus' . $row['voteStatus']) ?>" <?php echo !$row['voteID'] ? '' : 'title="' . MSG_ALREADY_CASTED_A_VOTE . '"' ?>>
                                <a href="#" class="thumb-up" data-type='topic' data-id="<?php echo $row['topicID'] ?>"
                                    data-hashed="<?php echo buckys_encrypt_id($row['topicID']) ?>">
                                    <?php
                                    if($row['votes'] > 0){
                                        echo '+';
                                    }
                                    echo $row['votes'];
                                    ?>
                                </a>
                            </td>
                            <td class="icon-column">
                                <a style="float: left;" href="/profile.php?user=<?php echo $row['creatorID'] ?>">
                                    <?php if(buckys_not_null($row['creatorThumbnail'])){ ?>
                                        <img
                                            src="<?php echo DIR_WS_PHOTO . 'users/' . $row['creatorID'] . '/resized/' . $row['creatorThumbnail']; ?>"
                                            class="poster-icon"/>
                                    <?php }else{ ?>
                                        <img src="<?php echo DIR_WS_IMAGE . 'defaultProfileImage.png'; ?>"
                                            class="poster-icon"/>
                                    <?php } ?>
                                </a>
                            </td>
                            <td style="width:100%;" class="post-content">
                                <a href="/forum/topic.php?id=<?php echo $row['topicID'] ?>"
                                    class="post-title"><?php echo $row['topicTitle'] ?></a><br/> <a
                                    href="/profile.php?user=<?php echo $row['creatorID'] ?>"
                                    class="poster-name"><?php echo $row['creatorName'] ?></a> &gt;&gt; <a
                                    href="/forum/category.php?id=<?php echo $row['categoryID'] ?>"
                                    class="category-name"><?php echo $row['categoryName'] ?></a> <br/>

                                <a href="/forum/topic.php?id=<?php echo $row['topicID'] ?>"
                                    class="postdate"><?php echo buckys_format_date($row['lastReplyDate']); ?></a>
                                &middot;
                                <a href="/forum/topic.php?id=<?php echo $row['topicID'] ?>"
                                    class="post-replies"><?php echo $row['replies'] . ($row['replies'] != 1 ? ' replies' : ' reply') ?></a>

                            </td>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <br/>
            <?php endif; ?>
        </section>
    <?php else: ?>
        <aside id="main_aside">
            <div class="category-section-title" style="margin-bottom:15px;">
                <?php if(!$videoSubject){ ?>
                    Computer Science Tutorials
                <?php }else{ ?>
                    <?php echo $videoSubject['subjectTitle'] ?> Videos & Tutorials
                <?php } ?>
            </div>
            <?php
            $color = 1;
            foreach($videoCategories as $pCat): ?>
                <dl>
                    <dt>
                    <h4 style="background-color:
                    <?php
                    switch($color){
                        case 1:
                            echo "#2c3e50";
                            $color++;
                            break;
                        case 2:
                            echo "#c0392b";
                            $color++;
                            break;
                        case 3:
                            echo "#16a085";
                            $color++;
                            break;
                        case 4:
                            echo "#8e44ad";
                            $color++;
                            break;
                        case 5:
                            echo "#e67e22";
                            $color++;
                            break;
                        case 6:
                            echo "#2980b9";
                            $color++;
                            break;
                        case 7:
                            echo "#27ae60";
                            $color++;
                            break;
                        default:
                            echo "#2c3e50";
                            break;
                    }
                    ?>
                        "><?php echo $pCat['categoryName'] ?></h4>                    </dt>
                    <?php
                    foreach($pCat['categories'] as $cat):
                        ?>
                        <dd>
                            <a href="/videos<?php echo isset($videoSubject) ? ("_" . $videoSubject['subjectName']) : "" ?>.php?cat=<?php echo $cat['categoryID']?>"
                                class="category-name"><?php echo $cat['categoryName']?>
                                <span
                                    style="font-size:11px; display:none;"> (<?php echo $cat['videosCount']?> videos)</span></a>
                        </dd>
                    <?php
                    endforeach;
                    ?>
                </dl>
            <?php endforeach; ?>
        </aside>
        <section id="right_side">

            <?php if(!buckys_is_logged_in()){ ?>
                <span class="video-section-title">Watch Thousands of Tutorials for Free!</span>
                <div
                    style="margin-top:1px;">Welcome to the worlds largest collection of computer and technology related tutorials on the web. Feel free to browse through our library of over 7,000 videos and tutorials. We have courses in programming, web design, video editing, game development, and more. Join the over 180 million people who have already enjoyed the benefits of online learning.
                    <br/><br/>
                </div>
            <?php } ?>

            <?php if(!$videoSubject){ ?> <!-- Video.php -->
                <span class="video-section-title">Most Popular Video - Node.js Tutorial for Beginners</span>
                <div id="featured_video">
                    <iframe width="640" height="360" src="//www.youtube.com/embed/-u-j7uqU7sI" frameborder="0"
                        allowfullscreen></iframe>
                </div>
                <!-- Share Code -->
                <div class="addthis_sharing_toolbox" style="margin:5px; margin-left:-2px;"></div>
                <div
                    class="video-description">Node.js is a platform built on Chrome's JavaScript runtime for easily building fast, scalable, awesome real-time applications.
                    <a href="videos.php?cat=355">Click here to watch the entire series now.</a></div>
                <span class="video-section-title">Top 10 Courses</span>
                <div id="featured_playlists">
                    <!-- Java -->
                    <div class="item">
                        <a href="/videos.php?cat=31"><img src="/images/videos/java_beginners.png"/></a> <a
                            href="/videos.php?cat=31" class="featured-playlist-title">1.&nbsp; Java - Beginners</a>
                        <span
                            class="featured-playlist-description">Java is an incredibly popular language that is used to create desktop software, games, applets, and Android apps.</span>
                        <a href="/videos.php?cat=31" class="featured-playlist-video-count">87 videos</a>
                    </div>
                    <!-- C++ Programming -->
                    <div class="item">
                        <a href="/videos.php?cat=16"><img src="/images/videos/cpp.png"/></a> <a
                            href="/videos.php?cat=16" class="featured-playlist-title">2.&nbsp; C++</a> <span
                            class="featured-playlist-description">One of the worlds most popular programming languages, C++ is used in many types of software including music players, video games, and many large scale applications.</span>
                        <a href="/videos.php?cat=16" class="featured-playlist-video-count">73 videos</a>
                    </div>
                    <!-- PHP -->
                    <div class="item">
                        <a href="/videos.php?cat=11"><img src="/images/videos/php.png"/></a> <a
                            href="/videos.php?cat=11" class="featured-playlist-title">3.&nbsp; PHP</a> <span
                            class="featured-playlist-description">Server-side, HTML embedded scripting language used to create dynamic Web pages.</span>
                        <a href="/videos.php?cat=11" class="featured-playlist-video-count">200 videos</a>
                    </div>
                    <!-- HTML5 -->
                    <div class="item">
                        <a href="/videos.php?cat=43"><img src="/images/videos/html5.png"/></a> <a
                            href="/videos.php?cat=43" class="featured-playlist-title">4.&nbsp; HTML5 Web Design</a>
                        <span
                            class="featured-playlist-description">HTML5 is the future of web development. Learn to create awesome interactive websites with these tutorials.</span>
                        <a href="/videos.php?cat=43" class="featured-playlist-video-count">53 videos</a>
                    </div>
                    <!-- JavaScript -->
                    <div class="item">
                        <a href="/videos.php?cat=10"><img src="/images/videos/javascript.png"/></a> <a
                            href="/videos.php?cat=10" class="featured-playlist-title">5.&nbsp; JavaScript</a> <span
                            class="featured-playlist-description">JavaScript is a scripting language that is used to create interactive effects, animations, games for the websites.</span>
                        <a href="/videos.php?cat=10" class="featured-playlist-video-count">40 videos</a>
                    </div>
                    <!-- Python -->
                    <div class="item">
                        <a href="/videos.php?cat=98"><img src="/images/videos/python.png"/></a> <a
                            href="/videos.php?cat=98" class="featured-playlist-title">6.&nbsp; Python for Beginners</a>
                        <span
                            class="featured-playlist-description">Designed for the absolute beginner, you will learn Python from the ground up.</span>
                        <a href="/videos.php?cat=98" class="featured-playlist-video-count">48 videos</a>
                    </div>
                    <!-- MySQL -->
                    <div class="item">
                        <a href="/videos.php?cat=49"><img src="/images/videos/mysql.png"/></a> <a
                            href="/videos.php?cat=49"
                            class="featured-playlist-title">7.&nbsp; MySQL Database for Beginners</a> <span
                            class="featured-playlist-description">Go from Beginner to Pro in MySQL Databases with Bucky Roberts.</span>
                        <a href="/videos.php?cat=49" class="featured-playlist-video-count">33 videos</a>
                    </div>
                    <!-- Java - Intermediate -->
                    <div class="item">
                        <a href="/videos.php?cat=25"><img src="/images/videos/java_intermediate.png"/></a> <a
                            href="/videos.php?cat=25" class="featured-playlist-title">8.&nbsp; Java - Intermediate</a>
                        <span
                            class="featured-playlist-description">Finished with the beginner videos? You are now ready for some more advanced topics including networking and learning to make an instant messaging program!</span>
                        <a href="/videos.php?cat=25" class="featured-playlist-video-count">59 videos</a>
                    </div>
                    <!-- jQuery -->
                    <div class="item">
                        <a href="/videos.php?cat=32"><img src="/images/videos/jquery.png"/></a> <a
                            href="/videos.php?cat=32" class="featured-playlist-title">9.&nbsp; jQuery</a> <span
                            class="featured-playlist-description">Learn how to create amazing effects and animations for interactive web applications using the jQuery.</span>
                        <a href="/videos.php?cat=32" class="featured-playlist-video-count">200 videos</a>
                    </div>
                    <!-- UDK -->
                    <div class="item">
                        <a href="/videos.php?cat=12"><img src="/images/videos/udk.png"/></a> <a
                            href="/videos.php?cat=12" class="featured-playlist-title">10.&nbsp; UDK Game Development</a>
                        <span
                            class="featured-playlist-description">For those interested in 3D game development, this is the course for you!</span>
                        <a href="/videos.php?cat=12" class="featured-playlist-video-count">65 videos</a>
                    </div>
                    <div class="clear"></div>
                </div>
            <?php }else{ ?>
                <span
                    class="video-section-title">Most Popular Video - <?php echo $videoSubject['featuredVideoTitle'] ?></span>
                <div id="featured_video">
                    <iframe width="640" height="360"
                        src="//www.youtube.com/embed/<?php echo $videoSubject['featuredVideoCode'] ?>" frameborder="0"
                        allowfullscreen></iframe>
                </div>
                <!-- Share Code -->
                <div class="addthis_sharing_toolbox" style="margin:5px; margin-left:-2px;"></div>
                <div class="video-description"><?php echo $videoSubject['featuredVideoDescription'] ?></div>
                <span class="video-section-title">Top 10 Courses</span>
                <div id="featured_playlists">
                    <?php
                    $topCourses = explode(",", $videoSubject['topCourses']);

                    foreach($topCourses as $idx => $tcID){
                        $tCategory = $videoClass->getCategory($tcID);
                        ?>
                        <div class="item">
                            <a href="/videos_<?php echo $videoSubject['subjectName']?>.php?cat=<?php echo $tcID?>"><img
                                    src="/images/video_categories/<?php echo $tcID?>.png"/></a> <a
                                href="/videos_<?php echo $videoSubject['subjectName']?>.php?cat=<?php echo $tcID?>"
                                class="featured-playlist-title"><?php echo $idx + 1; ?>.&nbsp; <?php echo $tCategory['categoryName']?></a>
                            <span
                                class="featured-playlist-description"><?php echo $tCategory['categoryDescription']?></span>
                            <a href="/videos_<?php echo $videoSubject['subjectName']?>.php?cat=<?php echo $tcID?>"
                                class="featured-playlist-video-count"><?php echo $tCategory['videosCount']?> videos</a>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="clear"></div>
                </div>
            <?php } ?>
            <br/>
        </section>
    <?php endif; ?>

</section>

<!-- Go to www.addthis.com/dashboard to customize your tools 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53b910e169f3bbcf"></script>
-->
