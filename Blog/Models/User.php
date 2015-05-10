<?php

namespace Models;

/**
* 
*/
class User extends \Models\BaseModel{

	public function __construct(){
		parent::__construct();
	}

    public function findByName($username) {
        $statement = self::$db->prepare('SELECT * FROM `users` WHERE username=?',
                 array($username))->execute();
        return $statement->fetchRowAssoc();
    }

    public function find($id) {
        $statement = self::$db->prepare('SELECT * FROM `users` WHERE id=?',
                 array($id))->execute();
        return $statement->fetchRowAssoc();
    }


    public function create($username, $password, $email, $isAdmin = false) {
        if (!isset($username) || $username == '' || $username == null) {
            return false;
        }
        
        if (!isset($password) || $password == '' || $password == null) {
            return false;
        }
        
        if (!isset($email) || $email == '' || $email == null) {
            return false;
        }

        $options = ['cost' => 12];
        $password = password_hash($password, PASSWORD_BCRYPT, $options);

        $statement = self::$db->prepare(
            "INSERT INTO users (`username`, `password`, `email`, `isAdmin`) VALUES (?,?,?,?)",
            array($username, $password, $email, $isAdmin))->execute();

        if (self::$db->getAffectedRows() > 0) {
            return self::$db->getLastInsertId();
        }

        return false;
    }

}