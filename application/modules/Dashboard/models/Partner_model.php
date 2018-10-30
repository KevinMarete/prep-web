<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Partner_model
 *
 * @author Marete
 */
class Partner_model extends CI_Model {

    public function get_partner_support($filters) {
        $this->db->select("Partner_Support name,COUNT(*)y, UPPER(REPLACE(Partner_Support, ' ', '_')) drilldown", FALSE);
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
        $this->db->select("UPPER(REPLACE(Partner_Support, ' ', '_')) category, County name,COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(Partner_Support, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, drilldown');
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
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(Partner_Support, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Partner_Support, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) drilldown, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
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
        return $this->get_partner_support_drilldown_level3($drilldown_data, $filters);
    }

    public function get_partner_support_drilldown_level3($drilldown_data, $filters){
        $this->db->select("UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Partner_Support, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) category, facility name, COUNT(*)y, '#dabdab' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_facility_details');
        $facility_data = $query->result_array();

        if ($drilldown_data) {
            $counter = sizeof($drilldown_data['drilldown']);
            foreach ($drilldown_data['drilldown'] as $main_data) {
                if(!empty($main_data['data'])){
                    foreach ($main_data['data'] as $item) {
                        $filter_name = $item['drilldown'];
                        foreach ($facility_data as $facility) {
                            if ($filter_name == $facility['category']) {
                                unset($facility['category']);
                                $drilldown_data['drilldown'][$counter]['id'] = $filter_name;
                                $drilldown_data['drilldown'][$counter]['name'] = ucwords($filter_name);
                                $drilldown_data['drilldown'][$counter]['colorByPoint'] = true;
                                $drilldown_data['drilldown'][$counter]['data'][] = $facility;
                            }
                        }
                        $counter += 1;
                    }
                }
            }
        }

        return $drilldown_data;
    }

    public function get_partner_distribution_map($filters){
        $columns = array();
        $response = array();

        //Get county data
        $this->db->select("County name, COUNT(DISTINCT implementing_partner) total", FALSE);
        $this->db->group_by('name');
        $this->db->order_by('total', 'Desc');
        $query = $this->db->get('tbl_partner_support');
        $counties = $query->result_array();

        //Get subcounty data
        $this->db->select("Sub_County name, County, COUNT(DISTINCT implementing_partner) total", FALSE);
        $this->db->group_by('name, County');
        $this->db->order_by('total', 'Desc');
        $query = $this->db->get('tbl_partner_support');
        $subcounties = $query->result_array();

        //Get facilities data
        $this->db->select("CONCAT(implementing_partner, '(facilities=',COUNT(facility), ')') name, County, Sub_County", FALSE);
        $this->db->group_by('implementing_partner, County, Sub_County');
        $query = $this->db->get('tbl_partner_support');
        $facilities = $query->result_array();

        //Construct the response (County)
        foreach ($counties as $county) {
            $county_name = strtolower(str_ireplace(array("'", " ", "-"), array("", "_", "_"), $county['name']));
            $response[$county_name] = array(
                'total' => $county['total'],
                'subcounties' => array()
            ); 
        }

        //Construct the response (Subcounty)
        foreach ($subcounties as $subcounty) {
            $county_name = strtolower(str_ireplace(array("'", " ", "-"), array("", "_", "_"), $subcounty['County']));
            $subcounty_name = strtolower(str_ireplace(array("'", " ", "-"), array("", "_", "_"), $subcounty['name']));
            $response[$county_name]['subcounties'][$subcounty_name] = array(
                'total' => $subcounty['total'],
                'facilities' => array()
            ); 
        }

        //Construct the response (Facility)
        foreach ($facilities as $facility) {
            $county_name = strtolower(str_ireplace(array("'", " ", "-"), array("", "_", "_"), $facility['County']));
            $subcounty_name = strtolower(str_ireplace(array("'", " ", "-"), array("", "_", "_"), $facility['Sub_County']));
            $facility_name = ucwords(str_ireplace(array("'", " ", "-"), array("", "_", "_"), $facility['name']));
            $response[$county_name]['subcounties'][$subcounty_name]['facilities'][] = $facility_name; 
        }

        return array('main' => $response, 'columns' => $columns);
    }

    public function get_partner_facility_numbers($filters) {
        $this->db->select("implementing_partner name,COUNT(*)y, UPPER(REPLACE(implementing_partner, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_partner_support');
        return $this->get_partner_facility_numbers_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_partner_facility_numbers_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(implementing_partner, ' ', '_')) category, County name,COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(implementing_partner, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_partner_support');
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
        $drilldown_data = $this->get_partner_facility_numbers_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }


    public function get_partner_facility_numbers_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(implementing_partner, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(implementing_partner, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) drilldown, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_partner_support');
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
        return $this->get_partner_facility_numbers_drilldown_level3($drilldown_data, $filters);
    }

    public function get_partner_facility_numbers_drilldown_level3($drilldown_data, $filters){
        $this->db->select("UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(implementing_partner, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) category, facility name, COUNT(*)y, '#dabdab' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_partner_support');
        $facility_data = $query->result_array();

        if ($drilldown_data) {
            $counter = sizeof($drilldown_data['drilldown']);
            foreach ($drilldown_data['drilldown'] as $main_data) {
                if(!empty($main_data['data'])){
                    foreach ($main_data['data'] as $item) {
                        $filter_name = $item['drilldown'];
                        foreach ($facility_data as $facility) {
                            if ($filter_name == $facility['category']) {
                                unset($facility['category']);
                                $drilldown_data['drilldown'][$counter]['id'] = $filter_name;
                                $drilldown_data['drilldown'][$counter]['name'] = ucwords($filter_name);
                                $drilldown_data['drilldown'][$counter]['colorByPoint'] = true;
                                $drilldown_data['drilldown'][$counter]['data'][] = $facility;
                            }
                        }
                        $counter += 1;
                    }
                }
            }
        }

        return $drilldown_data;
    }

    public function get_partner_service_delivery_point($filters) {
        $columns = array();
        $service_delivery_distribution_data = array(
            array('type' => 'column', 'name' => 'CCC', 'data' => array()),
            array('type' => 'column', 'name' => 'DICE', 'data' => array()),
            array('type' => 'column', 'name' => 'FP Clinic', 'data' => array()),
            array('type' => 'column', 'name' => 'IPD', 'data' => array()),
            array('type' => 'column', 'name' => 'OPD', 'data' => array()),
            array('type' => 'column', 'name' => 'PMTCT/MCH', 'data' => array()),
            array('type' => 'column', 'name' => 'Other', 'data' => array())
        );

        $this->db->select("UPPER(ps.implementing_partner) partner, COUNT(IF(sdp.Service_Delivery_Point = 'CCC', 1, NULL)) CCC,COUNT(IF(sdp.Service_Delivery_Point = 'DICE',1,Null)) DICE,COUNT(IF(sdp.Service_Delivery_Point='FP Clinic',1,NULL)) 'FP Clinic',COUNT(IF(sdp.Service_Delivery_Point='IPD',1,NULL)) IPD,COUNT(IF(sdp.Service_Delivery_Point = 'OPD', 1, NULL)) OPD,COUNT(IF(sdp.Service_Delivery_Point = 'PMTCT/MCH', 1, NULL)) 'PMTCT/MCH', COUNT(IF(sdp.Service_Delivery_Point = 'other', 1, NULL)) Other", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->from('tbl_service_delivery_point sdp');
        $this->db->join('tbl_partner_support ps', 'sdp.id=ps.id');
        $this->db->where_not_in('sdp.Service_Delivery_Point', 'ONE STOP SHOP(Everything in one room)');
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
                    } else if ($service_delivery_distribution['name'] == 'PMTCT/MCH') {
                        array_push($service_delivery_distribution_data[$index]['data'], $result['PMTCT/MCH']);
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
        $columns = array();
        $partner_data = array(
            array('type' => 'column', 'name' => 'Trained', 'data' => array()),
            array('type' => 'column', 'name' => 'Not Trained', 'data' => array())
        );

        $this->db->select("UPPER(ps.implementing_partner) partner, COUNT(IF(tp.trained_on_prep = 'Yes', 1, NULL)) trained, COUNT(IF(tp.trained_on_prep = 'No', 1, Null)) untrained", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->from('tbl_trained_personnel tp');
        $this->db->join('tbl_partner_support ps', 'tp.id=ps.id');
        $this->db->group_by('partner');
        $query = $this->db->get();
        $results = $query->result_array();

        if ($results) {
            foreach ($results as $result) {
                $columns[] = $result['partner'];
                foreach ($partner_data as $index => $partner) {
                    if ($partner['name'] == 'Trained') {
                        array_push($partner_data[$index]['data'], $result['trained']);
                    } else if ($partner['name'] == 'Not Trained') {
                        array_push($partner_data[$index]['data'], $result['untrained']);
                    } 
                }
            }
        }
        return array('main' => $partner_data, 'columns' => $columns);
    }

}
