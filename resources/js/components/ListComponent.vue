<template>
  <div>
      <h1>Workplaces</h1>
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link to="/Add" class="btn btn-primary">Add</router-link>
          </div>
        </div><br />

        <div class="row" v-if="nodata.status">
            <div class="col-md-10" >
              <h2  class="text-center">{{nodata.msg}}</h2>
            </div>
        </div>

        <div class="row">
          <div class="col-sm-3 marginclass d-flex" v-for="workplace in workplaces" :key="workplaces.id">

                <div class="card" style="width: 18rem;" >

                    <image-component :imgsrc="workplace.image"></image-component>
                    <div class="card-body">
                      <h5 class="card-title no-space-break">{{ workplace.title }}</h5>
                      <p class="card-text">{{ workplace.address }}</p>
                      <router-link :to="{name: 'workplace', params: { id: workplace.id,workplace:workplace }}" class="btn btn-primary">{{ workplace.price }} sek</router-link>
                    </div>
                 </div>

            </div>
          </div>
  </div>
</template>

<script>
  import ImageComponent from "./ImageComponent.vue";
  export default {
      components:{
          'image-component': ImageComponent
      },
      data() {
        return {
          workplaces: [],
          nodata:{
          status:false,
          msg:''
          },

        }
      },
      created() {
        this.getWorkPlaces();
    },
    methods:{
      getWorkPlaces(){

        let uri = this.$apihost+'workplaces';
        this.axios.get(uri).then(response => {
          this.nodata.status = false;
          this.workplaces = response.data;
        }).catch(e => {
          this.nodata.status = true;
          this.nodata.msg = e.response.data.msg;
        });
      }
    },
  }
</script>
<style scoped>
.marginclass{margin:0 5% 5% 0}
</style>
