<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of User
 *
 * @author kariukye
 */
class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->model('User_options_model');
    }

    public function user_list() {
        $list = $this->user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $no++;
            $row = array();
            $row[] = $user->first_name;
            $row[] = $user->last_name;
            $row[] = $user->email;
            $row[] = $user->role;
            $row[] = $user->mobile;
            $row[] = '<a class="btn btn-sm btn-default" href="javascript:void(0)" title="Edit" onclick="edit_user(' . "'" . $user->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-default" href="javascript:void(0)" title="Delete" onclick="delete_user(' . "'" . $user->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->user->count_all(),
            "recordsFiltered" => $this->user->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function user_edit($id) {
        $data = $this->user->get_by_id($id);
        echo json_encode($data);
    }

    public function profile($id){
        if($id == $this->session->userdata('id')){
            $data['user'] = $this->user->get_by_id($id);
            $data['counties'] = $this->User_options_model->getCounties();
            $data['scopes'] = $this->User_options_model->getScopes();
            $data['roles'] = $this->User_options_model->getRoles();
            $data['page_title'] = 'PrEP | User';
            $data['content_view'] = 'pages/auth/user_profile_view';
            $this->load->view('template/template_view_alt', $data);
        }
        else{
           $data['heading'] = 'Unauthorized Access';
           $data['message'] = 'You need to be logged in as current user.';
           $this->load->view('errors/html/error_general', $data);
        }
    }

    public function user_add() {
        $this->_validate();
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'emal' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'roleId' => $this->input->post('roleId'),
            'createdDtm' => date('Y-m-d H:i:s'),
            'updatedDtm' => date('Y-m-d H:i:s')
        );
        $insert = $this->user->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function authorize(){
       $status = $this->uri->segment(4);
       $user_id = $this->uri->segment(5);
       $auth_token = $this->uri->segment(6);

       //Get token stored in db
       $user = $this->user->get_by_id($user_id);
       $db_auth_token = $user->auth_token;
       $db_auth_status = $user->is_authorized;
       $name = $user->first_name.' '.$user->last_name;
       $email = $user->email;

        //Update Data
        $update_data= array('is_authorized'=>$status);

       //Compare token in db and returned by email link
       if($db_auth_status == '0'){
            if($db_auth_token){
                if($auth_token == $db_auth_token){
                    if($status == 1){
                        $this->user->update(array('id'=>$user_id), $update_data);
                        $this->session->set_flashdata('success_msg', $name.' authorized');
                        $this->load->view('Manager/pages/auth/login_view');
                    }
                    else{
                        $this->session->set_flashdata('error_msg', $name.' denied access');
                        $this->load->view('Manager/pages/auth/login_view');
                        $this->sendEmailToUser($email);
                    }
                    
                }
                else{

                }
            }   
       }else{
            $this->session->set_flashdata('error_msg', $name.'already authorized');
            $this->load->view('Manager/pages/auth/login_view');
       }


    }

    public function sendEmailToUser($email){

               //Email Details
               $subject =  'PrEP Assessment Tool Access';
               $message =  'PrEP Assessment Tool Access is pending authorization. Please reply to this email to enquire more';
         
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
               $this->email->from('ndethiw@gmail.com');
               $this->email->to($email);
       
       
               $this->email->subject($subject);
               $this->email->message($message);

               $this->email->send();
    }

    public function user_update() {
        $this->_validate();
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'mobile' => $this->input->post('mobile'),
            'password' => md5($this->input->post('password')),
            'roleId' => $this->input->post('roleId'),
            'createdDtm' => date('Y-m-d H:i:s'),
            'updatedDtm' => date('Y-m-d H:i:s')
        );
        $this->user->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function user_delete($id) {
        $this->user->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('first_name') == '') {
            $data['inputerror'][] = 'first_name';
            $data['error_string'][] = 'First Name is required';
            $data['status'] = FALSE;
        }


        if ($this->input->post('last_name') == '') {
            $data['inputerror'][] = 'last_name';
            $data['error_string'][] = 'Last Name is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('email') == '') {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('roleId') == '') {
            $data['inputerror'][] = 'roleId';
            $data['error_string'][] = 'Role type is required';
            $data['status'] = FALSE;
        }


        if ($this->input->post('mobile') == '') {
            $data['inputerror'][] = 'mobile';
            $data['error_string'][] = 'Mobile is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}
