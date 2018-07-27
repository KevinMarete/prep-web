<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Communication_model
 *
 * @author k
 */
class Communication_model extends CI_Model {

    public function get_county_gap_distribution($filters) {
        $columns = array();
        $county_gap_data = array(
            array('type' => 'column', 'name' => 'Training', 'data' => array()),
            array('type' => 'column', 'name' => 'Personnel', 'data' => array()),
            array('type' => 'column', 'name' => 'Commodities', 'data' => array()),
            array('type' => 'column', 'name' => 'Space', 'data' => array()),
            array('type' => 'column', 'name' => 'M&E Tools', 'data' => array()),
            array('type' => 'column', 'name' => 'LMIS Tools', 'data' => array()),
            array('type' => 'column', 'name' => 'Access to Lab Services', 'data' => array()),
            array('type' => 'column', 'name' => 'IEC Materials', 'data' => array()),
            array('type' => 'column', 'name' => 'Client Follow Up Services', 'data' => array()),
            array('type' => 'column', 'name' => 'Others', 'data' => array()),
        );

        $this->db->select("UPPER(county_name) county, SUM(training) training, SUM(personnel) personnel, SUM(commodity) commodity,SUM(space) space,SUM(me_tools)me_tools,SUM(lmis_tools)lmis_tools,SUM(access_lab_service)access_lab_service,SUM(iec_materials)iec_materials,SUM(follow_up_system)follow_up_system,SUM(other_gaps)other_gaps", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $this->db->limit(50);
        $query = $this->db->get('tbl_prep_data');
        $results = $query->result_array();

        if ($results) {
            foreach ($results as $result) {
                $columns[] = $result['county'];
                foreach ($county_gap_data as $index => $county_gap) {
                    if ($county_gap['name'] == 'Training') {
                        array_push($county_gap_data[$index]['data'], $result['training']);
                    } else if ($county_gap['name'] == 'Personnel') {
                        array_push($county_gap_data[$index]['data'], $result['personnel']);
                    } else if ($county_gap['name'] == 'Commodities') {
                        array_push($county_gap_data[$index]['data'], $result['commodity']);
                    } else if ($county_gap['name'] == 'Space') {
                        array_push($county_gap_data[$index]['data'], $result['space']);
                    } else if ($county_gap['name'] == 'M&E Tools') {
                        array_push($county_gap_data[$index]['data'], $result['me_tools']);
                    } else if ($county_gap['name'] == 'LMIS Tools') {
                        array_push($county_gap_data[$index]['data'], $result['lmis_tools']);
                    } else if ($county_gap['name'] == 'Access to Lab Services') {
                        array_push($county_gap_data[$index]['data'], $result['access_lab_service']);
                    } else if ($county_gap['name'] == 'IEC Materials') {
                        array_push($county_gap_data[$index]['data'], $result['iec_materials']);
                    } else if ($county_gap['name'] == 'Client Follow Up Services') {
                        array_push($county_gap_data[$index]['data'], $result['follow_up_system']);
                    } else if ($county_gap['name'] == 'Others') {
                        array_push($county_gap_data[$index]['data'], $result['other_gaps']);
                    }
                }
            }
        }
        return array('main' => $county_gap_data, 'columns' => $columns);
    }

    public function get_county_gap_table($filters) {
        $columns = array();

        $this->db->select("UPPER(county_name) county, SUM(training) training, SUM(personnel) personnel, SUM(commodity) commodity,SUM(space) space,SUM(me_tools)me_tools,SUM(lmis_tools)lmis_tools,SUM(access_lab_service)access_lab_service,SUM(iec_materials)iec_materials,SUM(follow_up_system)follow_up_system,SUM(other_gaps)other_gaps", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $query = $this->db->get('tbl_prep_data');
        return array('main' => $query->result_array(), 'columns' => $columns);
    }

}
