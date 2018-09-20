<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Home extends MX_Controller {

    public function index() {
        $this->load->helper('directory');
        $this->load->helper('file');
        $data['page_title'] = 'PrEP | Home';
        $data['gallery_dir'] = directory_map('./public/home/resources/gallery');
        $data['guidelines_dir'] = directory_map('./public/home/resources/guidelines');
        $data['publications_dir'] = directory_map('./public/home/resources/publications');
        $this->load->view('template/template_view', $data);
    }

    public function get_chart() {
        $chartname = $this->input->post('name');
        $selectedfilters = $this->get_filter($chartname, $this->input->post('selectedfilters'));
        //Get chart configuration
        $data['chart_name'] = $chartname;
        $data['chart_title'] = $this->config->item($chartname . '_title');
        $data['chart_yaxis_title'] = $this->config->item($chartname . '_yaxis_title');
        $data['chart_xaxis_title'] = $this->config->item($chartname . '_xaxis_title');
        $data['chart_source'] = $this->config->item($chartname . '_source');
        //Get data
        $main_data = array('main' => array(), 'drilldown' => array(), 'columns' => array());
        $main_data = $this->get_data($chartname, $selectedfilters);
        if ($this->config->item($chartname . '_has_drilldown')) {
            $data['chart_drilldown_data'] = json_encode(@$main_data['drilldown'], JSON_NUMERIC_CHECK);
        } else {
            $data['chart_categories'] = json_encode(@$main_data['columns'], JSON_NUMERIC_CHECK);
        }
        $data['selectedfilters'] = htmlspecialchars(json_encode($selectedfilters), ENT_QUOTES, 'UTF-8');
        $data['chart_series_data'] = json_encode($main_data['main'], JSON_NUMERIC_CHECK);
        //Load chart
        $this->load->view($this->config->item($chartname . '_chartview'), $data);
    }

    public function get_filter($chartname, $selectedfilters) {
        $filters = $this->config->item($chartname . '_filters_default');
        $filtersColumns = $this->config->item($chartname . '_filters');

        if (!empty($selectedfilters)) {
            foreach (array_keys($selectedfilters) as $filter) {
                if (in_array($filter, $filtersColumns)) {
                    $filters[$filter] = $selectedfilters[$filter];
                }
            }
        }
        return $filters;
    }



    public function get_data($chartname, $filters) {
        if ($chartname == 'facility_count_distribution_chart') {
            $main_data = $this->home_model->get_facility_count($filters);
        }
        return $main_data;
    }

    public function sendEmailFromHome(){


        //User Details: Email and Name
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        //Email Details
        $subject =  $this->input->post('subject');
        $message =  $this->input->post('message');


        $this->load->library('email');

        //Set config
        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = $email;
        $config['smtp_pass'] = $password;

        //Init Config
        $this->email->initialize($config);


        //Send Email
        $this->email->from($email, $name);
        $this->email->to('ulizanascop@gmail.com');


        $this->email->subject($subject);
        $this->email->message($message);

          if($this->email->send()){
            $data['message_display'] = 'Email Sent !';
          } else {
            $data['message_display'] =  '<p class="error_msg">Invalid Gmail Account or Password !</p>';
          }
      }


}
