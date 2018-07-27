<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Monitoring_evaluation_model
 *
 * @author k
 */
class Monitoring_evaluation_model extends CI_Model {

    public function get_prep_register_availability($filters) {
        $this->db->select("UPPER(county_name) name, (SUM(IF(prep_register='1',1,0))/COUNT(*))*100 y, UPPER(county_name) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'DESC');
        $this->db->limit(50);
        $query = $this->db->get('tbl_prep_data');
        return $this->get_prep_register_availability_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_prep_register_availability_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(county_name) category, subcounty_name name, (SUM(IF(prep_register='1',1,0)))/COUNT(*)*100 y, UPPER(subcounty_name) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_prep_data');
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
        return array_merge($main_data, $drilldown_data);
    }

    public function get_training_national_PrEP_ME_tools($filters) {
        $columns = array();
        $response = array();

        $this->db->select("COUNT(IF(prep_me_training=1,1,NULL)) Trained,COUNT(IF(prep_me_training=0,1,NULL)) 'Not Trained'", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $query = $this->db->get('tbl_prep_data');
        $result = $query->row_array();

        //Add columns
        $columns = array_keys($result);

        //Add data to response
        foreach ($columns as $column) {
            array_push($response, array('name' => $column, 'y' => $result[$column]));
        }
        return array('main' => $response, 'columns' => $columns);
    }

    public function get_rapid_assessment_tool_availability($filters) {
        $columns = array();
        $rapid_assessment_tool_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(county_name) county, COUNT(IF(`rapid_assessment_tool` = '1', 1, NULL)) YES, COUNT(IF(`rapid_assessment_tool` = '0', 1, NULL)) NO", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $query = $this->db->get('tbl_prep_data');
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

        $this->db->select("UPPER(county_name) county, COUNT(IF(prep_summary_tool = '1', 1, NULL)) YES, COUNT(IF(prep_summary_tool = '0', 1, NULL)) NO", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $query = $this->db->get('tbl_prep_data');
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

    public function get_tools_availability($filters) {
        $columns = array();
        $response = array();

        $this->db->select("SUM(rapid_assessment_tool) 'Rapid Assessment Tool',SUM(prep_summary_tool) 'Prep Summary Tool',SUM(prep_register) 'PrEP Register',SUM(clinical_encounter_form) 'Clinical Encounter Form',SUM(arvs_lmis_tool) 'ARVs LMIS Tool',SUM(pharmacovigilance_tool) 'Pharmacovigilance Tool'", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $query = $this->db->get('tbl_prep_data');
        $result = $query->row_array();

        //Add columns
        $columns = array_keys($result);

        //Add data to response
        foreach ($columns as $column) {
            array_push($response, array('name' => $column, 'y' => $result[$column]));
        }
        return array('main' => $response, 'columns' => $columns);
    }

    public function get_clinical_encounter_form($filters) {
        $columns = array();
        $clinical_encounter_form_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(county_name) county, COUNT(IF(`clinical_encounter_form` = '1', 1, NULL)) YES, COUNT(IF(`clinical_encounter_form` = '0', 1, NULL)) NO", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $query = $this->db->get('tbl_prep_data');
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

    public function get_follow_up_method($filters) {
        $columns = array();
        $response = array();

        $this->db->select("SUM(defaulters_list) 'Generate List Of Defaulters',SUM(follow_up_phonecalls) 'Follow-Up Phone Calls',SUM(sms_reminder) 'SMS Reminders', SUM(chw_tracing) 'CHW Tracing',SUM(support_group) 'Support Group',SUM(other_follow_up_mechanism) Others", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $query = $this->db->get('tbl_prep_data');
        $result = $query->row_array();

        //Add columns
        $columns = array_keys($result);

        //Add data to response
        foreach ($columns as $column) {
            array_push($response, array('name' => $column, 'y' => $result[$column]));
        }
        return array('main' => $response, 'columns' => $columns);
    }

    public function get_service_providers_training($filters) {
        $columns = array();
        $response = array();

        $this->db->select("SUM(prep_me_training)'PrEP M&E training',SUM(rapid_assessment_tool)'Rapid Assessment Screening Tool',SUM(prep_summary_tool)'PrEP Summary Reporting Tool',SUM(prep_register)'PrEP Register',SUM(clinical_encounter_form)'Clinical Encounter Form',SUM(arvs_lmis_tool)'ARV LMIS Tool',SUM(pharmacovigilance_tool)'Pharmacovigilance Tools'", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $query = $this->db->get('tbl_prep_data');
        $result = $query->row_array();

        //Add columns
        $columns = array_keys($result);

        //Add data to response
        foreach ($columns as $column) {
            array_push($response, array('name' => $column, 'y' => $result[$column]));
        }
        return array('main' => $response, 'columns' => $columns);
    }

    public function get_PrEP_clients_both_ever_initiated_and_currently_on_care($filters) {
        $columns = array();
        $prep_clients_data = array(
            array('type' => 'column', 'name' => 'Ever enrolled', 'data' => array()),
            array('type' => 'column', 'name' => 'Currently on Care', 'data' => array())
        );

        $this->db->select("UPPER(facility_name) facility, SUM(clients_ever_iniatiated) ever_enrolled,SUM(clients_on_care) currently_on_care", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('facility');
        $this->db->where('clients_ever_iniatiated !=',0);
        $this->db->limit(50);
        $query = $this->db->get('tbl_prep_data');
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
