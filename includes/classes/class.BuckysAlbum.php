<?php

/**
 * Manage Album
 */
class BuckysAlbum {

    /**
     * Getting Album Photos
     *
     * @param mixed $albumID
     * @param mixed $limit
     * @return Indexed
     */
    public static function getPhotos($albumID, $limit = null){
        global $db;

        $query = $db->prepare("SELECT p.* FROM " . TABLE_POSTS . " AS p LEFT JOIN " . TABLE_ALBUMS_PHOTOS . " AS op ON op.post_id=p.postID WHERE op.album_id=%d", $albumID);

        $rows = $db->getResultsArray($query, 'postID');

        return $rows;

    }

    /**
     * Create New Album
     *
     * @param Int    $userID
     * @param String $title
     * @return bool|int|null|string
     */
    public static function createAlbum($userID, $title, $visibility){
        global $db;

        $now = date('Y-m-d H:i:s');
        $newId = $db->insertFromArray(TABLE_ALBUMS, ['owner' => $userID, 'name' => $title, 'created_date' => $now, 'visibility' => $visibility]);

        if(!$newId) //Error
        {
            buckys_add_message($db->getLastError(), MSG_TYPE_ERROR);
            return false;
        }else{  //Success
            buckys_add_message(MSG_NEW_ALBUM_CREATED, MSG_TYPE_SUCCESS);
            return $newId;
        }

    }

    /**
     * Getting User Albums
     *
     * @param Int $userID
     * @return Indexed
     */
    public static function getAlbumsByUserId($userID){
        global $db;

        $query = $db->prepare("SELECT a.*, count(ap.id) AS photos FROM " . TABLE_ALBUMS . " AS a LEFT JOIN " . TABLE_ALBUMS_PHOTOS . " AS ap ON a.albumID=ap.album_id WHERE OWNER=%s GROUP BY a.albumID ORDER BY `name`", $userID);
        $albums = $db->getResultsArray($query, 'albumID');

        return $albums;
    }

    /**
     * Check that $userID is a owner of $albumID
     *
     * @param int $albumID
     * @param int $userID
     * @return bool
     */
    public static function checkAlbumOwner($albumID, $userID){
        global $db;

        $query = $db->prepare("SELECT albumID FROM " . TABLE_ALBUMS . " WHERE OWNER=%s AND albumID= %s", $userID, $albumID);
        $rs = $db->getVar($query);

        return !$rs ? false : true;
    }

    /**
     * Getting Photo Albums
     *
     * @param Int $photoID
     * @return Indexed
     */
    public static function getAlbumsByPostId($photoID){
        global $db;

        $query = $db->prepare("SELECT a.* FROM " . TABLE_ALBUMS_PHOTOS . " AS ap LEFT JOIN " . TABLE_ALBUMS . " AS a ON a.albumID=ap.album_id WHERE ap.post_id=%s ORDER BY `name`", $photoID);
        $albums = $db->getResultsArray($query, 'albumID');

        return $albums;
    }

    /**
     * Add photo to album
     *
     * @param mixed $albumID
     * @param mixed $photoID
     * @return int|null|string
     */
    public static function addPhotoToAlbum($albumID, $photoID){
        global $db;

        //Remove Old Entries
        $query = $db->prepare("DELETE FROM " . TABLE_ALBUMS_PHOTOS . " WHERE post_id=%s", $photoID);
        $db->query($query);

        //Insert New Entry
        $query = $db->prepare("INSERT INTO " . TABLE_ALBUMS_PHOTOS . "(album_id, post_id)VALUES(%s, %s)", $albumID, $photoID);
        $newId = $db->insert($query);

        return $newId;
    }

    /**
     * Remove photo from album
     *
     * @param mixed $albumID
     * @param mixed $photoID
     */
    public static function removePhotoFromAlbum($albumID, $photoID){
        global $db;

        //Remove Old Entries
        $query = $db->prepare("DELETE FROM " . TABLE_ALBUMS_PHOTOS . " WHERE album_id=%s AND post_id=%s", $albumID, $photoID);
        $db->query($query);

        return $newId;
    }

    /**
     * Remove Album
     *
     * @param mixed $albumID
     * @param mixed $userID
     * @return bool
     */
    public static function deleteAlbum($albumID, $userID){
        global $db;

        if(BuckysAlbum::checkAlbumOwner($albumID, $userID)){
            //Remove Album
            $query = $db->prepare("DELETE FROM " . TABLE_ALBUMS . " WHERE albumID=%s AND OWNER=%s", $albumID, $userID);
            $db->query($query);
            //Remove Assigned Photos
            $query = $db->prepare("DELETE FROM " . TABLE_ALBUMS_PHOTOS . " WHERE albumID=%s", $albumID);
            $db->query($query);
            return true;
        }
        return false;
    }

    /**
     * Get Album Detail
     *
     * @param int $albumID
     * @return array
     */
    public static function getAlbum($albumID){
        global $db;

        $query = $db->prepare("SELECT a.*, u.firstName, u.lastName FROM " . TABLE_ALBUMS . " AS a LEFT JOIN " . TABLE_USERS . " AS u ON u.userID=a.owner WHERE a.albumID=%s", $albumID);
        $row = $db->getRow($query);

        return $row;
    }

    /**
     * @param $albumID
     * @param $title
     * @param $visibility
     * @param $photos
     */
    public static function updateAlbum($albumID, $title, $visibility, $photos){
        global $db;

        //Update Album Title
        $query = $db->prepare("UPDATE " . TABLE_ALBUMS . " SET name=%s, visibility=%s WHERE albumID=%s", $title, $visibility, $albumID);
        $db->query($query);

        return;
    }
}