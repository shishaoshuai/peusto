<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Target extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('target_model');
    }

    function index()
    {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];

            $this->load->model('user_interest_area_model');
            $data['interest_area_list']=$this->user_interest_area_model->get_dropdown_list($session_data['idusers']);

            $data['targets'] = $this->target_model->get_all_targets_by_interest_area();

            $this->load->helper('form');

            $data['active_nav_item'] = 'target';

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

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('target_name', '目标名称', 'required');
        $this->form_validation->set_rules('priority', '优先级', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this -> index();
        } else {
            $this->target_model->set_target();

            $data['active_nav_item'] = 'interest_area';

            redirect('target');
        }
    }
}