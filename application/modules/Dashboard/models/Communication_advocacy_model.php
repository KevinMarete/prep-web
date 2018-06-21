<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Communication_advocacy_model
 *
 * @author k
 */
class Communication_advocacy_model extends CI_Model {

    public function get_rapid_assessment_tool_availability($filters) {
        $columns = array();
        $rapid_assessment_tool_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(`Rapid_Assessment_Screening_Tool` = 'YES', 1, NULL)) YES, COUNT(IF(`Rapid_Assessment_Screening_Tool` = 'NO', 1, NULL)) NO", FALSE);
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
                foreach ($rapid_assessment_tool_data as $index => $rapid_assessment_tool) {
                    if ($rapid_assessment_tool['name'] == 'YES') {
                        array_push($rapid_assessment_tool_data[$index]['data'], $result['YES']);
                    } else if ($rapid_assessment_tool['name'] == 'NO') {
                        array_push($rapid_assessment_tool_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $rapid_assessment_tool_data, 'columns' => $columns);
    }

    public function get_prep_summary_tool($filters) {
        $columns = array();
        $summary_tool_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(Prep_Summary_Reporting_Tool = 'YES', 1, NULL)) YES, COUNT(IF(Prep_Summary_Reporting_Tool = 'NO', 1, NULL)) NO", FALSE);
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
                foreach ($summary_tool_data as $index => $summary_tool) {
                    if ($summary_tool['name'] == 'YES') {
                        array_push($summary_tool_data[$index]['data'], $result['YES']);
                    } else if ($summary_tool['name'] == 'NO') {
                        array_push($summary_tool_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $summary_tool_data, 'columns' => $columns);
    }

    public function get_clinical_encounter_form($filters) {
        $columns = array();
        $clinical_encounter_form_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(`Clinical_Encounter_Form` = 'YES', 1, NULL)) YES, COUNT(IF(`Clinical_Encounter_Form` = 'NO', 1, NULL)) NO", FALSE);
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
                foreach ($clinical_encounter_form_data as $index => $clinical_encounter_form) {
                    if ($clinical_encounter_form['name'] == 'YES') {
                        array_push($clinical_encounter_form_data[$index]['data'], $result['YES']);
                    } else if ($clinical_encounter_form['name'] == 'NO') {
                        array_push($clinical_encounter_form_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $clinical_encounter_form_data, 'columns' => $columns);
    }

    public function get_prep_register_availability($filters) {
        $columns = array();
        $clinical_encounter_form_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(`PrEP_register` = 'YES', 1, NULL)) YES, COUNT(IF(`PrEP_register` = 'NO', 1, NULL)) NO", FALSE);
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
                foreach ($clinical_encounter_form_data as $index => $clinical_encounter_form) {
                    if ($clinical_encounter_form['name'] == 'YES') {
                        array_push($clinical_encounter_form_data[$index]['data'], $result['YES']);
                    } else if ($clinical_encounter_form['name'] == 'NO') {
                        array_push($clinical_encounter_form_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $clinical_encounter_form_data, 'columns' => $columns);
    }

}
