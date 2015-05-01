<?php

namespace Models;

/**
* 
*/
class Post extends \Models\BaseModel{

	public function __construct(){
		parent::__construct();
	}
 	public function getAll() {
 		$statement = self::$db->prepare('SELECT * FROM `posts`')->execute()->fetchAllAssoc();

        return $statement;
    }

    public function find($id) {
		$statement = self::$db->prepare('SELECT * FROM `posts` WHERE id=?',
				 array($id))->execute()->fetchRowAssoc();
    	return $statement;
    }

    public function create($title, $content, $user_id = null, $tags = null) {
        if (!isset($title) && $title == '' && $title == null) {
            return false;
        }
     	
     	if (!isset($content) && $content == '' && $content == null) {
            return false;
        }

        $statement = self::$db->prepare(
            "INSERT INTO posts (`title`, `date`, `content`, `user_id`) VALUES (?,?,?,?)",
            array($title, date('Y-m-d'), $content, $user_id))->execute();
        return self::$db->getAffectedRows() > 0;
    }
}