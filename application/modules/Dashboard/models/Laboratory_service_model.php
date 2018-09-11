<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Laboratory_service_model
 *
 * @author k
 */
class Laboratory_service_model extends CI_Model {

    public function get_overall_access_baseline_laboratory_tests($filters) {
        $columns = array();
        $response = array();

        $this->db->select("COUNT(IF(Creatinine_Testing='YES',1,NULL))/COUNT(*)*100 Creatinine, COUNT(IF(Hep_B_Testing='YES',1,NULL))/COUNT(*)*100 'Hep B', COUNT(IF(Hep_C_Testing='YES',1,NULL))/COUNT(*)*100 'Hep C'", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $query = $this->db->get('tbl_laboratory_service');
        $result = $query->row_array();

        //add columns
        $columns = array_keys($result);

        //add data to response
        foreach ($columns as $column) {
            array_push($response, array('name' => $column, 'y' => $result[$column]));
        }
        return array('main' => $response, 'columns' => $columns);
    }

    public function get_overall_laboratory_testing_equipment_availability($filters) {
        $columns = array();
        $response = array();

        $this->db->select("COUNT(IF(Creatinine_Equipment='YES',1,NULL))/COUNT(*)*100 Creatinine, COUNT(IF(Hep_B_Equipment='YES',1,NULL))/COUNT(*)*100 'Hep B', COUNT(IF(Hep_C_Equipment='YES',1,NULL))/COUNT(*)*100 'Hep C'", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $query = $this->db->get('tbl_laboratory_service');
        $result = $query->row_array();

        //add columns
        $columns = array_keys($result);

        //add data to response
        foreach ($columns as $column) {
            array_push($response, array('name' => $column, 'y' => $result[$column]));
        }
        return array('main' => $response, 'columns' => $columns);
    }

    public function get_overall_access_on_offsite_laboratory_testing($filters) {
        $columns = array();
        $response = array();

        $this->db->select("COUNT(IF(`Creatinine On/Off Site`='On - Site',1,NULL))/COUNT(*)*100 Creatinine, COUNT(IF(`Hep-B On/Off Site`='On - Site',1,NULL))/COUNT(*)*100 'Hep B', COUNT(IF(`Hep-C On/Off Site`='On - Site',1,NULL))/COUNT(*)*100 'Hep C'", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $query = $this->db->get('tbl_laboratory_service');
        $result = $query->row_array();

        //add columns
        $columns = array_keys($result);

        //add data to response
        foreach ($columns as $column) {
            array_push($response, array('name' => $column, 'y' => $result[$column]));
        }
        return array('main' => $response, 'columns' => $columns);
    }

    public function get_access_creatinine_testing($filters) {
        $this->db->select("Creatinine_Testing name,COUNT(*)y, UPPER(Creatinine_Testing) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
        //print_r(json_encode($query->result_array()));
        //die();
        return $this->get_access_creatinine_testing_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_access_creatinine_testing_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(Creatinine_Testing) category, County name,COUNT(*)y, UPPER(County) drilldown", FALSE);
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
        $drilldown_data = $this->get_distribution_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_creatinine_testing_equipment($filters) {
        $this->db->select("Creatinine_Equipment name,COUNT(*)y, UPPER(Creatinine_Equipment) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
        return $this->get_creatinine_testing_equipment_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_creatinine_testing_equipment_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(Creatinine_Equipment) category, County name,COUNT(*)y, UPPER(County) drilldown", FALSE);
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
        $drilldown_data = $this->get_distribution_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_offsite_onsite_creatinine_testing($filters) {
        $this->db->select("REPLACE(REPLACE(`Creatinine On/Off Site`,'-','_'),' ','_') name,COUNT(*)y, UPPER(REPLACE(REPLACE(`Creatinine On/Off Site`,'-','_'),' ','_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
        return $this->get_offsite_onsite_creatinine_testing_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_offsite_onsite_creatinine_testing_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(REPLACE(`Creatinine On/Off Site`,'-','_'),' ','_')) category, County name,COUNT(*)y, UPPER(County) drilldown", FALSE);
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
        $drilldown_data = $this->get_distribution_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_access_creatinine_testing_in_relation_to_equipment_availability($filters) {
        $columns = array();
        $creatinine_testing_equipment_relation_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county,COUNT(IF(Creatinine_Equipment='YES', 1, NULL) AND IF(Creatinine_Testing='YES',1,NULL)) YES, COUNT(IF(Creatinine_Equipment = 'NO', 1, NULL) AND IF(Creatinine_Testing='YES',1,NULL)) NO", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('county');
        $query = $this->db->get('tbl_laboratory_service');
        $results = $query->result_array();

        if ($results) {
            foreach ($results as $result) {
                $columns[] = $result['county'];
                foreach ($creatinine_testing_equipment_relation_data as $index => $creatinine_testing_equipment_relation) {
                    if ($creatinine_testing_equipment_relation['name'] == 'YES') {
                        array_push($creatinine_testing_equipment_relation_data[$index]['data'], $result['YES']);
                    } else if ($creatinine_testing_equipment_relation['name'] == 'NO') {
                        array_push($creatinine_testing_equipment_relation_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $creatinine_testing_equipment_relation_data, 'columns' => $columns);
    }

    public function get_access_creatinine_testing_in_relation_to_equipment_availability_numbers($filters) {
        $columns = array();
        $this->db->select("UPPER(Creatinine_Equipment) Creatinine_Equipment,COUNT(IF(Creatinine_Testing='YES',1,NULL)) Numbers", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('Creatinine_Equipment');
        $this->db->order_by('Creatinine_Equipment', 'ASC');
        $query = $this->db->get('tbl_laboratory_service');
        return array('main' => $query->result_array(), 'columns' => $columns);
    }

    public function get_creatinine_availability_reagents_in_relation_to_equipment_numbers($filters) {
        $columns = array();
        $this->db->select("UPPER(Creatinine_Equipment) Creatinine_Reagents,COUNT(IF(Creatinine_Reagents='YES',1,NULL)) Numbers", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('Creatinine_Equipment');
        $this->db->order_by('Creatinine_Equipment', 'ASC');
        $query = $this->db->get('tbl_laboratory_service');
        return array('main' => $query->result_array(), 'columns' => $columns);
    }

    public function get_creatinine_unavailability_reagents_in_relation_to_equipment_numbers($filters) {
        $columns = array();
        $this->db->select("UPPER(Creatinine_Equipment) Creatinine_Reagents,COUNT(IF(Creatinine_Reagents='NO',1,NULL)) Numbers", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('Creatinine_Equipment');
        $this->db->order_by('Creatinine_Equipment', 'ASC');
        $query = $this->db->get('tbl_laboratory_service');
        return array('main' => $query->result_array(), 'columns' => $columns);
    }

    public function get_onsite_offsite_access_to_creatinine_testing_numbers($filters) {
        $columns = array();
        $this->db->select("UPPER(`Creatinine On/Off Site`) creatinine_on_offsite,COUNT(IF(Creatinine_Testing='YES',1,NULL)) Numbers", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('creatinine_on_offsite');
        $this->db->order_by('creatinine_on_offsite', 'ASC');
        $query = $this->db->get('tbl_laboratory_service');
        return array('main' => $query->result_array(), 'columns' => $columns);
    }

    public function get_access_hep_b_testing($filters) {
        $this->db->select("Hep_B_Testing name,COUNT(*)y, UPPER(Hep_B_Testing) drilldown", FALSE);
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
        $this->db->select("UPPER(Hep_B_Testing) category, County name,COUNT(*)y, UPPER(County) drilldown", FALSE);
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
        $drilldown_data = $this->get_distribution_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_hep_b_testing_equipment($filters) {
        $this->db->select("Hep_B_Equipment name,COUNT(*)y, UPPER(Hep_B_Equipment) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
        return $this->get_hep_b_testing_equipment_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_hep_b_testing_equipment_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(Hep_B_Equipment) category, County name,COUNT(*)y, UPPER(County) drilldown", FALSE);
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
        $drilldown_data = $this->get_distribution_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_offsite_onsite_hep_b_testing($filters) {
        $this->db->select("REPLACE(REPLACE(`Hep-B On/Off Site`,'-','_'),' ','_') name,COUNT(*)y, UPPER(REPLACE(REPLACE(`Hep-B On/Off Site`,'-','_'),' ','_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
        return $this->get_offsite_onsite_hep_b_testing_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_offsite_onsite_hep_b_testing_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(REPLACE(`Hep-B On/Off Site`,'-','_'),' ','_')) category, County name,COUNT(*)y, UPPER(County) drilldown", FALSE);
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
        $drilldown_data = $this->get_distribution_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_access_hep_b_testing_numbers($filters) {
        $columns = array();
        $this->db->select("UPPER(Hep_B_Testing) Hep_B_Testing, COUNT(*) Numbers", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('Hep_B_Testing');
        $this->db->order_by('Hep_B_Testing', 'ASC');
        $query = $this->db->get('tbl_laboratory_service');
        return array('main' => $query->result_array(), 'columns' => $columns);
    }

    public function get_offsite_onsite_hep_b_testing_numbers($filters) {
        $columns = array();
        $this->db->select("UPPER(`Hep-B On/Off Site`) Hep_B_on_offsite, COUNT(*) Numbers", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('Hep_B_on_offsite');
        $this->db->order_by('Hep_B_on_offsite', 'ASC');
        $query = $this->db->get('tbl_laboratory_service');
        return array('main' => $query->result_array(), 'columns' => $columns);
    }

    public function get_access_hep_c_testing($filters) {
        $this->db->select("Hep_C_Testing name,COUNT(*)y, UPPER(Hep_C_Testing) drilldown", FALSE);
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
        $this->db->select("UPPER(Hep_C_Testing) category, County name,COUNT(*)y, UPPER(County) drilldown", FALSE);
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
        $drilldown_data = $this->get_distribution_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_hep_c_testing_equipment($filters) {
        $this->db->select("Hep_C_Equipment name,COUNT(*)y, UPPER(Hep_C_Equipment) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
        return $this->get_hep_c_testing_equipment_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_hep_c_testing_equipment_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(Hep_C_Equipment) category, County name,COUNT(*)y, UPPER(County) drilldown", FALSE);
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
        $drilldown_data = $this->get_distribution_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_offsite_onsite_hep_c_testing($filters) {
        $this->db->select("REPLACE(REPLACE(`Hep-C On/Off Site`,'-','_'),' ','_') name,COUNT(*)y, UPPER(REPLACE(REPLACE(`Hep-C On/Off Site`,'-','_'),' ','_')) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_laboratory_service');
        return $this->get_offsite_onsite_hep_c_testing_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_offsite_onsite_hep_c_testing_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(REPLACE(REPLACE(`Hep-C On/Off Site`,'-','_'),' ','_')) category, County name,COUNT(*)y, UPPER(County) drilldown", FALSE);
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
        $drilldown_data = $this->get_distribution_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_access_hep_c_testing_numbers($filters) {
        $columns = array();
        $this->db->select("UPPER(Hep_C_Testing) Hep_C_Testing, COUNT(*) Numbers", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('Hep_C_Testing');
        $this->db->order_by('Hep_C_Testing', 'ASC');
        $query = $this->db->get('tbl_laboratory_service');
        return array('main' => $query->result_array(), 'columns' => $columns);
    }

    public function get_offsite_onsite_hep_c_testing_numbers($filters) {
        $columns = array();
        $this->db->select("UPPER(`Hep-C On/Off Site`) hep_c_on_offsite, COUNT(*) Numbers", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('hep_c_on_offsite');
        $this->db->order_by('hep_c_on_offsite', 'ASC');
        $query = $this->db->get('tbl_laboratory_service');
        return array('main' => $query->result_array(), 'columns' => $columns);
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
        return $drilldown_data;
    }

}
