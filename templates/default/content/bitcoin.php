<?php
/**
 * Bitcoin Address Page
 */

if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section" class="tinted">

    <!-- Left Side -->
    <?php

    buckys_get_panel('profile_left_sidebar');

    ?>

    <!-- 752px -->
    <section id="right_side">
        <div class="info-box" id="photos-box">

            <h3>Bitcoin Address <a href="/profile.php?user=<?php echo $userData['userID'] ?>"
                    class="view-all">(back to profile)</a>
            </h3>
            <br/>

            <p>Bitcoin address for <a href="/profile.php?user=<?php echo $userData['userID'] ?>"
                    class="view-all"><b><?php echo $userData['firstName'] . " " . $userData['lastName'] ?></b></a>:
            </p>
            <br/>

            <p><b><?php echo $userBitcoinInfo['bitcoin_address'] ?></b></p>
            <br/>

            <p><img src="https://blockchain.info/qr?data=<?php echo $userBitcoinInfo['bitcoin_address'] ?>&size=150"/>
            </p>
        </div>

    </section>
</section>