//Get URL
var url = new URL(window.location.href);

//Vue JS
var survey_edit = new Vue({
    el: '#survey_edit',
    data:{
        s_description:'',
        s_title:'',
        response_msg:'',
        response_status:'',
        visibility:true,
    },
    methods:{
        addQuestion(){

            //Get survey id
            survey_id = this.$refs.survey_id.value;

            //Get form data
            var self = this;
            var form = document.getElementById('form_edit_survey');
            var formData = new FormData(form);

            //Send form data 
            axios.post(url.origin+'/prep/manager/survey/updateSurvey/'+survey_id, formData).
            then(function(response){
                self.response_msg = response.data.message;
                self.response_status = 'alert alert-'+response.data.status;

                setTimeout(()=>{
                    self.visibility = false,
                    self.response_msg ='';
                    self.response_status = '';
                }, 2000);

                //get Question Generator
                self.getQuestionGenerator();

            }).catch(function(error){
                self.response_msg = error.message,
                self.response_status = 'alert alert-danger'                
            })

        },
        getQuestionGenerator(survey_id){
            console.log('sldjlfjdlf');
        }
    }
});
