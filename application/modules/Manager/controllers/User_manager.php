<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of User_manager
 *
 * @author kariukye
 */
class User_manager extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_manager_model', 'user');
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
				  <a class="btn btn-sm btn-default" href="javascript:void(0)" title="Hapus" onclick="delete_user(' . "'" . $user->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

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

    public function user_add() {
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
        $insert = $this->user->save($data);
        echo json_encode(array("status" => TRUE));
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
