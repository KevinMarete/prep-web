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
    var $list_answer_type_lists = 'tbl_survey_lists';


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

    //get answertypes
    public function getAnswerTypes(){    
        $this->db->from($this->answer_types_table);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //get lists for list answertype
    public function getAllLists(){    
        $this->db->from($this->list_answer_type_lists);
        $query = $this->db->get();
        return $query->result_array();
    }

}
