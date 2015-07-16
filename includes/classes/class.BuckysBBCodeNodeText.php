<?php

class BuckysBBCodeNodeText extends BuckysBBCodeNode {

    protected $text;

    public function __construct($text){
        $this->text = $text;
    }

    public function get_html($nl2br = true){
        $string = htmlentities($this->text, ENT_QUOTES | ENT_IGNORE, "UTF-8");

        /*        $string = str_replace("  ", " &nbsp;", $string);*/

        if(!$nl2br)
            return $string;

        $string = str_replace(["\r\n", "\n\r", "\n", "\r"], ["<br>", "<br>", "<br>", "<br>"], $string);
        return $string;
    }

    public function get_text(){
        return $this->text;
    }
}