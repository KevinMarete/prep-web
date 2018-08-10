<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Service_delivery_model
 *
 * @author k
 */
class Service_delivery_model extends CI_Model {

    public function get_facility_count($filters) {
        $this->db->select("County name,COUNT(facility)y, UPPER(County) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $this->db->limit(50);
        $query = $this->db->get('tbl_facility_details');
        return $this->get_facility_count_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_facilities_level_distribution($filters) {
        $columns = array();
        $prep_dispensing_points_data = array(
            array('type' => 'column', 'name' => 'County Hospital', 'data' => array()),
            array('type' => 'column', 'name' => 'Health Center', 'data' => array()),
            array('type' => 'column', 'name' => 'County Referral Hospital', 'data' => array()),
            array('type' => 'column', 'name' => 'National Referral Hospital', 'data' => array()),
            array('type' => 'column', 'name' => 'DICE', 'data' => array()),
            array('type' => 'column', 'name' => 'Other (specify)', 'data' => array()),
            array('type' => 'column', 'name' => 'Dispensary', 'data' => array()),
            array('type' => 'column', 'name' => 'Sub County Hospital', 'data' => array())
        );

        $this->db->select("UPPER(County) county,COUNT(IF(Level = 'County Hospital', 1, NULL)) 'County Hospital', COUNT(IF(Level = 'Health Center', 1, NULL)) 'Health Center', COUNT(IF(Level = 'County Referral Hospital',1,Null)) 'County Referral Hospital',COUNT(IF(Level='National Referral Hospital',1,NULL)) 'National Referral Hospital',COUNT(IF(Level = 'DICE', 1, NULL)) DICE, COUNT(IF(Level='Other (specify)',1,NULL)) 'Other (specify)', COUNT(IF(Level='Dispensary',1,NULL)) Dispensary, COUNT(IF(Level='Sub County Hospital',1,NULL)) 'Sub County Hospital'", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $query = $this->db->get('tbl_facility_details');
        $results = $query->result_array();

        if ($results) {
            foreach ($results as $result) {
                $columns[] = $result['county'];
                foreach ($prep_dispensing_points_data as $index => $prep_dispensing_points) {
                    if ($prep_dispensing_points['name'] == 'County Hospital') {
                        array_push($prep_dispensing_points_data[$index]['data'], $result['County Hospital']);
                    } else if ($prep_dispensing_points['name'] == 'Health Center') {
                        array_push($prep_dispensing_points_data[$index]['data'], $result['Health Center']);
                    } else if ($prep_dispensing_points['name'] == 'County Referral Hospital') {
                        array_push($prep_dispensing_points_data[$index]['data'], $result['County Referral Hospital']);
                    } else if ($prep_dispensing_points['name'] == 'National Referral Hospital') {
                        array_push($prep_dispensing_points_data[$index]['data'], $result['National Referral Hospital']);
                    } else if ($prep_dispensing_points['name'] == 'DICE') {
                        array_push($prep_dispensing_points_data[$index]['data'], $result['DICE']);
                    } else if ($prep_dispensing_points['name'] == 'Other (specify)') {
                        array_push($prep_dispensing_points_data[$index]['data'], $result['Other (specify)']);
                    } else if ($prep_dispensing_points['name'] == 'Dispensary') {
                        array_push($prep_dispensing_points_data[$index]['data'], $result['Dispensary']);
                    } else if ($prep_dispensing_points['name'] == 'Sub County Hospital') {
                        array_push($prep_dispensing_points_data[$index]['data'], $result['Sub County Hospital']);
                    }
                }
            }
        }
        return array('main' => $prep_dispensing_points_data, 'columns' => $columns);
    }

    public function get_facility_count_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(County) category, Sub_County name,COUNT(facility)y, UPPER(Sub_County) drilldown", FALSE);
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
        return array_merge($main_data, $drilldown_data);
    }

    public function get_prep_focal_person($filters) {
        $columns = array();
        $facility_focal_person_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(Focal_Person = 'YES', 1, NULL)) YES, COUNT(IF(Focal_Person = 'NO', 1, NULL)) NO", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $query = $this->db->get('tbl_prep_facilities');
        $results = $query->result_array();

        if ($results) {
            foreach ($results as $result) {
                $columns[] = $result['county'];
                foreach ($facility_focal_person_data as $index => $facility_focal_person) {
                    if ($facility_focal_person['name'] == 'YES') {
                        array_push($facility_focal_person_data[$index]['data'], $result['YES']);
                    } else if ($facility_focal_person['name'] == 'NO') {
                        array_push($facility_focal_person_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $facility_focal_person_data, 'columns' => $columns);
    }

    public function get_partner_support($filters) {
        $columns = array();
        $partner_support_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(Partner_Support = 'YES', 1, NULL)) YES, COUNT(IF(Partner_Support = 'NO', 1, NULL)) NO", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $query = $this->db->get('tbl_prep_facilities');
        $results = $query->result_array();

        if ($results) {
            foreach ($results as $result) {
                $columns[] = $result['county'];
                foreach ($partner_support_data as $index => $partner_support) {
                    if ($partner_support['name'] == 'YES') {
                        array_push($partner_support_data[$index]['data'], $result['YES']);
                    } else if ($partner_support['name'] == 'NO') {
                        array_push($partner_support_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $partner_support_data, 'columns' => $columns);
    }

    public function get_hiv_services_offered($filters) {
        $columns = array();
        $this->db->select("Hiv_Service_Provided name,COUNT(*)y", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->limit(50);
        $query = $this->db->get('tbl_hiv_service_offered');
        $results = $query->result_array();

        foreach ($results as $result) {
            array_push($columns, $result['name']);
        }

        return array('main' => $results, 'columns' => $columns);
    }
public function get_service_delivery_points_distribution($filters) {
        $columns = array();
        $prep_dispensing_points_data = array(
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

        $this->db->select("UPPER(County) county, COUNT(IF(Service_Delivery_Point = 'CCC', 1, NULL)) CCC,COUNT(IF(Service_Delivery_Point = 'DICE',1,Null)) DICE,COUNT(IF(Service_Delivery_Point='FP Clinic',1,NULL)) 'FP Clinic',COUNT(IF(Service_Delivery_Point='IPD',1,NULL)) IPD,COUNT(IF(Service_Delivery_Point='MCH',1,NULL)) MCH,COUNT(IF(Service_Delivery_Point='ONE STOP SHOP',1,NULL)) 'ONE STOP SHOP',COUNT(IF(Service_Delivery_Point = 'OPD', 1, NULL)) OPD,COUNT(IF(Service_Delivery_Point = 'PMTCT Clinic', 1, NULL)) 'PMTCT Clinic', COUNT(IF(Service_Delivery_Point = 'other', 1, NULL)) Other", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $query = $this->db->get('tbl_service_delivery_point');
        $results = $query->result_array();

        if ($results) {
            foreach ($results as $result) {
                $columns[] = $result['county'];
                foreach ($prep_dispensing_points_data as $index => $prep_dispensing_points) {
                    if ($prep_dispensing_points['name'] == 'CCC') {
                        array_push($prep_dispensing_points_data[$index]['data'], $result['CCC']);
                    } else if ($prep_dispensing_points['name'] == 'DICE') {
                        array_push($prep_dispensing_points_data[$index]['data'], $result['DICE']);
                    } else if ($prep_dispensing_points['name'] == 'Fp Clinic') {
                        array_push($prep_dispensing_points_data[$index]['data'], $result['FP Clinic']);
                    } else if ($prep_dispensing_points['name'] == 'IPD') {
                        array_push($prep_dispensing_points_data[$index]['data'], $result['IPD']);
                    } else if ($prep_dispensing_points['name'] == 'MCH') {
                        array_push($prep_dispensing_points_data[$index]['data'], $result['MCH']);
                    } else if ($prep_dispensing_points['name'] == 'ONE STOP SHOP') {
                        array_push($prep_dispensing_points_data[$index]['data'], $result['ONE STOP SHOP']);
                    } else if ($prep_dispensing_points['name'] == 'PMTCT Clinic') {
                        array_push($prep_dispensing_points_data[$index]['data'], $result['PMTCT Clinic']);
                    } else if ($prep_dispensing_points['name'] == 'OPD') {
                        array_push($prep_dispensing_points_data[$index]['data'], $result['OPD']);
                    } else if ($prep_dispensing_points['name'] == 'Other') {
                        array_push($prep_dispensing_points_data[$index]['data'], $result['Other']);
                    }
                }
            }
        }
        return array('main' => $prep_dispensing_points_data, 'columns' => $columns);
    }
}
