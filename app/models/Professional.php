<?php

	class Professional extends Model {

		public $profile_id;
		public $profession;
		public $education;
		public $years;

		function insert(){
        	$sql = 'INSERT INTO Professional(profile_id, profession, education, years) VALUES(:profile_id, :profession, :education, :years)';
            $stmt = self::$_connection->prepare($sql);
            $stmt->execute(['profile_id'=>$this->profile_id, 'profession'=>$this->profession, 'education'=>$this->education, 'years'=>$this->years]);
            return self::$_connection->lastInsertId();
        }

        function getProfessional($profile_id){
        	$sql = 'SELECT * FROM Professional WHERE profile_id = :profile_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['profile_id'=>$profile_id]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Professional');
	        return $stmt->fetch();
        }

        function getProfessionalProfessionalId($professional_id){
        	$sql = 'SELECT * FROM Professional WHERE professional_id = :professional_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['professional_id'=>$professional_id]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Professional');
	        return $stmt->fetch();
        }

        function getProfessionalProfession($profession){
        	$sql = 'SELECT * FROM Professional WHERE profession = :profession';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['profession'=>$profession]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Professional');
	        return $stmt->fetchAll();
        }

	}

?>