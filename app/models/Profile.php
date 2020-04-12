<?php

	class Profile extends Model {

		public $user_id;
		public $first_name;
		public $last_name;
		public $email;
		public $city;
		public $country;

		function insert(){
    	$sql = 'INSERT INTO Profile(user_id, first_name, last_name, email, city, country) VALUES(:user_id, :first_name, :last_name, :email, :city, :country)';
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute(['user_id'=>$this->user_id, 'first_name'=>$this->first_name,'last_name'=>$this->last_name, 'email'=>$this->email, 'city'=>$this->city, 'country'=>$this->country]);
        return self::$_connection->lastInsertId();
    }

    function All(){
    	//return all records
    	$sql = 'SELECT * FROM Profile';
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Profile');
        return $stmt->fetchAll();
    }

	}

?>