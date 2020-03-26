<?php

class User extends Model
{
    public $username;
    public $password_hash;

    function All(){
    	//return all records
    	$sql = 'SELECT * FROM User';
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $stmt->fetchAll();
    }

	function getUser($username){
    	$sql = 'SELECT * FROM User WHERE username LIKE :username';
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute(['username'=>$username]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $stmt->fetch();
    }

    function insert(){
    	$sql = 'INSERT INTO User(username, password_hash) VALUES(:username, :password_hash)';
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute(['username'=>$this->username,'password_hash'=>$this->password_hash]);
        return self::$_connection->lastInsertId();
    }

}
?>