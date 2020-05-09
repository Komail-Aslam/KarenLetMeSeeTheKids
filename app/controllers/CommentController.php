<?php

class CommentController extends Controller
{
	public function writeComment(){
    	if(!isset($_SESSION['user_id']) || $_SESSION['user_id']==null)
    		return header('location:/Home/Login');
		
		$post = $this->model('Post');
		$currentPost = $post->getPost($_SESSION['comment_post']);

		if (isset($_POST['write_comment'])){
			$comment = $this->model('Comments');
			$comment->commenter_id = $_SESSION['profile_id'];
			$comment->post_id = $_SESSION['comment_post'];
			$comment->comment = $_POST['comment'];
			$comment->insert();
			return header('location:/Home/homepage');
		}
		else
			$this->view('home/writeComment', $currentPost);   	
    }

    public function writeReviewComment(){
    	if (isset($_POST['writeComment'])){
    		$reviewComment = $this->model('ReviewComment');
    		$reviewComment->professional_id = $_SESSION['professional_id'];
    		$reviewComment->review_id = $_SESSION['reviewCommentId'];
    		$reviewComment->comment = $_POST['reviewComment'];
    		$reviewComment->insert();
    		header('location:/Profile/modifyProfile');
    	}
    	$this->view('home/writeReviewComment');
    }
}