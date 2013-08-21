<?php

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
            'target_name' => $this->input->post('target_name'),
//            'due_time' => $this->input->post('due_time'),
            'parent_target' => $this->input->post('parent_target')
        );

        $sql = array();
        $result = array();

        if($this->input->post('parent_target')=='0') {
            $sql['query1'] = "LOCK TABLE target WRITE";
            $sql['query2'] = "SELECT @myRight := MAX(rgt) FROM target WHERE owner=".$owner ;

            $sql['query3'] = "UPDATE target SET rgt = rgt + 2 WHERE rgt >= @myRight AND owner=".$owner ;
            $sql['query4'] = "INSERT INTO target(owner, target_name,lft,rgt) VALUES("
                .$owner.",'"
                .$this->input->post('target_name')."',@myRight, @myRight + 1)";
            $sql['query5'] = "UNLOCK TABLES;";
            foreach($sql as $key => $value)
            {
                $result[$key] = $this->db->query($value);
            }
        } else {
            $sql['query1'] = "LOCK TABLE target WRITE";
            $sql['query2'] = "SELECT @myRight := rgt FROM target where idtarget=".$this->input->post('parent_target') ;
            $sql['query3'] = "UPDATE target SET rgt = rgt + 2 WHERE rgt >= @myRight AND owner=".$owner ;
            $sql['query4'] = "UPDATE target SET lft = lft + 2 WHERE lft > @myRight AND owner=".$owner ;
            $sql['query5'] = "INSERT INTO target(owner,  target_name,lft,rgt) VALUES("
                .$owner.",'"
                .$this->input->post('target_name')."',@myRight, @myRight + 1)";
            $sql['query6'] = "UNLOCK TABLES;";
            foreach($sql as $key => $value)
            {
                $result[$key] = $this->db->query($value);
            }
        }
//        return $this->db->insert('target', $data);
    }

    public function update_target()
    {
        $this->load->helper('url');

        $data = array(
            'interest_area'=> $this->input->post('interest_area'),
            'target_name' => $this->input->post('target_name'),
            'priority' => $this->input->post('priority'),
            'target_type' => $this->input->post('target_type'),
            'due_time' => $this->input->post('due_time'),
            'parent_target' => $this->input->post('parent_target')
        );
        $this->db->where('idtarget',  $this->input->post('idtarget'));
        $this->db->update('target', $data);
    }

    public function get_targets() {
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $sql = "SELECT idtarget,target_name,target_type_name, case priority when 1 then \"高\" when "
            ." 2 then \"中\" when 3 then \"低\" end as priority FROM target,target_type"
            ."WHERE owner = ? and target_type=idtarget_type order by priority asc";

        $query = $this->db->query($sql, $owner);
        return $query->result_array();
    }

    public function get_targets_group_by_interest_area($target_type=0) {
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $this->load->model('user_interest_area_model');
        $interest_areas = $this->user_interest_area_model->get_dropdown_list($owner);
        $targets = array();
        foreach($interest_areas as $interest_area_item) {
            $target_item = $this->get_targets_for_interest_area($interest_area_item['iduser_interest_area'],$target_type);
            $targets[$interest_area_item['user_interest_area_name']] = $target_item;
        }
        return $targets;
    }

    public function get_targets_for_interest_area($interest_area,$target_type="") {
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $sql = "SELECT idtarget,target_name, target_type_name, case priority when 1 then \"高\" when "
            ." 2 then \"中\" when 3 then \"低\" end as priority  FROM target,target_type "
            ."WHERE owner = ? and interest_area = ?  and target_type=idtarget_type "
            .($target_type==0 ?' ':(" and target.target_type=".$target_type.""))
            ." order by priority asc";

        $query = $this->db->query($sql, array($owner,$interest_area));
        return $query->result_array();
    }

    public function get_hierachy_targets_for_interest_area($target_type="") {
        $session_data = $this->session->userdata('logged_in');
        $owner = $session_data['idusers'];
        $sql = "SELECT node.idtarget as idtarget, CONCAT( REPEAT( '&nbsp;&nbsp;', (COUNT(parent.target_name) - 1) ),'--', node.target_name) AS target_name"
            ." FROM target AS node,target AS parent"
            ." WHERE node.lft BETWEEN parent.lft AND parent.rgt AND node.owner=".$owner
            ." GROUP BY node.idtarget"
            ." ORDER BY node.lft ASC";
        $query = $this->db->query($sql);
        $query_result = $query->result_array();
        $result=array();
        if(count($query_result)>=1) {
            $result = array_slice($query_result,1,count($query_result)-1);
        }
        foreach($result as $item) {
            log_message('info',$item['idtarget'] );
        }
        return $result;
    }

    public function get_dropdown_list($owner) {
        $this->db->select('idtargets, target_name');
        $this->db->where('owner', $owner);
        $this->db->order_by('display_order', "asc");
        $query = $this->db->get('target');
        if($query)
        {
            $result = $query->result_array();
            return $result;
        }
    }

    public function get_target($idtarget) {
        $this->db->select('idtarget,target_name,interest_area,priority,target_type');
        $this->db->from('target');
        $this->db->where('idtarget',$idtarget);

        $query = $this->db->get();

        return $query->row_array();
    }

    public function delete_target($idtarget) {
        $this->db->delete('target', array('idtarget' => $idtarget));
    }
}