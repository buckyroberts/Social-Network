<?php

abstract class BuckysBBCodeNodeContainer extends BuckysBBCodeNode {

    /**
     * Array of child nodes
     *
     * @var array
     */
    protected $children = [];

    /**
     * Adds a BuckysBBCodeNode as a child
     * of this node.
     *
     * @param BuckysBBCodeNode|The $child The child node to add
     */
    public function add_child(BuckysBBCodeNode $child){
        $this->children[] = $child;
        $child->set_parent($this);
    }

    /**
     * Replaces a child node
     *
     * @param BuckysBBCodeNode $what
     * @param mixed            $with BuckysBBCodeNode or an array of BuckysBBCodeNode
     * @return bool
     */
    public function replace_child(BuckysBBCodeNode $what, $with){
        $replace_key = array_search($what, $this->children);

        if($replace_key === false)
            return false;

        if(is_array($with))
            foreach($with as $child)
                $child->set_parent($this);

        array_splice($this->children, $replace_key, 1, $with);

        return true;
    }

    /**
     * Removes a child fromthe node
     *
     * @param BuckysBBCodeNode $child
     * @return bool
     */
    public function remove_child(BuckysBBCodeNode $child){
        $key = array_search($what, $this->children);

        if($key === false)
            return false;

        $this->children[$key]->set_parent();
        unset($this->children[$key]);
        return true;
    }

    /**
     * Gets the nodes children
     *
     * @return array
     */
    public function children(){
        return $this->children;
    }

    /**
     * Gets the last child of type BuckysBBCodeNodeContainerTag.
     *
     * @return BuckysBBCodeNodeContainerTag
     */
    public function last_tag_node(){
        $children_len = count($this->children);

        for($i = $children_len - 1; $i >= 0; $i--)
            if($this->children[$i] instanceof BuckysBBCodeNodeContainerTag)
                return $this->children[$i];

        return null;
    }

    /**
     * Gets a HTML representation of this node
     *
     * @return string
     */
    public function get_html($nl2br = true){
        $html = '';

        foreach($this->children as $child){
            if(isset($child->tag) && $child->tag == 'code'){
                //                $str = html_entity_decode($child->get_html($nl2br));
                $str = $child->get_text($nl2br);

                $str = str_replace(['<', '>'], ['&lt;', '&gt;'], $str);
                //                $str = str_replace(array('&lt;pre&gt;&lt;code&gt;', '&lt;/code&gt;&lt;/pre&gt;', '&lt;br&gt;'), array('<pre><code>', '</code></pre>', '<br>'), $str);
                $str = str_replace(["\r\n", "\n\r", "\n", "\r"], ["<br>", "<br>", "<br>", "<br>"], $str);
                $html .= '<pre><code>' . $str . '</code></pre>';

            }else{
                $html .= $child->get_html($nl2br);
            }

        }

        if($this instanceof BuckysBBCodeNodeContainerDocument)
            return $html;

        $bbcode = $this->root()->get_bbcode($this->tag);

        if(is_callable($bbcode->handler()) && ($func = $bbcode->handler()) !== false)
            return $func($html, $this->attribs, $this);
        //return call_user_func($bbcode->handler(), $html, $this->attribs, $this);

        return str_replace('%content%', $html, $bbcode->handler());
    }

    /**
     * Gets the raw text content of this node
     * and it's children.
     * The returned text is UNSAFE and should not
     * be used without filtering!
     *
     * @return string
     */
    public function get_text(){
        $text = '';

        foreach($this->children as $child)
            $text .= $child->get_text();

        return $text;
    }
}