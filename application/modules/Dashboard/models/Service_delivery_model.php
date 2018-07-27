<?php

/**
 * Description of Services_offered
 *
 * @author k
 */
class Service_delivery_model extends CI_Model {

    public function get_creatinine_distribution($filters) {
        $columns = array();
        $county_creatinine_data = array(
            array('type' => 'column', 'name' => 'without creatinine', 'data' => array()),
            array('type' => 'column', 'name' => 'with creatinine', 'data' => array())
        );

        $this->db->select("UPPER(county_name) county, COUNT(IF(creatinine_testing_equip = '1', 1, NULL)) with_creatinine, COUNT(IF(creatinine_testing_equip = '0', 1, NULL)) without_creatinine", FALSE);
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
                foreach ($county_creatinine_data as $index => $county_creatinine) {
                    if ($county_creatinine['name'] == 'with creatinine') {
                        array_push($county_creatinine_data[$index]['data'], $result['with_creatinine']);
                    } else if ($county_creatinine['name'] == 'without creatinine') {
                        array_push($county_creatinine_data[$index]['data'], $result['without_creatinine']);
                    }
                }
            }
        }
        return array('main' => $county_creatinine_data, 'columns' => $columns);
    }

    public function get_hepatitis_b_distribution($filters) {
        $columns = array();
        $county_hepatitis_data = array(
            array('type' => 'column', 'name' => 'without hepatitis B', 'data' => array()),
            array('type' => 'column', 'name' => 'with hepatitis B', 'data' => array())
        );

        $this->db->select("UPPER(county_name) county, COUNT(IF(hep_b_testing_equip = '1', 1, NULL)) with_hepatitis_b, COUNT(IF(hep_b_testing_equip = '0', 1, NULL)) without_hepatitis_b", FALSE);
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
                foreach ($county_hepatitis_data as $index => $county_hepatitis) {
                    if ($county_hepatitis['name'] == 'with hepatitis B') {
                        array_push($county_hepatitis_data[$index]['data'], $result['with_hepatitis_b']);
                    } else if ($county_hepatitis['name'] == 'without hepatitis B') {
                        array_push($county_hepatitis_data[$index]['data'], $result['without_hepatitis_b']);
                    }
                }
            }
        }
        return array('main' => $county_hepatitis_data, 'columns' => $columns);
    }

    public function get_hepatitis_c_distribution($filters) {
        $columns = array();
        $county_hepatitis_data = array(
            array('type' => 'column', 'name' => 'without hepatitis C', 'data' => array()),
            array('type' => 'column', 'name' => 'with hepatitis C', 'data' => array())
        );

        $this->db->select("UPPER(county_name) county, COUNT(IF(hep_c_testing_equip = '1', 1, NULL)) with_hepatitis_c, COUNT(IF(hep_c_testing_equip = '0', 1, NULL)) without_hepatitis_c", FALSE);
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
                foreach ($county_hepatitis_data as $index => $county_hepatitis) {
                    if ($county_hepatitis['name'] == 'with hepatitis C') {
                        array_push($county_hepatitis_data[$index]['data'], $result['with_hepatitis_c']);
                    } else if ($county_hepatitis['name'] == 'without hepatitis C') {
                        array_push($county_hepatitis_data[$index]['data'], $result['without_hepatitis_c']);
                    }
                }
            }
        }
        return array('main' => $county_hepatitis_data, 'columns' => $columns);
    }

    public function get_hiv_service_offered($filters) {
        $columns = array();
        $response = array();

        $this->db->select("(SUM(hts)/COUNT(hts))*100 HTS, (SUM(pmtct)/COUNT(*))*100 PMTCT,(SUM(vmmc)/COUNT(*))*100 VMMC,(SUM(kp_service)/COUNT(*))*100 'KP SERVICE',(SUM(pep)/COUNT(*))*100 PEP,(SUM(art)/COUNT(*))*100 ART,(SUM(prep)/COUNT(*))*100 PREP,(SUM(other_hiv_services)/COUNT(*))*100 OTHERS", FALSE);

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

    public function get_facility_PrEP_distribution($filters) {
        $columns = array();
        $this->db->select("SUBSTRING_INDEX((population_providing_prep),';',1) name,COUNT(*)y", FALSE);
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

    public function get_lab_services_availability($filters) {
        $columns = array();
        $response = array();

        $this->db->select("SUM(creatinine_test_reagent) Creatinine,SUM(hep_b_test_reagent) 'Hep B',SUM(hep_c_test_reagent) 'Hep C'", FALSE);
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
