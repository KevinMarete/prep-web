<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Service_delivery_model
 *
 * @author k
 */
class Service_delivery_model extends CI_Model {

    public function get_facilities_level_distribution($filters) {
        $columns = array();
        $facility_level_distribution_data = array(
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
                foreach ($facility_level_distribution_data as $index => $facility_level_distribution) {
                    if ($facility_level_distribution['name'] == 'County Hospital') {
                        array_push($facility_level_distribution_data[$index]['data'], $result['County Hospital']);
                    } else if ($facility_level_distribution['name'] == 'Health Center') {
                        array_push($facility_level_distribution_data[$index]['data'], $result['Health Center']);
                    } else if ($facility_level_distribution['name'] == 'County Referral Hospital') {
                        array_push($facility_level_distribution_data[$index]['data'], $result['County Referral Hospital']);
                    } else if ($facility_level_distribution['name'] == 'National Referral Hospital') {
                        array_push($facility_level_distribution_data[$index]['data'], $result['National Referral Hospital']);
                    } else if ($facility_level_distribution['name'] == 'DICE') {
                        array_push($facility_level_distribution_data[$index]['data'], $result['DICE']);
                    } else if ($facility_level_distribution['name'] == 'Other (specify)') {
                        array_push($facility_level_distribution_data[$index]['data'], $result['Other (specify)']);
                    } else if ($facility_level_distribution['name'] == 'Dispensary') {
                        array_push($facility_level_distribution_data[$index]['data'], $result['Dispensary']);
                    } else if ($facility_level_distribution['name'] == 'Sub County Hospital') {
                        array_push($facility_level_distribution_data[$index]['data'], $result['Sub County Hospital']);
                    }
                }
            }
        }
        return array('main' => $facility_level_distribution_data, 'columns' => $columns);
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

    public function get_hiv_services_offered($filters) {
        $columns = array();
        $this->db->select("Hiv_Service_Provided name,COUNT(*)y", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_hiv_service_offered');
        $results = $query->result_array();

        foreach ($results as $result) {
            array_push($columns, $result['name']);
        }

        return array('main' => $results, 'columns' => $columns);
    }

    public function get_facility_level_prep_availability_numbers($filters) {
        $columns = array();
        $this->db->select("Level level,COUNT(*) Numbers", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('level');
        $this->db->order_by('Numbers', 'DESC');
        $query = $this->db->get('tbl_facility_details');
        $results = $query->result_array();

        foreach ($results as $result) {
            array_push($columns, $result['level']);
        }

        return array('main' => $results, 'columns' => $columns);
    }

    public function get_current_service_delivery_points_distribution_numbers($filters) {
        $columns = array();
        $this->db->select("Service_Delivery_Point current_sdp_by_facilities,COUNT(*) Numbers", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('current_sdp_by_facilities');
        $this->db->order_by('Numbers', 'DESC');
        $query = $this->db->get('tbl_service_delivery_point');
        $results = $query->result_array();

        foreach ($results as $result) {
            array_push($columns, $result['current_sdp_by_facilities']);
        }

        return array('main' => $results, 'columns' => $columns);
    }

    public function get_current_service_delivery_points_distribution($filters) {
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

    public function get_prep_preffered_sdp_numbers($filters) {
        $columns = array();
        $this->db->select("Preferred_Sdp preferred_sdp_by_facilities,COUNT(*) Numbers", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('preferred_sdp_by_facilities');
        $this->db->order_by('Numbers', 'DESC');
        $query = $this->db->get('tbl_prep_preferred_sdp');
        $results = $query->result_array();

        foreach ($results as $result) {
            array_push($columns, $result['preferred_sdp_by_facilities']);
        }

        return array('main' => $results, 'columns' => $columns);
    }

    public function get_population_receiving_prep_numbers($filters) {
        $columns = array();
        $this->db->select("Population population,COUNT(*) Numbers", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('population');
        $this->db->order_by('Numbers', 'DESC');
        $query = $this->db->get('tbl_prep_population');
        $results = $query->result_array();

        foreach ($results as $result) {
            array_push($columns, $result['population']);
        }

        return array('main' => $results, 'columns' => $columns);
    }

}
