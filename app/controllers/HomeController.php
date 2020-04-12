<?php

class HomeController extends Controller
{
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
		     	
		     	header('location:/Home/Welcome');
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
    	//echo "This is secure!<a href='/Home/Logout'>Logout!!</a>";
    	
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
		        $profiles = $profile->All();
		        //$this->view('home/clientProfileCreate', ['profiles' => $profiles]);
		        header('location:/Home/clientProfileCreate');
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
    	$profile = $this->model('Profile');
    	$this->view('home/clientProfileCreate',  ('profile' => $profile);
    }
}

?>