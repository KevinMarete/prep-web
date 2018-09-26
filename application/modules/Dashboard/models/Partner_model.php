<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Partner_model
 *
 * @author kariukye
 */
class Partner_model extends CI_Model {

    public function get_partner_support($filters) {
        $this->db->select("Partner_Support name,COUNT(*)y, UPPER(Partner_Support) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_facility_details');
        return $this->get_partner_support_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_partner_support_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(Partner_Support) category, County name,COUNT(*)y, UPPER(County) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_facility_details');
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
        $drilldown_data = $this->get_partner_support_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_partner_support_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(County) category, Sub_County name,COUNT(*)y", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_facility_details');
        $population_data = $query->result_array();

        if ($drilldown_data) {
            $counter = sizeof($drilldown_data['drilldown']);
            foreach ($drilldown_data['drilldown'] as $main_data) {
                foreach ($main_data['data'] as $item) {
                    $filter_value = $item['name'];
                    $filter_name = $item['drilldown'];

                    $drilldown_data['drilldown'][$counter]['id'] = $filter_name;
                    $drilldown_data['drilldown'][$counter]['name'] = ucwords($filter_name);
                    $drilldown_data['drilldown'][$counter]['colorByPoint'] = true;

                    foreach ($population_data as $population) {
                        if ($filter_name == $population['category']) {
                            unset($population['category']);
                            $drilldown_data['drilldown'][$counter]['data'][] = $population;
                        }
                    }
                    $counter += 1;
                }
            }
        }
        return $drilldown_data;
    }

    public function get_key_populations_targeted_by_prep_partner($filters) {
        $this->db->select("ps.implementing_partner name,COUNT(pp.Population)y, ps.implementing_partner drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->from('tbl_partner_support ps');
        $this->db->join('tbl_prep_population pp', 'pp.id=ps.id', 'left');
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get();
        return $this->get_key_populations_targeted_by_prep_partner_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_key_populations_targeted_by_prep_partner_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(ps.implementing_partner) category, pp.Population name,COUNT(pp.Population)y", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->from('tbl_partner_support ps');
        $this->db->join('tbl_prep_population pp', 'pp.id=ps.id', 'left');
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $sub_data = $this->db->get()->result_array();

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

    public function get_partner_service_delivery_point($filters) {
        $columns = array();
        $service_delivery_distribution_data = array(
            array('type' => 'column', 'name' => 'CCC', 'data' => array()),
            array('type' => 'column', 'name' => 'DICE', 'data' => array()),
            array('type' => 'column', 'name' => 'FP Clinic', 'data' => array()),
            array('type' => 'column', 'name' => 'IPD', 'data' => array()),
            array('type' => 'column', 'name' => 'MCH', 'data' => array()),
            array('type' => 'column', 'name' => 'ONE STOP SHOP', 'data' => array()),
            array('type' => 'column', 'name' => 'OPD', 'data' => array()),
            array('type' => 'column', 'name' => 'PMTCT Clinic', 'data' => array()),
            array('type' => 'column', 'name' => 'Other', 'data' => array())
        );

        $this->db->select("UPPER(ps.implementing_partner) partner, COUNT(IF(sdp.Service_Delivery_Point = 'CCC', 1, NULL)) CCC,COUNT(IF(sdp.Service_Delivery_Point = 'DICE',1,Null)) DICE,COUNT(IF(sdp.Service_Delivery_Point='FP Clinic',1,NULL)) 'FP Clinic',COUNT(IF(sdp.Service_Delivery_Point='IPD',1,NULL)) IPD,COUNT(IF(sdp.Service_Delivery_Point='MCH',1,NULL)) MCH,COUNT(IF(sdp.Service_Delivery_Point='ONE STOP SHOP',1,NULL)) 'ONE STOP SHOP',COUNT(IF(sdp.Service_Delivery_Point = 'OPD', 1, NULL)) OPD,COUNT(IF(sdp.Service_Delivery_Point = 'PMTCT Clinic', 1, NULL)) 'PMTCT Clinic', COUNT(IF(sdp.Service_Delivery_Point = 'other', 1, NULL)) Other", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->from('tbl_service_delivery_point sdp');
        $this->db->join('tbl_partner_support ps', 'sdp.id=ps.id');
        $this->db->group_by('partner');
        $query = $this->db->get();
        $results = $query->result_array();

        if ($results) {
            foreach ($results as $result) {
                $columns[] = $result['partner'];
                foreach ($service_delivery_distribution_data as $index => $service_delivery_distribution) {
                    if ($service_delivery_distribution['name'] == 'CCC') {
                        array_push($service_delivery_distribution_data[$index]['data'], $result['CCC']);
                    } else if ($service_delivery_distribution['name'] == 'DICE') {
                        array_push($service_delivery_distribution_data[$index]['data'], $result['DICE']);
                    } else if ($service_delivery_distribution['name'] == 'Fp Clinic') {
                        array_push($service_delivery_distribution_data[$index]['data'], $result['FP Clinic']);
                    } else if ($service_delivery_distribution['name'] == 'IPD') {
                        array_push($service_delivery_distribution_data[$index]['data'], $result['IPD']);
                    } else if ($service_delivery_distribution['name'] == 'MCH') {
                        array_push($service_delivery_distribution_data[$index]['data'], $result['MCH']);
                    } else if ($service_delivery_distribution['name'] == 'ONE STOP SHOP') {
                        array_push($service_delivery_distribution_data[$index]['data'], $result['ONE STOP SHOP']);
                    } else if ($service_delivery_distribution['name'] == 'PMTCT Clinic') {
                        array_push($service_delivery_distribution_data[$index]['data'], $result['PMTCT Clinic']);
                    } else if ($service_delivery_distribution['name'] == 'OPD') {
                        array_push($service_delivery_distribution_data[$index]['data'], $result['OPD']);
                    } else if ($service_delivery_distribution['name'] == 'Other') {
                        array_push($service_delivery_distribution_data[$index]['data'], $result['Other']);
                    }
                }
            }
        }
        return array('main' => $service_delivery_distribution_data, 'columns' => $columns);
    }

    public function get_hcw_trained_by_partner($filters) {
        $this->db->select("ps.implementing_partner name,COUNT(IF(tp.hcw_trained_on_prep = 'Yes', 1, 0))y, ps.implementing_partner drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->from('tbl_trained_personnel tp');
        $this->db->join('tbl_partner_support ps', 'tp.id=ps.id');
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get();
        return $this->get_hcw_trained_by_partner_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_hcw_trained_by_partner_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(ps.implementing_partner) category, tp.hcw_trained_on_prep name,COUNT(IF(tp.hcw_trained_on_prep = 'Yes', 1, 0))y", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->from('tbl_trained_personnel tp');
        $this->db->join('tbl_partner_support ps', 'tp.id=ps.id');
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $sub_data = $this->db->get()->result_array();

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

    public function get_partner_facility_numbers($filters) {
        $columns = array();
        $this->db->select("implementing_partner partner,County,Sub_County,COUNT(*) Numbers", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('partner, County, Sub_County');
        $this->db->order_by('Numbers', 'DESC');
        $query = $this->db->get('tbl_partner_support');
        $results = $query->result_array();

        foreach ($results as $result) {
            array_push($columns, $result['partner']);
        }

        return array('main' => $results, 'columns' => $columns);
    }

}
