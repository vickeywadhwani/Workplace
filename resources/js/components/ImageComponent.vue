<template>

  <img class="card-img-top" :src="getImageSrc"  alt="Card image cap" >

</template>
<script>
  export default {
    props:['imgsrc'],
    name: 'ImageComponent',
    data:() => {
      return {

      }
    },

    computed:{
      getImageSrc(){
      if(this.imgsrc=="" || this.imgsrc==null)
      return "https://www.genesisglobalschool.edu.in/wp-content/uploads/2016/09/noimage.jpg";
      else
      return this.imgsrc;
      }
    }
  }
</script>
