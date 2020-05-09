<?php

	class ReviewComment extends Model {

		public $professional_id;
		public $review_id;
		public $comment;

		function insert(){
        	$sql = 'INSERT INTO ReviewComments(professional_id, review_id, comment) VALUES(:professional_id, :review_id, :comment)';
            $stmt = self::$_connection->prepare($sql);
            $stmt->execute(['professional_id'=>$this->professional_id, 'review_id'=>$this->review_id, 'comment'=>$this->comment]);
            return self::$_connection->lastInsertId();
        }

        function getComments($review_id){
        	$sql = 'SELECT * FROM ReviewComments WHERE review_id = :review_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['review_id'=>$review_id]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'ReviewComment');
	        return $stmt->fetchAll();
        }
	}

?>