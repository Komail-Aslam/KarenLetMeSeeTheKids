<?php

	class Post extends Model {

		public $client_id;
		public $post_content;

		function insert(){
        	$sql = 'INSERT INTO Post(client_id, post_content) VALUES(:client_id, :post_content)';
            $stmt = self::$_connection->prepare($sql);
            $stmt->execute(['client_id'=>$this->client_id, 'post_content'=>$this->post_content]);
            return self::$_connection->lastInsertId();
        }

        function viewPosts(){
        	$sql = 'SELECT * FROM Post';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute();
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Post');
	        return $stmt->fetchAll();
        }

        function getPost($post_id){
	        $sql = 'SELECT * FROM Post WHERE post_id = :post_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['post_id'=>$post_id]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Post');
	        return $stmt->fetch();
	    }

	}

?>