<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Time_record extends CI_Controller {

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
            $data['active_nav_item'] = 'time_record';
            add_css(array('fullcalendar.css','fullcalendar.print.css'));
            add_js(array('jquery-ui-1.10.2.custom.min.js','fullcalendar.js','jquery.jcombo.js'));
            //add_js(array('jquery-ui-1.10.2.custom.min.js','fullcalendar.js','jquery.jcombo.js'));

            $this->load->helper('form');

            $this->load->view('templates/header',$data);
            $this->load->view('time_record_view', $data);
            $this->load->view('templates/footer',$data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('/', 'refresh');
        }
    }
}
