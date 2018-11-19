<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';



class Manager extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_options_model');
    }

    //function login view
    public function index() {
        $this->load->view('pages/auth/login_view');
    }

    //function dashboardview
    public function home() {
        $this->isLoggedIn();
        redirect('dashboard');
        $data['page_title'] = 'PrEP';
        $this->load->view('template/template_view', $data);
    }

    //function register user
    public function register() {
        //Get user role, location options
        $data['counties'] = $this->User_options_model->getCounties();
        $data['scopes'] = $this->User_options_model->getScopes();
        $data['roles'] = $this->User_options_model->getRoles();
        $data['organizations'] = $this->User_options_model->getOrganizations();
        
        //Load registration view
        $this->load->view('pages/auth/registration_view', $data);
    }

    //get subcounties
    public function getSubCounties($county){
        return $this->User_options_model->getSubCounties($county);
    }

    public function file_upload() {
        $this->isLoggedIn();
        $data['page_title'] = 'PrEP | Doc';
        $data['content_view'] = 'pages/file_upload_view';
        $this->load->view('template/template_view', $data);
    }

    public function manage_users() {
        $this->isLoggedIn();
        $data['page_title'] = 'PrEP | User';
        $data['content_view'] = 'pages/user_view';
        $this->load->view('template/template_view', $data);
    }

    public function facility() {
        $this->isLoggedIn();
        $data['page_title'] = 'PrEP | Facility';
        $data['content_view'] = 'pages/facility_view';
        $this->load->view('template/template_view', $data);
    }

}
