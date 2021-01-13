<template>
    <div class="umkm-group">
        <product v-for="product in allProduct" :key="product.id" :product="product"></product>
    </div>
</template>

<script>
import Product from './Product'
export default {
    components:{
        Product
    },
    mounted(){
        // get id of all umkm
        axios.get('api/product').then(response=>{
            this.allProduct = response.data.product;
            // console.log(response.data.umkm);
        })
    },
    data(){
        return{
            allProduct:{}
        }
    }
}
</script>