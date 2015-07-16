<?php
/**
 * Display top search box

 */

if(isset($TNB_GLOBALS['searchParamPP'])){
    $view['param'] = $TNB_GLOBALS['searchParamPP'];
}


?>

<section id="pp_top_search">
    <form action="/search.php" method="get" id="pp_search_form">
        <div class="top-search-box">
            <input type="text" name="q" id="pp_search_q" class="q" value="<?php if(isset($view['param']['q']))
                echo $view['param']['q']; ?>"> <select id="pp_search_type" name="type" class="c">
                <option value="">All</option>
                <option
                    value="<?php echo BuckysSearch::SEARCH_TYPE_PAGE ?>" <?php if($view['param']['type'] != '' && $view['param']['type'] == BuckysSearch::SEARCH_TYPE_PAGE)
                    echo 'selected="selected"'; ?>>Pages
                </option>
                <option
                    value="<?php echo BuckysSearch::SEARCH_TYPE_USER ?>" <?php if($view['param']['type'] != '' && $view['param']['type'] == BuckysSearch::SEARCH_TYPE_USER)
                    echo 'selected="selected"'; ?> >People
                </option>
            </select> <input type="submit" value="Search" class="search_btn red-btn"/>

            <div class="clear"></div>
        </div>
        <div class="search-sortby-cont">
            <select id="pp_search_sortby" name="sort">
                <option value="pop" <?php if($view['param']['sort'] == 'pop')
                    echo 'selected="selected"'; ?> >Most Friends
                </option>
                <option value="reputation" <?php if($view['param']['sort'] == 'reputation')
                    echo 'selected="selected"'; ?> >Most Points
                </option>
                <option value="asc" <?php if($view['param']['sort'] == 'asc')
                    echo 'selected="selected"'; ?> >Alphabetically: A-Z
                </option>
                <option value="desc" <?php if($view['param']['sort'] == 'desc')
                    echo 'selected="selected"'; ?> >Alphabetically: Z-A
                </option>
            </select> <label for="pp_search_sortby">Sort by </label>

            <div class="clear"></div>
        </div>

    </form>

</section>
