<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <?php if($TNB_GLOBALS['headerType'] == 'trade'){ ?>
        <meta name="description"
            content="Trade, barter, and swap video games, books, movies, and tons of other stuff online for free!">
        <meta name="keywords"
            content="trade barter websites, trade items online, barter stuff online, swap or trade items, barter sites, things to barter, stuff for trade websites, trading things">
    <?php }else{ ?>
        <meta name="description"
            content="Watch thousands of free educational video tutorials on computer programming, game development, web design, video editing, 3D modeling, iPhone app development, Android app development, and more!">
        <meta name="keywords"
            content="free, educational, videos, tutorials, programming, bucky roberts, thenewboston, learn, css, java, c++, android, python, javascript, php, html5, html, tutorial, mysql, ruby, beginner, introduction, ajax, game development, after effects, photoshop, jquery, social network, buckysroom, bucky's room, source code, forum">
    <?php } ?>


    <?php
    echo isset($TNB_GLOBALS['meta']) ? $TNB_GLOBALS['meta'] : '';
    ?>
    <title><?php echo isset($TNB_GLOBALS['title']) ? $TNB_GLOBALS['title'] : TNB_SITE_NAME ?></title>
    <?php buckys_render_stylesheet(); ?>
    <!--[if lt IE 9]>
    <script src="<?php echo DIR_WS_JS?>html5shiv.js"></script><![endif]-->

    <?php buckys_render_javascripts(false); ?>
</head>
<body>
<?php buckys_get_panel('analyticstracking') ?>

<!-- Preload Images -->
<div id="preload-wrapper">
    <img src="/images/loading.gif"/> <img src="/images/loading1.gif"/> <img src="/images/loading2.gif"/> <img
        src="/images/loading3.gif"/> <img src="/images/loading16.gif"/>
</div>

<div id="wrapper">
    <?php require(dirname(__FILE__) . '/header.php') ?>
    <?php require(dirname(__FILE__) . '/content/' . $TNB_GLOBALS['content'] . '.php') ?>
    <?php require(dirname(__FILE__) . '/footer.php') ?>
</div>

<?php buckys_render_javascripts(true); ?>
</body>
</html>