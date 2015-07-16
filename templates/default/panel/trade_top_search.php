<?php
/**
 * Display trade top search box

 */

$tradeCatIns = new BuckysTradeCategory();
$categoryList = $tradeCatIns->getCategoryList(0);

if(isset($TNB_GLOBALS['tradeSearchParam'])){
    $view['param'] = $TNB_GLOBALS['tradeSearchParam'];
}
?>

<section id="trade_top_search">
    <div class="trade-top-search-box">
        <form action="/trade/search.php" method="get" id="trade_search_form">
            <input type="text" name="q" id="trade_s_q" class="q" value="<?php if(isset($view['param']['q']))
                echo $view['param']['q']; ?>"> <select id="trade_s_cat" name="cat" class="c">
                <option value="">All Categories</option>
                <?php
                if(count($categoryList) > 0){
                    foreach($categoryList as $catData){
                        $selected = '';
                        if(isset($view['param']['cat']) && strtolower($view['param']['cat']) == strtolower($catData['name']))
                            $selected = 'selected="selected"';
                        echo sprintf('<option value="%s" %s>%s</option>', $catData['name'], $selected, $catData['name']);
                    }
                }
                ?>
            </select> <input type="hidden" name="loc" id="trade_s_loc" value="<?php if(isset($view['param']['loc']))
                echo $view['param']['loc']; ?>"> <input type="hidden" name="sort" id="trade_s_sort"
                value="<?php if(isset($view['param']['sort']))
                    echo $view['param']['sort']; ?>"> <input type="hidden" name="user" id="trade_s_user"
                value="<?php if(isset($view['param']['user']))
                    echo $view['param']['user']; ?>">

            <input type="submit" value="Search" class="search_btn red-btn"/>

            <div class="clear"></div>
        </form>
    </div>
</section>
