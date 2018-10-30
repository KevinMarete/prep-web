<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Service_delivery_model
 *
 * @author Marete
 */
class Service_delivery_model extends CI_Model {

    public function get_facility_distribution_map($filters){
        $columns = array();
        $response = array();

        //Get county data
        $this->db->select("County name, COUNT(*) total", FALSE);
        $this->db->group_by('name');
        $this->db->order_by('total', 'Desc');
        $query = $this->db->get('tbl_facility_details');
        $counties = $query->result_array();

        //Get subcounty data
        $this->db->select("Sub_County name, County, COUNT(*) total", FALSE);
        $this->db->group_by('name, County');
        $this->db->order_by('total', 'Desc');
        $query = $this->db->get('tbl_facility_details');
        $subcounties = $query->result_array();

        //Get facilities data
        $this->db->select("facility name, County, Sub_County", FALSE);
        $this->db->group_by('name, County, Sub_County');
        $query = $this->db->get('tbl_facility_details');
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

    public function get_facilities_level_distribution($filters) {
        $this->db->select("Level name,COUNT(*)y, UPPER(REPLACE(Level, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_facility_details');
        return $this->get_facilities_level_distribution_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_facilities_level_distribution_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(Level, ' ', '_')) category, County name,COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(Level, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
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
        $drilldown_data = $this->get_facilities_level_distribution_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_facilities_level_distribution_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(Level, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Level, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) drilldown, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_facility_details');
        $subcounty_data = $query->result_array();

        if ($drilldown_data) {
            $counter = sizeof($drilldown_data['drilldown']);
            foreach ($drilldown_data['drilldown'] as $main_data) {
                if(!empty($main_data['data'])){
                    foreach ($main_data['data'] as $item) {
                        $filter_value = $item['name'];
                        $filter_name = $item['drilldown'];

                        $drilldown_data['drilldown'][$counter]['id'] = $filter_name;
                        $drilldown_data['drilldown'][$counter]['name'] = ucwords($filter_name);
                        $drilldown_data['drilldown'][$counter]['colorByPoint'] = true;

                        foreach ($subcounty_data as $subcounty) {
                            if ($filter_name == $subcounty['category']) {
                                unset($subcounty['category']);
                                $drilldown_data['drilldown'][$counter]['data'][] = $subcounty;
                            }
                        }
                        $counter += 1;
                    }
                }
            }
        }
        return $this->get_facilities_level_distribution_drilldown_level3($drilldown_data, $filters);
    }

    public function get_facilities_level_distribution_drilldown_level3($drilldown_data, $filters){
        $this->db->select("UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Level, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) category, facility name, COUNT(*)y, '#dabdab' color", FALSE);
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

    public function get_prep_focal_person($filters) {
        $this->db->select("Focal_Person name,COUNT(*)y, UPPER(REPLACE(Focal_Person, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_facility_details');
        return $this->get_prep_focal_person_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_prep_focal_person_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(Focal_Person, ' ', '_')) category, County name, COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(Focal_Person, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
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

                $drilldown_data['drilldown'][$counter]['type'] = 'column';
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
        $main_data['type'] = 'pie';
        $drilldown_data = $this->get_prep_focal_person_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_prep_focal_person_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(Focal_Person, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Focal_Person, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) drilldown, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_facility_details');
        $subcounty_data = $query->result_array();

        if ($drilldown_data) {
            $counter = sizeof($drilldown_data['drilldown']);
            foreach ($drilldown_data['drilldown'] as $main_data) {
                if(!empty($main_data['data'])){
                    foreach ($main_data['data'] as $item) {
                        $filter_value = $item['name'];
                        $filter_name = $item['drilldown'];

                        $drilldown_data['drilldown'][$counter]['id'] = $filter_name;
                        $drilldown_data['drilldown'][$counter]['name'] = ucwords($filter_name);
                        $drilldown_data['drilldown'][$counter]['colorByPoint'] = true;

                        foreach ($subcounty_data as $subcounty) {
                            if ($filter_name == $subcounty['category']) {
                                unset($subcounty['category']);
                                $drilldown_data['drilldown'][$counter]['data'][] = $subcounty;
                            }
                        }
                        $counter += 1;
                    }
                }
            }
        }
        return $this->get_prep_focal_person_drilldown_level3($drilldown_data, $filters);
    }

    public function get_prep_focal_person_drilldown_level3($drilldown_data, $filters){
        $this->db->select("UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Focal_Person, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) category, facility name, COUNT(*)y, '#dabdab' color", FALSE);
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

    public function get_hiv_services_offered($filters) {
        $this->db->select("Hiv_Service_Provided name,COUNT(*)y, UPPER(REPLACE(Hiv_Service_Provided, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_hiv_service_offered');
        return $this->get_hiv_services_offered_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_hiv_services_offered_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(Hiv_Service_Provided, ' ', '_')) category, County name, COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(Hiv_Service_Provided, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_hiv_service_offered');
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
        $drilldown_data = $this->get_hiv_services_offered_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_hiv_services_offered_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(Hiv_Service_Provided, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Hiv_Service_Provided, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) drilldown, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_hiv_service_offered');
        $subcounty_data = $query->result_array();

        if ($drilldown_data) {
            $counter = sizeof($drilldown_data['drilldown']);
            foreach ($drilldown_data['drilldown'] as $main_data) {
                if(!empty($main_data['data'])){
                    foreach ($main_data['data'] as $item) {
                        $filter_value = $item['name'];
                        $filter_name = $item['drilldown'];

                        $drilldown_data['drilldown'][$counter]['id'] = $filter_name;
                        $drilldown_data['drilldown'][$counter]['name'] = ucwords($filter_name);
                        $drilldown_data['drilldown'][$counter]['colorByPoint'] = true;

                        foreach ($subcounty_data as $subcounty) {
                            if ($filter_name == $subcounty['category']) {
                                unset($subcounty['category']);
                                $drilldown_data['drilldown'][$counter]['data'][] = $subcounty;
                            }
                        }
                        $counter += 1;
                    }
                }
            }
        }
        return $this->get_hiv_services_offered_drilldown_level3($drilldown_data, $filters);
    }

    public function get_hiv_services_offered_drilldown_level3($drilldown_data, $filters){
        $this->db->select("UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Hiv_Service_Provided, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) category, facility name, COUNT(*)y, '#dabdab' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_hiv_service_offered');
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

    public function get_current_service_delivery_points_distribution($filters) {
        $this->db->select("Service_Delivery_Point name,COUNT(*)y, UPPER(REPLACE(Service_Delivery_Point, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_not_in('Service_Delivery_Point', 'ONE STOP SHOP(Everything in one room)');
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_service_delivery_point');
        return $this->get_current_service_delivery_points_distribution_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_current_service_delivery_points_distribution_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(Service_Delivery_Point, ' ', '_')) category, County name, COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(Service_Delivery_Point, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_not_in('Service_Delivery_Point', 'ONE STOP SHOP(Everything in one room)');
        $this->db->group_by('category, drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_service_delivery_point');
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
        $drilldown_data = $this->get_current_service_delivery_points_distribution_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_current_service_delivery_points_distribution_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(Service_Delivery_Point, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Service_Delivery_Point, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) drilldown, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_not_in('Service_Delivery_Point', 'ONE STOP SHOP(Everything in one room)');
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_service_delivery_point');
        $subcounty_data = $query->result_array();

        if ($drilldown_data) {
            $counter = sizeof($drilldown_data['drilldown']);
            foreach ($drilldown_data['drilldown'] as $main_data) {
                if(!empty($main_data['data'])){
                    foreach ($main_data['data'] as $item) {
                        $filter_value = $item['name'];
                        $filter_name = $item['drilldown'];

                        $drilldown_data['drilldown'][$counter]['id'] = $filter_name;
                        $drilldown_data['drilldown'][$counter]['name'] = ucwords($filter_name);
                        $drilldown_data['drilldown'][$counter]['colorByPoint'] = true;

                        foreach ($subcounty_data as $subcounty) {
                            if ($filter_name == $subcounty['category']) {
                                unset($subcounty['category']);
                                $drilldown_data['drilldown'][$counter]['data'][] = $subcounty;
                            }
                        }
                        $counter += 1;
                    }
                }
            }
        }
        return $this->get_current_service_delivery_points_distribution_drilldown_level3($drilldown_data, $filters);
    }


    public function get_current_service_delivery_points_distribution_drilldown_level3($drilldown_data, $filters){
        $this->db->select("UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Service_Delivery_Point, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) category, facility name, COUNT(*)y, '#dabdab' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_not_in('Service_Delivery_Point', 'ONE STOP SHOP(Everything in one room)');
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_service_delivery_point');
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

    public function get_population_receiving_prep_numbers($filters) {
        $this->db->select("Population name,COUNT(*)y, UPPER(REPLACE(Population, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_prep_population');
        return $this->get_population_receiving_prep_numbers_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_population_receiving_prep_numbers_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(Population, ' ', '_')) category, County name, COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(Population, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_prep_population');
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
        $drilldown_data = $this->get_population_receiving_prep_numbers_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_population_receiving_prep_numbers_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(Population, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Population, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) drilldown, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_prep_population');
        $subcounty_data = $query->result_array();

        if ($drilldown_data) {
            $counter = sizeof($drilldown_data['drilldown']);
            foreach ($drilldown_data['drilldown'] as $main_data) {
                if(!empty($main_data['data'])){
                    foreach ($main_data['data'] as $item) {
                        $filter_value = $item['name'];
                        $filter_name = $item['drilldown'];

                        $drilldown_data['drilldown'][$counter]['id'] = $filter_name;
                        $drilldown_data['drilldown'][$counter]['name'] = ucwords($filter_name);
                        $drilldown_data['drilldown'][$counter]['colorByPoint'] = true;

                        foreach ($subcounty_data as $subcounty) {
                            if ($filter_name == $subcounty['category']) {
                                unset($subcounty['category']);
                                $drilldown_data['drilldown'][$counter]['data'][] = $subcounty;
                            }
                        }
                        $counter += 1;
                    }
                }
            }
        }
        return $this->get_population_receiving_prep_numbers_drilldown_level3($drilldown_data, $filters);
    }

    public function get_population_receiving_prep_numbers_drilldown_level3($drilldown_data, $filters){
        $this->db->select("UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Population, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) category, facility name, COUNT(*)y, '#dabdab' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_prep_population');
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

}