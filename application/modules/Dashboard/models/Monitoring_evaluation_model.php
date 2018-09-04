<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Monitoring_evaluation_model
 *
 * @author k
 */
class Monitoring_evaluation_model extends CI_Model {

    public function get_overall_availability_of_ME_tools($filters) {
        $columns = array();
        $response = array();

        $this->db->select("COUNT(IF(rapid_assessment_screening_tool = 'YES', 1, NULL)) 'Rapid Assessment Screening Tool',COUNT(IF(PrEP_summary_reporting_tool = 'YES', 1, NULL)) 'PrEP Summary Reporting Tool',COUNT(IF(PrEP_register = 'YES', 1, NULL)) 'PrEP Register',COUNT(IF(clinical_encounter_form = 'YES', 1, NULL)) 'Clinical Encounter Form',COUNT(IF(arv_lmis_tool = 'YES', 1, NULL)) 'ARV LMIS Tool', COUNT(IF(pharmacovigilance_reporting_tools = 'YES', 1, NULL)) 'Pharmacovigilance Reporting Tools'", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $query = $this->db->get('tbl_monitoring_evaluation');
        $result = $query->row_array();

        //Add columns
        $columns = array_keys($result);

        //Add data to response
        foreach ($columns as $column) {
            array_push($response, array('name' => $column, 'y' => $result[$column]));
        }
        return array('main' => $response, 'columns' => $columns);
    }

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

    public function get_pharmacovigilance_tools($filters) {
        $columns = array();
        $pharmacovigilance_tools_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(`pharmacovigilance_reporting_tools` = 'YES', 1, NULL)) YES, COUNT(IF(`pharmacovigilance_reporting_tools` = 'NO', 1, NULL)) NO", FALSE);
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
                foreach ($pharmacovigilance_tools_data as $index => $pharmacovigilance_tools) {
                    if ($pharmacovigilance_tools['name'] == 'YES') {
                        array_push($pharmacovigilance_tools_data[$index]['data'], $result['YES']);
                    } else if ($pharmacovigilance_tools['name'] == 'NO') {
                        array_push($pharmacovigilance_tools_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $pharmacovigilance_tools_data, 'columns' => $columns);
    }

    public function get_prep_registers($filters) {
        $columns = array();
        $prep_registers_data = array(
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
        $query = $this->db->get('tbl_monitoring_evaluation');
        $results = $query->result_array();

        if ($results) {
            foreach ($results as $result) {
                $columns[] = $result['county'];
                foreach ($prep_registers_data as $index => $prep_registers) {
                    if ($prep_registers['name'] == 'YES') {
                        array_push($prep_registers_data[$index]['data'], $result['YES']);
                    } else if ($prep_registers['name'] == 'NO') {
                        array_push($prep_registers_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $prep_registers_data, 'columns' => $columns);
    }

    public function get_rapid_assessment_screening_tools($filters) {
        $columns = array();
        $rapid_assessment_screening_tools_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(`rapid_assessment_screening_tool` = 'YES', 1, NULL)) YES, COUNT(IF(`rapid_assessment_screening_tool` = 'NO', 1, NULL)) NO", FALSE);
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
                foreach ($rapid_assessment_screening_tools_data as $index => $rapid_assessment_screening_tools) {
                    if ($rapid_assessment_screening_tools['name'] == 'YES') {
                        array_push($rapid_assessment_screening_tools_data[$index]['data'], $result['YES']);
                    } else if ($rapid_assessment_screening_tools['name'] == 'NO') {
                        array_push($rapid_assessment_screening_tools_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $rapid_assessment_screening_tools_data, 'columns' => $columns);
    }

    public function get_prep_summmary_tools($filters) {
        $columns = array();
        $prep_summmary_tools_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(`PrEP_summary_reporting_tool` = 'YES', 1, NULL)) YES, COUNT(IF(`PrEP_summary_reporting_tool` = 'NO', 1, NULL)) NO", FALSE);
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
                foreach ($prep_summmary_tools_data as $index => $prep_summmary_tools) {
                    if ($prep_summmary_tools['name'] == 'YES') {
                        array_push($prep_summmary_tools_data[$index]['data'], $result['YES']);
                    } else if ($prep_summmary_tools['name'] == 'NO') {
                        array_push($prep_summmary_tools_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $prep_summmary_tools_data, 'columns' => $columns);
    }

    public function get_clients_ever_started_on_prep($filters) {
        $this->db->select("County name,SUM(clients_ever_initiated)y, UPPER(County) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_monitoring_evaluation');
        return $this->get_clients_ever_started_on_prep_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_clients_ever_started_on_prep_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(County) category, Sub_County name,SUM(clients_ever_initiated)y, UPPER(Sub_County) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_monitoring_evaluation');
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

    public function get_clients_currently_on_prep($filters) {
        $this->db->select("County name,SUM(current_clients)y, UPPER(County) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $this->db->limit(50);
        $query = $this->db->get('tbl_monitoring_evaluation');
        return $this->get_clients_currently_on_prep_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_clients_currently_on_prep_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(County) category, Sub_County name,SUM(current_clients)y, UPPER(Sub_County) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_monitoring_evaluation');
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

}
