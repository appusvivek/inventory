<template>

    <div>
        <!-- <b-container>
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
        </div> -->
        
        <div>
            <!-- As a heading -->
            <b-navbar variant="danger" type="dark">
                <b-navbar-brand tag="h1" class="mb-0">Mini Car Inventory</b-navbar-brand>
            </b-navbar>
        </div>

       
       
        <b-container>
            <div>
                <b-nav>
                    <router-link :to="{ name: 'manufacturer' }" class="nav-link">Manufacturer</router-link>
                    <router-link :to="{ name: 'cars' }" class="nav-link">Cars</router-link>
                    <router-link :to="{ name: 'inventory' }" class="nav-link">Inventory</router-link>
                </b-nav>
            </div>
            <div class="container" style="margin-top: 10px;">
                <router-view></router-view>
            </div>
       </b-container>

         

       

       
    </div>
  
</template>

<script>
    //import ManufacturerComponent from './Manufacturer.vue';
    //import CarComponent from './Cars.vue';
    //import InventoryComponent from './Inventory.vue';

    // export default {
    //     mounted() {
    //         console.log('Component mounted.')
    //     },
    //     components: {
    //         ManufacturerComponent,
    //         //CarComponent,
    //         //InventoryComponent
    //     }
    // }

    export default {}
</script>

<style>
    
</style>
