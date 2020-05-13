<?php

class PersonController extends Controller{

	public function index(){
		$this->model('persons');
		$this->view('person/index');
	}

}


?>