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
        $array_tbi_size = count($array_tbi);
        for($i=0; $i<$array_tbi_size;$i++)
        {
            $this->db->insert('user_target_type', array('owner'=>$owner,"target_type_id" => $i));
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
        $this->db->select('target_type_id');
        $this->db->from('user_target_type');
        $this->db->where('owner',$owner);
        $this->db->order_by('target_type_id asc');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function add_user_target_type($owner, $target_type_id)
    {
        $this->db->insert('user_target_type', array('target_type_id' => $target_type_id,'owner'=>$owner));
    }

    public function delete_user_target_type($owner, $target_type_id)
    {
        $this->db->delete('user_target_type', array('target_type_id' => $target_type_id,'owner'=>$owner));
    }
}