<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Monitoring_evaluation_model
 *
 * @author Marete
 */
class Monitoring_evaluation_model extends CI_Model {

    public function get_lmis_tools($filters) {
        $this->db->select("arv_lmis_tool name,COUNT(*)y, UPPER(REPLACE(arv_lmis_tool, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_monitoring_evaluation');
        return $this->get_lmis_tools_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_lmis_tools_drilldown($main_data, $filters) {
        $drilldown_data = array();

        $this->db->select("UPPER(REPLACE(arv_lmis_tool, ' ', '_')) category, County name, COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(arv_lmis_tool, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, drilldown');
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
        $drilldown_data = $this->get_lmis_tools_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_lmis_tools_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(arv_lmis_tool, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_monitoring_evaluation');
        $subcounty_data = $query->result_array();

        if ($drilldown_data) {
            $counter = sizeof($drilldown_data['drilldown']);
            foreach ($drilldown_data['drilldown'] as $main_data) {
                if(!empty($main_data['data'])){
                    foreach ($main_data['data'] as $item) {
                        $filter_value = $item['name'];
                        $filter_name = $item['drilldown'];

                        $drilldown_data['drilldown'][$counter]['id'] = $filter_name;
                        $drilldown_data['drilldown'][$counter]['name'] = ucwords($filter_name);
                        $drilldown_data['drilldown'][$counter]['colorByPoint'] = true;

                        foreach ($subcounty_data as $subcounty) {
                            if ($filter_name == $subcounty['category']) {
                                unset($subcounty['category']);
                                $drilldown_data['drilldown'][$counter]['data'][] = $subcounty;
                            }
                        }
                        $counter += 1;
                    }
                }
            }
        }
        return $drilldown_data;
    }

    public function get_clinical_encounter_forms($filters) {
        $this->db->select("clinical_encounter_form name,COUNT(*)y, UPPER(REPLACE(clinical_encounter_form, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_monitoring_evaluation');
        return $this->get_clinical_encounter_forms_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_clinical_encounter_forms_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(clinical_encounter_form, ' ', '_')) category, County name, COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(clinical_encounter_form, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, drilldown');
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
        $drilldown_data = $this->get_clinical_encounter_forms_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_clinical_encounter_forms_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(clinical_encounter_form, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_monitoring_evaluation');
        $subcounty_data = $query->result_array();

        if ($drilldown_data) {
            $counter = sizeof($drilldown_data['drilldown']);
            foreach ($drilldown_data['drilldown'] as $main_data) {
                if(!empty($main_data['data'])){
                    foreach ($main_data['data'] as $item) {
                        $filter_value = $item['name'];
                        $filter_name = $item['drilldown'];

                        $drilldown_data['drilldown'][$counter]['id'] = $filter_name;
                        $drilldown_data['drilldown'][$counter]['name'] = ucwords($filter_name);
                        $drilldown_data['drilldown'][$counter]['colorByPoint'] = true;

                        foreach ($subcounty_data as $subcounty) {
                            if ($filter_name == $subcounty['category']) {
                                unset($subcounty['category']);
                                $drilldown_data['drilldown'][$counter]['data'][] = $subcounty;
                            }
                        }
                        $counter += 1;
                    }
                }
            }
        }
        return $drilldown_data;
    }

    public function get_pharmacovigilance_tools($filters) {
        $this->db->select("pharmacovigilance_reporting_tools name,COUNT(*)y, UPPER(REPLACE(pharmacovigilance_reporting_tools, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_monitoring_evaluation');
        return $this->get_pharmacovigilance_tools_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_pharmacovigilance_tools_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(pharmacovigilance_reporting_tools, ' ', '_')) category, County name, COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(pharmacovigilance_reporting_tools, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, drilldown');
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
        $drilldown_data = $this->get_pharmacovigilance_tools_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_pharmacovigilance_tools_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(pharmacovigilance_reporting_tools, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_monitoring_evaluation');
        $subcounty_data = $query->result_array();

        if ($drilldown_data) {
            $counter = sizeof($drilldown_data['drilldown']);
            foreach ($drilldown_data['drilldown'] as $main_data) {
                if(!empty($main_data['data'])){
                    foreach ($main_data['data'] as $item) {
                        $filter_value = $item['name'];
                        $filter_name = $item['drilldown'];

                        $drilldown_data['drilldown'][$counter]['id'] = $filter_name;
                        $drilldown_data['drilldown'][$counter]['name'] = ucwords($filter_name);
                        $drilldown_data['drilldown'][$counter]['colorByPoint'] = true;

                        foreach ($subcounty_data as $subcounty) {
                            if ($filter_name == $subcounty['category']) {
                                unset($subcounty['category']);
                                $drilldown_data['drilldown'][$counter]['data'][] = $subcounty;
                            }
                        }
                        $counter += 1;
                    }
                }
            }
        }
        return $drilldown_data;
    }

    public function get_prep_registers($filters) {

        $this->db->select("PrEP_register name,COUNT(*)y, UPPER(REPLACE(PrEP_register, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_monitoring_evaluation');
        return $this->get_prep_registers_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_prep_registers_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(PrEP_register, ' ', '_')) category, County name, COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(PrEP_register, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, drilldown');
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
        $drilldown_data = $this->get_prep_registers_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_prep_registers_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(PrEP_register, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_monitoring_evaluation');
        $subcounty_data = $query->result_array();

        if ($drilldown_data) {
            $counter = sizeof($drilldown_data['drilldown']);
            foreach ($drilldown_data['drilldown'] as $main_data) {
                if(!empty($main_data['data'])){
                    foreach ($main_data['data'] as $item) {
                        $filter_value = $item['name'];
                        $filter_name = $item['drilldown'];

                        $drilldown_data['drilldown'][$counter]['id'] = $filter_name;
                        $drilldown_data['drilldown'][$counter]['name'] = ucwords($filter_name);
                        $drilldown_data['drilldown'][$counter]['colorByPoint'] = true;

                        foreach ($subcounty_data as $subcounty) {
                            if ($filter_name == $subcounty['category']) {
                                unset($subcounty['category']);
                                $drilldown_data['drilldown'][$counter]['data'][] = $subcounty;
                            }
                        }
                        $counter += 1;
                    }
                }
            }
        }
        return $drilldown_data;
    }

    public function get_rapid_assessment_screening_tools($filters) {
        $this->db->select("rapid_assessment_screening_tool name,COUNT(*)y, UPPER(REPLACE(rapid_assessment_screening_tool, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_monitoring_evaluation');
        return $this->get_rapid_assessment_screening_tools_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_rapid_assessment_screening_tools_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(rapid_assessment_screening_tool, ' ', '_')) category, County name, COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(rapid_assessment_screening_tool, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, drilldown');
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
        $drilldown_data = $this->get_rapid_assessment_screening_tools_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_rapid_assessment_screening_tools_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(rapid_assessment_screening_tool, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_monitoring_evaluation');
        $subcounty_data = $query->result_array();

        if ($drilldown_data) {
            $counter = sizeof($drilldown_data['drilldown']);
            foreach ($drilldown_data['drilldown'] as $main_data) {
                if(!empty($main_data['data'])){
                    foreach ($main_data['data'] as $item) {
                        $filter_value = $item['name'];
                        $filter_name = $item['drilldown'];

                        $drilldown_data['drilldown'][$counter]['id'] = $filter_name;
                        $drilldown_data['drilldown'][$counter]['name'] = ucwords($filter_name);
                        $drilldown_data['drilldown'][$counter]['colorByPoint'] = true;

                        foreach ($subcounty_data as $subcounty) {
                            if ($filter_name == $subcounty['category']) {
                                unset($subcounty['category']);
                                $drilldown_data['drilldown'][$counter]['data'][] = $subcounty;
                            }
                        }
                        $counter += 1;
                    }
                }
            }
        }
        return $drilldown_data;
    }

    public function get_prep_summmary_tools($filters) {
        $this->db->select("PrEP_summary_reporting_tool name,COUNT(*)y, UPPER(REPLACE(PrEP_summary_reporting_tool, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_monitoring_evaluation');
        return $this->get_prep_summmary_tools_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_prep_summmary_tools_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(PrEP_summary_reporting_tool, ' ', '_')) category, County name, COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(PrEP_summary_reporting_tool, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, drilldown');
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
        $drilldown_data = $this->get_prep_summmary_tools_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_prep_summmary_tools_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(PrEP_summary_reporting_tool, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_monitoring_evaluation');
        $subcounty_data = $query->result_array();

        if ($drilldown_data) {
            $counter = sizeof($drilldown_data['drilldown']);
            foreach ($drilldown_data['drilldown'] as $main_data) {
                if(!empty($main_data['data'])){
                    foreach ($main_data['data'] as $item) {
                        $filter_value = $item['name'];
                        $filter_name = $item['drilldown'];

                        $drilldown_data['drilldown'][$counter]['id'] = $filter_name;
                        $drilldown_data['drilldown'][$counter]['name'] = ucwords($filter_name);
                        $drilldown_data['drilldown'][$counter]['colorByPoint'] = true;

                        foreach ($subcounty_data as $subcounty) {
                            if ($filter_name == $subcounty['category']) {
                                unset($subcounty['category']);
                                $drilldown_data['drilldown'][$counter]['data'][] = $subcounty;
                            }
                        }
                        $counter += 1;
                    }
                }
            }
        }
        return $drilldown_data;
    }

    public function get_clients_on_prep($filters) {
        $columns = array();
        $prep_registers_data = array(
            array('type' => 'column', 'name' => 'Clients Ever Initiated', 'data' => array()),
            array('type' => 'column', 'name' => 'Current Clients', 'data' => array())
        );

        $this->db->select("UPPER(County) county, SUM(clients_ever_initiated) 'Clients Ever Initiated', SUM(current_clients) 'Current Clients'", FALSE);
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
                    if ($prep_registers['name'] == 'Current Clients') {
                        array_push($prep_registers_data[$index]['data'], $result['Current Clients']);
                    } else if ($prep_registers['name'] == 'Clients Ever Initiated') {
                        array_push($prep_registers_data[$index]['data'], $result['Clients Ever Initiated']);
                    }
                }
            }
        }
        return array('main' => $prep_registers_data, 'columns' => $columns);
    }

}
