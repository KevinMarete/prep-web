<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BaseController extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    protected $roleId = '';
    protected $id = '';
    protected $mobile = '';
    protected $last_name = '';
    protected $first_name = '';

    //Takes mixed data and optionally a status code, then creates the response
    public function response($data = NULL) {
        $this->output->set_status_header(200)->set_content_type('application/json', 'utf-8')->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))->_display();
        exit();
    }

    //check the user is logged in or not
    function isLoggedIn() {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            redirect('manager/login');
        } else {
            $this->roleId = $this->session->userdata('roleId');
            $this->id = $this->session->userdata('id');
            $this->mobile = $this->session->userdata('mobile');
            $this->last_name = $this->session->userdata('last_name');
            $this->first_name = $this->session->userdata('first_name');
        }
    }

    //check the access
    function isNormalUser() {
        if ($this->role != ROLE_NORMAL_USER) {
            return true;
        } else {
            return false;
        }
    }

    //check the access
    function isTicketter() {
        if ($this->role != ROLE_NORMAL_USER || $this->role != ROLE_MANAGER) {
            return true;
        } else {
            return false;
        }
    }

    //log out user from system
    function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

}
