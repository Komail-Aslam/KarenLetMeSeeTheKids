<?php

	class Request extends Model {

		public $sender_id;
		public $receiver_id;
		public $status;
		public $type;

		function insertRelationRequest(){
        	$sql = 'INSERT INTO Requests(sender_id, receiver_id, status, type) VALUES(:sender_id, :receiver_id, :status, :type)';
            $stmt = self::$_connection->prepare($sql);
            $stmt->execute(['sender_id'=>$this->sender_id, 'receiver_id'=>$this->receiver_id, 'status'=>0, 'type'=>"relation"]);
            return self::$_connection->lastInsertId();
        }

        function insertAppointmentRequest(){
        	$sql = 'INSERT INTO Requests(sender_id, receiver_id, status, type) VALUES(:sender_id, :receiver_id, :status, :type)';
            $stmt = self::$_connection->prepare($sql);
            $stmt->execute(['sender_id'=>$this->sender_id, 'receiver_id'=>$this->receiver_id, 'status'=>0, 'type'=>"appointment"]);
            return self::$_connection->lastInsertId();
        }

        function getRequest($sender_id, $receiver_id, $type){
        	$sql = 'SELECT * FROM Requests WHERE sender_id = :sender_id AND receiver_id = :receiver_id AND type = :type';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['sender_id'=>$sender_id, 'receiver_id'=>$receiver_id, 'type'=>$type]);
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
        	$sql = 'SELECT * FROM Requests WHERE receiver_id = :receiver_id AND type = :type';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['receiver_id'=>$receiver_id, 'type'=>"relation"]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Request');
	        return $stmt->fetchAll();
        }

        function getRequestsClient($sender_id){
            $sql = 'SELECT * FROM Requests WHERE sender_id = :sender_id AND type = :type';
            $stmt = self::$_connection->prepare($sql);
            $stmt->execute(['sender_id'=>$sender_id, 'type'=>"relation"]);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Request');
            return $stmt->fetchAll();
        }

        function getAppRequestsProfessional($receiver_id){
        	$sql = 'SELECT * FROM Requests WHERE receiver_id = :receiver_id AND type = :type';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['receiver_id'=>$receiver_id, 'type'=>"appointment"]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Request');
	        return $stmt->fetchAll();
        }

        function getAppRequestsClient($sender_id){
            $sql = 'SELECT * FROM Requests WHERE sender_id = :sender_id AND type = :type';
            $stmt = self::$_connection->prepare($sql);
            $stmt->execute(['sender_id'=>$sender_id, 'type'=>"appointment"]);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Request');
            return $stmt->fetchAll();
        }

	}

?>