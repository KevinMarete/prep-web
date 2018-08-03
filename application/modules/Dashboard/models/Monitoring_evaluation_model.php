<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Monitoring_evaluation_model
 *
 * @author k
 */
class Monitoring_evaluation_model extends CI_Model {

    public function get_lmis_tools($filters) {
        $columns = array();
        $lmis_tools_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(`arv_lmis_tool` = 'YES', 1, NULL)) YES, COUNT(IF(`arv_lmis_tool` = 'NO', 1, NULL)) NO", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $query = $this->db->get('tbl_monitoring_evaluation');
        $results = $query->result_array();

        if ($results) {
            foreach ($results as $result) {
                $columns[] = $result['county'];
                foreach ($lmis_tools_data as $index => $lmis_tools) {
                    if ($lmis_tools['name'] == 'YES') {
                        array_push($lmis_tools_data[$index]['data'], $result['YES']);
                    } else if ($lmis_tools['name'] == 'NO') {
                        array_push($lmis_tools_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $lmis_tools_data, 'columns' => $columns);
    }

    public function get_clinical_encounter_forms($filters) {
        $columns = array();
        $clinical_encounter_forms_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(`clinical_encounter_form` = 'YES', 1, NULL)) YES, COUNT(IF(`clinical_encounter_form` = 'NO', 1, NULL)) NO", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $query = $this->db->get('tbl_monitoring_evaluation');
        $results = $query->result_array();

        if ($results) {
            foreach ($results as $result) {
                $columns[] = $result['county'];
                foreach ($clinical_encounter_forms_data as $index => $clinical_encounter_forms) {
                    if ($clinical_encounter_forms['name'] == 'YES') {
                        array_push($clinical_encounter_forms_data[$index]['data'], $result['YES']);
                    } else if ($clinical_encounter_forms['name'] == 'NO') {
                        array_push($clinical_encounter_forms_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $clinical_encounter_forms_data, 'columns' => $columns);
    }

}
