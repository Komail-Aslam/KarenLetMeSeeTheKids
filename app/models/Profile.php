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

    function currentProfile($user_id){
        $sql = 'SELECT * FROM Profile WHERE user_id = :user_id';
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute(['user_id'=>$user_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Profile');
        return $stmt->fetch();
    }

    function currentProfileProfileId($profile_id){
        $sql = 'SELECT * FROM Profile WHERE profile_id = :profile_id';
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute(['profile_id'=>$profile_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Profile');
        return $stmt->fetch();
    }

    function update(){
        $sql = 'UPDATE profile SET first_name = :first_name, last_name = :last_name, email = :email, city = :city, country = :country WHERE profile_id = :profile_id';
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute(['profile_id'=>$this->profile_id, 'first_name'=>$this->first_name,'last_name'=>$this->last_name, 'email'=>$this->email, 'city'=>$this->city, 'country'=>$this->country]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Profile');
        return $stmt->rowCount();
    }

    function search($search){
        //return all records
        $sql = "SELECT * FROM Profile WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%'";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute(['search'=>$search]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Profile');
        return $stmt->fetchAll();
    }
	}

?>