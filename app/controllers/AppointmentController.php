<?php

class AppointmentController extends Controller{

	public function viewAppointments(){
		$appointment = $this->model('Appointment');
		$request = $this->model('Request');

		if (isset($_SESSION['professional_id'])){
			$appointments = $appointment->getAppointmentsProfessional($_SESSION['professional_id']);
			$requests = $request->getAppRequestsProfessional($_SESSION['professional_id']);

			foreach ($requests as $request) {
				$client = $this->model('Client');
				$sender = $client->getClientClientId($request->sender_id);
				
				if (isset($_POST["0+$sender->profile_id"])){
					$_SESSION['viewClientProfileId'] = $sender->profile_id;
					return header('location:/Client/viewClientProfile');
				}
				else if (isset($_POST["1+$request->sender_id"])){
					$request->delete();
					$_SESSION['appointmentClientId'] = $request->sender_id;
					return header('location:/Appointment/createAppointment');
				}
				else if (isset($_POST["2+$request->sender_id"])){
					$request->delete();
					return header('location:/Appointment/viewAppointments');
				}
			}

			foreach ($appointments as $appointment) {
				$client = $this->model('Client');
				$sender = $client->getClientClientId($appointment->client_id);
				
				if (isset($_POST["3+$sender->profile_id"])){
					$_SESSION['viewClientProfileId'] = $sender->profile_id;
					return header('location:/Client/viewClientProfile');
				}
				else if (isset($_POST["$appointment->appointment_id"])){
					$_SESSION['modifyAppointmentId'] = $appointment->appointment_id;
					return header('location:/Appointment/modifyAppointment');
				}
				else if (isset($_POST["1+$appointment->appointment_id"])){
					$appointment->delete();
					return header('location:/Appointment/viewAppointments');
				}
			}

			$this->view('appointments/viewAppointments', ['requests'=>$requests, 'appointments'=>$appointments]);
		}

		if (isset($_SESSION['client_id'])){
			$appointments = $appointment->getAppointmentsClient($_SESSION['client_id']);
			$requests = $request->getAppRequestsClient($_SESSION['client_id']);

			foreach ($requests as $request) {
				if (isset($_POST["2+$request->sender_id"])){
					$request->delete();
					return header('location:/Appointment/viewAppointments');
				}
			}

			foreach ($appointments as $appointment) {
				$professional = $this->model('Professional');
				$pro = $professional->getProfessionalProfessionalId($appointment->professional_id);
				if (isset($_POST["$pro->profile_id"])){
					$_SESSION['viewProfessionalProfileId'] = $pro->profile_id;
					return header('location:/Professional/viewProfessionalProfile');
				}
				else if (isset($_POST["$appointment->appointment_id"])){
					$appointment->delete();
					return header('location:/Appointment/viewAppointments');
				}
			}

			$this->view('appointments/viewAppointmentsClient', ['requests'=>$requests, 'appointments'=>$appointments]);
		}
	}

	public function createAppointment(){
		$client = $this->model('Client');
		$thisClient = $client->getClientClientId($_SESSION['appointmentClientId']);
		$profile = $this->model('Profile');
		$clientProfile = $profile->currentProfileProfileId($thisClient->profile_id);

		if (isset($_POST['createAppointment'])){
			$appointment = $this->model('Appointment');
			$appointment->client_id = $thisClient->client_id;
			$appointment->professional_id = $_SESSION['professional_id'];
			$appointment->appLocation = $_POST['appLocation'];
			$appointment->appDate = $_POST['appDate'];
			$appointment->appTime = $_POST['appTime'];
			$appointment->insert();
			return header('location:/Appointment/viewAppointments');
		}

		$this->view('appointments/createAppointment', $clientProfile);
	}

	public function modifyAppointment(){
		$appointment = $this->model('Appointment');
		$thisAppointment = $appointment->getAppointmentById($_SESSION['modifyAppointmentId']);
		if (isset($_POST['modifyAppointment'])){
			$thisAppointment->appLocation = $_POST['appLocation'];
			$thisAppointment->appDate = $_POST['appDate'];
			$thisAppointment->appTime = $_POST['appTime'];
			$thisAppointment->update();
			return header('location:/Appointment/viewAppointments');
		}
		$this->view('appointments/modifyAppointment', $thisAppointment);
	}

}


?>