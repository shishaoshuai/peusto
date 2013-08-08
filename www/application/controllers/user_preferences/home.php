<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

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

            $data['active_nav_item'] = 'user_preferences';

            $this->load->model('user_preferences/user_target_type_model');
            $owner = $session_data['idusers'];
            $data['user_target_types'] = $this->user_target_type_model->get_target_types($owner);
            $ci = & get_instance();
            $data['target_types'] = $ci->config->item('target_type');

            $this->load->helper('form');
            add_css(array( 'jquery-ui/jquery.ui.all.css'));

            add_js(array( 'jquery.ui.core.js', 'jquery.ui.widget.js','jquery.ui.tabs.js'));
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
