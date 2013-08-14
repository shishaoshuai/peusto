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

        $start_time = date('Y-m-d H:i:s',  $this->input->post('start_time'));
        $due_time = date('Y-m-d H:i:s',  $this->input->post('due_time'));
        log_message('info','timescope'.($this->input->post('due_time') - $this->input->post('start_time')));

        $data = array(
            'owner' =>$owner,
            'task_name' => $this->input->post('task_name'),
            'expected_duration' =>  (($this->input->post('due_time')-$this->input->post('start_time'))/60),//tbm
            'start_time' => $start_time,
            'due_time' => $due_time,
            'interest_area'=> $this->input->post('interest_area'),
            'target' => $this->input->post('target'),
            'is_appointment' =>  $this->input->post('is_appointment')
        );

        log_message('info',"new task is:owner".$data['owner'].'task_name'.$data['task_name']
            .'start_time'.$data['start_time'].'end_time'.$data['due_time']
            .'interest_area'.$data['interest_area'].'target'.$data['target']);
        log_message('info','start_time:'. $this->input->post('start_time'));
        $this->db->insert('task', $data);
        $id = $this->db->insert_id();
        echo json_encode(array('id' => $id));
    }

    public function get_task($idtask) {
        $this->db->select('idtask, start_time,due_time');
        $this->db->where('idtask',$idtask);
        $query = $this->db->get('task');
        if($query)
        {
            $result = $query->row_array();
            return $result;
        }
    }

    public function move_task_in_calendar()    {
        $this->load->helper('url');
        $id =  $this->input->post('id');
        $start_time = date('Y-m-d H:i:s',  $this->input->post('new_start_time'));
        $due_time = date('Y-m-d H:i:s',  $this->input->post('new_due_time'));
        $data = array(
            'start_time'=>$start_time,
            'due_time' =>$due_time
        );
        log_message('info',$this->input->post('id')."new start and due time".$data['start_time']."aaa" .$data['due_time']);
        $this->db->where('idtask', $id);
        return $this->db->update('task', $data);
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

    public function get_tasks_for_fullcalendar() {
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $sql = "SELECT idtask,task_name, target_name,start_time, due_time "
            ."FROM task LEFT JOIN target ON target=idtarget "
            ."WHERE task.owner = ? ORDER BY priority ASC";

        $query = $this->db->query($sql, $owner);
        $tmp_result = $query->result_array();
        $result="";
        foreach($tmp_result as $item) {
            $start_time_arr = date_parse($item['start_time']);
            $end_time_arr = date_parse($item['due_time']);
            $result .="{
					id: ";
            $result .= $item['idtask'].",";
            $result .= "title:";
            $result .= "'".$item['task_name']."',";
            $result .="start:new Date(";
            $result .=$start_time_arr['year'] .",".($start_time_arr['month']-1).",".$start_time_arr['day'] .",";
            $result .=$start_time_arr['hour'].",".$start_time_arr['minute']."),";
            $result .="end:new Date(";
            $result .=$end_time_arr['year'] .",".($end_time_arr['month']-1).",".$end_time_arr['day'] .",";
            $result .=$end_time_arr['hour'].",".$end_time_arr['minute']."),";
//            $result .="description:'test event description(tbm)',";
            $result .="allDay: false
				},";
        }
        log_message('info', "for full calendar".$result);
        return $result;
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