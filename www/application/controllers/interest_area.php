<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Interest_area extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_interest_area_model');
    }

    function index()
    {
        if($this->session->userdata('logged_in'))
        {
            $this->load->helper('form');

            $session_data = $this->session->userdata('logged_in');

            $data['username'] = $session_data['username'];
            $data['active_nav_item'] = 'interest_area';

            $data['interest_areas'] = $this->user_interest_area_model->get_interest_areas($session_data['idusers']);

            $this->load->view('templates/header',$data);
            $this->load->view('interest_area_view', $data);
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

        $this->form_validation->set_rules('user_interest_area_name', '关注域名称', 'required');
        $this->form_validation->set_rules('display_order', '显示顺序', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect('/');
        } else {


            $session_data = $this->session->userdata('logged_in');
            $owner = $session_data['idusers'];

            $this->user_interest_area_model->set_interest_area($owner);

            $data['username'] = $session_data['username'];
            $data['active_nav_item'] = 'interest_area';

            redirect('interest_area');
        }
    }
}
