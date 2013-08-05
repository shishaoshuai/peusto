<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Tris
 * Date: 13-8-1
 * Time: 上午5:35
 * To change this template use File | Settings | File Templates.
 */

class Interest_area_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_interest_areas() {
        $this->db->select('idinterest_area,interest_area_name,display_order');
        $this->db->from('interest_area');
        $this->db->order_by('display_order asc, idinterest_area desc');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function set_interest_area()
    {
        $this->load->helper('url');

        $data = array(
            'interest_area_name' => $this->input->post('interest_area_name'),
            'display_order' => $this->input->post('display_order')
        );
        return $this->db->insert('interest_area', $data);
    }

    public function get_dropdwon_list() {
        $this->db->select('idinterest_area, interest_area_name');
        $this->db->order_by('display_order', "asc");
        $query = $this->db->get('interest_area');
        if($query)
        {
            $result = $query->result_array();
            return $result;
        }

    }
}