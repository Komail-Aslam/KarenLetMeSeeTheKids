<?php

	class Logbook extends Model {

		public $client_id;
		public $log_title;
		public $log_content;

		function insert(){
        	$sql = 'INSERT INTO Logbook(client_id, log_title, log_content) VALUES(:client_id, :log_title, :log_content)';
            $stmt = self::$_connection->prepare($sql);
            $stmt->execute(['client_id'=>$this->client_id, 'log_title'=>$this->log_title, 'log_content'=>$this->log_content]);
            return self::$_connection->lastInsertId();
        }

        function viewLogbook($client_id){
        	$sql = 'SELECT * FROM Logbook WHERE client_id = :client_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['client_id'=>$client_id]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Logbook');
	        return $stmt->fetchAll();
        }

	}

?>