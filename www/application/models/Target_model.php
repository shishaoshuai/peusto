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

}