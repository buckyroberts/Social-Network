<?php

class Pagination {

    var $total = 0;
    var $per_page = 0;
    var $currrent_page = 1;
    var $total_page = 0;

    /**
     * Construct
     *
     * @param Int $total        = Total Item Numbers
     * @param Int $per_page     = Item Numbers Per a Page
     * @param Int $current_page = Current page
     */
    public function __construct($total = 0, $per_page = 0, $current_page = 0){
        if($total < 1 || $per_page < 1)
            return;
        $this->total = $total;
        $this->per_page = $per_page;
        $this->total_page = ceil($this->total / $this->per_page);
        if($current_page < 1)
            $this->currrent_page = 1;else if($current_page > $this->total_page)
            $this->currrent_page = $this->total_page;else
            $this->currrent_page = $current_page;

        return;
    }

    /**
     * @return int
     */
    public function getCurrentPage(){
        return $this->currrent_page;
    }

    /**
     * @return float|int
     */
    public function getTotalPage(){
        return $this->total_page;
    }

    /**
     * @return int
     */
    public function getTotalItems(){
        return $this->total;
    }

    /**
     * Display Pagination Bar
     *
     * @param mixed $isReturn
     * @return string
     */
    public function renderPaginate($mainURL = "", $current_items = 0, $isReturn = false){
        ob_start();
        if($this->total_page > 0){

            $start = ($this->currrent_page - 1) * $this->per_page + 1;
            $end = $start + $current_items - 1;
            ?>
            <div class="paginate">
                <span
                    class="label"><?php echo number_format($start) ?> - <?php echo number_format($end)?> of <?php echo $this->total?></span>

                <div class="pages">
                    <?php
                    $sPage = $current_items - 2;

                    $startItems = 2;
                    $centerItems = $this->total_page > 5 ? 5 : $this->total_page;
                    $endItems = 2;

                    $cStart = $this->currrent_page - 2;
                    $cEnd = $this->currrent_page + 2;
                    while($cStart <= 0){
                        $cStart++;
                        $cEnd++;
                    }

                    while($cStart > 1 && $cEnd > $this->total_page){
                        $cStart--;
                        $cEnd--;
                    }

                    if($cEnd > $this->total_page)
                        $cEnd = $this->total_page;

                    if($cStart < 3)
                        $startItems = 2 - (3 - $cStart);

                    if($this->total_page - $cEnd < 3)
                        $endItems = $this->total_page - $cEnd;

                    //Show Prev
                    if($this->total_page > 1){
                        if($this->currrent_page > 1){
                            ?>
                            <a href="<?php echo $mainURL?>page=<?php echo $this->currrent_page - 1?>">Prev</a>
                        <?php
                        }else{
                            ?>
                            <span class="current">Prev</span>
                        <?php
                        }
                    }

                    for($i = 1; $i <= $startItems; $i++){
                        ?>
                        <a href="<?php echo $mainURL?>page=<?php echo $i?>"><?php echo $i?></a>
                    <?php

                    }
                    //Show Ellipse
                    if($startItems == 2 && $cStart > 3){
                        if($cStart - $startItems > 2){
                            ?>
                            <span class="ellipse">...</span>
                        <?php
                        }else{
                            ?>
                            <a href="<?php echo $mainURL?>page=<?php echo $startItems + 1?>"><?php echo $startItems + 1?></a>
                        <?php
                        }
                    }

                    for($i = $cStart; $i <= $cEnd; $i++){
                        if($i == $this->currrent_page){
                            ?>
                            <span class="current"><?php echo $i?></span>
                        <?php
                        }else{
                            ?>
                            <a href="<?php echo $mainURL?>page=<?php echo $i?>"><?php echo $i?></a>
                        <?php
                        }

                    }

                    //Show Ellipse
                    if($endItems == 2){
                        if($this->total_page - $cEnd > 3){
                            ?>
                            <span class="ellipse">...</span>
                        <?php
                        }else if($this->total_page - $cEnd == 3){
                            ?>
                            <a href="<?php echo $mainURL ?>page=<?php echo $this->total_page - 2 ?>"><?php echo $this->total_page - 2 ?></a>
                        <?php
                        }
                    }
                    for($i = $endItems - 1; $i >= 0; $i--){
                        ?>
                        <a href="<?php echo $mainURL?>page=<?php echo $this->total_page - $i?>"><?php echo $this->total_page - $i?></a>
                    <?php

                    }
                    //Show Next
                    if($this->total_page > 1){
                        if($this->currrent_page < $this->total_page){
                            ?>
                            <a href="<?php echo $mainURL?>page=<?php echo $this->currrent_page + 1?>">Next</a>
                        <?php
                        }else{
                            ?>
                            <span class="current">Next</span>
                        <?php
                        }
                    }
                    ?>
                </div>
                <div class="clear"></div>
            </div>
        <?php
        }
        $html = ob_get_contents();
        ob_end_clean();
        if($isReturn)
            return $html;else
            echo $html;
    }
}