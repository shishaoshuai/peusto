<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	
	/*
	 ÏÔÊ¾×¢²áÒ³Ãæ
	*/
	public function register() {
		$this->load->view('register');
	}
	
	public function create() {
		$this->load->view('welcome_message');
	}
}
