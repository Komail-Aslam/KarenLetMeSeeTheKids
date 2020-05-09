<?php

class MessageController extends Controller{

	public function viewMessages(){
    	if(!isset($_SESSION['user_id']) || $_SESSION['user_id']==null)
    		return header('location:/Home/Login');
    	$profile = $this->model('Profile');
    	$currentProfile = $profile->currentProfile($_SESSION['user_id']);

    	$message = $this->model('Messages');
    	$messages = $message->viewMessages($currentProfile->user_id);

    	if (isset($_POST['create']))
    		return header('location:/Message/createMessage');

		$this->view('home/viewMessages', ['messages' => $messages]);
    }

    public function createMessage(){

    	if (isset($_POST['search'])){
    		$search = $_POST['receiver'];
	    	$profile = $this->model('Profile');
	   		$profiles = $profile->search($search);
    		$this->view('home/createMessage', ['profiles' => $profiles]);
    	}
    	else if (isset($_POST['proceed'])){
    		if (!isset($_POST['search_select'])){
    			$_SESSION['error'] = "Please select someone to send the message to.";
				$this->view('home/createMessage');
			}
			else {
			   	$_SESSION['receiver'] = $_POST['search_select'];
		    	return header('location:/Message/writeMessage');
			}
    	}
    	else {
			$this->view('home/createMessage');
    	}
    }

    public function writeMessage(){
    	$profile = $this->model('Profile');
		$receiver = $profile->currentProfile($_SESSION['receiver']);
    	$this->view('home/writeMessage', $receiver);
    	if (isset($_POST['send_message'])){
    		$message = $this->model('Messages');
    		$message->sender = $_SESSION['user_id'];
    		$message->receiver = $_SESSION['receiver'];
    		$message->message = $_POST['message'];
    		$message->insert();
    		return header('location:/Message/viewMessages');
    	}
    }
}