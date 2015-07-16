<?php

class BuckysShopCategory {

    /**
     * Add category
     *
     * @param mixed $name
     * @param mixed $parentID
     * @param mixed $status
     * @return string
     */
    public function addCategory($name, $parentID = 0, $status = 1){
        global $db;

        $name = trim($name);

        if(empty($name))
            return;

        $newID = $db->insertFromArray(TABLE_SHOP_CATEGORIES, ['name' => $name, 'parentID' => $parentID, 'status' => $status]);

        return $newID;
    }

    /**
     * Get categories
     *
     * @param mixed $parentID
     * @param mixed $status
     * @return stdClass
     */
    public function getCategoryList($parentID = null, $status = 1){
        global $db;

        $whereCond = '';
        if(isset($parentID)){
            $whereCond .= ' WHERE parentID=' . $parentID;
        }

        if(isset($status)){
            if($whereCond != ''){
                $whereCond .= ' AND ';
            }else{
                $whereCond .= ' WHERE ';
            }

            $whereCond .= 'status=' . $status;
        }

        $query = $db->prepare("SELECT * FROM " . TABLE_SHOP_CATEGORIES . $whereCond . ' ORDER BY NAME');

        $data = $db->getResultsArray($query);

        return $data;
    }

    /**
     * Get Category By Name
     *
     * @param String  $catName
     * @param integer $status
     * @return stdClass
     */
    public function getCategoryByName($catName, $status = 1){
        global $db;

        if($catName == '')
            return;
        if(isset($status))
            $query = $db->prepare("SELECT * FROM " . TABLE_SHOP_CATEGORIES . " WHERE lower(NAME)=lower(%s) AND STATUS=%d", $catName, $status);else
            $query = $db->prepare("SELECT * FROM " . TABLE_SHOP_CATEGORIES . " WHERE lower(NAME)=lower(%s)", $catName);

        $data = $db->getRow($query);

        return $data;
    }

    /**
     * Get Category By ID
     *
     * @param integer $catID
     * @param integer $status
     * @return stdClass
     */
    public function getCategoryByID($catID, $status = 1){
        global $db;

        if(!is_numeric($catID))
            return;

        if(isset($status))
            $query = $db->prepare("SELECT * FROM " . TABLE_SHOP_CATEGORIES . " WHERE catID=%d AND STATUS=%d", $catID, $status);else
            $query = $db->prepare("SELECT * FROM " . TABLE_SHOP_CATEGORIES . " WHERE catID=%d", $catID);

        $data = $db->getRow($query);

        return $data;
    }

    /**
     * Remove Trade category
     *
     * @param Int $categoryID
     */
    public function removeCategory($categoryID){
        global $db;

        $query = $db->prepare("DELETE FROM " . TABLE_SHOP_CATEGORIES . " WHERE catID=%s", $categoryID);
        $db->query($query);

        return;
    }

}