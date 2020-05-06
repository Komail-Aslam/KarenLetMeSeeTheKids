<?php

	class Messages extends Model {

		public $message;
		public $sender;
		public $receiver;

		function insert(){
        	$sql = 'INSERT INTO Message(message, sender, receiver) VALUES(:message, :sender, :receiver)';
            $stmt = self::$_connection->prepare($sql);
            $stmt->execute(['message'=>$this->message, 'sender'=>$this->sender, 'receiver'=>$this->receiver]);
            return self::$_connection->lastInsertId();
        }

        function viewMessages($user_id){
        	$sql = 'SELECT * FROM Message WHERE receiver = :user_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['user_id'=>$user_id]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Message');
	        return $stmt->fetchAll();
        }

	}

?>