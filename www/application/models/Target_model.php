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
            'interest_area'=> $this->input->post('interest_area'),
            'target_name' => $this->input->post('target_name'),
            'priority' => $this->input->post('priority')
        );
        return $this->db->insert('target', $data);
    }

    public function get_targets() {
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $sql = "SELECT idtarget,target_name,case priority when 1 then \"高\" when "
            ." 2 then \"中\" when 3 then \"低\" end as priority FROM target WHERE owner = ? order by priority asc";

        $query = $this->db->query($sql, $owner);
        return $query->result_array();
    }

    public function get_all_targets_by_interest_area() {
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $this->load->model('user_interest_area_model');
        $interest_areas = $this->user_interest_area_model->get_dropdown_list($owner);
        $targets = array();
        foreach($interest_areas as $interest_area_item) {
            $target_item = $this->get_targets_for_interest_area($interest_area_item['iduser_interest_area']);
            $targets[$interest_area_item['user_interest_area_name']] = $target_item;
        }
        return $targets;

    }

    public function get_targets_for_interest_area($interest_area) {
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $sql = "SELECT idtarget,target_name, case priority when 1 then \"高\" when "
            ." 2 then \"中\" when 3 then \"低\" end as priority  FROM target "
            ."WHERE owner = ? and interest_area = ?  order by priority asc";

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