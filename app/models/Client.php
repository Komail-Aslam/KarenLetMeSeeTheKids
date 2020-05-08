<?php

	class Client extends Model {

		public $profile_id;
		public $professional_type;

		function insert(){
        	$sql = 'INSERT INTO Client(profile_id, professional_type) VALUES(:profile_id, :professional_type)';
            $stmt = self::$_connection->prepare($sql);
            $stmt->execute(['profile_id'=>$this->profile_id, 'professional_type'=>$this->professional_type]);
            return self::$_connection->lastInsertId();
        }

        function getClient($profile_id){
        	$sql = 'SELECT * FROM Client WHERE profile_id = :profile_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['profile_id'=>$profile_id]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Client');
	        return $stmt->fetch();
        }

        function getClientClientId($client_id){
        	$sql = 'SELECT * FROM Client WHERE client_id = :client_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['client_id'=>$client_id]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Client');
	        return $stmt->fetch();
        }

        function getClientProfessionalType($professional_type){
        	$sql = 'SELECT * FROM Client WHERE professional_type = :professional_type';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['professional_type'=>$professional_type]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Client');
	        return $stmt->fetchAll();
        }

	}

?>