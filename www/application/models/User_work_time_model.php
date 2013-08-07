<?php

class User_work_time_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function initialize($owner)
    {
        $ci = & get_instance();
        $item_tbi = $ci->config->item('work_time');
        $item_tbi['owner'] = $owner;
        $this->db->insert('user_work_time', $item_tbi);
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

    public function update_work_time()
    {
        $this->load->helper('url');
        $data = array(
            'morning_start' => $this->input->post('morning_start'),
            'morning_end' => $this->input->post('morning_end'),
            'afternoon_start' => $this->input->post('afternoon_start'),
            'afternoon_end' => $this->input->post('afternoon_end')
        );
        $this->db->where('iduser_work_time', $this->input->post('iduser_work_time'));
        $this->db->update('user_work_time', $data);
    }


    public function get_user_interest_area($iduser_work_time)
    {
        $this->db->select('iduser_interest_area, morning_start,morning_end, afternoon_start, afternoon_end');
        $this->db->where('iduser_work_time', $iduser_work_time);
        $query = $this->db->get('user_work_time');
        if ($query) {
            $result = $query->row_array();
            return $result;
        }
    }

    public function delete_user_interest_area($iduser_work_time)
    {
        $this->db->delete('user_work_time', array('iduser_work_time' => $iduser_work_time));
    }
}