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

    public function get_access_creatinine_testing_availability($filters) {
        $columns = array();
        $creatinine_testing_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(Creatinine_Testing='YES', 1, NULL)) YES, COUNT(IF(Creatinine_Testing = 'NO', 1, NULL)) NO", FALSE);
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
                foreach ($creatinine_testing_data as $index => $creatinine_testing) {
                    if ($creatinine_testing['name'] == 'YES') {
                        array_push($creatinine_testing_data[$index]['data'], $result['YES']);
                    } else if ($creatinine_testing['name'] == 'NO') {
                        array_push($creatinine_testing_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $creatinine_testing_data, 'columns' => $columns);
    }

    public function get_creatinine_testing_equipment_availability($filters) {
        $columns = array();
        $creatinine_testing_equipment_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(Creatinine_Equipment='YES', 1, NULL)) YES, COUNT(IF(Creatinine_Equipment = 'NO', 1, NULL)) NO", FALSE);
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
                foreach ($creatinine_testing_equipment_data as $index => $creatinine_testing_equipment) {
                    if ($creatinine_testing_equipment['name'] == 'YES') {
                        array_push($creatinine_testing_equipment_data[$index]['data'], $result['YES']);
                    } else if ($creatinine_testing_equipment['name'] == 'NO') {
                        array_push($creatinine_testing_equipment_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $creatinine_testing_equipment_data, 'columns' => $columns);
    }

    public function get_offsite_onsite_creatinine_testing($filters) {
        $columns = array();
        $offsite_onsite_data = array(
            array('type' => 'column', 'name' => 'Off - Site', 'data' => array()),
            array('type' => 'column', 'name' => 'On - Site', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(`Creatinine On/Off Site`='On - Site', 1, NULL)) 'On - Site', COUNT(IF(`Creatinine On/Off Site` = 'Off - Site', 1, NULL)) 'Off - Site'", FALSE);
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
                foreach ($offsite_onsite_data as $index => $offsite_onsite) {
                    if ($offsite_onsite['name'] == 'On - Site') {
                        array_push($offsite_onsite_data[$index]['data'], $result['On - Site']);
                    } else if ($offsite_onsite['name'] == 'Off - Site') {
                        array_push($offsite_onsite_data[$index]['data'], $result['Off - Site']);
                    }
                }
            }
        }
        return array('main' => $offsite_onsite_data, 'columns' => $columns);
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

    public function get_access_hep_b_testing_facilities($filters) {
        $columns = array();
        $hep_b_testing_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(Hep_B_Testing='YES', 1, NULL)) YES, COUNT(IF(Hep_B_Testing = 'NO', 1, NULL)) NO", FALSE);
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
                foreach ($hep_b_testing_data as $index => $hep_b_testing) {
                    if ($hep_b_testing['name'] == 'YES') {
                        array_push($hep_b_testing_data[$index]['data'], $result['YES']);
                    } else if ($hep_b_testing['name'] == 'NO') {
                        array_push($hep_b_testing_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $hep_b_testing_data, 'columns' => $columns);
    }

    public function get_hep_b_testing_equipment_availability($filters) {
        $columns = array();
        $hep_b_testing_equipment_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(Hep_B_Equipment='YES', 1, NULL)) YES, COUNT(IF(Hep_B_Equipment = 'NO', 1, NULL)) NO", FALSE);
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
                foreach ($hep_b_testing_equipment_data as $index => $hep_b_testing_equipment) {
                    if ($hep_b_testing_equipment['name'] == 'YES') {
                        array_push($hep_b_testing_equipment_data[$index]['data'], $result['YES']);
                    } else if ($hep_b_testing_equipment['name'] == 'NO') {
                        array_push($hep_b_testing_equipment_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $hep_b_testing_equipment_data, 'columns' => $columns);
    }

    public function get_offsite_onsite_hep_b_testing($filters) {
        $columns = array();
        $hep_b_offsite_onsite_data = array(
            array('type' => 'column', 'name' => 'Off - Site', 'data' => array()),
            array('type' => 'column', 'name' => 'On - Site', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(`Hep-B On/Off Site`='On - Site', 1, NULL)) 'On - Site', COUNT(IF(`Hep-B On/Off Site` = 'Off - Site', 1, NULL)) 'Off - Site'", FALSE);
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
                foreach ($hep_b_offsite_onsite_data as $index => $hep_b_offsite_onsite) {
                    if ($hep_b_offsite_onsite['name'] == 'On - Site') {
                        array_push($hep_b_offsite_onsite_data[$index]['data'], $result['On - Site']);
                    } else if ($hep_b_offsite_onsite['name'] == 'Off - Site') {
                        array_push($hep_b_offsite_onsite_data[$index]['data'], $result['Off - Site']);
                    }
                }
            }
        }
        return array('main' => $hep_b_offsite_onsite_data, 'columns' => $columns);
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

    public function get_access_hep_c_testing_facilities($filters) {
        $columns = array();
        $hep_c_testing_equipment_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(Hep_C_Testing='YES', 1, NULL)) YES, COUNT(IF(Hep_C_Testing = 'NO', 1, NULL)) NO", FALSE);
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
                foreach ($hep_c_testing_equipment_data as $index => $hep_c_testing_equipment) {
                    if ($hep_c_testing_equipment['name'] == 'YES') {
                        array_push($hep_c_testing_equipment_data[$index]['data'], $result['YES']);
                    } else if ($hep_c_testing_equipment['name'] == 'NO') {
                        array_push($hep_c_testing_equipment_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $hep_c_testing_equipment_data, 'columns' => $columns);
    }

    public function get_hep_c_testing_equipment_availability($filters) {
        $columns = array();
        $hep_c_testing_equipment_data = array(
            array('type' => 'column', 'name' => 'NO', 'data' => array()),
            array('type' => 'column', 'name' => 'YES', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(Hep_C_Equipment='YES', 1, NULL)) YES, COUNT(IF(Hep_C_Equipment = 'NO', 1, NULL)) NO", FALSE);
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
                foreach ($hep_c_testing_equipment_data as $index => $hep_c_testing_equipment) {
                    if ($hep_c_testing_equipment['name'] == 'YES') {
                        array_push($hep_c_testing_equipment_data[$index]['data'], $result['YES']);
                    } else if ($hep_c_testing_equipment['name'] == 'NO') {
                        array_push($hep_c_testing_equipment_data[$index]['data'], $result['NO']);
                    }
                }
            }
        }
        return array('main' => $hep_c_testing_equipment_data, 'columns' => $columns);
    }

    public function get_offsite_onsite_hep_c_testing($filters) {
        $columns = array();
        $hep_c_offsite_onsite_data = array(
            array('type' => 'column', 'name' => 'Off - Site', 'data' => array()),
            array('type' => 'column', 'name' => 'On - Site', 'data' => array())
        );

        $this->db->select("UPPER(County) county, COUNT(IF(`Hep-C On/Off Site`='On - Site', 1, NULL)) 'On - Site', COUNT(IF(`Hep-C On/Off Site` = 'Off - Site', 1, NULL)) 'Off - Site'", FALSE);
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
                foreach ($hep_c_offsite_onsite_data as $index => $hep_c_offsite_onsite) {
                    if ($hep_c_offsite_onsite['name'] == 'On - Site') {
                        array_push($hep_c_offsite_onsite_data[$index]['data'], $result['On - Site']);
                    } else if ($hep_c_offsite_onsite['name'] == 'Off - Site') {
                        array_push($hep_c_offsite_onsite_data[$index]['data'], $result['Off - Site']);
                    }
                }
            }
        }
        return array('main' => $hep_c_offsite_onsite_data, 'columns' => $columns);
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

}
