<?php

abstract class BuckysBBCodeNode {

    /**
     * Nodes parent
     *
     * @var BuckysBBCodeNodeContainer
     */
    protected $parent;

    /**
     * Nodes root parent
     *
     * @var BuckysBBCodeNodeContainer
     */
    protected $root;

    /**
     * Sets the nodes parent
     *
     * @param BuckysBBCodeNode|BuckysBBCodeNodeContainer $parent
     */
    public function set_parent(BuckysBBCodeNodeContainer $parent = null){
        $this->parent = $parent;

        if($parent instanceof BuckysBBCodeNodeContainerDocument)
            $this->root = $parent;else
            $this->root = $parent->root();
    }

    /**
     * Gets the nodes parent. Returns null if there
     * is no parent
     *
     * @return BuckysBBCodeNode
     */
    public function parent(){
        return $this->parent;
    }

    /**
     * @return string
     */
    public function get_html(){
        return null;
    }

    /**
     * Gets the nodes root node
     *
     * @return BuckysBBCodeNode
     */
    public function root(){
        return $this->root;
    }

    /**
     * Finds a parent node of the passed type.
     * Returns null if none found.
     *
     * @param string $tag
     * @return BuckysBBCodeNodeContainerTag
     */
    public function find_parent_by_tag($tag){
        $node = $this->parent();

        while($this->parent() != null && !$node instanceof BuckysBBCodeNodeContainerDocument){
            if($node->tag() === $tag)
                return $node;

            $node = $node->parent();
        }

        return null;
    }
}