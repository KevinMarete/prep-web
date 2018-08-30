<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Ftp extends BaseController {

    function index() {
        $this->isLoggedIn();
        $this->load->view('template/elfinder');
    }

}
