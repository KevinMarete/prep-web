//Get URL
var url = new URL(window.location.href);

//Define Vue Instance
var app = new Vue({
    el: '#reg_form',
    data: {
      optionsLabel: '',
      scopeOpt:'',
      user_scope: '',
      scopeOptions:'',
      changePwd:true,
      updateStatus: '',
      updateMessage: ''
    },
    watch:{
      user_scope:function(val){
        var self = this;
        if((val.text !='National')){
          this.getScopeDropDown(val.text)
          self.optionsLabel = val.text;
        }else{
          self.scopeOptions = '';
        }
      }
    },
    methods:{
      updateUser(e){
        var self = this;
        //Get form data
        var form = document.getElementById('userUpdateForm');
        var formData = new FormData(form);

        //Append value of user scope to serialized form data
        formData.append('user_scope', self.user_scope.id);
        console.log(formData);

        //Send to update function
        axios.post(url.origin+'/prep/manager/user/user_update', formData).
        then(function(response){
          if(response.statusText == 'OK'){
            if(response.data.status === 'TRUE'){
              self.updateStatus = 'alert alert-success'
              self.updateMessage = response.data.message
            }else{
              self.updateStatus = 'alert alert-danger'
              self.updateMessage = response.data.error_string
            }
          }
        }).catch(function(error){
              self.updateStatus = 'alert alert-danger'
              self.updateMessage = error.data.error_string
        })

      },
      saveUser(e){
        var self = this;
        //Get form data
        var form = document.getElementById('registrationForm');
        var formData = new FormData(form);

        //Append value of user scope to serialized form data
        console.log(self.user_scope);
        formData.append('user_scope', self.user_scope.id);
        console.log(formData);

        //Send to update function
        axios.post(url.origin+'/prep/manager/user', formData).
        then(function(response){
          if(response.statusText == 'OK'){
            if(response.data.status === 'TRUE'){
              self.updateStatus = 'alert alert-success'
              self.updateMessage = response.data.message
            }else{
              self.updateStatus = 'alert alert-danger'
              self.updateMessage = response.data.error_string
            }
          }
        }).catch(function(error){
              self.updateStatus = 'alert alert-danger'
              self.updateMessage = error.data.error_string
        })
      },
      getScopeDropDown(val){
        var self = this;
        var scopeName  =  val.replace(' ', '');

        axios.get(url.origin +'/prep/manager/getAllOptions/'+scopeName).
        then(function(response){
          if(response.statusText == 'OK'){
            self.scopeOptions = response.data
            console.log(response)
          }else{
            console.log(response)
          }
        }).catch(function(error){
          console.log(error)
        })

      }
    }
  })

  //Update user details 
