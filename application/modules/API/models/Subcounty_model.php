<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Subcounty_model extends CI_Model {

    public function read($conditions) {
        $query = $this->db->get_where('tbl_subcounty', $conditions);
        return $query->result_array();
    }

    public function insert($data) {
        $this->db->insert('tbl_subcounty', $data);
        $count = $this->db->affected_rows();
        if ($count > 0) {
            $data['id'] = $this->db->insert_id();
            $data['status'] = TRUE;
        } else {
            $data['status'] = FALSE;
        }
        return $data;
    }

    public function update($id, $data) {
        $this->db->update('tbl_subcounty', $data, array('id' => $id));
        $count = $this->db->affected_rows();
        if ($count > 0) {
            $data['status'] = TRUE;
        } else {
            $data['status'] = FALSE;
        }
        return $data;
    }

    public function delete($id) {
        $this->db->delete('tbl_subcounty', array('id' => $id));
        $count = $this->db->affected_rows();
        if ($count > 0) {
            $data['status'] = TRUE;
        } else {
            $data['status'] = FALSE;
        }
        return $data;
    }

}
