<?php

namespace Models;

/**
* 
*/
class Comment extends \Models\BaseModel{

	public function __construct(){
		parent::__construct();
	}

    public function listComments($post_id){
        $statement = self::$db->prepare('SELECT  c.`id`, c.`content`, c.`date`, c.`likes`, c.`dislikes`, c.`authorUser_id`, c.`author_name`, 
            c.`author_email`, u.`username` FROM `comments` as c left join `users` as u ON u.id = c.authorUser_id WHERE post_id=?',
                 array($post_id))->execute()->fetchAllAssoc();
        return $statement;

    }

    public function addCommentToPost($comment, $postId, $user_id = null){
        if (!isset($comment) || $comment == '' || $comment == null) {
            return false;
        }
        
        if (!isset($postId) || $postId == '' || $postId == null) {
            return false;
        }


        $statement = self::$db->prepare(
            "INSERT INTO comments (`post_id`, `date`, `content`, `authorUser_id`) VALUES (?,?,?,?)",
            array($postId, date('Y-m-d'), $comment, $user_id))->execute();

        if (self::$db->getAffectedRows() > 0) {
            return self::$db->getLastInsertId();
        }
        return false;
    }

}