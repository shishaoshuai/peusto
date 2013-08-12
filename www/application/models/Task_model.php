<?php

class Task_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function set_task()
    {
        $this->load->helper('url');
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];

        $data = array(
            'owner' =>$owner,
            'task_name' => $this->input->post('task_name'),
            'expected_duration' => $this->input->post('duration_hour') * 60 +$this->input->post('duration_minute'),
            'start_time' => $this->input->post('start_time'),
            'due_time' => $this->input->post('end_time'),
            'interest_area'=> $this->input->post('interest_area'),
            'target' => $this->input->post('target'),
            'is_appointment' => $this->input->post('is_appointment')
        );
        log_message('info','start_time:'. $this->input->post('start_time'));
        return $this->db->insert('task', $data);
    }

    public function set_task_from_calendar()
    {
        $this->load->helper('url');
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];


        $data = array(
            'owner' =>$owner,
            'task_name' => $this->input->post('task_name'),
            'expected_duration' => 30,//tbm
            'start_time' => $this->input->post('start_time'),
            'due_time' => $this->input->post('end_time'),
            'interest_area'=> $this->input->post('interest_area'),
            'target' => $this->input->post('target'),
            'is_appointment' => 1
        );

        log_message('info',"new task is:owner".$data['owner'].'task_name'.$data['task_name']
            .'start_time'.$data['start_time'].'end_time'.$data['end_time']
            .'interest_area'.$data['interest_area'].'target'.$data['target']);
        log_message('info','start_time:'. $this->input->post('start_time'));
        return $this->db->insert('task', $data);
    }

    public function get_targets() {
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $sql = "SELECT idtarget,target_name,case priority when 1 then \"高\" when "
            ." 2 then \"中\" when 3 then \"低\" end as priority FROM target WHERE owner = ? order by priority asc";

        $query = $this->db->query($sql, $owner);
        return $query->result_array();
    }

    public function get_all_tasks_by_interest_area() {
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $this->load->model('user_interest_area_model');
        $interest_areas = $this->user_interest_area_model->get_dropdown_list($owner);
        $tasks = array();
        foreach($interest_areas as $interest_area_item) {
            $task_item = $this->get_tasks_for_interest_area($interest_area_item['iduser_interest_area']);
            $tasks[$interest_area_item['user_interest_area_name']] = $task_item;
        }
        return $tasks;

    }

    public function get_tasks_for_interest_area($interest_area) {
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $sql = "SELECT idtask,task_name, target_name FROM task LEFT JOIN target ON target=idtarget "
            ."WHERE task.owner = ? AND task.interest_area = ? ORDER BY priority ASC";

        $query = $this->db->query($sql, array($owner,$interest_area));
        return $query->result_array();
    }

    public function get_dropdown_list($owner) {
        $this->db->select('idtargets, target_name');
        $this->db->where('owner', $owner);
        $this->db->order_by('display_order', "asc");
        $query = $this->db->get('target');
        if($query)
        {
            $result = $query->result_array();
            return $result;
        }
    }

}