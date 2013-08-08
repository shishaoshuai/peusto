<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Ajax extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_interest_areas() {
        $this->load->model('user_interest_area_model');
        $session_data = $this->session->userdata('logged_in');
        $user = $session_data['idusers'];

        $interest_areas = $this->user_interest_area_model->get_dropdown_list($user);
        $items = array();
        foreach($interest_areas as $interest_area_item) {
            $items[$interest_area_item['iduser_interest_area']] = $interest_area_item['user_interest_area_name'];
        }
        header('content-type: application/json; charset=utf-8');
        // convert into JSON format and print
        $response = json_encode($items);
        if(isset($_GET['callback'])) {
            echo $_GET['callback']."(".$response.")";
        } else {
            echo $response;
        }
    }

    public function get_targets($interest_area) {
        $this->load->model('target_model');
        $session_data = $this->session->userdata('logged_in');
        $targets = $this->target_model->get_targets_for_interest_area($interest_area);
        $items = array();
        foreach($targets as $target_item) {
            $items[$target_item['idtarget']] = $target_item['target_name'];
        }
        header('content-type: application/json; charset=utf-8');
        // convert into JSON format and print
        $response = json_encode($items);
        if(isset($_GET['callback'])) {
            echo $_GET['callback']."(".$response.")";
        } else {
            echo $response;
        }
    }
}