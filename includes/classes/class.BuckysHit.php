<?php

class BuckysHit {

    /**
     * @param $postID
     * @param $userID
     * @return int|null|string
     */
    public static function addHit($postID, $userID){
        global $db;

        $now = date("Y-m-d H:i:s");

        $newID = $db->insertFromArray(TABLE_POSTS_HITS, ['postID' => $postID, 'userID' => $userID, 'hitDate' => $now]);

        return $newID;
    }

    /**
     * @param $postID
     * @param $userID
     * @return one
     */
    public static function removeHit($postID, $userID){
        global $db;

        $query = $db->prepare("SELECT hitID FROM " . TABLE_POSTS_HITS . " WHERE postID=%d AND userID=%d LIMIT 1", $postID, $userID);
        $hitID = $db->getVar($query);
        if($hitID){
            $db->query("DELETE FROM " . TABLE_POSTS_HITS . " WHERE hitID=$hitID");
        }

        return $hitID;
    }
}