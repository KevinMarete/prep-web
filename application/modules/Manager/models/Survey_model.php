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

    //save questions
    public function saveQuestion($questions_array, $choices){
        //insert into questions table
        $this->db->insert($this->questions_table, $questions_array);
        
        //get auto increment id
        $question_id = $this->db->insert_id();

        //insert into choices table
        $this->saveChoices($question_id, $choices);

        //check if insert successful
        if($this->db->affected_rows()>0){
            echo json_encode(array('status'=>'success','message'=>'Questions and choices saved successfully.'));
        }else{
            echo json_encode(array('status'=>'danger','message'=>'Error saving questions/choices.'));
        }
    
    }

    //save choices
    public function saveChoices($question_id, $choices){

        $i=1;

        foreach($choices as $choice){
            $choices_array = array('question_id'=> $question_id , 'choice_text'=> $choice, 'choice_weight'=>$i);
            $this->db->insert($this->choices_table, $choices_array);
            $i++;
        }
    }


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
