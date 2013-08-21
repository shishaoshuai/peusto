<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Target extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        add_js(array( 'jquery.jcombo.js'));
        $this->load->model('target_model');
    }

    function index()
    {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['action_name']='target/create';

            $data['targets'] = $this->target_model->get_targets_group_by_interest_area();

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
//        $this->form_validation->set_rules('priority', '优先级', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this -> index();
        } else {
            $this->target_model->set_target();
            $data['active_nav_item'] = 'target';
            redirect('target');
        }
    }

    public function modify($idtarget) {
        $data['target_tbm'] = $this->target_model->get_target($idtarget);

        $this->load->helper('form');

        $session_data = $this->session->userdata('logged_in');

        $data['username'] = $session_data['username'];
        $data['active_nav_item'] = 'target';
        $data['action_name']='target/update';

        $data['targets'] = $this->target_model->get_all_targets_by_interest_area();

        $this->load->view('templates/header',$data);
        $this->load->view('target_view', $data);
        $this->load->view('templates/footer',$data);
    }

    public function update()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('target_name', '目标名称', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect('/');
        } else {
            $session_data = $this->session->userdata('logged_in');

            $this->target_model->update_interest_area();
            $data['action_name']='target/create';

            $data['username'] = $session_data['username'];
            $data['active_nav_item'] = 'target';
            $data['targets'] = $this->target_model->get_all_targets_by_interest_area();

            redirect('target');
        }
    }

    public function delete_target($idtarget) {
        $this->target_model->delete_target($idtarget);
        redirect('target');
    }
}
