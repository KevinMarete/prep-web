<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Facility_service_model
 *
 * @author k
 */
class Facility_service_model extends CI_Model {

    public function get_facility_ownership($filters) {
        $columns = array();
        $this->db->select("Owner name,COUNT(*)y", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'DESC');
        $this->db->limit(50);
        $query = $this->db->get('tbl_facility_service');
        $results = $query->result_array();

        foreach ($results as $result) {
            array_push($columns, $result['name']);
        }

        return array('main' => $results, 'columns' => $columns);
    }

    public function get_facility_level($filters) {
        $columns = array();
        $this->db->select("Level name, COUNT(*)y", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'DESC');
        $this->db->limit(50);
        $query = $this->db->get('tbl_facility_service');
        $results = $query->result_array();

        foreach ($results as $result) {
            array_push($columns, $result['name']);
        }

        return array('main' => $results, 'columns' => $columns);
    }

}
