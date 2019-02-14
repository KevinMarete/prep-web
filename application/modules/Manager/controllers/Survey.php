<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Facility
 *
 * @author ndethi
 */
class Survey extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Survey_model', 'survey');
    }


     //Survey index page
     public function index() {
        $data['page_title'] = 'Prep Surveys';
        $data['page_name'] = 'PrEPSurveysMain';
        $data['content_view'] =  'pages/survey/survey_view';
        $this->load->view('template/template_view_alt', $data);
    }

    //Survey admin page
    public function admin() {
        $data['page_title'] = 'Prep Survey Admin';
        $data['page_name'] = 'PrEPSurveysAdmin';
        $data['content_view'] =  'pages/survey/survey_admin_view';
        $this->load->view('template/template_view_alt', $data);
    }

    //Get all surveys
    public function surveys_list(){

        //Get all surveys
        $surveys = $this->survey->getAllSurveys();

        if($surveys){
            echo json_encode($surveys);
        }else{
            echo '[]'; 
        }
    }

    //Add Survey
    public function addSurvey(){
        //Get title and description of survey
        $survey_title = $this->input->post('survey_title');
        $survey_description = $this->input->post('survey_description');
        
        //Insert array
        $insert_array = array(
            'survey_title'=> $survey_title,
            'survey_description' => $survey_description
        );

        //Insert into db
        $this->db->insert('tbl_surveys', $insert_array);

        //Check if insert was successful or not
        if ($this->db->affected_rows() > 0) {
            echo json_encode(array('status'=>'success','message'=>'Survey added successfully.'));
        }else{
            echo json_encode(array('status'=>'danger','message'=>'Survey not added.'));
        }

    
    }

    //Edit Survey
    public function editSurvey($survey_id){

        //Define survey edit page
        $data['survey'] = $survey = $this->survey->getSurvey($survey_id);
        $data['answerTypes'] = $this->survey->getAnswerTypes();
        $data['page_title'] = 'Edit Survey '.$survey[0]['survey_title'];
        $data['page_name'] = 'Edit_'.$survey[0]['survey_title'];
        $data['content_view'] =  'pages/survey/survey_edit_view';
        $this->load->view('template/template_view_alt', $data);
    }

    //Update Survey
    public function updateSurvey($survey_id){

        //Get title and description of survey
        $survey_title = $this->input->post('survey_title');
        $survey_description = $this->input->post('survey_description');

        //Insert array
        $update_array = array(
            'survey_title'=> $survey_title,
            'survey_description' => $survey_description
        );

        //Update db
        $this->db->where('id', $survey_id);
        $this->db->update('tbl_surveys', $update_array);

        //Check if update successful
        if($this->db->affected_rows()>0){
            echo json_encode(array('status'=>'success','message'=>'Survey edit saved.'));
        }else{
            echo json_encode(array('status'=>'warning','message'=>'No edits to save.'));
        }
    }


}
