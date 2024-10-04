<?php

class Database
{
    private $host = 'localhost';
    private $database = 'resumebuilder';
    private $username = 'root';
    private $password = '';
    private static $db = null;

    private function __construct()
    {
        self::$db = new mysqli($this->host, $this->username, $this->password, $this->database);
        if (self::$db->connect_error) {
            die("Connection failed: " . self::$db->connect_error);
        }
    }

    public static function connect()
    {
        if (self::$db === null) {
            new Database();
        }
        return self::$db;
    }
}

$db = Database::connect();
date_default_timezone_set('Asia/Dhaka');
?>