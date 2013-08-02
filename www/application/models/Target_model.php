<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Tris
 * Date: 13-8-1
 * Time: 上午5:35
 * To change this template use File | Settings | File Templates.
 */

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

        $this->db->select('idtarget,target_name,priority');
        $this->db->from('target');
        $this->db->where('owner',$owner);
        $this->db->order_by('priority asc');

        $query = $this->db->get();

        return $query->result_array();
    }

}