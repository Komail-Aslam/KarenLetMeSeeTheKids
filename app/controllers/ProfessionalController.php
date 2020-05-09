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

	public function viewProfessionals(){
    	$relation = $this->model('Relation');
		$allRelations = $relation->getRelationsClientId($_SESSION['client_id']);

    	if (isset($_POST['search'])){
	   		$_SESSION['professional_search'] = $_POST['search_professional'];
			$search = $_SESSION['professional_search'];
			$profile = $this->model('Profile');
		   	$profiles = $profile->search($search);
		   	$professional = $this->model('Professional');
			$professionals = $professional->getProfessionalProfession($search);
		   	if ($profiles!=null || $professionals!=null)
    			header('location:/Professional/searchProfessional');
    		else{
    			//error
    			$this->view('home/viewProfessionals', ['relations' => $allRelations]);
    		}
		}

		foreach ($allRelations as $relation) {
			$professional = $this->model('Professional');
			$currProfessional = $professional->getProfessionalProfessionalId($relation->professional_id);
			if (isset($_POST["$currProfessional->professional_id"])){
				$relation->delete();
				return header('location:/Professional/viewProfessionals');
			}
			else if (isset($_POST["0+$currProfessional->professional_id"])){
				$profile = $this->model('Profile');
				$currProfile = $profile->currentProfileProfileId($currProfessional->profile_id);
				$_SESSION['receiver'] = $currProfile->user_id;
				return header('location:/Message/writeMessage');
			}
			else if (isset($_POST["1+$currProfessional->professional_id"])){
				$_SESSION['professionalReview'] = $currProfessional->profile_id;
				return header('location:/Review/writeReview');
			}
		}

    	$this->view('home/viewProfessionals', ['relations' => $allRelations]);
    }

    public function searchProfessional(){
    	$search = $_SESSION['professional_search'];

		$profile = $this->model('Profile');
	   	$profiles = $profile->search($search);
	   	if ($profiles!=null){
			$this->view('home/searchProfessional', ['profiles'=> $profiles]);
			foreach ($profiles as $profile) {
				if (isset($_POST[$profile->profile_id])){
					$_SESSION['viewProfessionalProfileId'] = $profile->profile_id;
					return header('location:/Professional/viewProfessionalProfile');
				}
			}
	   	}

		$professional = $this->model('Professional');
		$professionals = $professional->getProfessionalProfession($search);
		if ($professionals!=null){
			$this->view('Professional/searchProfessional', ['professionals'=> $professionals]);
			foreach ($professionals as $professional) {
				if (isset($_POST[$professional->profile_id])){
					$_SESSION['viewProfessionalProfileId'] = $professional->profile_id;
					return header('location:/Professional/viewProfessionalProfile');
				}
			}
		}
    }

    public function viewProfessionalProfile(){
    	$profile = $this->model('Profile');
		$currentProfile = $profile->currentProfileProfileId($_SESSION['viewProfessionalProfileId']);
		$professional = $this->model('Professional');
		$professionalProfile = $professional->getProfessional($_SESSION['viewProfessionalProfileId']);
		$request = $this->model('Request');
		$request->sender_id = $_SESSION['client_id'];
		$request->receiver_id = $professionalProfile->professional_id;

		$review = $this->model('Review');
		$reviews = $review->getReviews($professionalProfile->professional_id);

		if (isset($_POST['request'])){
			$request->insert();
			$this->view('home/viewProfessionalProfile', ['currentProfile'=>$currentProfile, 'reviews' => $reviews]);
		}
		else if (isset($_POST['deleteRequest'])){
			$request->delete();
			$this->view('home/viewProfessionalProfile', ['currentProfile'=>$currentProfile, 'reviews' => $reviews]);
		}
		else
			$this->view('home/viewProfessionalProfile', ['currentProfile'=>$currentProfile, 'reviews' => $reviews]);
    }

}