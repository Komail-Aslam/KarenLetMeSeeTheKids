<?php

class HomeController extends Controller
{
    public function index()
    {
        if (isset($_SESSION['user_id'])){
            header('location:/Home/homepage');
        }
        else {
            header('location:/Home/login');
        }
    }

    public function login()
    {
	   	if(isset($_POST['action'])){
	   		//login logic
		   	$username = $_POST['username'];
		   	$password = $_POST['password'];
		   	$user = $this->model('User')->getUser($username);
		   	if($user!=null && password_verify($password, $user->password_hash)){
		   		$_SESSION['user_id'] = $user->user_id;
		   		$profile = $this->model('Profile')->currentProfile($_SESSION['user_id']);
		   		if ($profile == null)
		     		header('location:/Home/Welcome');
		     	else {
		     		$_SESSION['profile_id'] = $profile->profile_id;
		     		header('location:/Home/homepage');
		     	}
		   	}
		    else{
		    	$_SESSION["error"] = "Wrong username or password!";
		    	$this->view('home/login');
		    }
	   	}else{
	       	$this->view('home/login');
	   	}
    }

    public function Welcome(){
    	if(!isset($_SESSION['user_id']) || $_SESSION['user_id']==null)
    		return header('location:/Home/Login');
    	if(isset($_SESSION['profile_id']))
    		return header('location:/Home/homepage');
    	
    	$id = $_SESSION['user_id'];
    	
    	if (isset($_POST['action'])){
       		$first_name = $_POST['first_name'];
       		$last_name = $_POST['last_name'];
       		$email = $_POST['email'];
       		$city = $_POST['city'];
       		$country = $_POST['country'];

       		if ($first_name == null || $last_name == null || $email == null || $city == null || $country == null){
       			$_SESSION['error'] = "You must fill in each field.";
       			$this->view('home/welcome');
       		}
       		else if (!isset($_POST['clientOrProfessional'])){
       			$_SESSION["error"] = "You must choose a type of profile option.";
	       		$this->view('home/welcome');
       		}
	       	else
	       	{
	       		$profile = $this->model('Profile');
	       		$profile->user_id = $id;
	       		$profile->first_name = $first_name;
	       		$profile->last_name = $last_name;
	       		$profile->email = $email;
	       		$profile->city = $city;
	       		$profile->country = $country;
	       		$profile->insert();
	       		$_SESSION['profile_id'] = $profile->profile_id;
		        $profiles = $profile->All();
		        
		        if ($_POST['clientOrProfessional'] == 'client')
		        	header('location:/Client/clientProfileCreate');
		        else
		        	header('location:/Professional/professionalProfileCreate');
	       	}
	    }
	    else{
	       	$this->view('home/welcome');
	   	}
    }

    public function Logout(){
    	session_destroy();
    	header('location:/Home/Login');
    }

    public function register()
    {

	   	if(isset($_POST['action'])){
		   	$username = $_POST['username'];
		   	$password = $_POST['password'];
		   	$password_confirmation = $_POST['password_confirmation'];

		   	if($password == $password_confirmation){
		     	$user = $this->model('User');
		     	$user->username = $username;
		     	$user->password_hash = password_hash($password, PASSWORD_DEFAULT);//
		     	$user->insert();//
		     	//RedirectToAction
		     	header('location:/Home/Login');
		    }else{
		    	//provide an error message

		    }
	   	}else{
	       	$this->view('home/register');
	   	}
    }

    public function homepage(){
    	if(!isset($_SESSION['user_id']) || $_SESSION['user_id']==null)
    		return header('location:/Home/Login');

    	$profile = $this->model('Profile');
    	$currentProfile = $profile->currentProfile($_SESSION['user_id']);
    	$_SESSION['profile_id'] = $currentProfile->profile_id;

    	$client = $this->model('Client');
    	$currentClient = $client->getClient($_SESSION["profile_id"]);
    	if ($currentClient != null)
    		$_SESSION["client_id"] = $currentClient->client_id;
    	else {
    		$professional = $this->model('Professional');
    		$currentProfessional = $professional->getProfessional($currentProfile->profile_id);
    		$_SESSION["professional_id"] = $currentProfessional->professional_id;
    	}

    	$post = $this->model('Post');
    	$posts = $post->viewPosts();
    	$comment = $this->model('Comments');
    	$comments = $comment->allComments();

    	if(isset($_SESSION['professional_id'])){
	    	foreach ($comments as $comment) {
	    			// echo +$_POST[$comment->comment_id];
	    		if (isset($_POST["1+$comment->comment_id"])){
	    			$comment->verifyComment($comment->comment_id);
	    		}
	    		if (isset($_POST["0+$comment->comment_id"])){
	    			$comment->unverifyComment($comment->comment_id);
	    		}
	    	}
    	}

    	foreach ($posts as $post) {
    		if (isset($_POST[$post->post_id])){
    			$_SESSION['comment_post'] = $post->post_id;
    			return header('location:/Comment/writeComment');
    		}
    	}
    	$this->view('home/homepage', ['posts' => $posts]);
    }

    public function writePost(){
    	if(!isset($_SESSION['user_id']) || $_SESSION['user_id']==null)
    		return header('location:/Home/Login');

    	if (isset($_POST['post'])) {
            if ($_POST['post_content'] == null || ctype_space($_POST['post_content'])){
                $_SESSION['error'] = "Error: The post must contain text.";
                $this->view('home/writePost');
            }
            else {
        		$post = $this->model('Post');
        		$post->client_id = $_SESSION['client_id'];
        		$post->post_content = $_POST['post_content'];
        		$post->insert();
        		header('location:/Home/homepage');
            }
    	}
    	else
    		$this->view('home/writePost');
    }
}

?>