<?php

class ClientController extends Controller{

	public function clientProfileCreate(){
    	if(!isset($_SESSION['user_id']) || $_SESSION['user_id']==null)
    		return header('location:/Home/Login');

    	$profile = $this->model('Profile');
    	$currentProfile = $profile->currentProfile($_SESSION['user_id']);
    	$this->view('home/clientProfileCreate', $currentProfile);

    	if (isset($_POST['action'])){
    		if (!isset($_POST['professional_type'])){
    			$_SESSION["error"] = "Please select one of the options.";
	    		$this->view('home/clientProfileCreate', $currentProfile);
	    	}
	    	else {
	    		$client = $this->model('Client');
	    		$client->profile_id = $currentProfile->profile_id;
	    		$client->professional_type = $_POST['professional_type'];
	    		$client->insert();
	    		header('location:/Home/homepage');
	    	}
    	}
    	else
    		$this->view('home/clientProfileCreate', $currentProfile);
    }

    public function viewClients(){
		$request = $this->model('Request');
		$allRequests = $request->getRequestsProfessional($_SESSION['professional_id']);
		$relation = $this->model('Relation');
		$allRelations = $relation->getRelations($_SESSION['professional_id']);

		if (isset($_POST['search'])){
	   		$_SESSION['client_search'] = $_POST['search_client'];
			$search = $_SESSION['client_search'];
			$profile = $this->model('Profile');
		   	$profiles = $profile->search($search);
		   	$client = $this->model('Client');
			$clients = $client->getClientProfessionalType($search);
		   	if ($profiles!=null || $clients!=null)
    			header('location:/Client/searchClient');
    		else{
    			$_SESSION['error'] = "No profiles found.";
    			$this->view('home/viewClients', ['requests' => $allRequests, 'relations' => $allRelations]);
    		}
		}

		foreach ($allRequests as $request) {
			$client = $this->model('Client');
			$sender = $client->getClientClientId($request->sender_id);
			
			if (isset($_POST["0+$sender->profile_id"])){
				$_SESSION['viewClientProfileId'] = $sender->profile_id;
				return header('location:/Client/viewClientProfile');
			}
			else if (isset($_POST["1+$request->sender_id"])){
				$relation = $this->model('Relation');
				$relation->client_id = $request->sender_id;
				$relation->professional_id = $request->receiver_id;
				$relation->insert();
				$request->delete();
				return header('location:/Client/viewClients');
			}
			else if (isset($_POST["2+$request->sender_id"])){
				$request->delete();
				return header('location:/Client/viewClients');
			}
		}

		foreach ($allRelations as $relation) {
			$client = $this->model('Client');
			$currClient = $client->getClientClientId($relation->client_id);
			if (isset($_POST["$currClient->client_id"])){
				$relation->delete();
				return header('location:/Client/viewClients');
			}
			else if (isset($_POST["0+$currClient->client_id"])){
				$profile = $this->model('Profile');
				$currProfile = $profile->currentProfileProfileId($currClient->profile_id);
				$_SESSION['receiver'] = $currProfile->user_id;
				return header('location:/Message/writeMessage');
			}
			else if(isset($_POST["1+$currClient->client_id"])){
				$_SESSION['viewClientLogbook'] = $currClient->client_id;
				return header('location:/Logbook/viewLogbook');
			}
		}

		$this->view('home/viewClients', ['requests' => $allRequests, 'relations' => $allRelations]);
	}

	public function searchClient()
	{
		$search = $_SESSION['client_search'];

		$profile = $this->model('Profile');
	   	$profiles = $profile->search($search);
	   	if ($profiles!=null){
			$this->view('home/searchClient', ['profiles'=> $profiles]);
			foreach ($profiles as $profile) {
				if (isset($_POST[$profile->profile_id])){
					$_SESSION['viewClientProfileId'] = $profile->profile_id;
					return header('location:/Client/viewClientProfile');
				}
			}
	   	}

		$client = $this->model('Client');
		$clients = $client->getClientProfessionalType($search);
		if ($clients!=null){
			$this->view('home/searchClient', ['clients'=> $clients]);
			foreach ($clients as $client) {
				if (isset($_POST[$client->profile_id])){
					$_SESSION['viewClientProfileId'] = $client->profile_id;
					return header('location:/Client/viewClientProfile');
				}
			}
		}
	}

	public function viewClientProfile(){
		$profile = $this->model('Profile');
		$currentProfile = $profile->currentProfileProfileId($_SESSION['viewClientProfileId']);
		$this->view('home/viewClientProfile', $currentProfile);
	}

}