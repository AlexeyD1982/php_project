<?php

class DB
{
    private static $_db = null;

    public static function getInstance()
    {
        if (self::$_db == null) {
            self::$_db = new PDO('mysql:host=localhost:8890;dbname=linkcutter', 'root', 'root');
        }
        return self::$_db;
    }

    public function __construct() {}
    public function __clone() {}
    public function __wakeup() {}
}
