<?php

	class Request extends Model {

		public $sender_id;
		public $receiver_id;
		public $status;

		function insert(){
        	$sql = 'INSERT INTO Requests(sender_id, receiver_id, status) VALUES(:sender_id, :receiver_id, :status)';
            $stmt = self::$_connection->prepare($sql);
            $stmt->execute(['sender_id'=>$this->sender_id, 'receiver_id'=>$this->receiver_id, 'status'=>0]);
            return self::$_connection->lastInsertId();
        }

        function getRequest($sender_id, $receiver_id){
        	$sql = 'SELECT * FROM Requests WHERE sender_id = :sender_id AND receiver_id = :receiver_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['sender_id'=>$sender_id, 'receiver_id'=>$receiver_id]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Requests');
	        return $stmt->fetch();
        }

        function delete(){
        	$sql = 'DELETE FROM Requests WHERE sender_id = :sender_id AND receiver_id = :receiver_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['sender_id'=>$this->sender_id, 'receiver_id'=>$this->receiver_id]);
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