<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of User_model
 *
 * @author kariukye
 */
class User_model extends CI_Model {

    var $table = 'auth_tbl_users';
    var $column_order = array('first_name', 'last_name', 'email', 'roleId', 'mobile');
    var $column_search = array('first_name', 'last_name', 'email', 'roleId', 'mobile');
    var $order = array('id' => 'desc');

    private function _get_datatables_query() {
        $this->db->select('u.id,u.first_name,u.last_name,u.email,r.role,u.mobile');
        $this->db->from('auth_tbl_users u');
        $this->db->join('auth_tbl_roles r', 'r.roleId=u.roleId');
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) { // first loop
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables() {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id) {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data) {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

}