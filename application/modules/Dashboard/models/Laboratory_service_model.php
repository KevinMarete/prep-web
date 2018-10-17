<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Laboratory_service_model
 *
 * @author Marete
 */
class Laboratory_service_model extends CI_Model {

    public function get_access_creatinine_testing($filters) {
        $this->db->select("Creatinine_Testing name,COUNT(*)y, UPPER(REPLACE(Creatinine_Testing, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
        return $this->get_access_creatinine_testing_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_access_creatinine_testing_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(Creatinine_Testing, ' ', '_')) category, County name,COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(Creatinine_Testing, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
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
        $drilldown_data = $this->get_access_creatinine_testing_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_access_creatinine_testing_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(Creatinine_Testing, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Creatinine_Testing, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) drilldown, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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
        return $this->get_access_creatinine_testing_drilldown_level3($drilldown_data, $filters);
    }

    public function get_access_creatinine_testing_drilldown_level3($drilldown_data, $filters){
        $this->db->select("UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Creatinine_Testing, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) category, facility name, COUNT(*)y, '#dabdab' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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

    public function get_offsite_onsite_creatinine_testing($filters) {
        $this->db->select("`Creatinine On/Off Site` name,COUNT(*)y, UPPER(REPLACE(`Creatinine On/Off Site`, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Creatinine_Testing', 'YES');
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
        return $this->get_offsite_onsite_creatinine_testing_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_offsite_onsite_creatinine_testing_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(`Creatinine On/Off Site`, ' ', '_')) category, County name,COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(`Creatinine On/Off Site`, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Creatinine_Testing', 'YES');
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
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
        $drilldown_data = $this->get_offsite_onsite_creatinine_testing_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_offsite_onsite_creatinine_testing_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(`Creatinine On/Off Site`, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(`Creatinine On/Off Site`, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) drilldown, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Creatinine_Testing', 'YES');
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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
        return $this->get_offsite_onsite_creatinine_testing_drilldown_level3($drilldown_data, $filters);
    }

    public function get_offsite_onsite_creatinine_testing_drilldown_level3($drilldown_data, $filters){
        $this->db->select("UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(`Creatinine On/Off Site`, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) category, facility name, COUNT(*)y, '#dabdab' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Creatinine_Testing', 'YES');
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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


    public function get_creatinine_testing_equipment($filters) {
        $this->db->select("Creatinine_Equipment name,COUNT(*)y, UPPER(REPLACE(Creatinine_Equipment, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Creatinine_Testing', 'YES');
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
        return $this->get_creatinine_testing_equipment_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_creatinine_testing_equipment_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(Creatinine_Equipment, ' ', '_')) category, County name,COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(Creatinine_Equipment, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Creatinine_Testing', 'YES');
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
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
        $drilldown_data = $this->get_creatinine_testing_equipment_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_creatinine_testing_equipment_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(Creatinine_Equipment, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Creatinine_Equipment, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) drilldown, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Creatinine_Testing', 'YES');
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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
        return $this->get_creatinine_testing_equipment_drilldown_level3($drilldown_data, $filters);
    }

    public function get_creatinine_testing_equipment_drilldown_level3($drilldown_data, $filters){
        $this->db->select("UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Creatinine_Equipment, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) category, facility name, COUNT(*)y, '#dabdab' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Creatinine_Testing', 'YES');
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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

    public function get_creatinine_reagents($filters) {
        $this->db->select("Creatinine_Reagents name,COUNT(*)y, UPPER(REPLACE(Creatinine_Reagents, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Creatinine_Testing', 'YES');
        $this->db->where_in('Creatinine_Equipment', 'YES');
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
        return $this->get_creatinine_reagents_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_creatinine_reagents_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(Creatinine_Reagents, ' ', '_')) category, County name,COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(Creatinine_Reagents, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Creatinine_Testing', 'YES');
        $this->db->where_in('Creatinine_Equipment', 'YES');
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
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
        $drilldown_data = $this->get_creatinine_reagents_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_creatinine_reagents_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(Creatinine_Reagents, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Creatinine_Reagents, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) drilldown, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Creatinine_Testing', 'YES');
        $this->db->where_in('Creatinine_Equipment', 'YES');
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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
        return $this->get_creatinine_reagents_drilldown_level3($drilldown_data, $filters);
    }

    public function get_creatinine_reagents_drilldown_level3($drilldown_data, $filters){
        $this->db->select("UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Creatinine_Reagents, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) category, facility name, COUNT(*)y, '#dabdab' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Creatinine_Testing', 'YES');
        $this->db->where_in('Creatinine_Equipment', 'YES');
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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


    public function get_access_hep_b_testing($filters) {
        $this->db->select("Hep_B_Testing name,COUNT(*)y, UPPER(REPLACE(Hep_B_Testing, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
        return $this->get_access_hep_b_testing_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_access_hep_b_testing_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(Hep_B_Testing, ' ', '_')) category, County name,COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(Hep_B_Testing, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
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
        $drilldown_data = $this->get_access_hep_b_testing_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_access_hep_b_testing_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(Hep_B_Testing, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Hep_B_Testing, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) drilldown, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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
        return $this->get_access_hep_b_testing_drilldown_level3($drilldown_data, $filters);
    }

    public function get_access_hep_b_testing_drilldown_level3($drilldown_data, $filters){
        $this->db->select("UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Hep_B_Testing, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) category, facility name, COUNT(*)y, '#dabdab' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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

    public function get_offsite_onsite_hep_b_testing($filters) {
        $this->db->select("`Hep-B On/Off Site` name,COUNT(*)y, UPPER(REPLACE(`Hep-B On/Off Site`, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_B_Testing', 'YES');
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
        return $this->get_offsite_onsite_hep_b_testing_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_offsite_onsite_hep_b_testing_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(`Hep-B On/Off Site`, ' ', '_')) category, County name,COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(`Hep-B On/Off Site`, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_B_Testing', 'YES');
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
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
        $drilldown_data = $this->get_offsite_onsite_hep_b_testing_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_offsite_onsite_hep_b_testing_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(`Hep-B On/Off Site`, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(`Hep-B On/Off Site`, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) drilldown, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_B_Testing', 'YES');
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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
        return $this->get_offsite_onsite_hep_b_testing_drilldown_level3($drilldown_data, $filters);
    }

    public function get_offsite_onsite_hep_b_testing_drilldown_level3($drilldown_data, $filters){
        $this->db->select("UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(`Hep-B On/Off Site`, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) category, facility name, COUNT(*)y, '#dabdab' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_B_Testing', 'YES');
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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

    public function get_hep_b_testing_equipment($filters) {
        $this->db->select("Hep_B_Equipment name,COUNT(*)y, UPPER(REPLACE(Hep_B_Equipment, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_B_Testing', 'YES');
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
        return $this->get_hep_b_testing_equipment_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_hep_b_testing_equipment_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(Hep_B_Equipment, ' ', '_')) category, County name,COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(Hep_B_Equipment, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_B_Testing', 'YES');
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
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
        $drilldown_data = $this->get_hep_b_testing_equipment_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_hep_b_testing_equipment_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(Hep_B_Equipment, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Hep_B_Equipment, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) drilldown, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_B_Testing', 'YES');
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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
        return $this->get_hep_b_testing_equipment_drilldown_level3($drilldown_data, $filters);
    }

    public function get_hep_b_testing_equipment_drilldown_level3($drilldown_data, $filters){
        $this->db->select("UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Hep_B_Equipment, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) category, facility name, COUNT(*)y, '#dabdab' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_B_Testing', 'YES');
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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

    public function get_hep_b_reagents($filters) {
        $this->db->select("`Hep-B Reagents` name,COUNT(*)y, UPPER(REPLACE(`Hep-B Reagents`, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_B_Testing', 'YES');
        $this->db->where_in('Hep_B_Equipment', 'YES');
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
        return $this->get_hep_b_reagents_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_hep_b_reagents_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(`Hep-B Reagents`, ' ', '_')) category, County name,COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(`Hep-B Reagents`, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_B_Testing', 'YES');
        $this->db->where_in('Hep_B_Equipment', 'YES');
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
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
        $drilldown_data = $this->get_hep_b_reagents_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_hep_b_reagents_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(`Hep-B Reagents`, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(`Hep-B Reagents`, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) drilldown, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_B_Testing', 'YES');
        $this->db->where_in('Hep_B_Equipment', 'YES');
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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
        return $this->get_hep_b_reagents_drilldown_level3($drilldown_data, $filters);
    }

    public function get_hep_b_reagents_drilldown_level3($drilldown_data, $filters){
        $this->db->select("UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(`Hep-B Reagents`, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) category, facility name, COUNT(*)y, '#dabdab' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_B_Testing', 'YES');
        $this->db->where_in('Hep_B_Equipment', 'YES');
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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

    public function get_access_hep_c_testing($filters) {
        $this->db->select("Hep_C_Testing name,COUNT(*)y, UPPER(REPLACE(Hep_C_Testing, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
        return $this->get_access_hep_c_testing_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_access_hep_c_testing_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(Hep_C_Testing, ' ', '_')) category, County name,COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(Hep_C_Testing, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
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
        $drilldown_data = $this->get_access_hep_c_testing_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_access_hep_c_testing_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(Hep_C_Testing, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Hep_C_Testing, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) drilldown, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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
        return $this->get_access_hep_c_testing_drilldown_level3($drilldown_data, $filters);
    }


    public function get_access_hep_c_testing_drilldown_level3($drilldown_data, $filters){
        $this->db->select("UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Hep_C_Testing, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) category, facility name, COUNT(*)y, '#dabdab' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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


    public function get_offsite_onsite_hep_c_testing($filters) {
        $this->db->select("`Hep-C On/Off Site` name,COUNT(*)y, UPPER(REPLACE(`Hep-C On/Off Site`, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_C_Testing', 'YES');
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
        return $this->get_offsite_onsite_hep_c_testing_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_offsite_onsite_hep_c_testing_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(`Hep-C On/Off Site`, ' ', '_')) category, County name,COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(`Hep-C On/Off Site`, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_C_Testing', 'YES');
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
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
        $drilldown_data = $this->get_offsite_onsite_hep_c_testing_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_offsite_onsite_hep_c_testing_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(`Hep-C On/Off Site`, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(`Hep-C On/Off Site`, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) drilldown, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_C_Testing', 'YES');
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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
        return $this->get_offsite_onsite_hep_c_testing_drilldown_level3($drilldown_data, $filters);
    }

    public function get_offsite_onsite_hep_c_testing_drilldown_level3($drilldown_data, $filters){
        $this->db->select("UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(`Hep-C On/Off Site`, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) category, facility name, COUNT(*)y, '#dabdab' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_C_Testing', 'YES');
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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

    public function get_hep_c_testing_equipment($filters) {
        $this->db->select("Hep_C_Equipment name,COUNT(*)y, UPPER(REPLACE(Hep_C_Equipment, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_C_Testing', 'YES');
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
        return $this->get_hep_c_testing_equipment_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_hep_c_testing_equipment_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(Hep_C_Equipment, ' ', '_')) category, County name,COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(Hep_C_Equipment, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_C_Testing', 'YES');
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
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
        $drilldown_data = $this->get_hep_c_testing_equipment_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_hep_c_testing_equipment_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(Hep_C_Equipment, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Hep_C_Equipment, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) drilldown, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_C_Testing', 'YES');
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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
        return $this->get_hep_c_testing_equipment_drilldown_level3($drilldown_data, $filters);
    }

    public function get_hep_c_testing_equipment_drilldown_level3($drilldown_data, $filters){
        $this->db->select("UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(Hep_C_Equipment, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) category, facility name, COUNT(*)y, '#dabdab' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_C_Testing', 'YES');
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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

    public function get_hep_c_reagents($filters) {
        $this->db->select("`Hep-C Reagents` name,COUNT(*)y, UPPER(REPLACE(`Hep-C Reagents`, ' ', '_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_C_Testing', 'YES');
        $this->db->where_in('Hep_C_Equipment', 'YES');
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
        return $this->get_hep_c_reagents_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_hep_c_reagents_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(`Hep-C Reagents`, ' ', '_')) category, County name,COUNT(*)y, UPPER(CONCAT_WS('_', REPLACE(`Hep-C Reagents`, ' ', '_'), REPLACE(County, ' ', '_'))) drilldown, '#7798BF' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_C_Testing', 'YES');
        $this->db->where_in('Hep_C_Equipment', 'YES');
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
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
        $drilldown_data = $this->get_hep_c_reagents_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_hep_c_reagents_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(CONCAT_WS('_', REPLACE(`Hep-C Reagents`, ' ', '_'), REPLACE(County, ' ', '_'))) category, Sub_County name, COUNT(*)y, UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(`Hep-C Reagents`, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) drilldown, '#90ee7e' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_C_Testing', 'YES');
        $this->db->where_in('Hep_C_Equipment', 'YES');
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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
        return $this->get_hep_c_reagents_drilldown_level3($drilldown_data, $filters);
    }

    public function get_hep_c_reagents_drilldown_level3($drilldown_data, $filters){
        $this->db->select("UPPER(CONCAT_WS('_', CONCAT_WS('_', REPLACE(`Hep-C Reagents`, ' ', '_'), REPLACE(County, ' ', '_')), REPLACE(Sub_County, ' ', '_'))) category, facility name, COUNT(*)y, '#dabdab' color", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->where_in('Hep_C_Testing', 'YES');
        $this->db->where_in('Hep_C_Equipment', 'YES');
        $this->db->group_by('category, name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_laboratory_service');
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