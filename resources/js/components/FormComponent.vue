<template>
  <div>
    <h1>{{sectionTitle}}</h1>

    <div class="row" v-if="nodata.status">
        <div class="col-md-10" >
          <h2  class="text-center">{{nodata.msg}}</h2>
        </div>
    </div>

    <form class="form" @submit.prevent="onSubmit"  v-if="!nodata.status">
      <div v-show="apiErrorStatus" class="row">
        <div class="col-md-6">
          <div  class="form-group " >
            <div class="invalid-feedback" style="display:block;">
            {{apiErrors }}
            </div>
          </div>
        </div>
      </div>

      <div class="row" >

        <div class="col-md-6">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>User id:</label>
                <input type="text" disabled v-model="workplace.user_id" class="form-control" />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Title:</label>
                <input type="text" v-model="workplace.title" v-validate="{required: true,min:3,max:50, regex:/^[a-zA-Z0-9öäåÖÄÅ\- ]+$/}" name="workplace.title" class="form-control" :class="{ 'is-invalid': submitted && errors.has('workplace.title') }" >
                <div v-if="submitted && errors.has('workplace.title')" class="invalid-feedback">{{ errors.first('workplace.title') }}</div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Price:</label>
                <input type="text" v-model="workplace.price" v-validate="{required: true,decimal:3}" name="workplace.price" class="form-control" :class="{ 'is-invalid': submitted && errors.has('workplace.price') }" >
                <div v-if="submitted && errors.has('workplace.price')" class="invalid-feedback">{{ errors.first('workplace.price') }}</div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
              <label>Address:</label>
              <vue-google-autocomplete
              ref="address"
              id="map"
              classname="form-control"
              placeholder="Please type your address"
              v-on:placechanged="getAddressData"
              v-model="workplace.address"
              name="workplace.address"
              :value="workplace.address"
               v-validate="{required: true,regex:/(^[-0-9A-Za-zöäåÖÄÅ.,\/ ]+$)/}"
              :class="{ 'is-invalid': submitted && errors.has('workplace.address') }"
              >
              </vue-google-autocomplete>
              <div v-if="submitted && errors.has('workplace.address')" class="invalid-feedback">{{ errors.first('workplace.address') }}</div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Latitude:</label>
                <input type="text" v-model="workplace.latitude" v-validate="{required: true,decimal:16}" name="workplace.latitude" class="form-control" :class="{ 'is-invalid': submitted && errors.has('workplace.latitude') }" >
                <div v-if="submitted && errors.has('workplace.latitude')" class="invalid-feedback">{{ errors.first('workplace.latitude') }}</div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Longitude:</label>
                <input type="text" v-model="workplace.longitude" v-validate="{required: true,decimal:16}" name="workplace.longitude" class="form-control" :class="{ 'is-invalid': submitted && errors.has('workplace.longitude') }" >
                <div v-if="submitted && errors.has('workplace.longitude')" class="invalid-feedback">{{ errors.first('workplace.longitude') }}</div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6" >

          <div class="row" v-if="isupdate">
            <div class="col-md-12">
              <div class="form-group">
                <label>Name:</label>
                <input type="text" disabled v-model="workplace.user.name" class="form-control" />
              </div>
            </div>
          </div>

          <div class="row" v-if="isupdate">
            <div class="col-md-12">
              <div class="form-group">
                <label>Email:</label>
                <input type="text" disabled v-model="workplace.user.email" class="form-control"  />
              </div>
            </div>
          </div>

          <div class="row" v-if="isupdate">
            <div class="col-md-12">
              <div class="form-group">
                <label>Phone:</label>
                  <input type="text" disabled v-model="workplace.user.phone" class="form-control"  />
              </div>
            </div>
          </div>

          <div class="row" v-if="isupdate">
            <div class="col-md-12">
              <image-component :imgsrc="workplace.image"></image-component>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Image:</label>
                <input type="file" v-validate="{ required:false, mimes: ['image/jpeg', 'image/png','image/gif','image/jpg'],size:5000}" data-vv-as="image"  name="image" ref="image"  v-on:change="handleFileUpload()" class="form-control" :class="{ 'is-invalid': submitted && errors.has('image') }" >
                <div v-if="submitted && errors.has('image')" class="invalid-feedback">{{ errors.first('image') }}</div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <br />
      <div class="form-group">
        <button class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</template>

<script>
import VueGoogleAutocomplete from 'vue-google-autocomplete'
import {WorkplaceMixin} from '../mixins/workplaceMixin'
import ImageComponent from "./ImageComponent.vue";
    export default {
     name:'FormComponent',
     components: { VueGoogleAutocomplete,'image-component': ImageComponent },
     mixins:[WorkplaceMixin],
     props:['isupdate','sectionTitle'],
      data() {
        return {
          workplace:{
            title:'',
            price:'',
            address:'',
            latitude:'',
            longitude:'',
            user_id:1,
            user:{
              name:"",
              email:"",
              phone:"",
            },
          },
          file:'',
          apiurl:'',
          submitted: false,
          apiErrorStatus:false,
          apiErrors:{},
          nodata:{
          status:false,
          msg:''
          },
        }
      },
      mounted() {
      if(this.isupdate)
      this.apiurl = this.$apihost+'workplace/'+this.$route.params.id
      else
      this.apiurl=this.$apihost+'workplace';

      if(this.isupdate && this.$route.params.workplace)
        {
        this.workplace = this.$route.params.workplace;
        }
      else if(this.isupdate)
        {
        this.getWorkPlace()
        }

      },

      methods: {
      },

    }
</script>
