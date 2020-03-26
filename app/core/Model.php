<?php
class Model{
	
    protected static $_connection;
    
    public function __construct()
    {

        $hostname = 'localhost';
        $dbname = 'myApp';
        $username = 'root';
        $password = '';

        if (self::$_connection === null) {
            self::$_connection = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
            self::$_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }
}