<?php

class Day_type_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_dropdown_list() {
        $sql = "select idday_type, day_type_name from day_type order by idday_type asc";

        $query = $this->db->query($sql);
        if($query)
        {
            $result = $query->result_array();
            return $result;
        }
    }
}