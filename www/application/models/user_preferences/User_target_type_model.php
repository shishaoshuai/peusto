<?php

class User_target_type_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function initialize($owner)
    {
        $ci = & get_instance();
        $array_tbi = $ci->config->item('target_type');
        foreach($array_tbi as $target_type_item)
        {
            $this->db->insert('user_target_type', array('owner'=>$owner,"user_target_type_name" => $target_type_item));
        }
    }

    public function set_work_time($owner)
    {
        $this->load->helper('url');
        $data = array(
            'owner' => $owner,
            'morning_start' => $this->input->post('morning_start'),
            'morning_end' => $this->input->post('morning_end'),
            'afternoon_start' => $this->input->post('afternoon_start'),
            'afternoon_end' => $this->input->post('afternoon_end')
        );
        return $this->db->insert('user_work_time', $data);
    }

    public function get_target_types($owner) {
        $this->db->select('iduser_target_type,user_target_type_name');
        $this->db->from('user_target_type');
        $this->db->where('owner',$owner);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function delete_user_target_type($iduser_target_type)
    {
        $this->db->delete('user_target_type', array('iduser_target_type' => $iduser_target_type));
    }
}