<?php

namespace Models;

abstract class BaseModel {
    /**
    *@var \GF\DB\SimpleDB
    */
    protected static $db = null;

    public function __construct() {
        if (self::$db == null) {
            self::$db = new \GF\DB\SimpleDB();
        }
    }
}
