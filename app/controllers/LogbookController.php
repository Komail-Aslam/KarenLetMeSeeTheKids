<?php

class LogbookController extends Controller
{
	public function viewLogbook(){
		if (isset($_POST['writeLogbook']))
			return header('location:/Logbook/writeLogbook');
		else{
			$logbook = $this->model('Logbook');
			$thisLogbook = $logbook->viewLogbook($_SESSION['client_id']);
			$this->view('logbook/viewLogbook', ['logbook'=>$thisLogbook]);
		}
	}

	public function writeLogbook()
	{	
		if (isset($_POST['writeLog'])){
			$logbook = $this->model('Logbook');
			$logbook->client_id = $_SESSION['client_id'];
			$logbook->log_title = $_POST['log_title'];
			$logbook->log_content = $_POST['log_content'];
			$logbook->insert();
			return header('location:/Logbook/viewLogbook');
		}
		else
			$this->view('logbook/writeLogbook');
	}
}	