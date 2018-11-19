<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model for user registration options
 * County, subcounty user is from
 * Scope, Role, Org user 
 * @author 
 */
class User_options_model extends CI_Model {

    public function getCounties(){
        $counties = $this->db->get('tbl_county');
        return $counties->result();
    }

    public function getSubCounties($county){
        $subCounties = $this->db->where('county_id', $county)->get('tbl_subcounty');
        echo json_encode($subCounties->result_array());
    }

    public function getScopes(){
        $scope = $this->db->get('auth_tbl_scope');
        return $scope->result();
    }

    public function getRoles(){
        $roles = $this->db->get('auth_tbl_roles');
        return $roles->result();
    }

    public function getOrganizations(){
        $org = $this->db->get('auth_tbl_organizations');
        return $org->result();
    }
}
