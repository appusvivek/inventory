<template>
  <div class="row">
    <div class="col-md-12">
       <b-table bordered hover :items="list" :fields="fields" @row-clicked="rowClickHandler">

        <template slot="Sl No" slot-scope="data">
        {{data.index + 1}}
        </template>

        <template slot="carname" slot-scope="data">
        {{data.value}}
        </template>

        <template slot="count" slot-scope="data">
          {{data.value}}
        </template>

      </b-table>
    </div>
    <div>

      <b-modal ref="myModalRef" hide-footer title="Details">
        <div class="d-block text-center">
          <h3>{{this.modal.carname}}</h3>
        </div>
        <div>
          <p>Manufacturer : {{this.modal.manufacturer}}</p>
          <p>Color : {{this.modal.color}}</p>
          <p>Year : {{this.modal.manufacture_year}}</p>
          <p>Registration No : {{this.modal.registration_no}}</p>
          <p>Note : {{this.modal.note}}</p>
        </div>
        <b-btn class="mt-3" variant="outline-danger" block @click="hideModal()">Sold</b-btn>
      </b-modal>

    </div>
  </div>
  
</template>

<script>
export default {
  data() {
    return {
      list: [],
      fields:[
        'Sl No',
        { key: 'name', label:'Manufacturer' },
        { key: 'carname', label:'Car Name' },
        { key: 'count', label: 'Count (Manufacturer)'}
      ],
      modal: {
        carname: '',
        color: '',
        manufacture_year: '',
        registration_no: '',
        note: '',
        manufacturer: '',
        carid: '',
        index: ''
      }
    }
  },
  mounted() {
     window.axios.get('/api/inventory')
    .then((response) => {
        console.log(response.data);
        this.list = response.data;
    })
    .catch(function (error) {
    // handle error
    console.log(error);
    });
  },
  methods: {
    rowClickHandler(record, index) {
      //console.log(record.id);
      this.modal.carname = record.carname;
      this.modal.color = record.color;
      this.modal.manufacture_year = record.manufacture_year;
      this.modal.registration_no = record.registration_no;
      this.modal.note = record.note;
      this.modal.manufacturer = record.name;
      this.modal.carid = record.id;
      this.modal.index = index;
      this.$refs.myModalRef.show()

    },
    hideModal() {
      window.axios.delete('/api/car/'+this.modal.carid)
      .then((response) => {
          console.log(response);
          this.list.splice(this.modal.index,1);
          this.$refs.myModalRef.hide()
      })
      .catch(function (error) {
      // handle error
      console.log(error);
      });
    }
  }
}
</script>

