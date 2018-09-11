<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Manager extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    //function login view
    public function index() {
        $this->load->view('pages/auth/login_view');
    }

    //function dashboardview
    public function home() {
        $this->isLoggedIn();
        redirect('dashboard');
        $data['page_title'] = 'prep';
        $this->load->view('template/template_view', $data);
    }

    //function register user
    public function register() {
        $this->load->view('pages/auth/registration_view');
    }

    public function file_upload() {
        $this->isLoggedIn();
        $data['page_title'] = 'prep | Doc';
        $data['content_view'] = 'pages/file_upload_view';
        $this->load->view('template/template_view', $data);
    }

    public function manage_users() {
        $this->isLoggedIn();
        $data['page_title'] = 'prep | User';
        $data['content_view'] = 'pages/user_view';
        $this->load->view('template/template_view', $data);
    }

    public function facility() {
        $this->isLoggedIn();
        $data['page_title'] = 'prep | Facility';
        $data['content_view'] = 'pages/facility_view';
        $this->load->view('template/template_view', $data);
    }

}
