<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Partner_model
 *
 * @author kariukye
 */
class Partner_model extends CI_Model {

    public function get_partner_support($filters) {
        $columns = array();
        $partner_support_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(Partner_Support = 'YES', 1, NULL)) YES, COUNT(IF(Partner_Support = 'NO', 1, NULL)) NO", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $query = $this->db->get('tbl_prep_facilities');
        $results = $query->result_array();

        if ($results) {
            foreach ($results as $result) {
                $columns[] = $result['county'];
                foreach ($partner_support_data as $index => $partner_support) {
                    if ($partner_support['name'] == 'YES') {
                        array_push($partner_support_data[$index]['data'], $result['YES']);
                    } else if ($partner_support['name'] == 'NO') {
                        array_push($partner_support_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $partner_support_data, 'columns' => $columns);
    }

}
