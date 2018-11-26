 export const WorkplaceMixin = {
  methods: {

        getWorkPlace(){
          let uri = this.$apihost+'workplace/'+this.$route.params.id;
          this.axios.get(uri).then(response => {
            this.nodata.status = false;
            this.workplace = response.data;
          }).catch(e => {
            this.nodata.status = true;
            this.nodata.msg = e.response.data.msg;
          });
        },

        saveWorkPlace() {
          let formData = new FormData();
          Object.keys(this.workplace).forEach(key => {
            formData.append(key, this.workplace[key]);
          })

          if(this.file!="")
          formData.append('image', this.file);
          if(this.isupdate)
          formData.append('_method', 'put');

          this.callAjax(formData)

        },

        handleFileUpload()  {
        this.file = this.$refs.image.files[0];
        },

        getAddressData: function (addressData, placeResultData, id) {
          this.workplace.address = placeResultData.formatted_address;
          this.workplace.latitude = addressData.latitude
          this.workplace.longitude = addressData.longitude

        },

        onSubmit()  {
          this.submitted = true;

          this.$validator.validate().then(valid => {
                if (valid) {
                  this.apiErrorStatus = false;
                  this.apiErrors = null;
                  this.saveWorkPlace();
                }
            });
        },
        callAjax(formData)
        {
          let uri = this.apiurl
          this.axios.post(uri, formData,
                {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
              }
            ).then((response) => {
            if(this.isupdate)
            alert(response.data.msg)
            this.$router.push({name: 'home'});
          }).catch(e => {
            this.apiErrorStatus = true;
            this.apiErrors = e.response.data;

          })
        },
        
    },


}
