<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Target extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['active_nav_item'] = 'target';
            $data['interest_area_list']=$this->get_dropdown_list();

            $this->load->view('templates/header',$data);
            $this->load->view('target_view', $data);
            $this->load->view('templates/footer',$data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('/', 'refresh');
        }
    }

    function get_dropdown_list() {
        $this->load->model('interest_area_model');
        return $this->interest_area_model->get_dropdwon_list();
    }
}
