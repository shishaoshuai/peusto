<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Todo extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        add_css(array('datetimepicker.css', 'jquery-ui/jquery.ui.all.css'));
        add_js(array( 'jquery.ui.core.js', 'jquery.ui.widget.js',
            'jquery.ui.spinner.js', 'jquery.mousewheel.js','jquery.ui.tabs.js','jquery.ui.button.js',
            'bootstrap-datetimepicker.js','locales/bootstrap-datetimepicker.zh-CN.js',
            'jquery.jcombo.js','home.js'));
        $this->load->model('todo_model');
    }

    function index()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');

            $this->load->model('user_interest_area_model');
            $data['interest_area_list']=$this->user_interest_area_model->get_dropdown_list($session_data['idusers']);

            $data['username'] = $session_data['username'];
            $data['idusers'] = $session_data['idusers'];
            $data['active_nav_item'] = 'todo';
            $data['todos'] = $this->todo_model->get_all_todos_by_interest_area();


            $this->load->helper('form');

            $this->load->view('templates/header', $data);
            $this->load->view('todo_view', $data);
            $this->load->view('templates/footer', $data);
        } else {
            //If no session, redirect to login page
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

            redirect('todo');
        }
    }

}
