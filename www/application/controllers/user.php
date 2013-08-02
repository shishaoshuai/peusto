<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
    }
	/*
	 显示注册页面
	*/
	public function register() {
        $this->load->helper('form');
		$this->load->view('register');
	}

    /*
     * 新增用户
     */
	public function create() {
        if( $this->users_model->set_user()) {
            $owner = $this->db->insert_id();
            $this->load->model('user_interest_area_model');
            $this->user_interest_area_model->initialize($owner);
        }

        $this->load->helper('url');
        redirect('/');
	}

    public function login() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_login');
        if($this->form_validation->run() == FALSE) {
             $this->load->view('welcome_message');
       } else {
            redirect('/home', 'refresh');
        }
    }

    function check_login($password) {
        $username = $this->input->post('username');
        $result = $this->users_model->login($username, $password);
        if($result) {
            $sess_array = array();
            foreach($result as $row) {
                $sess_array = array(
                    'idusers' => $row->idusers,
                    'username' => $row->username,
                    'email' => $row->email
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check_login', 'Invalid username or password');
            return false;
        }
    }
}
