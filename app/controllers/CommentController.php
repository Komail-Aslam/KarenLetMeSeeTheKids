<?php

class CommentController extends Controller
{

	public function index()
    {
        if (isset($_SESSION['user_id']))
            header('location:/Home/homepage');
        else 
            header('location:/Home/login');
    }

	public function writeComment(){
    	if(!isset($_SESSION['user_id']) || $_SESSION['user_id']==null)
    		return header('location:/Home/Login');
		
		$post = $this->model('Post');
		$currentPost = $post->getPost($_SESSION['comment_post']);

		if (isset($_POST['write_comment'])){
			if ($_POST['comment'] == null || ctype_space($_POST['comment'])){
                $_SESSION['error'] = "Error: The comment must contain text.";
                $this->view('comments/writeComment', $currentPost);
            }
            else {
				$comment = $this->model('Comments');
				$comment->commenter_id = $_SESSION['profile_id'];
				$comment->post_id = $_SESSION['comment_post'];
				$comment->comment = $_POST['comment'];
				$comment->insert();
				return header('location:/Home/homepage');
			}
		}
		else
			$this->view('comments/writeComment', $currentPost);   	
    }

    public function writeReviewComment(){
    	if (isset($_POST['writeComment'])){
    		if ($_POST['reviewComment'] == null || ctype_space($_POST['reviewComment'])){
    			$_SESSION['error'] = "Error: The comment must contain text.";
    			$this->view('comments/writeReviewComment');
    		}
    		else {
	    		$reviewComment = $this->model('ReviewComment');
	    		$reviewComment->professional_id = $_SESSION['professional_id'];
	    		$reviewComment->review_id = $_SESSION['reviewCommentId'];
	    		$reviewComment->comment = $_POST['reviewComment'];
	    		$reviewComment->insert();
	    		header('location:/Profile/modifyProfile');
	    	}
    	}
    	$this->view('comments/writeReviewComment');
    }
}