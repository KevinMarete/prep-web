<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Summary_model
 *
 * @author k
 */
class Summary_model extends CI_Model {

    public function get_support_implementing_partners($filters) {
        $columns = array();
        $response = array();

        $this->db->select("COUNT(IF(support_partner='1',1,NULL))Supported,COUNT(IF(support_partner='0',1,NULL))'Not Supported'", FALSE);
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

    public function get_facility_count($filters) {
        $this->db->select("county_name name,COUNT(facility_name)y, UPPER(county_name) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'ASC');
        $this->db->limit(50);
        $query = $this->db->get('tbl_prep_data');
        return $this->get_facility_count_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_facility_count_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(county_name) category, subcounty_name name,COUNT(facility_name)y, UPPER(subcounty_name) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'ASC');
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

    public function get_staff_dispensing_PrEP($filters) {
        $columns = array();
        $this->db->select("designation_prep_personnel name,COUNT(*)y", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'DESC');
        $this->db->limit(50);
        $query = $this->db->get('tbl_prep_data');
        $results = $query->result_array();

        foreach ($results as $result) {
            array_push($columns, $result['name']);
        }

        return array('main' => $results, 'columns' => $columns);
    }

    public function get_partners_percentage_support($filters) {
        $this->db->select("county_name name,(SUM(support_partner)/COUNT(*))*100 y, UPPER(county_name) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'ASC');
        $this->db->limit(50);
        $query = $this->db->get('tbl_prep_data');
        return $this->get_partners_percentage_support_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_partners_percentage_support_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(county_name) category, subcounty_name name, (SUM(support_partner)/COUNT(*))*100 y, UPPER(subcounty_name) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'ASC');
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

    public function get_facility_ownership($filters) {
        $columns = array();
        $this->db->select("facility_ownership name,COUNT(*)y", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'DESC');
        $this->db->limit(50);
        $query = $this->db->get('tbl_prep_data');
        $results = $query->result_array();

        foreach ($results as $result) {
            array_push($columns, $result['name']);
        }

        return array('main' => $results, 'columns' => $columns);
    }

    public function get_facility_level($filters) {
        $columns = array();
        $this->db->select("facility_level name,COUNT(*)y", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'DESC');
        $this->db->limit(50);
        $query = $this->db->get('tbl_prep_data');
        $results = $query->result_array();

        foreach ($results as $result) {
            array_push($columns, $result['name']);
        }

        return array('main' => $results, 'columns' => $columns);
    }

    public function get_partner_supported_component($filters) {
        $columns = array();
        $response = array();

        $this->db->select("SUM(hiring_staff)'Hiring Staff',SUM(furniture_equipment)'Provision of Furniture and Equipment',SUM(me_tool)'M&E Tools',SUM(iec_material)'IEC Materials',SUM(lab_support)'Lab Support',SUM(others)'Others'", FALSE);
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

}
