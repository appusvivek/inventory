<template>

    <div id="app">
        <b-container>
             <div class="heading">
                <h2>Mini Car Inventory</h2>
            </div>
        </b-container>
        <div class="row">
            <div class="col-md-4">
                <manufacturer-component></manufacturer-component>
            </div>
        </div>
    </div>
  
</template>

<script>
    import ManufacturerComponent from './Manufacturer.vue';

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        components: {
            ManufacturerComponent
        }
    }
</script>

<style>
    .row {
        margin: 10px;
    }
</style>
