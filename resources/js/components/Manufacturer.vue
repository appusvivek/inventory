<template>
  <div class="row">
    <div class="col-md-4">

      <div class="manufacturer">
        <b-form @submit="onSubmit" @reset="onReset" v-if="show">
          <b-form-group id="exampleInputGroup2"
                        label="Manufacturer Name:"
                        label-for="manufacturername">
            <b-form-input id="manufacturername"
                          type="text"
                          v-model="form.manufacturername"
                          required
                          placeholder="Enter manufacturer name">
            </b-form-input>
          </b-form-group>
          <b-button type="submit" variant="primary">Submit</b-button>
          <b-button type="reset" variant="danger">Reset</b-button>
        </b-form>
      </div>

    </div>
    <div class="col-md-6">
        <b-table bordered hover :items="manufacturers" :fields="fields" v-if="table" >

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
        <b-alert v-else variant="danger" show>Table data is empty!</b-alert>

    </div>
  </div>
  
</template>

<script>
export default {
  data () {
    return {
      table: false,
      form: {
        manufacturername: '',
      },
      show: true,
      fields:[
        'Sl No',
        { key: 'name', label:'Manufacturer Name',sortable: true },
        'Action'
      ],
      manufacturers: []
    }
  },
  mounted(){
    window.axios.get('/api/manufacturer')
    .then((response) => {
        this.manufacturers = response.data;
        if(this.manufacturers.length > 0){
          this.table = true;
        }
    })
    .catch(function (error) {
      // handle error
      console.log(error);
    });
  },
  methods: {
    onSubmit (evt) {
      evt.preventDefault();
        window.axios.post('/api/manufacturer', {
            name: this.form.manufacturername
        })
        .then( (response) => {
            this.table = true;
            this.manufacturers.push(response.data);
            this.form.manufacturername = '';
        })
        .catch(function (error) {
            console.log(error);
        });
    },
    onReset (evt) {
      evt.preventDefault();
      /* Reset our form values */
      this.form.manufacturername = '';
      /* Trick to reset/clear native browser form validation state */
      this.show = false;
      this.$nextTick(() => { this.show = true });
    },
    deleteBtn(data){
       window.axios.delete('/api/manufacturer/'+data.item.id)
      .then((response) => {
          //console.log(response);
          this.manufacturers.splice(data.index,1);
          if(this.manufacturers.length < 1) {
            this.table = false;
          }
      })
      .catch(function (error) {
        // handle error
        console.log(error);
      });
    }
  }
}
</script>