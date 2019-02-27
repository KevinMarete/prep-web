//Get URL
var url = new URL(window.location.href);

            //define component to hold answer type options
            Vue.component('answer-type-options', {
                data:function(){
                    return {
                        options:[],
                        selected:'',
                        choices:[{
                            value:'',
                            id:0
                        }]
                    }
                },
                computed:{
                    choices_id(){
                        return this.choices.length
                    }
                },
                watch:{
                    type:function(val){
                        this.getAnswerTypeView(val);
                    },
                    options:function(){
                        this.updateOpts();
                    }
                }, 
                methods:{
                    getAnswerTypeView(val){
                        switch(val){
                            case 'List':
                               this.getList()
                            break;
                            case 'Multichoice':
                                this.getMultichoice()
                            break;
                            case 'Prose':
                                this.getProse()
                            break;
                            default:
                                return '<div>&nbsp;</div>'
                        }
                    },
                    getList(){
                        var self = this
                        axios.get(url.origin+'/prep/manager/survey/getLists').
                        then(function(response){
                            self.options = response.data;
                        }).catch(function(error){
                            return error
                        })
                    },
                    getMultichoice(){
                        var self = this
                        self.options = '[]';

                    },
                    getProse(){
                        var self = this
                        self.options = '[]';
                    },
                    updateOpts(){
                        var self=this;
                        this.$emit('update-options', this.options);
                    },
                    updateListOption(e){
                        var self=this;
                        this.$parent.$emit('updateListParent', this.selected)
                        console.log(e)
                    },
                    addChoice(e){
                        var self=this;
                        this.choices.push({value:'',id:this.choices_id})
                        //this.$parent.$emit('updateChoices', e)
                    },
                    updateChoices(e){
                        var self= this;
                        this.choices[e.target.id].value = e.target.value;
                    }
                },
                props:['type','typesList'],
                created(){
                    this.selected = this.typesList
                    this.choices
                },
                template:'<div></div>',
            })



//Vue JS
var survey_edit = new Vue({
    el: '#survey_edit',
    data:{
        multipleChoices:[],
        options:[],
        answerTypeList:'sdfdf',
        answerTypeLabel:'',
        answerType:'Prose',
        s_description:'',
        s_title:'',
        response_msg:'',
        response_status:'',
        visibility:true,
    },
    components:{name:'answer-type-options'},
    created(){
        this.$on('updateListParent', (selection) =>{
            this.answerTypeList = selection;
        }),

        this.$on('updateChoices', (choices) => {
            this.multipleChoices = choices;
        })
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
                    self.$watch('answerType', function(val){self.getAnswerTypeView(val)}, {immediate:true})

                }, 2000);

            }).catch(function(error){
                self.response_msg = error.message,
                self.response_status = 'alert alert-danger'                
            })

        },
        getAnswerTypeView(val){
            
            //set this to variable self
            var self = this;
            self.answerTypeLabel = val;


        },
         updateOptions(e){
             this.options = e;
         },
         updateListParent(e){
             this.answerTypeList = e.target.value
             console.log(this.answerTypeList)
         },
         updateChoices(e){
             this.multipleChoices.push(e);
         }
    }
});
