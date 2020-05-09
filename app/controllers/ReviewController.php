<?php

class ReviewController extends Controller{

	 public function writeReview(){
    	$professional = $this->model('Professional');
    	$pro = $professional->getProfessional($_SESSION['professionalReview']);

    	if (isset($_POST['writeReview'])){
    		$review = $this->model('Review');
    		$review->client_id = $_SESSION['client_id'];
    		$review->professional_id = $pro->professional_id;
    		$review->review_content = $_POST['reviewContent'];
    		$review->insert();
    		return header('location:/Professional/viewProfessionals');
    	}
    	$this->view('home/writeReview', $_SESSION['professionalReview']);
    }
	
}