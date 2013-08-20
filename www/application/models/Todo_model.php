<?php

class Todo_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function set_todo()
    {
        $this->load->helper('url');
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];

        $data = array(
            'owner' =>$owner,
            'todo_name' => $this->input->post('todo_name'),
            'expected_duration' => $this->input->post('duration_hour') * 60 +$this->input->post('duration_minute'),
            'start_time' => $this->input->post('start_time'),
            'due_time' => $this->input->post('end_time'),
            'interest_area'=> $this->input->post('interest_area'),
            'target' => $this->input->post('target'),
            'is_appointment' => $this->input->post('is_appointment')
        );
        log_message('info','start_time:'. $this->input->post('start_time'));
        return $this->db->insert('todo', $data);
    }

    public function set_todo_from_calendar()
    {
        $this->load->helper('url');
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];

        $start_time = date('Y-m-d H:i:s',  $this->input->post('start_time'));
        $due_time = date('Y-m-d H:i:s',  $this->input->post('due_time'));
        log_message('info','timescope'.($this->input->post('due_time') - $this->input->post('start_time')));

        $data = array(
            'owner' =>$owner,
            'todo_name' => $this->input->post('todo_name'),
            'expected_duration' =>  (($this->input->post('due_time')-$this->input->post('start_time'))/60),//tbm
            'start_time' => $start_time,
            'due_time' => $due_time,
            'interest_area'=> $this->input->post('interest_area'),
            'target' => $this->input->post('target'),
            'is_appointment' =>  $this->input->post('is_appointment')
        );

        log_message('info',"new todo is:owner".$data['owner'].'todo_name'.$data['todo_name']
            .'start_time'.$data['start_time'].'end_time'.$data['due_time']
            .'interest_area'.$data['interest_area'].'target'.$data['target']);
        log_message('info','start_time:'. $this->input->post('start_time'));
        $this->db->insert('todo', $data);
        $id = $this->db->insert_id();
        echo json_encode(array('id' => $id));
    }

    public function get_todo($todo_id) {
        $this->db->select('todo_id, start_time,due_time');
        $this->db->where('todo_id',$todo_id);
        $query = $this->db->get('todo');
        if($query)
        {
            $result = $query->row_array();
            return $result;
        }
    }

    public function move_todo_in_calendar()    {
        $this->load->helper('url');
        $id =  $this->input->post('id');
        $start_time = date('Y-m-d H:i:s',  $this->input->post('new_start_time'));
        $due_time = date('Y-m-d H:i:s',  $this->input->post('new_due_time'));
        $data = array(
            'start_time'=>$start_time,
            'due_time' =>$due_time
        );
        log_message('info',$this->input->post('id')."new start and due time".$data['start_time']."aaa" .$data['due_time']);
        $this->db->where('todo_id', $id);
        return $this->db->update('todo', $data);
    }

    public function modify_todo_from_calendar()    {
        $this->load->helper('url');
        $id =  $this->input->post('id');
        $todo_name = $this->input->post('todo_name');
        $target = $this->input->post('target');
        $interest_area = $this->input->post('interest_area');
        $is_appointment = $this->input->post('is_appointment');

        $data = array(
            'todo_name'=>$todo_name,
            'target' =>$target,
            'interest_area' =>$interest_area,
            'is_appointment' =>$is_appointment,
        );
        log_message('info','Task_model->modify_todo_from_calendar id:'.  $id."target".$target."interest_area".$interest_area."is_appointment".$is_appointment);

        $this->db->where('todo_id', $id);
        return $this->db->update('todo', $data);
    }

    public function get_targets() {
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $sql = "SELECT idtarget,target_name,case priority when 1 then \"高\" when "
            ." 2 then \"中\" when 3 then \"低\" end as priority FROM target WHERE owner = ? order by priority asc";

        $query = $this->db->query($sql, $owner);
        return $query->result_array();
    }

    public function get_all_todos_by_interest_area() {
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $this->load->model('user_interest_area_model');
        $interest_areas = $this->user_interest_area_model->get_dropdown_list($owner);
        $todos = array();
        foreach($interest_areas as $interest_area_item) {
            $todo_item = $this->get_todos_for_interest_area($interest_area_item['iduser_interest_area']);
            $todos[$interest_area_item['user_interest_area_name']] = $todo_item;
        }
        return $todos;

    }

    public function get_todos_for_interest_area($interest_area) {
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $sql = "SELECT todo_id,todo_name, target_name FROM todo LEFT JOIN target ON target=idtarget "
            ."WHERE todo.owner = ? AND todo.interest_area = ? ORDER BY priority ASC";

        $query = $this->db->query($sql, array($owner,$interest_area));
        return $query->result_array();
    }

    public function get_todos_for_fullcalendar() {
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $sql = "SELECT todo_id,todo_name, target_name,start_time, due_time, todo.interest_area interest_area,is_appointment, target "
            ."FROM todo LEFT JOIN target ON target=idtarget "
            ."WHERE todo.owner = ? ORDER BY priority ASC";

        $query = $this->db->query($sql, $owner);
        $tmp_result = $query->result_array();
        $result="";
        foreach($tmp_result as $item) {
            $start_time_arr = date_parse($item['start_time']);
            $end_time_arr = date_parse($item['due_time']);
            $result .="{
					id: ";
            $result .= $item['todo_id'].",";
            $result .= "title:";
            $result .= "'".$item['todo_name']."',";
            $result .="start:new Date(";
            $result .=$start_time_arr['year'] .",".($start_time_arr['month']-1).",".$start_time_arr['day'] .",";
            $result .=$start_time_arr['hour'].",".$start_time_arr['minute']."),";
            $result .="end:new Date(";
            $result .=$end_time_arr['year'] .",".($end_time_arr['month']-1).",".$end_time_arr['day'] .",";
            $result .=$end_time_arr['hour'].",".$end_time_arr['minute']."),";
//            $result .="description:'test event description(tbm)',";
            $result .="allDay: false,";
            $result .="interest_area:" .$item['interest_area'].",";
            $result .="is_appointment:" .$item['is_appointment'].",";

            $result .="target:" .$item['target']."},";
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