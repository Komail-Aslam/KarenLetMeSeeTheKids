<?php

class HomeController extends Controller
{
	public $mainProfile;

    public function index($name = '')
    {
       $profile = $this->model('Profile');
       $profiles = $profile->All();
       $this->view('home/index', ['profiles' => $profiles]);
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
		    	//provide an error message
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
		        	header('location:/Home/clientProfileCreate');
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

    public function homepage(){
    	if(!isset($_SESSION['user_id']) || $_SESSION['user_id']==null)
    		return header('location:/Home/Login');

    	$profile = $this->model('Profile');
    	$currentProfile = $profile->currentProfile($_SESSION['user_id']);
    	

    	$client = $this->model('Client');
    	$currentClient = $client->getClient($_SESSION['profile_id']);
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

    	foreach ($comments as $comment) {
    			// echo +$_POST[$comment->comment_id];
    		if (isset($_POST["1+$comment->comment_id"])){
    			$comment->verifyComment($comment->comment_id);
    		}
    		if (isset($_POST["0+$comment->comment_id"])){
    			$comment->unverifyComment($comment->comment_id);
    		}
    	}

    	foreach ($posts as $post) {
    		if (isset($_POST[$post->post_id])){
    			$_SESSION['comment_post'] = $post->post_id;
    			return header('location:/Home/writeComment');
    		}
    	}
    	$this->view('home/homepage', ['posts' => $posts]);
    }

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

    public function writePost(){
    	if(!isset($_SESSION['user_id']) || $_SESSION['user_id']==null)
    		return header('location:/Home/Login');

    	if (isset($_POST['post'])) {
    		$post = $this->model('Post');
    		$post->client_id = $_SESSION['client_id'];
    		$post->post_content = $_POST['post_content'];
    		$post->insert();
    		header('location:/Home/homepage');
    	}
    	else
    		$this->view('home/writePost');
    }

    public function modifyProfile(){
    	if(!isset($_SESSION['user_id']) || $_SESSION['user_id']==null)
    		return header('location:/Home/Login');
    	$profile = $this->model('Profile');
    	$currentProfile = $profile->currentProfile($_SESSION['user_id']);
		$this->view('home/modifyProfile', $currentProfile);

		if (isset($_POST['action'])){
			$profile = $this->model('profile');
			$profile->profile_id = $_SESSION['profile_id'];
			$profile->user_id = $_SESSION['user_id'];
			$profile->first_name = $_POST['first_name'];
       		$profile->last_name = $_POST['last_name'];
       		$profile->email = $_POST['email'];
       		$profile->city = $_POST['city'];
       		$profile->country = $_POST['country'];
       		$profile->update();
       		header('location:/Home/homepage');
		}


    }

    public function viewMessages(){
    	if(!isset($_SESSION['user_id']) || $_SESSION['user_id']==null)
    		return header('location:/Home/Login');
    	$profile = $this->model('Profile');
    	$currentProfile = $profile->currentProfile($_SESSION['user_id']);

    	$message = $this->model('Messages');
    	$messages = $message->viewMessages($currentProfile->user_id);	

		$this->view('home/viewMessages', ['messages' => $messages]);
    }

    public function createMessage(){

    	if (isset($_POST['search'])){
    		$search = $_POST['receiver'];
	    	$profile = $this->model('Profile');
	   		$profiles = $profile->search($search);
    		$this->view('home/createMessage', ['profiles' => $profiles]);
    	}
    	else if (isset($_POST['proceed'])){
    		if (!isset($_POST['search_select'])){
    			$_SESSION['error'] = "Please select someone to send the message to.";
				$this->view('home/createMessage');
			}
			else {
			   	$_SESSION['receiver'] = $_POST['search_select'];
		    	return header('location:/Home/writeMessage');
			}
    	}
    	else {
			$this->view('home/createMessage');
    	}
    }

    public function writeMessage(){
    	$profile = $this->model('Profile');
		$receiver = $profile->currentProfile($_SESSION['receiver']);
    	$this->view('home/writeMessage', $receiver);
    	if (isset($_POST['send_message'])){
    		$message = $this->model('Messages');
    		$message->sender = $_SESSION['user_id'];
    		$message->receiver = $_SESSION['receiver'];
    		$message->message = $_POST['message'];
    		$message->insert();
    		return header('location:/Home/viewMessages');
    	}
    }

    public function viewProfessionals(){
    	if (isset($_POST['search'])){
	   		$_SESSION['professional_search'] = $_POST['search_professional'];
			$search = $_SESSION['professional_search'];
			$profile = $this->model('Profile');
		   	$profiles = $profile->search($search);
		   	$professional = $this->model('Professional');
			$professionals = $professional->getProfessionalProfession($search);
		   	if ($profiles!=null || $professionals!=null)
    			header('location:/Home/searchProfessional');
    		else{
    			//error
    			$this->view('home/viewProfessionals');
    		}
		}
		else
    		$this->view('home/viewProfessionals');
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
					return header('location:/Home/viewProfessionalProfile');
				}
			}
	   	}

		$professional = $this->model('Professional');
		$professionals = $professional->getProfessionalProfession($search);
		if ($professionals!=null){
			$this->view('home/searchProfessional', ['professionals'=> $professionals]);
			foreach ($professionals as $professional) {
				if (isset($_POST[$professional->profile_id])){
					$_SESSION['viewProfessionalProfileId'] = $professional->profile_id;
					return header('location:/Home/viewProfessionalProfile');
				}
			}
		}
    }

    public function viewProfessionalProfile(){
    	$profile = $this->model('Profile');
		$currentProfile = $profile->currentProfileProfileId($_SESSION['viewProfessionalProfileId']);
		$this->view('home/viewProfessionalProfile', $currentProfile);
    }
}

?>