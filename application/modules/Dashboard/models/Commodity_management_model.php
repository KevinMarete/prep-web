<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Commodity_management_model
 *
 * @author k
 */
class Commodity_management_model extends CI_Model {

    public function get_software_managing_prep_commodities($filters) {
        $columns = array();

        $this->db->select("SUBSTRING_INDEX((commodity_management_software),';',1) name,COUNT(*)y", FALSE);
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

    public function get_facility_source_ARVs($filters) {
        $columns = array();
        $this->db->select("arvs_source name,COUNT(*)y", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_prep_data');
        $results = $query->result_array();

        foreach ($results as $result) {
            array_push($columns, $result['name']);
        }

        return array('main' => $results, 'columns' => $columns);
    }

    public function get_cadre_staff_dispensing_PrEP($filters) {
        $columns = array();
        $response = array();

        $this->db->select("SUM(pharmacist) Pharmacist,SUM(pharm_tech) 'Pharm Tech',SUM(nurses) Nurses,SUM(clinical_officer) 'Clinical Officer',SUM(medical_officer) 'Medical Officer',SUM(hts_provider) 'HTS Provider',SUM(other_cadres) Others", FALSE);
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

    public function get_PrEP_drug_dispensation($filters) {
        $columns = array();
       // $this->db->select("prep_drug name, COUNT(*) y", FALSE);
        $this->db->select("SUBSTRING_INDEX((prep_drug),' ',1) name,count(*)y", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->where('prep_drug !=', '');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_prep_data');
        $results = $query->result_array();

        foreach ($results as $result) {
            array_push($columns, $result['name']);
        }

        return array('main' => $results, 'columns' => $columns);
    }

    public function get_facility_partner_service_delivery_point_table($filters) {
        $columns = array();

        $this->db->select("UPPER(subcounty_name) sub_county, facility_name, implementing_partner partner, assessment_date date_of_enrollment,service_delivery_point");
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('sub_county');
        $query = $this->db->get('tbl_prep_data');
        return array('main' => $query->result_array(), 'columns' => $columns);
    }

}
