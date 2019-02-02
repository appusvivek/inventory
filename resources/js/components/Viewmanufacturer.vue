<template>
  <b-table striped hover :items="manufacturers"></b-table>
</template>

<script>
const items = [
  { isActive: true, age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
  { isActive: false, age: 21, first_name: 'Larsen', last_name: 'Shaw' },
  { isActive: false, age: 89, first_name: 'Geneva', last_name: 'Wilson' },
  { isActive: true, age: 38, first_name: 'Jami', last_name: 'Carney' }
]

export default {
  data () {
    return {
      manufacturers: []
    }
  },
  mounted(){

    window.axios.get('/api/manufacturer')
    .then((response) => {
        console.log(response.data);
        this.manufacturers = response.data;
    })
    .catch(function (error) {
    // handle error
    console.log(error);
    });
      console.log(this.manufacturers);
  }
}
</script>