<div id="survey_admin">
    <div class = "container-fluid" >
    <div class = "table">
        <button v-on:click="visibility=!visibility" id="addNewSurvey">Add New Survey</button>
        <table id="survey_table" class="table table-condensed table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div v-bind:class="{hidden:visibility}" id="add_survey_modal">
        <div class ="modal fade in show" role="dialog">
        <div class="modal-dialog">
            <div class ="modal-content">
                <div class="modal-header">
                    <button v-on:click="visibility=!visibility" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Add New Survey</h3>  
                </div>
                <div :class="response_status">{{response_msg}}</div>
                <form id="form_survey" method="POST" v-on:submit.prevent="addSurvey()" >
                <div class ="modal-body form">
                        <div class = "row">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Survey Name</label>
                                    <div class="col-md-9">
                                        <input v-model="s_name" name="survey_title" placeholder="" class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Survey Description</label>
                                    <div class="col-md-9">
                                        <textarea v-model="s_description" name="survey_description" class="form-control" id="" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div> 
                        </div>
                </div>
                <div class ="modal-footer"> 
                    <input type="submit" id="saveSurvey" class="btn btn-primary" value="Save"/>
                    <button v-on:click="visibility=!visibility" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
                </form>          
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url() . 'public/manager/js/survey.js'; ?>"></script>