<?php

	class Review extends Model {

		public $client_id;
		public $professional_id;
		public $review_content;

		function insert(){
        	$sql = 'INSERT INTO Reviews(client_id, professional_id, review_content) VALUES(:client_id, :professional_id, :review_content)';
            $stmt = self::$_connection->prepare($sql);
            $stmt->execute(['client_id'=>$this->client_id, 'professional_id'=>$this->professional_id, 'review_content'=>$this->review_content]);
            return self::$_connection->lastInsertId();
        }

        function getReviews($professional_id){
        	$sql = 'SELECT * FROM Reviews WHERE professional_id = :professional_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['professional_id'=>$professional_id]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Review');
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