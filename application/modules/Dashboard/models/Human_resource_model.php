<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Human_resource_model
 *
 * @author k
 */
class Human_resource_model extends CI_Model {

    public function get_facilities_trained_on_prep($filters) {
        $columns = array();
        $this->db->select("trained_on_prep name,COUNT(*)y", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->limit(50);
        $query = $this->db->get('tbl_trained_personnel');
        $results = $query->result_array();

        foreach ($results as $result) {
            array_push($columns, $result['name']);
        }

        return array('main' => $results, 'columns' => $columns);
    }

    public function get_distibution_of_facilities_trained_personnel_in_facilities($filters) {
        $columns = array();
        $demand_creation_activities_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(trained_on_prep = 'YES', 1, NULL)) YES, COUNT(IF(trained_on_prep = 'NO', 1, NULL)) NO", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $query = $this->db->get('tbl_trained_personnel');
        $results = $query->result_array();

        if ($results) {
            foreach ($results as $result) {
                $columns[] = $result['county'];
                foreach ($demand_creation_activities_data as $index => $demand_creation_activities) {
                    if ($demand_creation_activities['name'] == 'YES') {
                        array_push($demand_creation_activities_data[$index]['data'], $result['YES']);
                    } else if ($demand_creation_activities['name'] == 'NO') {
                        array_push($demand_creation_activities_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $demand_creation_activities_data, 'columns' => $columns);
    }

}
