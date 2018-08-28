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
        //$data['content_view'] = 'pages/dashboard_view';
        $data['page_title'] = 'prep';
        $this->load->view('template/template_view', $data);
    }

    //function register user
    public function register() {
        $this->load->view('pages/auth/registration_view');
    }

}
