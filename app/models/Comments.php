<?php

	class Comments extends Model {

		public $commenter_id;
		public $post_id;
		public $comment;
		public $verified;

		function insert(){
        	$sql = 'INSERT INTO Comments(commenter_id, post_id, comment, verified) VALUES(:commenter_id, :post_id, :comment, :verified)';
            $stmt = self::$_connection->prepare($sql);
            $stmt->execute(['commenter_id'=>$this->commenter_id, 'post_id'=>$this->post_id, 'comment'=>$this->comment, 'verified'=>0]);
            return self::$_connection->lastInsertId();
        }

        function viewComments($post_id){
        	$sql = 'SELECT * FROM Comments WHERE post_id = :post_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['post_id'=>$post_id]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Comments');
	        return $stmt->fetchAll();
        }

	}

?>