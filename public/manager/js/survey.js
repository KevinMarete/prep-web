//DataTables
$(document).ready(function(){   

    var table = $('#survey_table').DataTable({
        dom:'Bfrtip',
        buttons:[{
            text:'Add Survey',
            action:function(e, dt, node, config){
                    $('#add_survey_modal').modal('show')
                }
            }],
            "aoColumns":[
                {"sTitle":"Title", "mData":"survey_title"},
                {"sTitle":"Description", "mData":"survey_description"},
                {"sTitle":"Start Date", "mData":"start_date"},
                {"sTitle":"End Date", "mData":"end_date"},
                {"sTitle":"Actions", "mData":"id",
                    "mRender":function(data, type, row){
                        return '<a class="btn btn-primary" href="../../Manager/Survey/editSurvey/'+data+'">Edit</a>&nbsp;&nbsp;<a class="btn btn-default" v-on:click="">Delete</a>';
                    }
                }
            ],
            "processing":true,
            "serverSide":true,
            "sAjaxDataProp":"",
            "sAjaxSource":'../../Manager/Survey/surveys_list'         
    });
})


//Get URL
var url = new URL(window.location.href);

//Vue JS
var survey = new Vue({
    el: '#survey_admin',
    data:{
        s_description:'',
        s_name:'',
        response_msg:'',
        response_status:'',
        visibility:true,
    },
    methods:{
        addSurvey(e){
            //Get form data
            var self = this;
            var form = document.getElementById('form_survey');
            var formData = new FormData(form);

            //Send form data 
            axios.post(url.origin+'../../Manager/Survey/addSurvey', formData).
            then(function(response){
                self.response_msg = response.data.message;
                self.response_status = 'alert alert-'+response.data.status;

                setTimeout(()=>{
                    self.visibility = true;
                    self.response_msg ='';
                    self.response_status = '';
                }, 2000);

                //Reload DataTables
                $('#survey_table').DataTable().ajax.reload();

            }).catch(function(error){
                self.response_msg = error.message,
                self.response_status = 'alert alert-danger'                
            })

        }
    }
});

console.log(survey);