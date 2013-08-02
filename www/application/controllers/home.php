<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

    }

    function index()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');

            $data['username'] = $session_data['username'];
            $data['active_nav_item'] = 'home';

            add_css(array('datetimepicker.css', 'jquery-ui/jquery.ui.all.css'));
            add_js(array( 'jquery.ui.core.js', 'jquery.ui.widget.js',
                'jquery.ui.spinner.js', 'jquery.mousewheel.js','jquery.ui.tabs.js','jquery.ui.button.js',
                'bootstrap-datetimepicker.js','locales/bootstrap-datetimepicker.zh-CN.js',
                'home.js'));

            $this->load->view('templates/header', $data);
            $this->load->view('home_view', $data);
            $this->load->view('templates/footer', $data);
        } else {
            //If no session, redirect to login page
            redirect('/', 'refresh');
        }
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('home', 'refresh');
    }
}
