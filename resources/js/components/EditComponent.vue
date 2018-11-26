<template>
  <div>
      <form-componet :isupdate="isupdate" :sectionTitle="sectionTitle"></form-componet>
  </div>
</template>
<script>
    import FormComponent from "./FormComponent.vue";
    export default {
        data: () =>  {
        return {
            isupdate:true,
            sectionTitle:"Edit Workplace",
            }
        },
        components:{
            'form-componet': FormComponent
        }
    }
</script>
