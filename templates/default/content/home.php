<?php
/**
 * Index Page Layout
 */

if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}

?>
<section id="main_home_section">

    <!-- Left -->
    <aside id="home-left-bar">

        <?php if(buckys_is_logged_in()){ ?>

            <div
                class="user-name"><?php echo $TNB_GLOBALS['user']['firstName'] . " " . $TNB_GLOBALS['user']['lastName'] ?></div>
            <div class="user-thumbnail">
                <a href="/profile.php?user=<?php echo $TNB_GLOBALS['user']['userID'] ?>">
                    <?php if(!$TNB_GLOBALS['user']['thumbnail']){ ?>
                        <img src="<?php echo DIR_WS_IMAGE . 'defaultProfileImage.png' ?>"/>
                    <?php }else{ ?>
                        <img
                            src="<?php echo DIR_WS_PHOTO . 'users/' . $TNB_GLOBALS['user']['userID'] . '/resized/' . $TNB_GLOBALS['user']['thumbnail'] ?>"/>
                    <?php } ?>
                </a>
            </div>

        <?php } ?>

        <dl>
            <dd>
                <a href="/videos_beauty.php"> <img src="/images/homepage_images/white/heart_thin.png"
                        style="background:#9B59B6">

                    <div id="link-text">Beauty</div>
                </a>
            </dd>
            <dd>
                <a href="/videos_business.php"> <img src="/images/homepage_images/white/graph_thin.png"
                        class="bg-color-2">

                    <div id="link-text">Business</div>
                </a>
            </dd>
            <dd>
                <a href="/videos.php"> <img src="/images/homepage_images/white/computer_thin.png" class="bg-color-3">

                    <div id="link-text">Computer Science</div>
                </a>
            </dd>
            <dd>
                <a href="/videos_food.php"> <img src="/images/homepage_images/white/bacon_thin.png" class="bg-color-4">

                    <div id="link-text">Cooking</div>
                </a>
            </dd>
            <dd>
                <a href="/videos_humanities.php"> <img src="/images/homepage_images/white/book_thin.png"
                        class="bg-color-5">

                    <div id="link-text">Humanities</div>
                </a>
            </dd>
            <dd>
                <a href="/videos_math.php"> <img src="/images/homepage_images/white/math_thin.png" class="bg-color-6">

                    <div id="link-text">Math</div>
                </a>
            </dd>
            <dd>
                <a href="/videos_science.php"> <img src="/images/homepage_images/white/science_thin.png"
                        class="bg-color-1">

                    <div id="link-text">Science</div>
                </a>
            </dd>
            <dd>
                <a href="/videos_social.php"> <img src="/images/homepage_images/white/globe_thin.png"
                        class="bg-color-2">

                    <div id="link-text">Social Sciences</div>
                </a>
            </dd>
            <dd>
                <a href="/forum"> <img src="/images/homepage_images/white/forum_thin.png" class="bg-color-3">

                    <div id="link-text">Forum</div>
                </a>
            </dd>

            <?php if(!buckys_is_logged_in()){ ?>
                <dd>
                    <a href="/register.php"> <img src="/images/homepage_images/white/signup_thin.png"
                            class="bg-color-4">

                        <div id="link-text">Create an Account</div>
                    </a>
                </dd>
            <?php } ?>

        </dl>

    </aside>

    <!-- Right -->
    <section id="home-right">

        <?php render_result_messages(); ?>

        <?php /* if(!buckys_is_logged_in()) { ?>
			<div id="home-title-1">Welcome to thenewboston!</div>
			<div id="homepage_description">Welcome to the worlds largest collection of free tutorials on the web. Feel free to browse through our library of over 7,000 videos and tutorials!</div>
		<?php } */ ?>

        <?php if(!buckys_is_logged_in()){ ?>
            <a href="/register.php"> <img src="https://www.thenewboston.com/images/homepage_images/main_homepage_01.png"
                    style="margin-top:7px; margin-bottom:5px;"> </a>
        <?php }else{ ?>
            <a href="/account.php"> <img src="https://www.thenewboston.com/images/homepage_images/main_homepage_01.png"
                    style="margin-top:7px; margin-bottom:5px;"> </a>
        <?php } ?>

        <!-- Popular Courses -->
        <div id="popular_courses">
            <div id="home-title-2">Most Popular Courses <a href="/videos.php" class="mini-link">(view more)</a></div>
            <div class="item">
                <a href="/videos.php?cat=16"><img src="https://www.thenewboston.com/images/videos/cpp.png"></a> <a
                    href="/videos.php?cat=16" class="title">C++</a> <br/> <span class="desc"><a href="/videos.php"
                        class="desc">Computer Science</a> | 73 videos</span>
            </div>
            <div class="item">
                <a href="/videos_humanities.php?cat=98"><img
                        src="https://www.thenewboston.com/images/videos/python.png"></a> <a
                    href="/videos_humanities.php?cat=98" class="title">Python for Beginners</a> <br/> <span
                    class="desc"><a href="/videos.php" class="desc">Computer Science</a> | 48 videos</span>
            </div>
            <div class="item">
                <a href="/videos.php?cat=31"><img
                        src="https://www.thenewboston.com/images/videos/java_beginners.png"></a> <a
                    href="/videos.php?cat=31" class="title">Java - Beginners</a> <br/> <span class="desc"><a
                        href="/videos.php" class="desc">Computer Science</a> | 87 videos</span>
            </div>
            <div class="item">
                <a href="/videos.php?cat=43"><img src="https://www.thenewboston.com/images/videos/html5.png"></a> <a
                    href="/videos.php?cat=43" class="title">HTML5 Web Design</a> <br/> <span class="desc"><a
                        href="/videos.php" class="desc">Computer Science</a> | 53 videos</span>
            </div>
            <div class="item">
                <a href="/videos_social.php?cat=199"><img
                        src="https://www.thenewboston.com/images/video_categories/199.png"></a> <a
                    href="/videos_social.php?cat=199" class="title">World History II</a> <br/> <span class="desc"><a
                        href="/videos_humanities.php" class="desc">Humanities</a> | 17 videos</span>
            </div>
            <div class="item">
                <a href="/videos.php?cat=49"><img src="https://www.thenewboston.com/images/videos/mysql.png"></a> <a
                    href="/videos.php?cat=49" class="title">MySQL Database for Beginners</a> <br/> <span class="desc"><a
                        href="/videos.php" class="desc">Computer Science</a> | 53 videos</span>
            </div>
            <div class="item last">
                <a href="/videos_science.php?cat=35"><img
                        src="https://www.thenewboston.com/images/video_categories/35.png"></a> <a
                    href="/videos_science.php?cat=35" class="title">Physics</a> <br/> <span class="desc"><a
                        href="/videos_science.php" class="desc">Science</a> | 45 videos</span>
            </div>
        </div>

        <!-- Trending Forums -->
        <div id="right_panel">
            <div id="home-title-2">Trending Community Forums <a href="/forum/search_forums.php"
                    class="mini-link">(view all)</a></div>

            <div class="item">
                <a href="/forum/category.php?id=194"><img
                        src="https://www.thenewboston.com/images/forum/logos/d181a3083266d12ee49ca0658ffa1ab5.jpg"></a>
                <a href="/forum/category.php?id=194" class="title">Material Design</a> <br/> <span
                    class="desc">Material design is a comprehensive guide for visual, motion, and interaction design across platforms and devices.</span>
            </div>

            <div class="item">
                <a href="/forum/category.php?id=10"><img
                        src="https://www.thenewboston.com/images/forum/logos/dfdfdb6ea30dd264d092183442b4ec5c.png"></a>
                <a href="/forum/category.php?id=10" class="title">Java / Android Development</a> <br/> <span
                    class="desc">Java is a very popular language used to create desktop applications, website applets, and Android apps.</span>
            </div>

            <div class="item">
                <a href="/forum/category.php?id=187"><img
                        src="https://www.thenewboston.com/images/forum/logos/34899a116c6a9dc52527360dca909c34.png"></a>
                <a href="/forum/category.php?id=187" class="title">Node.js</a> <br/> <span
                    class="desc">Node.js is a platform built on Chrome's JavaScript runtime for easily building fast, scalable, awesome real-time applications.</span>
            </div>

            <div class="item">
                <a href="/forum/category.php?id=11"><img
                        src="https://www.thenewboston.com/images/forum/logos/11.png"></a> <a
                    href="/forum/category.php?id=11" class="title">Javascript</a> <br/> <span
                    class="desc">A scripting language that is added to standard HTML to create interactive effects, apps, games for the browser.</span>
            </div>
            <div class="item last">
                <a href="/forum/category.php?id=14"><img
                        src="https://www.thenewboston.com/images/forum/logos/14.png"></a> <a
                    href="/forum/category.php?id=14" class="title">PHP</a> <br/> <span
                    class="desc">PHP is a language used to create dynamic web pages.</span>
            </div>

        </div>

    </section>

</section>