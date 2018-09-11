<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Human_resource_model
 *
 * @author k
 */
class Human_resource_model extends CI_Model {

    public function get_distibution_of_facilities_trained_personnel($filters) {
        $this->db->select("trained_on_prep name,Count(*)y, UPPER(trained_on_prep) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_trained_personnel');
        return $this->get_distibution_of_facilities_trained_personnel_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_distibution_of_facilities_trained_personnel_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(trained_on_prep) category, County name,COUNT(*)y, UPPER(County) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_trained_personnel');
        $sub_data = $query->result_array();

        if ($main_data) {
            foreach ($main_data['main'] as $counter => $main) {
                $category = $main['drilldown'];

                $drilldown_data['drilldown'][$counter]['id'] = $category;
                $drilldown_data['drilldown'][$counter]['name'] = ucwords($category);
                $drilldown_data['drilldown'][$counter]['colorByPoint'] = true;

                foreach ($sub_data as $sub) {
                    if ($category == $sub['category']) {
                        unset($sub['category']);
                        $drilldown_data['drilldown'][$counter]['data'][] = $sub;
                    }
                }
            }
        }
        $drilldown_data = $this->get_distribution_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_health_care_workers_trained_on_prep($filters) {
        $columns = array();
        $hcw_trained_data = array(
            array('type' => 'column', 'name' => '1-3', 'data' => array()),
            array('type' => 'column', 'name' => '4-6', 'data' => array()),
            array('type' => 'column', 'name' => '>7', 'data' => array()),
        );

        $this->db->select("UPPER(County) county, COUNT(IF(hcw_trained_on_prep > 0, 1, NULL) AND IF(hcw_trained_on_prep <= 3, 1, NULL)) '1-3', COUNT(IF(hcw_trained_on_prep > 3, 1, NULL) AND IF(hcw_trained_on_prep <= 6, 1, NULL)) '4-6', COUNT(IF(hcw_trained_on_prep > 6, 1, NULL)) '>7'", FALSE);
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
                    if ($hcw_trained['name'] == '>7') {
                        array_push($hcw_trained_data[$index]['data'], $result['>7']);
                    } else if ($hcw_trained['name'] == '4-6') {
                        array_push($hcw_trained_data[$index]['data'], $result['4-6']);
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

        $this->db->select("COUNT(IF(hcw_trained_on_prep > 0, 1, NULL) AND IF(hcw_trained_on_prep <= 3, 1, NULL)) '1-3', COUNT(IF(hcw_trained_on_prep > 3, 1, NULL) AND IF(hcw_trained_on_prep <= 6, 1, NULL)) '4-6', COUNT(IF(hcw_trained_on_prep > 6, 1, NULL)) '>7'", FALSE);
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
            array_push($response, array('hcw_trained_on_prep' => $column, 'Numbers' => $result[$column]));
        }
        return array('main' => $response, 'columns' => $columns);
    }

    public function get_distribution_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(County) category, Sub_County name,COUNT(*)y", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_trained_personnel');
        $population_data = $query->result_array();

        if ($drilldown_data) {
            $counter = sizeof($drilldown_data['drilldown']);
            foreach ($drilldown_data['drilldown'] as $main_data) {
                foreach ($main_data['data'] as $item) {
                    $filter_value = $item['name'];
                    $filter_name = $item['drilldown'];

                    $drilldown_data['drilldown'][$counter]['id'] = $filter_name;
                    $drilldown_data['drilldown'][$counter]['name'] = ucwords($filter_name);
                    $drilldown_data['drilldown'][$counter]['colorByPoint'] = true;

                    foreach ($population_data as $population) {
                        if ($filter_name == $population['category']) {
                            unset($population['category']);
                            $drilldown_data['drilldown'][$counter]['data'][] = $population;
                        }
                    }
                    $counter += 1;
                }
            }
        }
        return $drilldown_data;
    }

}
