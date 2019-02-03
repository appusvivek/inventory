<template>

    <div id="app">
        <b-container>
             <div class="heading">
                <h2>Mini Car Inventory</h2>
            </div>
        </b-container>
        <div class="row">
            <div class="col-md-12">
                <manufacturer-component></manufacturer-component>
            </div>
            <div class="col-md-12">
                <car-component></car-component>
            </div>
             <div class="col-md-12">
                <inventory-component></inventory-component>
            </div>
        </div>
    </div>
  
</template>

<script>
    import ManufacturerComponent from './Manufacturer.vue';
    import CarComponent from './Cars.vue';
    import InventoryComponent from './Inventory.vue';

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        components: {
            ManufacturerComponent,
            CarComponent,
            InventoryComponent
        }
    }
</script>

<style>
    .row {
        margin: 10px;
    }
</style>
