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

    public function get_prep_dispensing_points_numbers($filters) {
        $columns = array();
        $this->db->select("SDP_PrEP_Dispensed where_prep_is_dispensed, COUNT(*) Frequency", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('where_prep_is_dispensed');
        $this->db->order_by('where_prep_is_dispensed', 'ASC');
        $query = $this->db->get('tbl_prep_dispensing_point');
        return array('main' => $query->result_array(), 'columns' => $columns);
    }

    public function get_prep_dispensing_points($filters) {
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

    public function get_prep_dispensing_software($filters) {
        $columns = array();
        $dispensing_software_data = array(
            array('type' => 'column', 'name' => 'Access ADT', 'data' => array()),
            array('type' => 'column', 'name' => 'EDDIT', 'data' => array()),
            array('type' => 'column', 'name' => 'IQ Care', 'data' => array()),
            array('type' => 'column', 'name' => 'Kenya EMR', 'data' => array()),
            array('type' => 'column', 'name' => 'OTHER (specify)', 'data' => array()),
            array('type' => 'column', 'name' => 'Web ADT', 'data' => array())
        );

        $this->db->select("UPPER(County) county,COUNT(IF(dispensing_software = 'Access ADT', 1, NULL)) 'Access ADT', COUNT(IF(dispensing_software = 'EDDIT', 1, NULL)) 'EDDIT', COUNT(IF(dispensing_software = 'IQ Care',1,Null)) 'IQ Care',COUNT(IF(dispensing_software='Kenya EMR',1,NULL)) 'Kenya EMR',COUNT(IF(dispensing_software = 'OTHER (specify)', 1, NULL)) 'OTHER (specify)', COUNT(IF(dispensing_software='Web ADT',1,NULL)) 'Web ADT'", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $query = $this->db->get('tbl_dispensing_software');
        $results = $query->result_array();

        if ($results) {
            foreach ($results as $result) {
                $columns[] = $result['county'];
                foreach ($dispensing_software_data as $index => $dispensing_software) {
                    if ($dispensing_software['name'] == 'Access ADT') {
                        array_push($dispensing_software_data[$index]['data'], $result['Access ADT']);
                    } else if ($dispensing_software['name'] == 'EDDIT') {
                        array_push($dispensing_software_data[$index]['data'], $result['EDDIT']);
                    } else if ($dispensing_software['name'] == 'IQ Care') {
                        array_push($dispensing_software_data[$index]['data'], $result['IQ Care']);
                    } else if ($dispensing_software['name'] == 'Kenya EMR') {
                        array_push($dispensing_software_data[$index]['data'], $result['Kenya EMR']);
                    } else if ($dispensing_software['name'] == 'OTHER (specify)') {
                        array_push($dispensing_software_data[$index]['data'], $result['OTHER (specify)']);
                    } else if ($dispensing_software['name'] == 'Web ADT') {
                        array_push($dispensing_software_data[$index]['data'], $result['Web ADT']);
                    }
                }
            }
        }
        return array('main' => $dispensing_software_data, 'columns' => $columns);
    }

    public function get_prep_dispensing_software_numbers($filters) {
        $columns = array();
        $this->db->select("UPPER(dispensing_software) software_in_use, COUNT(*) Frequency", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('software_in_use');
        $this->db->order_by('software_in_use', 'ASC');
        $query = $this->db->get('tbl_dispensing_software');
        return array('main' => $query->result_array(), 'columns' => $columns);
    }

    public function get_prep_product_dispensed_numbers($filters) {
        $columns = array();
        $this->db->select("UPPER(prep_product_dispensed) prep_product_dispensed, COUNT(*) Frequency", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('prep_product_dispensed');
        $this->db->order_by('prep_product_dispensed', 'ASC');
        $query = $this->db->get('tbl_prep_product');
        return array('main' => $query->result_array(), 'columns' => $columns);
    }

    public function get_prep_product_dispensed($filters) {
        $columns = array();
        $product_dispensed_data = array(
            array('type' => 'column', 'name' => 'TDF', 'data' => array()),
            array('type' => 'column', 'name' => 'TDF/3TC', 'data' => array()),
            array('type' => 'column', 'name' => 'TDF/FTC', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(prep_product_dispensed='TDF/FTC', 1, NULL)) 'TDF/FTC', COUNT(IF(prep_product_dispensed='TDF/3TC', 1, NULL)) 'TDF/3TC', COUNT(IF(prep_product_dispensed = 'TDF', 1, NULL)) TDF", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $this->db->order_by('county', 'ASC');
        $query = $this->db->get('tbl_prep_product');
        $results = $query->result_array();

        if ($results) {
            foreach ($results as $result) {
                $columns[] = $result['county'];
                foreach ($product_dispensed_data as $index => $product_dispensed) {
                    if ($product_dispensed['name'] == 'TDF/FTC') {
                        array_push($product_dispensed_data[$index]['data'], $result['TDF/FTC']);
                    } else if ($product_dispensed['name'] == 'TDF/3TC') {
                        array_push($product_dispensed_data[$index]['data'], $result['TDF/3TC']);
                    } else if ($product_dispensed['name'] == 'TDF') {
                        array_push($product_dispensed_data[$index]['data'], $result['TDF']);
                    }
                }
            }
        }
        return array('main' => $product_dispensed_data, 'columns' => $columns);
    }

}
