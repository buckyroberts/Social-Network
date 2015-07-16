<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>

    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <?php echo render_result_messages() ?>
            <div id="send-bitcoins">
                <h2 class="titles">Send Bitcoins</h2>

                <form name="sentbitcoinsform" id="sentbitcoinsform" action="/wallet.php" method="post"
                    autocomplete="off">
                    <div class="row" id="receiverholder">
                        <label>To: </label> <input type="text" class="input" name="receiver" id="receiver"
                            placeholder="Bitcoin Address of Recipient"/>

                        <div class="clear"></div>
                    </div>
                    <div class="row">
                        <label>Amount: </label> <input type="text" class="input" name="amount" id="amount"
                            autocomplete="off"/> BTC
                        <div class="clear"></div>
                    </div>
                    <div class="row">
                        <label>Password: </label> <input type="password" autocomplete="off" class="input" value=""
                            style="display: none;"/> <input type="password" autocomplete="off" class="input"
                            name="password" id="password" value=""/>

                        <div class="clear"></div>
                    </div>
                    <div class="row">
                        <label>&nbsp;</label> <input type="submit" id="send-bitcoins-btn" value="Send Bitcoins"
                            class="redButton"/>

                        <div class="clear"></div>
                    </div>
                    <input type="hidden" name="action" value="send-bitcoins"/>
                    <?php render_form_token() ?>
                </form>
            </div>
            <div id="my-wallet">
                <h2 class="titles">My Wallet</h2>
                <br/>

                <div class="row">
                    <label>Balance: </label> <?php echo $bitcoinBalance / 100000000 ?> BTC
                </div>
                <div class="row">
                    <label>My Bitcoin Address: </label> <?php echo $bitcoinInfo['bitcoin_address'] ?>
                </div>
                <div class="row">
                    <img src="https://blockchain.info/qr?data=<?php echo $bitcoinInfo['bitcoin_address'] ?>&size=100"
                        style="margin: 10px 0px 0px 110px;"/>
                </div>
            </div>
            <div class="clear"></div>
            <div id="bitcoin-activities">
                <h2 class="titles">Recent Activity</h2>

                <div class="row">
                    <div class="table">
                        <?php if(count($transactions) > 0){ ?>
                            <div class="thead">
                                <div class="td td-addr">To/From</div>
                                <div class="td td-name">Name</div>
                                <div class="td td-amount">Amount</div>
                                <div class="td td-balance">Balance</div>
                                <div class="td td-date">Date</div>
                                <div class="clear"></div>
                            </div>
                            <?php foreach($transactions as $row){ ?>
                                <div class="tr">
                                    <div class="td td-addr">
                                        <?php
                                        echo str_replace("\n", "<br />", $row['addr']);
                                        ?>
                                    </div>
                                    <div class="td td-name">
                                        <?php
                                        $tAddrs = explode("\n", $row['addr']);
                                        foreach($tAddrs as $addr){
                                            $tUserInfo = $bitcoinClass->getUserInfoFromAddr($addr);
                                            if($tUserInfo){
                                                ?>
                                                <a href="/profile.php?user=<?php echo $tUserInfo['userID']?>"><?php echo $tUserInfo['firstName'] . " " . $tUserInfo['lastName']?></a>
                                                <br/>
                                            <?php
                                            }elseif($row['addr'] == TNB_BITCOIN_ADDRESS){
                                                echo '<a href="/ads/index.php">BuckysRoomAds</a>';
                                            }elseif($row['addr'] == TRADE_TNB_LISTING_FEE_RECEIVER_BITCOIN_ADDRESS){
                                                echo '<a href="/trade/index.php">BuckysRoomTrade</a>';
                                            }elseif($row['addr'] == SHOP_TNB_LISTING_FEE_RECEIVER_BITCOIN_ADDRESS){
                                                echo '<a href="/shop/index.php">BuckysRoomShop</a>';
                                            }else{
                                                echo '<span style="color:#999999;">Unknown</span><br />';
                                            }
                                        }

                                        ?>
                                    </div>
                                    <div class="td td-amount">
                                <span class="bitcoin-<?php echo $row['type'] ?>">
                                <?php
                                $tAmounts = explode("\n", $row['amount']);
                                foreach($tAmounts as $amount)
                                    echo $amount / 100000000 . ' BTC <br />';
                                ?>                                
                                </span>
                                    </div>
                                    <div class="td td-balance">
                                        <?php
                                        echo $row['balance'] / 100000000;
                                        ?>
                                        BTC
                                    </div>
                                    <div class="td td-date">
                                        <?php echo buckys_format_date(date("Y-m-d H:i:s", $row['date'])); ?>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            <?php } ?>
                            <br/>
                            <?php $pagination->renderPaginate('/wallet.php?', count($transactions)); ?>
                        <?php }else{ ?>
                            <div class="tr noborder">
                                Nothing to see here.
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    </section>
</section>