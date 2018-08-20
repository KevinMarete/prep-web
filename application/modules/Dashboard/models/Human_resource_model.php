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

    public function get_distibution_of_facilities_trained_personnel($filters) {
        $columns = array();
        $trained_personnel_data = array(
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
                foreach ($trained_personnel_data as $index => $trained_personnel) {
                    if ($trained_personnel['name'] == 'YES') {
                        array_push($trained_personnel_data[$index]['data'], $result['YES']);
                    } else if ($trained_personnel['name'] == 'NO') {
                        array_push($trained_personnel_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $trained_personnel_data, 'columns' => $columns);
    }

    public function get_health_care_workers_trained_on_prep($filters) {
        $columns = array();
        $hcw_trained_data = array(
            array('type' => 'column', 'name' => '1-3', 'data' => array()),
            array('type' => 'column', 'name' => '3-6', 'data' => array()),
            array('type' => 'column', 'name' => '>6', 'data' => array()),
        );

        $this->db->select("UPPER(County) county, COUNT(IF(hcw_trained_on_prep > 0, 1, NULL) AND IF(hcw_trained_on_prep <= 3, 1, NULL)) '1-3', COUNT(IF(hcw_trained_on_prep > 3, 1, NULL) AND IF(hcw_trained_on_prep <= 6, 1, NULL)) '3-6', COUNT(IF(hcw_trained_on_prep > 6, 1, NULL)) '>6'", FALSE);
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
                foreach ($hcw_trained_data as $index => $hcw_trained) {
                    if ($hcw_trained['name'] == '>6') {
                        array_push($hcw_trained_data[$index]['data'], $result['>6']);
                    } else if ($hcw_trained['name'] == '3-6') {
                        array_push($hcw_trained_data[$index]['data'], $result['3-6']);
                    } else if ($hcw_trained['name'] == '1-3') {
                        array_push($hcw_trained_data[$index]['data'], $result['1-3']);
                    }
                }
            }
        }
        return array('main' => $hcw_trained_data, 'columns' => $columns);
    }

    public function get_health_care_workers_trained_on_prep_numbers($filters) {

        $columns = array();
        $response = array();

        $this->db->select("COUNT(IF(hcw_trained_on_prep > 0, 1, NULL) AND IF(hcw_trained_on_prep <= 3, 1, NULL)) '1-3', COUNT(IF(hcw_trained_on_prep > 3, 1, NULL) AND IF(hcw_trained_on_prep <= 6, 1, NULL)) '3-6', COUNT(IF(hcw_trained_on_prep > 6, 1, NULL)) '>6'", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $query = $this->db->get('tbl_trained_personnel');
        $result = $query->row_array();

        //add columns
        $columns = array_keys($result);

        //add data to response
        foreach ($columns as $column) {
            array_push($response, array('hcw_trained_on_prep' => $column, 'Frequency' => $result[$column]));
        }
        return array('main' => $response, 'columns' => $columns);
    }

}
