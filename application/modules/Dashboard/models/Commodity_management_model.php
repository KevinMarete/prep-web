<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Commodity_management_model
 *
 * @author k
 */
class Commodity_management_model extends CI_Model {

    public function get_facility_source_of_ARVs($filters) {
        $columns = array();
        $this->db->select("ARV_Source name,COUNT(*)y", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->limit(50);
        $query = $this->db->get('tbl_arv_source');
        $results = $query->result_array();

        foreach ($results as $result) {
            array_push($columns, $result['name']);
        }

        return array('main' => $results, 'columns' => $columns);
    }

    public function get_facility_source_of_arvs_by_county($filters) {
        $columns = array();
        $arv_source_data = array(
            array('type' => 'column', 'name' => 'KEMSA-Central Site', 'data' => array()),
            array('type' => 'column', 'name' => 'Central Sites', 'data' => array()),
            array('type' => 'column', 'name' => 'KEMSA-Standalone', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(ARV_Source = 'Stand Alone', 1, NULL)) 'KEMSA-Standalone', ,COUNT(IF(ARV_Source = 'Satellites', 1, NULL)) 'Central Sites', COUNT(IF(ARV_Source = 'Central Site', 1, NULL)) 'KEMSA-Central Site'", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $query = $this->db->get('tbl_arv_source');
        $results = $query->result_array();

        if ($results) {
            foreach ($results as $result) {
                $columns[] = $result['county'];
                foreach ($arv_source_data as $index => $arv_source) {
                    if ($arv_source['name'] == 'KEMSA-Standalone') {
                        array_push($arv_source_data[$index]['data'], $result['KEMSA-Standalone']);
                    } else if ($arv_source['name'] == 'Central Sites') {
                        array_push($arv_source_data[$index]['data'], $result['Central Sites']);
                    } else if ($arv_source['name'] == 'KEMSA-Central Site') {
                        array_push($arv_source_data[$index]['data'], $result['KEMSA-Central Site']);
                    }
                }
            }
        }
        return array('main' => $arv_source_data, 'columns' => $columns);
    }

    public function get_prep_dispensing_points_in_facilities($filters) {
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

        $this->db->select("UPPER(County) county, COUNT(IF(SDP_PrEP_Dispensed = 'CCC', 1, NULL)) CCC,COUNT(IF(SDP_PrEP_Dispensed = 'DICE',1,Null)) DICE,COUNT(IF(SDP_PrEP_Dispensed='FP Clinic',1,NULL)) 'FP Clinic',COUNT(IF(SDP_PrEP_Dispensed='IPD',1,NULL)) IPD,COUNT(IF(SDP_PrEP_Dispensed='MCH',1,NULL)) MCH,COUNT(IF(SDP_PrEP_Dispensed='ONE STOP SHOP(Everything in one room)',1,NULL)) 'ONE STOP SHOP',COUNT(IF(SDP_PrEP_Dispensed = 'OPD', 1, NULL)) OPD,COUNT(IF(SDP_PrEP_Dispensed = 'PMTCT Clinic', 1, NULL)) 'PMTCT Clinic', COUNT(IF(SDP_PrEP_Dispensed = 'Other', 1, NULL)) Other", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $query = $this->db->get('tbl_prep_dispensing_point');
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
