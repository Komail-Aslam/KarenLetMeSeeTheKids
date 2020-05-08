<?php

	class Relation extends Model {

		public $client_id;
		public $professional_id;

		function insert(){
        	$sql = 'INSERT INTO Relations(client_id, professional_id) VALUES(:client_id, :professional_id)';
            $stmt = self::$_connection->prepare($sql);
            $stmt->execute(['client_id'=>$this->client_id, 'professional_id'=>$this->professional_id]);
            return self::$_connection->lastInsertId();
        }

        function getRelations($professional_id){
        	$sql = 'SELECT * FROM Relations WHERE professional_id = :professional_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['professional_id'=>$professional_id]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Relation');
	        return $stmt->fetchAll();
        }

        function getRelationsClientId($client_id){
        	$sql = 'SELECT * FROM Relations WHERE client_id = :client_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['client_id'=>$client_id]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Relation');
	        return $stmt->fetchAll();
        }

        function delete(){
        	$sql = 'DELETE FROM Relations WHERE client_id = :client_id AND professional_id = :professional_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['client_id'=>$this->client_id, 'professional_id'=>$this->professional_id]);
	        return $stmt->rowCount();
        }

        function getRequestsProfessional($receiver_id){
        	$sql = 'SELECT * FROM Requests WHERE receiver_id = :receiver_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['receiver_id'=>$receiver_id]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Request');
	        return $stmt->fetchAll();
        }

	}

?>