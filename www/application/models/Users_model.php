<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Tris
 * Date: 13-8-1
 * Time: 上午5:35
 * To change this template use File | Settings | File Templates.
 */

class Users_model extends CI_Model
{
    public function __construct()
    {
        $this->load->helper('security');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->news_model->set_users();
    }

    public function set_user()
    {
        $this->load->helper('url');

        $password = $this->input->post('password');
        $md5_password = do_hash($password, 'md5');

        $data = array(
            'username' => $this->input->post('username'),
            'password' => $md5_password,
            'email' => $this->input->post('email'),
            'mobile' => $this->input->post('mobile')
        );
        return $this->db->insert('users', $data);
    }

    public function login($username, $password)
    {
        $this->db->select('idusers, username, email, password');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('password', do_hash($password, 'md5'));
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function initialize($owner)
    {
        $this->load->model('user_interest_area_model');
        $this->user_interest_area_model->initialize($owner);
        $this->load->model('user_work_time_model');
        $this->user_work_time_model->initialize($owner);
    }
}