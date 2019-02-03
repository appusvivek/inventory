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
    </div>
  </div>
  
</template>

<script>
export default {
  data () {
    return {
      form: {
        manufacturername: '',
      },
      show: true,
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
    onSubmit (evt) {
      evt.preventDefault();
      //alert(JSON.stringify(this.form));
        window.axios.post('/api/manufacturer', {
            name: this.form.manufacturername
        })
        .then( (response) => {
            this.manufacturers.push(response.data);
            this.form.manufacturername = '';
            //console.log(response);
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
      })
      .catch(function (error) {
        // handle error
        console.log(error);
      });
    }
  }
}
</script>