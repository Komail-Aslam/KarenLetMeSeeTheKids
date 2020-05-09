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

        function getReviewReviewId($review_id){
        	$sql = 'SELECT * FROM Reviews WHERE review_id = :review_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['review_id'=>$review_id]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Review');
	        return $stmt->fetch();
        }
	}

?>