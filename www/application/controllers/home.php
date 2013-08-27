<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        add_css(array('fc_ui_theme.css','fullcalendar.css','zTreeStyle.css'));
        add_js(array('jquery-ui-1.10.3.custom.min.js','fullcalendar.js',
            'jquery.jcombo.js','date.js','jquery.ztree.all-3.5.js'));
        $this->load->model('target_model');
        $this->load->helper('form');
    }

    function index()
    {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');

            $data['username'] = $session_data['username'];
            $data['targets'] = $this->target_model->get_targets();
            $data['active_nav_item'] = 'home';
            $data['action_name'] = 'ddd';

            $this->load->view('templates/header',$data);
            $this->load->view('home_view', $data);
            $this->load->view('templates/footer',$data);
        }
        else
        {
            redirect('/', 'refresh');
        }
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('todo_name', '任务名称', 'required');
        $this->form_validation->set_rules('interest_area', '所属关注域', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect('/');
        } else {
            $this->todo_model->set_todo();

            $data['active_nav_item'] = 'todo';

            redirect('home');
        }
    }


}
