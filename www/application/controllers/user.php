<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
    }
	/*
	 ��ʾע��ҳ��
	*/
	public function register() {
        $this->load->helper('form');
		$this->load->view('register');
	}

    /*
     * �����û�
     */
	public function create() {
        $this->users_model->set_user();
		$this->load->view('welcome_message');
	}
}
