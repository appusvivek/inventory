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
                     :max-rows="6" style="width:150%;">
                </b-form-textarea>
          </b-form-group>
        
          <b-form-group id="exampleInputGroup6"
                        label="Image 1:"
                        label-for="note">
                 
                  <uploader :options="options" class="uploader-example" :fileStatusText="fileStatusText">
                    <uploader-unsupport></uploader-unsupport>
                    <uploader-drop>
                      <p>Drop image here to upload or</p>
                      <uploader-btn :attrs="attrs" :single="single">select image</uploader-btn>
                    </uploader-drop>
                    <uploader-list></uploader-list>
                  </uploader>
          </b-form-group>

           <b-form-group id="exampleInputGroup7"
                        label="Image 2:"
                        label-for="note">
                 
                  <uploader :options="options" class="uploader-example" :fileStatusText="fileStatusText2" >
                    <uploader-unsupport></uploader-unsupport>
                    <uploader-drop>
                      <p>Drop image here to upload or</p>
                      <uploader-btn :attrs="attrs" :single="single">select image</uploader-btn>
                    </uploader-drop>
                    <uploader-list></uploader-list>
                  </uploader>
          </b-form-group>

          
          <b-form-group >
            <b-button type="submit" variant="primary">Submit</b-button>
            <b-button type="reset" variant="danger">Reset</b-button>
          </b-form-group>
       
         
       </b-form>
    </div>
    <div class="col-md-6">
      <b-table bordered hover :items="cars" :fields="fields" v-if="table2">

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
        this.cars = response.data;
        if(this.cars.length > 0) {
            this.table2 = true;
        }
    })
    .catch(function (error) {
      console.log(error);
    });

  },
  data () {
    return {
      manufacturers: [],
      table2: false, 
      form: {
        carname: '',
        color: '',
        manufacturing_year: '',
        registration_no: '',
        note: '',
        manufacturer: null,
        image1: '',
        image2: ''
      },
      show: true,
      fields:[
        'Sl No',
        { key: 'carname', label:'Car Name' },
        'Action'
      ],
      cars:[],
      attrs: {
          accept: 'image/*'
      },
      single:true,
      options: {
          target: '/api/image',
          testChunks: false
      },
      
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
          image1: this.form.image1,
          image2: this.form.image2,
          manufacturer_id: this.form.manufacturer
        })
        .then( (response) => {
            this.table2 = true;
            this.cars.push(response.data);
            this.form.carname = '';
            this.form.color = '';
            this.form.manufacturing_year = '';
            this.form.registration_no = '';
            this.form.note = '';
            this.form.image1 = '';
            this.form.image2 = '';
            //console.log(response);
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
      this.form.image1 = '';
      this.form.image2 = '';
      /* Trick to reset/clear native browser form validation state */
      this.show = false;
      this.$nextTick(() => { this.show = true });
    },
    deleteBtn(data){
       window.axios.delete('/api/car/'+data.item.id)
      .then((response) => {
          //console.log(response);
          this.cars.splice(data.index,1);
      })
      .catch(function (error) {
        // handle error
        console.log(error);
      });
    },
    fileStatusText(status, response){
        const statusTextMap = {
          uploading: 'uploading',
          paused: 'paused',
          waiting: 'waiting'
        }
        if (status === 'success') {
          // only use response when status is success or error
          this.form.image1 = response;
          return response.data
        } else {
          return statusTextMap[status]
        }
      },
      fileStatusText2(status, response){
        const statusTextMap = {
          uploading: 'uploading',
          paused: 'paused',
          waiting: 'waiting'
        }
        if (status === 'success') {
          // only use response when status is success or error
          this.form.image2 = response;
          return response.data
        } else {
          return statusTextMap[status]
        }
      }

  }
}
</script>
<style>
  label {
    margin: 10px !important;
  }

  fieldset {
    width: 100%;
    margin-top: 5% !important;
  }

  .form-group {
    margin: 5px;
  }

  #color {
    width: 150%;
  }

   .uploader-example {
    width: 150%;
    padding: 15px;
    margin: 0px auto 0;
    font-size: 12px;
    box-shadow: 0 0 10px rgba(0, 0, 0, .4);
  }
  .uploader-example .uploader-btn {
    margin-right: 4px;
  }
  .uploader-example .uploader-list {
    max-height: 440px;
    overflow: auto;
    overflow-x: hidden;
    overflow-y: auto;
  }

</style>
