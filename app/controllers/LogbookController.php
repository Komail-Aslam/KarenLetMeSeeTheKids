<?php

class LogbookController extends Controller
{

	public function index()
    {
        if (isset($_SESSION['user_id']))
            header('location:/Logbook/viewLogbook');
        else 
            header('location:/Home/login');
    }

	public function viewLogbook(){
		$logbook = $this->model('Logbook');

		if (isset($_POST['writeLogbook']))
			return header('location:/Logbook/writeLogbook');
		else if (isset($_SESSION['professional_id'])){
			$thisLogbook = $logbook->viewLogbook($_SESSION['viewClientLogbook']);
			$this->view('logbook/viewLogbook', ['logbook'=>$thisLogbook]);
		}
		else{
			$thisLogbook = $logbook->viewLogbook($_SESSION['client_id']);
			$this->view('logbook/viewLogbook', ['logbook'=>$thisLogbook]);
		}

	}

	public function writeLogbook()
	{	
		if (isset($_POST['writeLog'])){
			$logbook = $this->model('Logbook');
			if (trim($_POST['log_title']) == null || trim($_POST['log_content']) == null) {
				$_SESSION['error'] = "Error: You must fill in all fields.";
				$this->view('logbook/writeLogbook');
			}
			else {
				$logbook->client_id = $_SESSION['client_id'];
				$logbook->log_title = $_POST['log_title'];
				$logbook->log_content = $_POST['log_content'];
				$logbook->insert();
				return header('location:/Logbook/viewLogbook');
			}
		}
		else
			$this->view('logbook/writeLogbook');
	}
}	