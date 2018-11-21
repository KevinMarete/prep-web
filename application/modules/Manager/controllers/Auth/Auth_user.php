<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_user extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('Auth/Auth_user_model');
    }

    public function index() {
        //generate auth token for admin authorization callback
        $auth_token = md5(date('ymd H:i:s').$this->input->post('last_name'));

        //register user details
        $user = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('user_email'),
            'mobile' => $this->input->post('user_mobile'),
            'organization' => $this->input->post('user_org'),
            'scope' => $this->input->post('user_scope'),
            'county' => $this->input->post('user_county'),
            'subcounty' => $this->input->post('user_subcounty'),
            'password' => md5($this->input->post('user_password')),
            'auth_token' => $auth_token,
            'roleId' => $this->input->post('roleId'),
            'createdDtm' => date('Y-m-d H:i:s'),
            'updatedDtm' => date('Y-m-d H:i:s')
        );

        $email_check = $this->Auth_user_model->email_check($user['email']);
        //check if email is already registered, if not register user
        if ($email_check == TRUE) {
            $this->Auth_user_model->register_user($user);
                        
            //Get user data and send to admin                      
            $user_data = $this->Auth_user_model->getRegisteredUser($user['email']);
            
            $this->sendEmailToAdmin($user_data[0]['id'],$user['first_name'], $user['last_name'],$user_data, $auth_token);

            //Reload Page
            $this->session->set_flashdata('success_msg', 'Registration Successfully.Now login to your account.');
            $this->load->view('Manager/pages/auth/login_view');


        }
        //If email already registered echo this error and redirect registration_view
        else {

            $this->session->set_flashdata('error_msg', 'Email already registered');
            $this->load->view('Manager/pages/auth/registration_view');
        }
    }

   function sendEmailToAdmin($user_id,$fname, $lname, $data, $auth_token){
       

        //User Details: Email and Name
        $email = $this->input->post('email');

        //Email Details
        $subject =  $fname.' '.$lname. ' is requesting Access to the PrEP Assessment Tool.';
        $message =  $this->formatAuthEmail($data, $auth_token,$user_id);
  
        $this->load->library('email');
        $this->load->library('encrypt');

        //Set config
        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = 'wndethi@gmail.com';
        $config['smtp_pass'] = '2schw8yz';
        $config['mailtype'] = 'html';
        $config['charset']  = 'utf-8';

        //Init Config
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //Send Email
        $this->email->from('wndethiw@gmail.com');
        $this->email->to('kmarete@clintonhealthaccess.org');


        $this->email->subject($subject);
        $this->email->message($message);

        $this->email->send();

      }

      public function formatAuthEmail($data,$auth_token,$user_id){
        $messageArray = [];

        foreach($data[0] as $k=>$v){
           array_push($messageArray, $v);
        }

        $formattedMessage = implode('</tr><tr>', $messageArray);
        
        $button ='<p><a href='.base_url('/manager/user/authorize/1/'.$user_id.'/'.$auth_token).'><button>Grant</button></a>&nbsp;|&nbsp;<a href='.base_url('/manager/user/authorize/0/'.$user_id.'/'.$auth_token).'><button>Deny</button></a></p>';
    
        return $formattedMessage.$button;
    }


}
