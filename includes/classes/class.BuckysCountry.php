<?php

class BuckysCountry {

    /**
     * Get country list
     *
     * @param mixed $status
     * @return Indexed
     */
    public function getCountryList($status = 1){
        global $db;

        if(isset($status)){
            $query = $db->prepare("SELECT * FROM " . TABLE_COUNTRY . " WHERE STATUS=%d", $status);
        }else{
            $query = $db->prepare("SELECT * FROM " . TABLE_COUNTRY . "");
        }

        $data = $db->getResultsArray($query);

        return $data;
    }

    /**
     * Get country data by id
     *
     * @param mixed $countryID
     * @return stdClass
     */
    public function getCountryById($countryID){
        global $db;

        $query = $db->prepare("SELECT * FROM " . TABLE_COUNTRY . " WHERE countryID=%d", $countryID);

        $data = $db->getRow($query);

        return $data;
    }

    /**
     * Get Country By Name
     *
     * @param string  $countryName
     * @param integer $status
     * @return stdClass
     */
    public function getCountryByName($countryName, $status = 1){
        global $db;

        $countryName = trim($countryName);

        if($countryName == '')
            return;

        if(isset($status))
            $query = $db->prepare("SELECT * FROM " . TABLE_COUNTRY . " WHERE lower(country_title)=lower(%s) AND STATUS=%d", $countryName, $status);else
            $query = $db->prepare("SELECT * FROM " . TABLE_COUNTRY . " WHERE lower(country_title)=lower(%s)", $countryName);

        $data = $db->getRow($query);

        return $data;
    }

}