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

    public function get_tools_availability($filters) {
        $columns = array();
        $response = array();
        $this->db->select("COUNT(IF(Rapid_Assessment_Screening_Tool = 'YES', 1, NULL)) 'Rapid Assessment Screening Tool', COUNT(IF(Prep_Summary_Reporting_Tool = 'YES', 1, NULL)) 'PrEP Summary Reporting Tool',COUNT(IF(PrEP_register='YES',1,NULL)) 'PrEP Register',COUNT(IF(Clinical_Encounter_Form='YES',1,NULL)) 'Clinical Encounter Form',COUNT(IF(ARV_LMIS_Tool='YES',1,NULL)) 'ARV LMIS Tool',COUNT(IF(Pharmacovigilance_Reporting_Tools='YES',1,NULL)) 'Pharmacovigilance Reporting Tools' ", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $query = $this->db->get('tbl_communication_advocacy');
        $result = $query->row_array();

        //Add columns
        $columns = array_keys($result);

        //Add data to response
        foreach ($columns as $column) {
            array_push($response, array('name' => $column, 'y' => $result[$column]));
        }
        return array('main' => $response, 'columns' => $columns);
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

    public function get_hepatitis_b_distribution($filters) {
        $columns = array();
        $county_hepatitis_data = array(
            array('type' => 'column', 'name' => 'without hepatitis B', 'data' => array()),
            array('type' => 'column', 'name' => 'with hepatitis B', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(`Hep-C_Equipment` = 'YES', 1, NULL)) with_hepatitis_b, COUNT(IF(`Hep-C_Equipment` = 'NO', 1, NULL)) without_hepatitis_b", FALSE);
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
                foreach ($county_hepatitis_data as $index => $county_hepatitis) {
                    if ($county_hepatitis['name'] == 'with hepatitis B') {
                        array_push($county_hepatitis_data[$index]['data'], $result['with_hepatitis_b']);
                    } else if ($county_hepatitis['name'] == 'without hepatitis B') {
                        array_push($county_hepatitis_data[$index]['data'], $result['without_hepatitis_b']);
                    }
                }
            }
        }
        return array('main' => $county_hepatitis_data, 'columns' => $columns);
    }

    public function get_hepatitis_c_distribution($filters) {
        $columns = array();
        $county_hepatitis_data = array(
            array('type' => 'column', 'name' => 'without hepatitis C', 'data' => array()),
            array('type' => 'column', 'name' => 'with hepatitis C', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(`Hep-C_Equipment` = 'YES', 1, NULL)) with_hepatitis_c, COUNT(IF(`Hep-C_Equipment` = 'NO', 1, NULL)) without_hepatitis_c", FALSE);
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
                foreach ($county_hepatitis_data as $index => $county_hepatitis) {
                    if ($county_hepatitis['name'] == 'with hepatitis C') {
                        array_push($county_hepatitis_data[$index]['data'], $result['with_hepatitis_c']);
                    } else if ($county_hepatitis['name'] == 'without hepatitis C') {
                        array_push($county_hepatitis_data[$index]['data'], $result['without_hepatitis_c']);
                    }
                }
            }
        }
        return array('main' => $county_hepatitis_data, 'columns' => $columns);
    }

    public function get_creatinine_distribution($filters) {
        $columns = array();
        $county_creatinine_data = array(
            array('type' => 'column', 'name' => 'without creatinine', 'data' => array()),
            array('type' => 'column', 'name' => 'with creatinine', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(Creatinine_Equipment = 'YES', 1, NULL)) with_creatinine, COUNT(IF(Creatinine_Equipment = 'NO', 1, NULL)) without_creatinine", FALSE);
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
                foreach ($county_creatinine_data as $index => $county_creatinine) {
                    if ($county_creatinine['name'] == 'with creatinine') {
                        array_push($county_creatinine_data[$index]['data'], $result['with_creatinine']);
                    } else if ($county_creatinine['name'] == 'without creatinine') {
                        array_push($county_creatinine_data[$index]['data'], $result['without_creatinine']);
                    }
                }
            }
        }
        return array('main' => $county_creatinine_data, 'columns' => $columns);
    }

    public function get_PrEP_clients_both_ever_initiated_and_currently_on_care($filters) {
        $columns = array();
        $prep_clients_data = array(
            array('type' => 'column', 'name' => 'Ever enrolled', 'data' => array()),
            array('type' => 'column', 'name' => 'Currently on Care', 'data' => array())
        );

        $this->db->select("UPPER(Facility) facility, SUM(Clients_Ever_Initiated) ever_enrolled,SUM(Current_Clients) currently_on_care", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('facility');
        $this->db->limit(50);
        $query = $this->db->get('tbl_communication_advocacy');
        $results = $query->result_array();

        if ($results) {
            foreach ($results as $result) {
                $columns[] = $result['facility'];
                foreach ($prep_clients_data as $index => $prep_clients) {
                    if ($prep_clients['name'] == 'Ever enrolled') {
                        array_push($prep_clients_data[$index]['data'], $result['ever_enrolled']);
                    } else if ($prep_clients['name'] == 'Currently on Care') {
                        array_push($prep_clients_data[$index]['data'], $result['currently_on_care']);
                    }
                }
            }
        }
        return array('main' => $prep_clients_data, 'columns' => $columns);
    }

}
