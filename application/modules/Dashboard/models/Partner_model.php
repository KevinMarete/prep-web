<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Partner_model
 *
 * @author kariukye
 */
class Partner_model extends CI_Model {

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

    public function get_key_populations_targeted_by_prep_partner($filters) {
        $this->db->select("ps.implementing_partner name,COUNT(*)y, ps.implementing_partner drilldown", FALSE);
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
        $this->db->select("UPPER(ps.implementing_partner) category, pp.Population name,COUNT(*)y", FALSE);
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

}
