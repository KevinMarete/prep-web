<div class="container" id = "survey_edit" >
    <form id="form_edit_survey" action="POST" v-on:submit.prevent="addQuestion" >
        <div class = "panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class = "panel-heading" role="tab" id="headingOne">
                    <h4 class ="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="collapseOne" aria-expanded="true" aria-controls="collapseOne">Survey General Details</a>
                    </h4>
                </div>
            </div>
        </div>
        <input type="hidden" ref="survey_id" value="<?=$survey[0]['id']?>"  >
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Survey Name</label>
                        <div class="col-md-9">
                            <input name="survey_title" placeholder="" class="form-control" type="text" value="<?=$survey[0]['survey_title']?>">
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Survey Description</label>
                        <div class="col-md-9">
                            <textarea name="survey_description" placeholder="" class="form-control" ><?=$survey[0]['survey_description']?></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class = "panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class = "panel-heading" role="tab" id="headingOne">
                    <h4 class ="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="collapseOne" aria-expanded="true" aria-controls="collapseOne">Survey Questions</a>
                    </h4>
                </div>
            </div>
        </div>
        <div :class="response_status">{{response_msg}}</div>
        <div>
            <a v-on:click="addQuestion()" class="btn btn-primary" href="#">Add Question</a>
        </div>   
    </form>
    <div v-bind:class="{hidden:visibility}">
        <div class ="modal fade in show">
            <div class="modal-dialog" role="document">
                <div class ="modal-content">
                    <div class ="modal-header">
                        <button v-on:click="visibility=!visibility" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4>Add Question</h4>
                    </div>
                        <div id ="questionHolder">
                            <div></div>          
                        </div>
                        <div class = "modal-body">
                        <form role="form" id="saveQuestion" action="POST" v-on:submit.prevent="saveQuestion()">
                        <div class = "form-body">
                            <div class ="form-group">
                                    <label class="control-label col-md-3">Question Text</label>
                                    <div class="col-md-9">
                                        <textarea name="question_text" placeholder="" class="form-control" ></textarea>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class ="form-group">
                                    <label class="control-label col-md-3">Answer Type</label>
                                    <div class="col-md-9">
                                        <select v-model="answerType" name="answer_type" id="answerType">
                                            <?php foreach($answerTypes as $type) { ?>
                                                <option value="<?=$type['name']?>"><?=$type['name']?></option>
                                            <?php }?>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!--Insert AnswerType component here.-->
                                <div class="form-group">
                                    <label class="control-label col-md-3" for="">{{answerTypeLabel}}</label>
                                    <div class="col-md-9">
                                        <answer-type-options v-bind:type="answerType" @update-options="updateOptions" inline-template>
                                                <div>
                                                    <div v-if="type==='List'">
                                                        <select name="choices[]" v-model="selected" v-on:change="updateListOption">
                                                            <option v-for="option in options" :value="option.tbl">{{option.list}}</option>
                                                        </select>
                                                    </div>
                                                    <div v-if="type==='Multichoice'">
                                                    <a class="btn btn-sm btn-default col-md-3" @click="addChoice"> + Add Choice</a>
                                                        <div class="row">&nbsp;</div>
                                                        <div class="row">&nbsp;</div>
                                                        <div class="col-md-9">
                                                            <div class="row">
                                                                <div v-for="choice in choices">
                                                                    <textarea name="choices[]" :id="choice.id" class="form-control col-md-6" @blur="updateChoices" >{{choice.value}}</textarea>                                                            
                                                                    <div>&nbsp;</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div v-if="type==='Prose'">
                                                        <div class="alert alert-info">Answer will be typed.
                                                            <input type="hidden" name="choices[]">
                                                        </div>
                                                    </div>
                                                </div>
                                        </answer-type-options>
                                    </div>
                                </div>
                            </div>
                    <div class ="modal-footer">
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="Add">
                            <a v-on:click="visibility=!visibility" class="btn btn-default" >Close</a>                
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="<?php echo base_url() . 'public/manager/js/survey_edit.js'; ?>"></script>