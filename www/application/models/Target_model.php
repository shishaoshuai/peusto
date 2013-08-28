<?php

class Target_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function set_target()
    {
        $this->load->helper('url');
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];

        $data = array(
            'owner' =>$owner,
            'target_name' => $this->input->post('target_name'),
            'due_date' =>$this->input->post('due_date'),
            'parent_target' => $this->input->post('parent_target')
        );
        log_message('info','target_model->set_target() $data is: owner '.$owner. " target_name "
            .$this->input->post('target_name'). "due_date" . $this->input->post('due_date')
            ." parent_target" . $this->input->post('parent_target'));
        $this->db->insert('target', $data);

        $id = $this->db->insert_id();
        return $id;
//        echo json_encode(array('newAddedId' => $id));
    }

    public function update_target()
    {
        $this->load->helper('url');

        $data = array(
            'interest_area'=> $this->input->post('interest_area'),
            'target_name' => $this->input->post('target_name'),
            'due_time' => $this->input->post('due_time'),
            'parent_target' => $this->input->post('parent_target')
        );
        $this->db->where('idtarget',  $this->input->post('idtarget'));
        $this->db->update('target', $data);
    }

    public function get_targets() {
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $sql = "SELECT idtarget,parent_target, target_name, due_date FROM target"
            ." WHERE owner = ?  order by parent_target, dis_order asc";

        $query = $this->db->query($sql, $owner);
        return $query->result_array();
    }

    public function get_targets_group_by_interest_area($target_type=0) {
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $this->load->model('user_interest_area_model');
        $interest_areas = $this->user_interest_area_model->get_dropdown_list($owner);
        $targets = array();
        foreach($interest_areas as $interest_area_item) {
            $target_item = $this->get_targets_for_interest_area($interest_area_item['iduser_interest_area'],$target_type);
            $targets[$interest_area_item['user_interest_area_name']] = $target_item;
        }
        return $targets;
    }

    public function get_targets_for_interest_area($interest_area,$target_type="") {
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $sql = "SELECT idtarget,target_name FROM target "
            ." WHERE owner = ? AND interest_area = ? ";

        $query = $this->db->query($sql, array($owner,$interest_area));
        return $query->result_array();
    }

    public function get_hierachy_targets_for_interest_area($target_type="") {
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $sql = "SELECT node.lft as lft, CONCAT( REPEAT('&nbsp;&nbsp;',"
            ."COUNT(parent.target_name) - (CASE COUNT(parent.target_name) WHEN 1 THEN 1 ELSE 2 END) ),"
            ."(CASE COUNT(parent.target_name) WHEN 1 THEN '' WHEN 2 THEN '' ELSE '└' END)"
            .", node.target_name) AS target_name"
            ." FROM target AS node,target AS parent"
            ." WHERE node.lft BETWEEN parent.lft AND parent.rgt AND node.owner=".$owner
            ." GROUP BY node.idtarget"
            ." ORDER BY node.lft ASC";
        $query = $this->db->query($sql);
        $query_result = $query->result_array();
        $result=array();
        if(count($query_result)>=1) {
            $result = array_slice($query_result,1,count($query_result)-1);
        }
        return $result;
    }


    public function get_target($idtarget) {
        $this->db->select('idtarget,target_name,interest_area');
        $this->db->from('target');
        $this->db->where('idtarget',$idtarget);

        $query = $this->db->get();

        return $query->row_array();
    }

    public function delete_target($idtarget) {
        $this->db->delete('target', array('idtarget' => $idtarget));
    }
}