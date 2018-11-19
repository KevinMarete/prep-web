var app = new Vue({
    el: '#reg_form',
    data: {
      county: '',
      subcounties: {}
    },
    watch:{
      county:function(val){
        this.getSubCounties(val)
      }
    },
    methods:{
      getSubCounties(val){
        var self = this;
        axios.get('manager/getSubCounties/'+val).
        then(function(response){
          if(response.statusText == 'OK'){
            self.subcounties = response.data
          }else{

          }
        }).catch(function(error){
          console.log(error)
        })
      }
    }
  })