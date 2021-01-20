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
        axios.get('api/product').then(response=>{
            this.allProduct = response.data.product;
        })
    },
    data(){
        return{
            allProduct:{}
        }
    }
}
</script>