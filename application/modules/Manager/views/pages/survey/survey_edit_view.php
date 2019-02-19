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
                        <div class = "modal-body">
                        <form role="form" id="addQuestion" action="POST" v-on:submit.prevent="saveQuestion()">
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
                                        <select v-model="answerType" name="answerType" id="answerType">
                                            <?php foreach($answerTypes as $type) { ?>
                                                <option value="<?=$type['slug']?>"><?=$type['name']?></option>
                                            <?php }?>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <div class ="modal-footer">
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="<?php echo base_url() . 'public/manager/js/survey_edit.js'; ?>"></script>