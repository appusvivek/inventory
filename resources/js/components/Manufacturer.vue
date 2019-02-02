<template>
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
</template>

<script>
export default {
  data () {
    return {
      form: {
        manufacturername: '',
      },
      show: true
    }
  },
  methods: {
    onSubmit (evt) {
      evt.preventDefault();
      //alert(JSON.stringify(this.form));
        window.axios.post('/api/manufacturer', {
            name: this.form.manufacturername
        })
        .then(function (response) {
            console.log(response);
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
    }
  }
}
</script>