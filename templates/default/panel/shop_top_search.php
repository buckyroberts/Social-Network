<?php
/**
 * Display shop top search box

 */

$shopCatIns = new BuckysTradeCategory();
$categoryList = $shopCatIns->getCategoryList(0);

if(isset($TNB_GLOBALS['shopSearchParam'])){
    $view['param'] = $TNB_GLOBALS['shopSearchParam'];
}
?>

<section id="shop_top_search">
    <div class="shop-top-search-box">
        <form action="/shop/search.php" method="get" id="shop_search_form">
            <input type="text" name="q" id="shop_s_q" class="q" value="<?php if(isset($view['param']['q']))
                echo $view['param']['q']; ?>"> <select id="shop_s_cat" name="cat" class="c">
                <option value="">All Categories</option>
                <?php
                if(count($categoryList) > 0){
                    foreach($categoryList as $catData){
                        $selected = '';
                        if(isset($view['param']['cat']) && strtolower($view['param']['cat']) == strtolower($catData['name']))
                            $selected = 'selected="selected"';
                        echo sprintf('<option value="%s" %s>%s</li>', $catData['name'], $selected, $catData['name']);
                    }
                }
                ?>
            </select> <input type="hidden" name="loc" id="shop_s_loc" value="<?php if(isset($view['param']['loc']))
                echo $view['param']['loc']; ?>"> <input type="hidden" name="sort" id="shop_s_sort"
                value="<?php if(isset($view['param']['sort']))
                    echo $view['param']['sort']; ?>"> <input type="hidden" name="user" id="shop_s_user"
                value="<?php if(isset($view['param']['user']))
                    echo $view['param']['user']; ?>">

            <input type="submit" value="Search" class="search_btn red-btn"/>

            <div class="clear"></div>
        </form>
    </div>
</section>
