<?php

/**
 * BuckysBBCode
 */
class BuckysBBCode {

    /**
     * The tag this BuckysBBCode applies to
     *
     * @var string
     */
    protected $tag;

    /**
     * The BBCodes handler
     *
     * @var mixed string or function
     */
    protected $handler;

    /**
     * If the tag is a self closing tag
     *
     * @var bool
     */
    protected $is_self_closing;

    /**
     * Array of tags which will cause this tag to close
     * if they are encountered before the end of it.
     * Used for [*] which may not have a closing tag so
     * other [*] or [/list] tags will cause it to be closed�
     *
     * @var array
     */
    protected $closing_tags;

    /**
     * Valid child nodes for this tag. Tags like list, table,
     * ect. will only accept li, tr, ect. tags and not text nodes
     *
     * @var array
     */
    protected $accepted_children;

    /**
     * Which auto detections this BuckysBBCode should be excluded from
     *
     * @var int
     */
    protected $is_inline;

    const AUTO_DETECT_EXCLUDE_NONE = 0;
    const AUTO_DETECT_EXCLUDE_URL = 2;
    const AUTO_DETECT_EXCLUDE_EMAIL = 4;
    const AUTO_DETECT_EXCLUDE_EMOTICON = 8;
    const AUTO_DETECT_EXCLUDE_ALL = 15;

    const BLOCK_TAG = false;
    const INLINE_TAG = true;

    /**
     * Creates a new BuckysBBCode
     *
     * @param string     $tag                 Tag this BuckysBBCode is for
     * @param mixed      $handler             String or function, should return a string
     * @param bool       $is_inline           If this tag is an inline tag or a block tag
     * @param array|bool $is_self_closing     If this tag is self closing, I.E. doesn't need [/tag]
     * @param array      $closing_tags        Tags which will close this tag
     * @param array|int  $accepted_children   Tags allowed as children of this BuckysBBCode. Can also include text_node
     * @param int        $auto_detect_exclude Which auto detections to exclude this BuckysBBCode from
     */
    public function __construct($tag, $handler, $is_inline = BuckysBBCode::INLINE_TAG, $is_self_closing = false, $closing_tags = [], $accepted_children = [], $auto_detect_exclude = BuckysBBCode::AUTO_DETECT_EXCLUDE_NONE){
        $this->tag = $tag;
        $this->is_inline = $is_inline;
        $this->handler = $handler;
        $this->is_self_closing = $is_self_closing;
        $this->closing_tags = $closing_tags;
        $this->accepted_children = $accepted_children;
        $this->auto_detect_exclude = $auto_detect_exclude;
    }

    /**
     * Gets the tag name this BuckysBBCode is for
     *
     * @return string
     */
    public function tag(){
        return $this->tag;
    }

    /**
     * Gets if this BuckysBBCode is inline or if it's block
     *
     * @return bool
     */
    public function is_inline(){
        return $this->is_inline;
    }

    /**
     * Gets if this BuckysBBCode is self closing
     *
     * @return bool
     */
    public function is_self_closing(){
        return $this->is_self_closing;
    }

    /**
     * Gets the format string/handler for this BuckysBBCode
     *
     * @return mixed String or function
     */
    public function handler(){
        return $this->handler;
    }

    /**
     * Gets an array of tags which will cause this tag to be closed
     *
     * @return array
     */
    public function closing_tags(){
        return $this->closing_tags;
    }

    /**
     * Gets an array of tags which are allowed as children of this tag
     *
     * @return array
     */
    public function accepted_children(){
        return $this->accepted_children;
    }

    /**
     *  Which auto detections this BuckysBBCode should be excluded from
     *
     * @return int
     */
    public function auto_detect_exclude(){
        return $this->auto_detect_exclude;
    }
}