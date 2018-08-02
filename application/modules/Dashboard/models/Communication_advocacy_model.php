<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Communication_advocacy_model
 *
 * @author k
 */
class Communication_advocacy_model extends CI_Model {

    public function get_demand_creation_activities_in_facilities($filters) {
        $columns = array();
        $rapid_assessment_tool_data = array(
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

}
