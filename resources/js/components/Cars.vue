<template>
  <div class="row">
    <div class="col-md-6">
       <b-form inline @submit="onSubmit" @reset="onReset" v-if="show">
          <label class="sr-only" for="inlineFormInputName2">Car Name</label>
          <b-input  v-model="form.carname" class="mb-2 mr-sm-2 mb-sm-0" id="carname" placeholder="Car Name" required />
          <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
          <b-input-group left="@" class="mb-2 mr-sm-2 mb-sm-0">
            <b-form-select id="manufacturer"
                      :options="manufacturers"
                      required
                      v-model="form.manufacturer">
              <option :value="null" disabled>Select manufacturer</option>
            </b-form-select>
          </b-input-group>

          <b-form-group id="exampleInputGroup3"
                        label="Color:"
                        label-for="color">
            <b-form-input id="color"
                          type="text"
                          v-model="form.color"
                          required
                          placeholder="Enter Color">
            </b-form-input>
          </b-form-group>

           <b-form-group id="exampleInputGroup4"
                        label="Manufacturing Year :"
                        label-for="manufacturing_year">
            <b-form-input id="manufacturing_year"
                          type="text"
                          v-model="form.manufacturing_year"
                          required
                          placeholder="Enter Manufacturing Year">
            </b-form-input>
          </b-form-group>

           <b-form-group id="exampleInputGroup5"
                        label="Registration Number :"
                        label-for="registration_no">
            <b-form-input id="registration_no"
                          type="text"
                          v-model="form.registration_no"
                          required
                          placeholder="Enter Registration Number">
            </b-form-input>
          </b-form-group>

           <b-form-group id="exampleInputGroup6"
                        label="Note :"
                        label-for="note">
                <b-form-textarea id="note"
                     v-model="form.note"
                     placeholder="Enter Notes.."
                     :rows="3"
                     :max-rows="6" style="width:100%;">
                </b-form-textarea>
          </b-form-group>
        
          <!-- <b-form-group id="exampleInputGroup6"
                        label="Note :"
                        label-for="note">
                  <b-button type="submit" variant="primary">Submit</b-button>
          </b-form-group> -->
          <b-form-group >
            <b-button type="submit" variant="primary">Submit</b-button>
            <b-button type="reset" variant="danger">Reset</b-button>
          </b-form-group>
       
         
       </b-form>
    </div>
    <div class="col-md-6">
      <b-table bordered hover :items="cars" :fields="fields">

      <template slot="Sl No" slot-scope="data">
      {{data.index + 1}}
      </template>

      <template slot="carname" slot-scope="data">
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
  mounted() {
    window.axios.get('/api/manufacturer')
    .then((response) => {
        //console.log(response.data);
        $.each(response.data, (key, val) => {
          console.log(val);
          const obj = { value: val.id, text: val.name};
          this.manufacturers.push(obj);
        });
        //this.manufacturers = response.data;
    })
    .catch(function (error) {
    // handle error
    console.log(error);
    });

    window.axios.get('/api/car')
    .then((response) => {
        //console.log(response.data);
        this.cars = response.data;
    })
    .catch(function (error) {
    // handle error
    console.log(error);
    });


  },
  data () {
    return {
      manufacturers: [],
      form: {
        carname: '',
        color: '',
        manufacturing_year: '',
        registration_no: '',
        note: '',
        manufacturer: null,
        file: ''
      },
      show: true,
      fields:[
        'Sl No',
        { key: 'carname', label:'Car Name' },
        'Action'
      ],
      cars:[]
    }
  },
  methods: {
    onSubmit (evt) {
      evt.preventDefault();
        window.axios.post('/api/car', {
          carname: this.form.carname,
          color: this.form.color,
          manufacture_year: this.form.manufacturing_year,
          registration_no: this.form.registration_no,
          note: this.form.note,
          image1: 'img1',
          image2: 'img2',
          manufacturer_id: this.form.manufacturer
        })
        .then( (response) => {
            this.cars.push(response.data);
            this.form.carname = '';
            this.form.color = '';
            this.form.manufacturing_year = '';
            this.form.registration_no = '';
            this.form.note = '';
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        });
    },
    onReset (evt) {
      evt.preventDefault();
      /* Reset our form values */
      this.form.carname = '';
      this.form.color = '';
      this.form.manufacturing_year = '';
      this.form.registration_no = '';
      this.form.note = '';
      /* Trick to reset/clear native browser form validation state */
      this.show = false;
      this.$nextTick(() => { this.show = true });
    },
    deleteBtn(data){
       window.axios.delete('/api/car/'+data.item.id)
      .then((response) => {
          console.log(response);
          this.cars.splice(data.index,1);
      })
      .catch(function (error) {
      // handle error
      console.log(error);
      });
    }

  }
}
</script>
<style>
  label {
    margin: 10px !important;
  }

  fieldset {
    margin: 5%;
  }
</style>
