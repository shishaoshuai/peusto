<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Ajax extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_interest_areas()
    {
        $this->load->model('user_interest_area_model');
        $session_data = $this->session->userdata('logged_in');
        $user = $session_data['idusers'];

        $interest_areas = $this->user_interest_area_model->get_dropdown_list($user);
        $items = array();
        foreach ($interest_areas as $interest_area_item) {
            $items[$interest_area_item['iduser_interest_area']] = $interest_area_item['user_interest_area_name'];
        }
        header('content-type: application/json; charset=utf-8');
        // convert into JSON format and print
        $response = json_encode($items);
        if (isset($_GET['callback'])) {
            echo $_GET['callback'] . "(" . $response . ")";
        } else {
            echo $response;
        }
    }

    public function get_targets($interest_area)
    {
        $this->load->model('target_model');
        $targets = $this->target_model->get_targets_for_interest_area($interest_area);
        $items = array();
        foreach ($targets as $target_item) {
            $items[$target_item['idtarget']] = $target_item['target_name'];
        }
        header('content-type: application/json; charset=utf-8');
        // convert into JSON format and print
        $response = json_encode($items);
        if (isset($_GET['callback'])) {
            echo $_GET['callback'] . "(" . $response . ")";
        } else {
            echo $response;
        }
    }

    public function get_hierachy_targets($interest_area="")
    {
        $this->load->model('target_model');
        $targets = $this->target_model->get_hierachy_targets_for_interest_area();
        $items = array();
        foreach ($targets as $target_item) {
            $items[$target_item['lft']] = $target_item['target_name'];
        }
        header('content-type: application/json; charset=utf-8');
        // convert into JSON format and print
        $response = json_encode($items);
        log_message('info','$response '.$response );
        if (isset($_GET['callback'])) {
            echo $_GET['callback'] . "(" . $response . ")";
        } else {
            echo $response;
        }
    }
    public function get_target_types()
    {
        $this->load->model('user_preferences/user_target_type_model');
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];

        $target_types = $this->user_target_type_model->get_dropdown_list($owner);
        $items = array();
        foreach ($target_types as $target_type_item) {
            $items[$target_type_item['target_type_id']] = $target_type_item['target_type_name'];
        }
        header('content-type: application/json; charset=utf-8');
        // convert into JSON format and print
        $response = json_encode($items);
        if (isset($_GET['callback'])) {
            echo $_GET['callback'] . "(" . $response . ")";
        } else {
            echo $response;
        }
    }

    public function delete_target_type($target_type_id)
    {

        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $this->load->model('user_preferences/user_target_type_model');
        $this->user_target_type_model->delete_user_target_type($owner, $target_type_id);

    }

    public function add_target_type($target_type_id)
    {
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $this->load->model('user_preferences/user_target_type_model');
        $this->user_target_type_model->add_user_target_type($owner, $target_type_id);
    }

    public function create_task_from_calendar()
    {
        $this->load->model('task_model');
        $ii = $this->task_model->set_task_from_calendar();
        log_message('info','$this->db->$ii():'.$ii);

        return $ii;
    }

    public function modify_task_from_calendar()
    {
        $this->load->model('task_model');
        $this->task_model->modify_task_from_calendar();
    }

    public function move_task_in_calendar()
    {
        $this->load->model('task_model');
        $this->task_model->move_task_in_calendar();
    }
}