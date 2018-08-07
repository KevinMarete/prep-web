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
        $facility_focal_person_data = array(
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
}
