<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Commodity_management_model
 *
 * @author k
 */
class Commodity_management_model extends CI_Model {

    public function get_facility_source_of_ARVs($filters) {
        $columns = array();
        $this->db->select("ARV_Source name,COUNT(*)y", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->limit(50);
        $query = $this->db->get('tbl_arv_source');
        $results = $query->result_array();

        foreach ($results as $result) {
            array_push($columns, $result['name']);
        }

        return array('main' => $results, 'columns' => $columns);
    }

}
