//Get URL
var url = new URL(window.location.href);

//Define Vue Instance
var app = new Vue({
    el: '#reg_form',
    data: {
      county: '',
      subcounties: {},
      changePwd:true,
      updateStatus: '',
      updateMessage: ''
    },
    watch:{
      county:function(val){
        this.getSubCounties(val)
      }
    },
    methods:{
      getSubCounties(val){
        var self = this;
        axios.get(url.origin +'/prep/manager/getSubCounties/'+val).
        then(function(response){
          if(response.statusText == 'OK'){
            self.subcounties = response.data
          }else{

          }
        }).catch(function(error){
          console.log(error)
        })
      },
      updateUser(e){
        var self = this;
        //Get form data
        var form = document.getElementById('userUpdateForm');
        var formData = new FormData(form);
        
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

      }
    }
  })

  //Update user details 
