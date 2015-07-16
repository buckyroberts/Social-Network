<?php
/**
 * Header.php
 */
if($userID = buckys_is_logged_in()){

    switch($TNB_GLOBALS['headerType']){

        case 'trade':

            ?>
            <header id="main_header">
                <a href="index.php" class="headerLogo">the<span class="secondColor">new</span>boston<span
                        class="secondColor">trade</span></a>

                <div id="rightAlignLinks">
                    <a href="/trade/additem.php" class="headerLinks">Add Item</a> | <a href="/trade/available.php"
                        class="headerLinks">Trade Account</a>
                </div>
            </header>
            <?php

            break;

        case 'shop':

            ?>
            <header id="main_header">
                <a href="index.php" class="headerLogo">the<span class="secondColor">new</span>boston<span
                        class="secondColor">shop</span></a>

                <div id="rightAlignLinks">
                    <a href="/shop/additem.php" class="headerLinks">Sell Item</a> | <a href="/shop/available.php"
                        class="headerLinks">Shop Account</a>
                </div>
            </header>
            <?php

            break;
        case 'forum':

            ?>
            <header id="main_header">
                <a href="index.php" class="headerLogo">the<span class="secondColor">new</span>boston<span
                        class="secondColor">forum</span></a>
            </header>
            <?php

            break;
        case 'ads':

            ?>
            <header id="main_header">
                <a href="index.php" class="headerLogo">the<span class="secondColor">new</span>boston<span
                        class="secondColor">ads</span></a>

                <div id="rightAlignLinks">
                    <a href="/ads/advertiser.php" class="headerLinks">Advertiser Account</a> | <a
                        href="/ads/publisher.php" class="headerLinks">Publisher Panel</a>
                </div>
            </header>
            <?php

            break;
        default:

            $newMessages = BuckysMessage::getNumOfNewMessages($userID);
            ?>
            <header id="main_header">
                <a href="index.php" class="headerLogo">the<span class="secondColor">new</span>boston</a>

                <div id="rightAlignLinks">
                    <a href="/account.php" class="headerLinks">My Account</a> | <a href="/messages_inbox.php"
                        class="headerLinks<?php echo $newMessages > 0 ? 'Bold' : ''?>">Messages<?php echo $newMessages > 0 ? ' (' . $newMessages . ') ' : ''?></a> |
                    <a href="/profile.php?user=<?php echo $userID?>"
                        class="headerLinks"><?php echo $TNB_GLOBALS['user']['firstName']?></a> <a
                        href="/profile.php?user=<?php echo $userID?>"
                        class="headerLinksSmall">(<?php echo number_format($TNB_GLOBALS['user']['reputation'])?>)</a>
                </div>
            </header>
        <?php
    }

}else{
    ?>
    <header id="main_header">
        <?php if($TNB_GLOBALS['headerType'] == 'trade') : ?>
            <a href="index.php" class="headerLogo">the<span class="secondColor">new</span>boston<span
                    class="secondColor">trade</span></a>
        <?php elseif($TNB_GLOBALS['headerType'] == 'ads') : ?>
            <a href="index.php" class="headerLogo">the<span class="secondColor">new</span>boston<span
                    class="secondColor">ads</span></a>
        <?php elseif($TNB_GLOBALS['headerType'] == 'shop') : ?>
            <a href="index.php" class="headerLogo">the<span class="secondColor">new</span>boston<span
                    class="secondColor">shop</span></a>
        <?php elseif($TNB_GLOBALS['headerType'] == 'forum') : ?>
            <a href="index.php" class="headerLogo">the<span class="secondColor">new</span>boston<span
                    class="secondColor">forum</span></a>
        <?php else : ?>
            <a href="index.php" class="headerLogo">the<span class="secondColor">new</span>boston</a>
        <?php endif;?>
    </header>
<?php
}
