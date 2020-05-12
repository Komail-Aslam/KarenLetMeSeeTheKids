<?php

class ProfileController extends Controller{

	public function index()
    {
        if (isset($_SESSION['user_id']))
            header('location:/Profile/modifyProfile');
        else 
            header('location:/Home/login');
    }

	public function modifyProfile(){
    	if(!isset($_SESSION['user_id']) || $_SESSION['user_id']==null)
    		return header('location:/Home/Login');
    	$profile = $this->model('Profile');
    	$currentProfile = $profile->currentProfile($_SESSION['user_id']);

		if (isset($_POST['action'])){
			$checked = true;

			$array = array($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['city'], $_POST['country']);
			foreach ($array as $field) {
				$text = trim($field);
				if (empty($text)){
					$checked = false;
					$_SESSION['error'] = "Error: All fields must be filled.";
					$this->view('profile/modifyProfile', $currentProfile);
				}
			}
			if ($checked){
				$profile = $this->model('profile');
				$profile->profile_id = $_SESSION['profile_id'];
				$profile->user_id = $_SESSION['user_id'];
				$profile->first_name = $_POST['first_name'];
	       		$profile->last_name = $_POST['last_name'];
	       		$profile->email = $_POST['email'];
	       		$profile->city = $_POST['city'];
	       		$profile->country = $_POST['country'];
	       		$profile->update();
	       		if (isset($_SESSION['professional_id'])){
	       			if ($_POST['education'] == null || ctype_space($_POST['education']) || $_POST['years'] == null || ctype_space($_POST['years'])){
	       				$_SESSION['error'] = "Error: All fields must be filled.";
						$this->view('profile/modifyProfile', $currentProfile);
	       			}
	       			else {
		       			$professional = $this->model('Professional');
		       			$pro = $professional->getProfessionalProfessionalId($_SESSION['professional_id']);
		       			$pro->profession = $_POST['professional_type'];
			    		$pro->education = $_POST['education'];
			    		$pro->years = $_POST['years'];
			    		$pro->update();
			    		header('location:/Home/homepage');
		    		}
	       		}
	       		if (isset($_SESSION['client_id']))
	       			header('location:/Home/homepage');
	       	}
		}
		else
			$this->view('profile/modifyProfile', $currentProfile);
		

		if (isset($_SESSION['professional_id'])){
			$review = $this->model('Review');
			$reviews = $review->getReviews($_SESSION['professional_id']);

			foreach ($reviews as $review) {
				if (isset($_POST[$review->review_id])){
					$_SESSION['reviewCommentId'] = $review->review_id;
					header('location:/Comment/writeReviewComment');
				}
			}
		}
    }
}