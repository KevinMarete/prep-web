<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Service_delivery_model
 *
 * @author k
 */
class Service_delivery_model extends CI_Model {

    public function get_facilities_level_distribution($filters) {
        $this->db->select("Level name,COUNT(*)y, UPPER(Level) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->where('Level !=', 'Dice');
        $this->db->where('Level !=', 'Other (specify)');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_facility_details');
        return $this->get_facilities_level_distribution_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_facilities_level_distribution_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(Level) category, County name,COUNT(*)y, UPPER(County) drilldown", FALSE);
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
        $drilldown_data = $this->get_distribution_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_prep_focal_person($filters) {
        $this->db->select("Focal_Person name,COUNT(*)y, UPPER(Focal_Person) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_prep_facilities');
        return $this->get_prep_focal_person_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_prep_focal_person_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(Focal_Person) category, County name,COUNT(*)y, UPPER(County) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_prep_facilities');
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
        $drilldown_data = $this->get_distribution_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_hiv_services_offered($filters) {
        $this->db->select("Hiv_Service_Provided name,COUNT(*)y, UPPER(Hiv_Service_Provided) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->where('Hiv_Service_Provided !=', 'PrEP');
        $this->db->where('Hiv_Service_Provided !=', 'PEP');
        $this->db->where('Hiv_Service_Provided !=', 'HTS');
        $this->db->where('Hiv_Service_Provided !=', 'ART');
        $this->db->where('Hiv_Service_Provided !=', 'PMTCT');
        $this->db->where('Hiv_Service_Provided !=', 'KP Service');
        $this->db->where('Hiv_Service_Provided !=', 'VMMC');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_hiv_service_offered');
        return $this->get_hiv_services_offered_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_hiv_services_offered_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(Hiv_Service_Provided) category, County name,COUNT(*)y, UPPER(County) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('drilldown');
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
        $drilldown_data = $this->get_distribution_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_current_service_delivery_points_distribution($filters) {
        $this->db->select("Service_Delivery_Point name,COUNT(*)y, UPPER(Service_Delivery_Point) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->where('Service_Delivery_Point !=', 'PMTCT Clinic');
        $this->db->where('Service_Delivery_Point !=', 'MCH');
        $this->db->where('Service_Delivery_Point !=', 'Other');
        $this->db->where('Service_Delivery_Point !=', 'IPD');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_service_delivery_point');
        //print_r(json_encode($query->result_array()));
        //die();
        return $this->get_current_service_delivery_points_distribution_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_current_service_delivery_points_distribution_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(Service_Delivery_Point) category, County name,COUNT(*)y, UPPER(County) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('drilldown');
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
        $drilldown_data = $this->get_distribution_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
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
        $this->db->select("Population name,COUNT(*)y, UPPER(Population) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $this->db->where('Population !=', 'MSM - Men who have sex with men');
        $this->db->where('Population !=', 'PWID');
        $query = $this->db->get('tbl_prep_population');
        //print_r(json_encode($query->result_array()));
        //die();
        return $this->get_population_receiving_prep_numbers_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_population_receiving_prep_numbers_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(Population) category, County name,COUNT(*)y, UPPER(County) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('drilldown');
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
        $drilldown_data = $this->get_distribution_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_distribution_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(County) category, Sub_County name,COUNT(*)y", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_service_delivery_point');
        $population_data = $query->result_array();

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
        }
        return $drilldown_data;
    }

}
