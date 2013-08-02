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
        $this->load->model('interest_area_model');
        $user_interest_area = $this->interest_area_model->get_interest_areas();
        foreach($user_interest_area as $user_interest_area_item) {
            $data = array('owner'=> $owner,
                'user_interest_area_name'=>$user_interest_area_item['interest_area_name'],
                'display_order'=>$user_interest_area_item['display_order']);
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
}