<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

$classPublisherAd = new BuckysPublisherAds();
$bannerHTML = $classPublisherAd->renderAd($_GET['ad']);

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <style type="text/css">
            *{
                margin: 0;
                padding: 0;
                color: #333333;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 12px;
            }

            /*** publisher.css Starts Here ***/
            .buckysroom-ad-banner table{
                border: solid 1px #006699;
            }

            .buckysroom-ad-banner td{
                padding: 0;
            }

            .buckysroom-ad{
                padding: 0 8px;
                white-space: -moz-pre-wrap !important;
                white-space: -pre-wrap;
                white-space: -o-pre-wrap;
                white-space: pre-wrap;
                word-wrap: break-word;
                white-space: normal;
            }

            .bsroom-ad-title{
                color: #006699;
                font-size: 14px;
                text-decoration: underline;
                line-height: 18px;
                font-weight: bold;
            }

            .bsroom-ad-desc{
                color: #999999;
                font-size: 12px;
                line-height: 18px;
            }

            a.bsroom-ad-link{
                color: #C0392B;
                font-size: 12px;
                line-height: 18px;
                word-wrap: normal;
                text-decoration: none;
            }

            /*** Ad Styles (Start of Copy) ***/

            /* 180 x 150 - Small rectangle*/
            .small_rectangle{
            }

            /* 300 x 250 - Medium rectangle*/
            .medium_rectangle .bsroom-ad-title,
            .medium_rectangle .bsroom-ad-desc,
            .medium_rectangle .bsroom-ad-link{
                font-size: 12px;
                line-height: 16px;
            }

            /* 336 x 280 - Large rectangle */
            .large_rectangle{
            }

            /* 728 x 90 - Leaderboard */
            .leaderboard{
            }

            /* 970 x 90 - Large leaderboard */
            .large_leaderboard .bsroom-ad-title,
            .large_leaderboard .bsroom-ad-desc,
            .large_leaderboard .bsroom-ad-link{
                font-size: 12px;
                line-height: 16px;
            }

            /* 120 x 600 - Skyscraper */
            .buckysroom-ad-banner .skyscraper{
            }

            .skyscraper .bsroom-ad-title,
            .skyscraper .bsroom-ad-desc{
                font-size: 12px;
                line-height: 14px;
            }

            .skyscraper .bsroom-ad-link{
                font-size: 9px;
                line-height: 12px;
            }

            /* 240 x 400 - Fat skyscraper */
            /* 160 x 600 - Wide skyscraper */
            .wide_skyscraper .bsroom-ad-link{
                font-size: 12px;
                line-height: 12px;
            }

            /* 230 x 600 - Bucky's skyscraper */
            /* 300 x 600 - Large skyscraper */
            .large_skyscraper .bsroom-ad-title,
            .large_skyscraper .bsroom-ad-desc,
            .large_skyscraper .bsroom-ad-link{
                font-size: 14px;
            }

            /* 234 x 60 - Half banner */
            .half_banner .bsroom-ad-title,
            .half_banner .bsroom-ad-desc{
                font-size: 11px;
                line-height: 12px;
            }

            .half_banner .bsroom-ad-link{
                display: none;
            }

            /* 468 x 60 - Banner */
            .banner .bsroom-ad-title,
            .banner .bsroom-ad-desc{
                font-size: 11px;
                line-height: 12px;
            }

            .banner .bsroom-ad-link{
                display: none;
            }

            /* 120 x 240 - Vertical banner */
            .vertical_banner .bsroom-ad-title,
            .vertical_banner .bsroom-ad-desc{
            }

            .vertical_banner .bsroom-ad-link{
                font-size: 11px;
            }

            /* 125 x 125 - Button */
            .button .bsroom-ad-title,
            .button .bsroom-ad-desc,
            .button .bsroom-ad-link{
                font-size: 11px;
                line-height: 15px;
            }

            /* 200 x 200 - Small square */
            .small_square .bsroom-ad-title,
            .small_square .bsroom-ad-desc,
            .small_square .bsroom-ad-link{
                font-size: 11px;
            }

            /* 250 x 250 - Square */
            .square .bsroom-ad-title,
            .square .bsroom-ad-desc,
            .square .bsroom-ad-link{
                font-size: 11px;
                line-height: 16px;
            }

            .buckysroom-ad-image a{
                line-height: 100%;
            }

            /*** Ad Styles (End of Copy) ***/

        </style>
    </head>
    <body style="overflow:hidden;">
    <?php echo $bannerHTML ?>
    </body>
    </html>
<?php
