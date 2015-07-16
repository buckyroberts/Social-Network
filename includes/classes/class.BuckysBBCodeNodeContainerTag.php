<?php

class BuckysBBCodeNodeContainerTag extends BuckysBBCodeNodeContainer {

    /**
     * Tag name of this node
     *
     * @var string
     */
    protected $tag;

    /**
     * Assoc array of attributes
     *
     * @var array
     */
    protected $attribs;

    public function __construct($tag, $attribs){
        $this->tag = $tag;
        $this->attribs = $attribs;
    }

    /**
     * Gets the tag of this node
     *
     * @return string
     */
    public function tag(){
        return $this->tag;
    }

    /**
     * Gets the tags attributes
     *
     * @return array
     */
    public function attributes(){
        return $this->attribs;
    }
}
