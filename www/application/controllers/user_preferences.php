<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class User_preferences extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['name'] = $session_data['name'];
            $this->load->view('templates/header',$data);
            $this->load->view('user_preferences_view', $data);
            $this->load->view('templates/footer',$data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('/', 'refresh');
        }
    }
}
