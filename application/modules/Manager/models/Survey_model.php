<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of User_model
 *
 * @author ndethi
 */
class Survey_model extends CI_Model {

    var $survey_table = 'tbl_surveys';
    var $answer_types_table ='tbl_survey_answer_types';
    var $answers_table = 'tbl_survey_answers';
    var $choices_table = 'tbl_survey_choices';
    var $questions_table = 'tbl_survey_questions';
    var $question_types_table = 'tbl_survey_question_types';


    //get all surveys
    public function getAllSurveys(){
        $this->db->from($this->survey_table);
        $query = $this->db->get();
        return $query->result_array();
    }

    //get single survey
    public function getSurvey($survey_id){
        $this->db->from($this->survey_table);
        $this->db->where('id', $survey_id);
        $query = $this->db->get();
        return $query->result_array();
    }

        //get single survey
    public function getAnswerTypes(){    
        $this->db->from($this->answer_types_table);
        $query = $this->db->get();
        return $query->result_array();
    }
    


}
