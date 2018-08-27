<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Communication_advocacy_model
 *
 * @author k
 */
class Communication_advocacy_model extends CI_Model {

    public function get_demand_creation_activities($filters) {
        $columns = array();
        $demand_creation_activities_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(`demand_creation_activity` = 'YES', 1, NULL)) YES, COUNT(IF(`demand_creation_activity` = 'NO', 1, NULL)) NO", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $query = $this->db->get('tbl_communication_advocacy');
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

    public function get_prep_education_activities($filters) {
        $columns = array();
        $prep_education_activities_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(`prep_education_activity` = 'YES', 1, NULL)) YES, COUNT(IF(`prep_education_activity` = 'NO', 1, NULL)) NO", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $query = $this->db->get('tbl_communication_advocacy');
        $results = $query->result_array();

        if ($results) {
            foreach ($results as $result) {
                $columns[] = $result['county'];
                foreach ($prep_education_activities_data as $index => $prep_education_activities) {
                    if ($prep_education_activities['name'] == 'YES') {
                        array_push($prep_education_activities_data[$index]['data'], $result['YES']);
                    } else if ($prep_education_activities['name'] == 'NO') {
                        array_push($prep_education_activities_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $prep_education_activities_data, 'columns' => $columns);
    }

    public function get_iec_materials($filters) {
        $columns = array();
        $iec_materials_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(`iec_materials` = 'YES', 1, NULL)) YES, COUNT(IF(`iec_materials` = 'NO', 1, NULL)) NO", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $query = $this->db->get('tbl_communication_advocacy');
        $results = $query->result_array();

        if ($results) {
            foreach ($results as $result) {
                $columns[] = $result['county'];
                foreach ($iec_materials_data as $index => $iec_materials) {
                    if ($iec_materials['name'] == 'YES') {
                        array_push($iec_materials_data[$index]['data'], $result['YES']);
                    } else if ($iec_materials['name'] == 'NO') {
                        array_push($iec_materials_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $iec_materials_data, 'columns' => $columns);
    }

}
