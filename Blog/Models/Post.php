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
        $input =  \GF\InputData::getInstance();
        $tagModel = new \Models\Tag();
        if ($input->hasPost('tags')) {
            $setedTags = explode(',',$input->post('tags'));
            if (is_array($setedTags)) {
                $where = '';
                foreach ($setedTags as $key => $value) {
                    $findedTagId = $tagModel->findByName($value);
                    if ($findedTagId > 0) {
                        if ($where != '') {
                           $where .= ' AND';
                        }
                         $where .= ' pt.tag_id = '. $findedTagId['id']. ' '; 
                    }
                }
                $sql = 'SELECT * FROM `post_tags` as pt join `posts` as p ON pt.post_id = p.id WHERE '. $where;
                echo "<h3>".$sql."</h3>";
                $statement = self::$db->prepare($sql)->execute()->fetchAllAssoc();
                return $statement;
            }
        }
        $statement = self::$db->prepare('SELECT * FROM `posts`')->execute()->fetchAllAssoc();

        return $statement;
    }

    public function find($id) {
		$statement = self::$db->prepare('SELECT * FROM `posts` WHERE id=?',
				 array($id))->execute()->fetchRowAssoc();
    	return $statement;
    }

    public function create($title, $content, $user_id = null) {
        if (!isset($title) || $title == '' || $title == null) {
            return false;
        }
     	
     	if (!isset($content) || $content == '' || $content == null) {
            return false;
        }

        $statement = self::$db->prepare(
            "INSERT INTO posts (`title`, `date`, `content`, `user_id`) VALUES (?,?,?,?)",
            array($title, date('Y-m-d'), $content, $user_id))->execute();

        if (self::$db->getAffectedRows() > 0) {
            return self::$db->getLastInsertId();
        }
        return false;
    }
    public function countView($id)   {
        if (!isset($id) || $id < 0) {
            return false;
        }

        $statement = self::$db->prepare(
            "UPDATE posts SET views = views + 1 WHERE id = ?",
            array($id))->execute();

        if (self::$db->getAffectedRows() > 0) {
            return self::$db->getLastInsertId();
        }
        return false;
    }
}