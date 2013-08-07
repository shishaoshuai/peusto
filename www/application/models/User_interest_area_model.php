<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Tris
 * Date: 13-8-1
 * Time: 上午5:35
 * To change this template use File | Settings | File Templates.
 */

class User_interest_area_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function initialize($owner){
        $ci = & get_instance();
        $item_tbi = $ci->config->item('interest_area');

        foreach($item_tbi as $user_interest_area_name=>$display_order) {
            $data = array('owner'=> $owner,
                'user_interest_area_name'=>$user_interest_area_name,
                'display_order'=>$display_order);
            $this->db->insert('user_interest_area', $data);
        }
    }

    public function get_interest_areas($owner) {
        $this->db->select('iduser_interest_area,user_interest_area_name,display_order');
        $this->db->from('user_interest_area');
        $this->db->where('owner',$owner);
        $this->db->order_by('display_order asc, iduser_interest_area desc');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function set_interest_area($owner)
    {
        $this->load->helper('url');

        $data = array(
            'owner' =>$owner,
            'user_interest_area_name' => $this->input->post('user_interest_area_name'),
            'display_order' => $this->input->post('display_order')
        );
        return $this->db->insert('user_interest_area', $data);
    }

    public function update_interest_area()
    {
        $this->load->helper('url');

        $data = array(
            'user_interest_area_name' => $this->input->post('user_interest_area_name'),
            'display_order' => $this->input->post('display_order')
        );
        $this->db->where('iduser_interest_area',  $this->input->post('iduser_interest_area'));
        $this->db->update('user_interest_area', $data);
    }

    public function get_dropdown_list($owner) {
        $this->db->select('iduser_interest_area, user_interest_area_name');
        $this->db->where('owner', $owner);
        $this->db->order_by('display_order', "asc");
        $query = $this->db->get('user_interest_area');
        if($query)
        {
            $result = $query->result_array();
            return $result;
        }
    }

    public function get_user_interest_area($iduser_interest_area) {
        $this->db->select('iduser_interest_area, user_interest_area_name,display_order');
        $this->db->where('iduser_interest_area',$iduser_interest_area);
        $query = $this->db->get('user_interest_area');
        if($query)
        {
            $result = $query->row_array();
            return $result;
        }
    }

    public function delete_ia($iduser_interest_area) {
        $this->db->delete('user_interest_area', array('iduser_interest_area' => $iduser_interest_area));
    }
}