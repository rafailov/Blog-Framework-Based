<?php

namespace Models;

/**
* 
*/
class Tags extends \Models\BaseModel{

	public function __construct(){
		parent::__construct();
	}
 	public function getAll() {
 		$statement = self::$db->prepare('SELECT `id`,`tag` FROM `tags` ORDER BY `popularity` DESC')->execute()->fetchAllAssoc();

        return $statement;
    }

    public function find($id) {
        $statement = self::$db->prepare('SELECT `tag` FROM `tags` WHERE id=?',
                 array($id))->execute()->fetchRowAssoc();
        return $statement;
    }

    public function findByName($name) {
        $statement = self::$db->prepare('SELECT `id` FROM `tags` WHERE tag=?',
                 array($name))->execute()->fetchRowAssoc();
        return $statement;
    }

    public function create($tagName) {
        if (!isset($tagName) && $tagName == '' && $tagName == null) {
            return false;
        }

        $statement = self::$db->prepare(
            "INSERT INTO tags (`tag`) VALUES (?)",
            array($tagName))->execute();

        if (self::$db->getAffectedRows() > 0) {
            return self::$db->getLastInsertId();
        }

        return false;
    }

    public function addTagToPost($tagId, $postId) {
        $tagId = intval($tagId);
        $postId = intval($postId);

        if ($tagId > 0 || $postId > 0) {
            $statement = self::$db->prepare(
                "INSERT INTO post_tags (`post_id`, `tag_id`) VALUES (?,?)",
                array($postId, $tagId))->execute();

            if (self::$db->getAffectedRows() > 0) {
                $statement = self::$db->prepare(
                    "UPDATE tags 
                    SET popularity = popularity + 1
                    WHERE id = ?",array($tagId))->execute();

                return true;
            }
        }

        return false;

    }
}