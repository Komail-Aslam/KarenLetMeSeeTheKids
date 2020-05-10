<?php

	class Appointment extends Model {

		public $client_id;
		public $professional_id;
		public $appLocation;
		public $appDate;
		public $appTime;

		function insert(){
        	$sql = 'INSERT INTO Appointments(client_id, professional_id, appLocation, appDate, appTime) VALUES(:client_id, :professional_id, :appLocation, :appDate, :appTime)';
            $stmt = self::$_connection->prepare($sql);
            $stmt->execute(['client_id'=>$this->client_id, 'professional_id'=>$this->professional_id, 'appLocation'=>$this->appLocation, 'appDate'=>$this->appDate, 'appTime'=>$this->appTime]);
            return self::$_connection->lastInsertId();
        }

        function update(){
        	$sql = 'UPDATE Appointments SET appLocation = :appLocation, appDate = :appDate, appTime = :appTime WHERE appointment_id = :appointment_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['appLocation'=>$this->appLocation, 'appDate'=>$this->appDate,'appTime'=>$this->appTime, 'appointment_id'=>$this->appointment_id]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Appointment');
	        return $stmt->rowCount();
        }

		function delete(){
		    $sql = 'DELETE FROM Appointments WHERE appointment_id = :appointment_id';
	        $stmt = self::$_connection->prepare($sql);
			$stmt->execute(['appointment_id'=>$this->appointment_id]);
	        return $stmt->rowCount();
        }

        function getAppointmentsProfessional($professional_id){
        	$sql = 'SELECT * FROM Appointments WHERE professional_id = :professional_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['professional_id'=>$professional_id]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Appointment');
	        return $stmt->fetchAll();
        }

        function getAppointmentsClient($client_id){
        	$sql = 'SELECT * FROM Appointments WHERE client_id = :client_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['client_id'=>$client_id]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Appointment');
	        return $stmt->fetchAll();
        }

        function getAppointmentById($appointment_id){
        	$sql = 'SELECT * FROM Appointments WHERE appointment_id = :appointment_id';
	        $stmt = self::$_connection->prepare($sql);
	        $stmt->execute(['appointment_id'=>$appointment_id]);
	        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Appointment');
	        return $stmt->fetch();
        }

	}

?>