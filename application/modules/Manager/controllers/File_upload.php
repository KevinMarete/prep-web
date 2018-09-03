<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class File_upload extends BaseController {

    function index() {
        $this->isLoggedIn();
        $data['page_title'] = 'prep | Doc';
        $this->load->view('template/file_upload', $data);
    }

}
