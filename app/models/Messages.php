<?php

	class Messages extends Model {

		public $message;
		public $sender;
		public $receiver;

		function insert(){
        	$sql = 'INSERT INTO Messages(message, sender, receiver) VALUES(:message, :sender, :receiver)';
            $stmt = self::$_connection->prepare($sql);
            $stmt->execute(['message'=>$this->message, 'sender'=>$this->sender, 'receiver'=>$this->receiver]);
            return self::$_connection->lastInsertId();
        }

        function viewMessages($profile_id){
        	$sql = 'SELECT * FROM Messages WHERE receiver = :profile_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['profile_id'=>$profile_id]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Messages');
	        return $stmt->fetchAll();
        }

	}

?>