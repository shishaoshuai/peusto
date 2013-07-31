<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Tris
 * Date: 13-8-1
 * Time: 上午5:35
 * To change this template use File | Settings | File Templates.
 */

class Users_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function create()    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->news_model->set_users();
    }

    public function set_user() {
        $this->load->helper('url');

        $data = array(
            'name' => $this->input->post('name'),
            'password' => $this->input->post('password'),
            'email' => $this->input->post('email'),
            'mobile' => $this->input->post('mobile')
        );

        return $this->db->insert('users', $data);
    }
}