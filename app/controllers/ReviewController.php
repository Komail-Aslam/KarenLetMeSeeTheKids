<?php

class ReviewController extends Controller{

    public function index()
    {
        if (isset($_SESSION['user_id']))
            header('location:/Review/writeReview');
        else 
            header('location:/Home/login');
    }

	 public function writeReview(){
    	$professional = $this->model('Professional');
    	$pro = $professional->getProfessional($_SESSION['professionalReview']);

    	if (isset($_POST['writeReview'])){
            if ($_POST['reviewContent'] == null || ctype_space($_POST['reviewContent'])){
                $_SESSION['error'] = "Error: The review must contain text.";
                $this->view('home/writeReview', $_SESSION['professionalReview']);
            }
            else {
        		$review = $this->model('Review');
        		$review->client_id = $_SESSION['client_id'];
        		$review->professional_id = $pro->professional_id;
        		$review->review_content = $_POST['reviewContent'];
        		$review->insert();
        		return header('location:/Professional/viewProfessionals');
            }
    	}
        else
    	   $this->view('home/writeReview', $_SESSION['professionalReview']);
    }
	
}