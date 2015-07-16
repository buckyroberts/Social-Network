<?php

/**
 * Database Management Class Using Mysqli
 */
Class Database_Mysqli {

    //Database Link
    public $link;

    //The query executed lastly
    public $last_query;

    //Last Query Error
    public $last_error;

    /**
     * Construct
     *
     * @param mixed $host
     * @param mixed $username
     * @param mixed $pass
     * @param mixed $database
     */
    public function __construct($host, $username, $pass, $database){
        //Init Class Member Variables
        $this->link = null;
        $this->last_query = null;
        $this->last_error = null;

        //Establish connection to mysql using mysqli
        $link = mysqli_connect($host, $username, $pass, $database);
        if(mysqli_connect_errno()){
            echo "Failed to connect to MySQL: (Error " . mysqli_connect_errno() . ") " . mysqli_connect_error();
            exit(0);
        }
        if(!$link->set_charset("utf8")){
            printf("Error loading character set utf8: %s\n", $link->error);
            exit(0);
        }
        $this->link = $link;
    }

    /**
     * Fetch Rows by query
     *
     * @param mixed $query
     * @param mixed $type : ASSOC, BOTH, NUM AND OBJ
     * @return Indexed Array
     */
    public function getResultsArray($query, $key = null, $type = 'ASSOC'){
        $res = mysqli_query($this->link, $query);

        $this->last_query = $query;
        $this->last_error = null;

        if(mysqli_errno($this->link)){
            $this->setLastError();
            return null;
        }

        $rows = [];

        if($res){
            $resultType = MYSQLI_BOTH;
            switch($type){
                case 'ASSOC':
                case 'OBJ':
                    $resultType = MYSQLI_ASSOC;
                    break;
                case 'NUM':
                    $resultType = MYSQLI_NUM;
                    break;
                case 'BOTH':
                default:
                    $resultType = MYSQLI_BOTH;
                    break;
            }
            while($row = mysqli_fetch_array($res, $resultType)){
                if($type != 'OBJ')
                    $rows[] = $row;else{
                    //Convert array to object
                    $rowObj = new stdClass();
                    foreach($row as $k => $v){
                        $rowObj->$k = $v;
                    }
                    $rows[] = $rowObj;
                }
            }
            mysqli_free_result($res);
        }
        if($key != null && count($rows) > 0 && isset($rows[0][$key])){
            //Change the array to $key indexed array
            $result = [];
            foreach($rows as $row){
                $result[$row[$key]] = $row;
            }
            $rows = $result;
        }
        return $rows;
    }

    /**
     * Get One Row
     *
     * @param mixed $query
     * @param mixed $type
     * @return array or null
     */
    public function getRow($query, $type = 'ASSOC'){
        $res = mysqli_query($this->link, $query);

        $this->last_query = $query;
        $this->last_error = null;

        if(mysqli_errno($this->link)){
            $this->setLastError();
            return null;
        }

        $row = [];

        if($res){
            $resultType = MYSQLI_BOTH;
            switch($type){
                case 'ASSOC':
                case 'OBJ':
                    $resultType = MYSQLI_ASSOC;
                    break;
                case 'NUM':
                    $resultType = MYSQLI_NUM;
                    break;
                case 'BOTH':
                default:
                    $resultType = MYSQLI_BOTH;
                    break;
            }
            if($row = mysqli_fetch_array($res, $resultType)){
                if($type == 'OBJ'){
                    //Convert array to object
                    $rowObj = new stdClass();
                    foreach($row as $k => $v){
                        $rowObj->$k = $v;
                    }
                    $row = $rowObj;
                }
            }
            mysqli_free_result($res);
        }
        return $row;
    }

    /**
     * Get One value of the query
     *
     * @param String $query
     * @return one value
     */
    public function getVar($query){
        $res = mysqli_query($this->link, $query);

        $this->last_query = $query;
        $this->last_error = null;

        if(mysqli_errno($this->link)){
            $this->setLastError();
            return null;
        }

        $var = null;

        if($res){
            if($row = mysqli_fetch_array($res, MYSQLI_NUM)){
                $var = $row[0];
            }
            mysqli_free_result($res);
        }
        return $var;
    }

    /**
     * Set Last error if an error happened

     */
    function setLastError(){
        $this->last_error = "Query Error" . mysqli_errno($this->link) . ": " . mysqli_error($this->link);
    }

    /**
     * Get Last Mysql Error

     */
    public function getLastError(){
        if(mysqli_errno($this->link)){
            return mysqli_error($this->link);
        }else{
            return null;
        }
    }

    /**
     * Escape input to prevent sql injection or error
     *
     * @param string $input
     * @return escaped string
     */
    public function escapeInput(&$input, $html_encode = true){
        $converts = ['<' => '&lt;', '>' => '&gt;', "'" => '&#039;', '"' => '&quot;'];
        if(is_array($input)){
            $escaped = [];
            foreach($input as $k => $v){
                if($html_encode)
                    $v = str_replace(array_keys($converts), array_values($converts), $v);
                $escaped[$k] = mysqli_real_escape_string($this->link, $v);
            }

        }else{
            if($html_encode)
                $input = str_replace(array_keys($converts), array_values($converts), $input);
            $escaped = mysqli_real_escape_string($this->link, $input);
        }
        $input = $escaped;
        return $escaped;

    }

    /**
     * Prepare a SQL query for safe execution. Uses sprintf()-like syntax
     * %d (integer)
     * %f (float)
     * %s (string)
     * %% (literal percentage sign - no argument needed)
     *
     * @param mixed $query
     * @return string|void
     */
    public function prepare($query = null) // { $query, $args}
    {
        if(is_null($query))
            return;

        $args = func_get_args();
        array_shift($args);
        if(isset($args[0]) && is_array($args[0]))
            $args = $args[0];

        $query = str_replace("'%s'", '%s', $query);
        $query = str_replace('"%s"', '%s', $query);
        $query = preg_replace('|(?<!%)%s|', "'%s'", $query);

        array_walk($args, [&$this, 'escapeInput']);

        return @vsprintf($query, $args);
    }

    /**
     * Execute Insert Query
     *
     * @param mixed $query
     * @return int|null|string
     */
    public function insert($query){
        $this->last_query = $query;
        $this->last_error = null;

        $res = mysqli_query($this->link, $query);
        if($res){
            $newId = mysqli_insert_id($this->link);
            return $newId;
        }else{
            $this->setLastError();
            return null;
        }
    }

    /**
     * @return int|string
     */
    public function getLastInsertId(){
        return mysqli_insert_id($this->link);
    }

    /**
     * Insert Data From Array
     *
     * @param string $table : Table Name
     * @param array  $data  : key = Field Name, value = Field Value
     * @return int|null|string
     */
    public function insertFromArray($table, $data){
        $query = [];
        $query_v = [];
        foreach($data as $k => $v){
            $query[] = "`" . $k . "`";
            $query_v[] = "'" . $this->escapeInput($v) . "'";
        }
        $query = "INSERT INTO " . $table . "(" . implode(", ", $query) . ")VALUES(" . implode(", ", $query_v) . ")";

        return $this->insert($query);
    }

    /**
     * Execute all kind of query
     *
     * @param mixed $query
     * @return bool
     */
    public function query($query){
        $this->last_query = $query;
        $res = mysqli_query($this->link, $query);
        if(!$res){
            $this->setLastError();
            return false;
        }else{
            return true;
        }
    }

    /**
     * Execute Update Query
     *
     * @param mixed $query
     * @return bool|null
     */
    public function update($query){
        $this->last_query = $query;
        $this->last_error = null;

        $res = mysqli_query($this->link, $query);
        if($res){
            return true;
        }else{
            $this->setLastError();
            return null;
        }
    }

    /**
     * Update Query
     *
     * @param String $table
     * @param array  $data
     * @param array  $where
     * @return bool|null
     */

    public function updateFromArray($table, $data, $where){
        $query_v = [];
        $query_w = [];
        foreach($data as $k => $v){
            $query_v[] = "`" . $k . "`='" . $this->escapeInput($v) . "'";
        }
        foreach($where as $k => $v){
            $query_w[] = "`" . $k . "`='" . $this->escapeInput($v) . "'";
        }

        $query = "UPDATE " . $table . " SET " . implode(", ", $query_v) . " WHERE 1=1 AND (" . implode(" AND ", $query_w) . ")";

        return $this->update($query);
    }
}


