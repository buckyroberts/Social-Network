<?php
exit;
$dir = dirname(__FILE__) . "/photos/users";

$dp = opendir($dir);

while(false !== ($sd1 = readdir($dp))){
    if($sd1 != "." && $sd1 != ".."){
        if(is_dir($dir . "/$sd1")){
            $fp = fopen($dir . "/$sd1/index.html", "w");
            fclose($fp);
            $sdp1 = opendir($dir . "/$sd1");
            while(false !== ($sd2 = readdir($sdp1))){
                if($sd2 != "." && $sd2 != ".."){
                    if(is_dir($dir . "/$sd1/$sd2")){
                        $fp = fopen($dir . "/$sd1/$sd2/index.html", "w");
                        fclose($fp);
                    }
                }
            }
        }
    }
}