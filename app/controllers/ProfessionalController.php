<?php

class ProfessionalController extends Controller
{
	public function professionalProfileCreate(){
		if(!isset($_SESSION['user_id']) || $_SESSION['user_id']==null)
    		return header('location:/Home/Login');

    	$profile = $this->model('Profile');
    	$currentProfile = $profile->currentProfile($_SESSION['user_id']);

    	if (isset($_POST['action'])){
    		if (!isset($_POST['professional_type']) || $_POST['education'] == null || ($_POST['years']) == null){
    			$_SESSION["error"] = "Please enter all of the information.";
	    		$this->view('home/professionalProfileCreate', $currentProfile);
	    	}
	    	else {
	    		$professional = $this->model('Professional');
	    		$professional->profile_id = $currentProfile->profile_id;
	    		$professional->profession = $_POST['professional_type'];
	    		$professional->education = $_POST['education'];
	    		$professional->years = $_POST['years'];
	    		$professional->insert();
	    		header('location:/Home/homepage');
	    	}
    	}
    	else
    		$this->view('home/professionalProfileCreate', $currentProfile);
	}

	public function viewClients(){
		if (isset($_POST['search'])){
	   		$_SESSION['client_search'] = $_POST['search_client'];
			$search = $_SESSION['client_search'];
			$profile = $this->model('Profile');
		   	$profiles = $profile->search($search);
		   	$client = $this->model('Client');
			$clients = $client->getClientProfessionalType($search);
		   	if ($profiles!=null || $clients!=null)
    			header('location:/Professional/searchClient');
    		else{
    			//error
    			$this->view('home/viewClients');
    		}
		}
		else
			$this->view('home/viewClients');
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
					return header('location:/Professional/viewClientProfile');
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
					return header('location:/Professional/viewClientProfile');
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