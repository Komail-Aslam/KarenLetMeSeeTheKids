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

	}

?>