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
            if ($_POST['receiver'] == null || ctype_space($_POST['receiver'])){
                $_SESSION['error'] = "Please enter a name to search.";
                $this->view('home/createMessage');
            }
            else {
        		$search = $_POST['receiver'];
    	    	$profile = $this->model('Profile');
    	   		$profiles = $profile->search($search);
                $client = $this->model('Client');
                $searchClients = array();
                foreach ($profiles as $profile) {
                    $currentClient = $client->getClient($profile->profile_id);
                    if ($currentClient != null)
                        array_push($searchClients, $profile);
                    if (isset($_SESSION['client_id'])){
                        $professional = $this->model('Professional');
                        $pro = $professional->getProfessional($profile->profile_id);
                        if ($pro != null){
                            $relation = $this->model('Relation');
                            $checkRelation = $relation->getRelation($_SESSION['client_id'], $pro->professional_id);
                            if ($checkRelation != null)
                                array_push($searchClients, $profile);
                        }
                    }
                }
                if (isset($_SESSION['professional_id']))
                    $this->view('home/createMessage', ['profiles' => $profiles]);
                else
        		    $this->view('home/createMessage', ['profiles' => $searchClients]);
            }
    	}
    	else if (isset($_POST['proceed'])){
    		if (!isset($_POST['search_select'])){
    			$_SESSION['error'] = "Please search and select someone to send the message to.";
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
    	if (isset($_POST['send_message'])){
            if ($_POST['message'] == null || ctype_space($_POST['message'])){
                $_SESSION['error'] = "Error: The message must contain text.";
                $this->view('home/writeMessage', $receiver);
            }
            else {
        		$message = $this->model('Messages');
        		$message->sender = $_SESSION['user_id'];
        		$message->receiver = $_SESSION['receiver'];
        		$message->message = $_POST['message'];
        		$message->insert();
        		return header('location:/Message/viewMessages');
            }
    	}
        else
            $this->view('home/writeMessage', $receiver);
    }
}