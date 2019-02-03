<template>
  <b-table bordered hover :items="manufacturers" :fields="fields">

    <template slot="Sl No" slot-scope="data">
      {{data.index + 1}}
    </template>

    <template slot="name" slot-scope="data">
      {{data.value}}
    </template>

    <template slot="Action" slot-scope="data">
      <b-button variant="danger" size="sm" @click="deleteBtn(data)" >Delete</b-button>
    </template>

  </b-table>
</template>

<script>

export default {
  data () {
    return {
      fields:[
        'Sl No',
        { key: 'name', label:'Manufacturer Name' },
        'Action'
      ],
      manufacturers: []
    }
  },
  mounted(){
    window.axios.get('/api/manufacturer')
    .then((response) => {
        //console.log(response.data);
        this.manufacturers = response.data;
    })
    .catch(function (error) {
    // handle error
    console.log(error);
    });
  },
  methods: {
    deleteBtn(data){
       window.axios.delete('/api/manufacturer/'+data.item.id)
      .then((response) => {
          console.log(response);
          this.manufacturers.splice(data.index,1);
      })
      .catch(function (error) {
      // handle error
      console.log(error);
      });
    }
  }
}
</script>