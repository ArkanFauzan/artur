<template>
    <main class="container-fluid main">
        <div class="row">
            <div class="col-12 text-right mb-3">
                <a href="/member/my-product/add" class="btn btn-primary">+ Add Product</a>
            </div>
            <show-product v-for="product in products" :product="product" :key="product.id"></show-product>
        </div>
    </main>
</template>

<script>
import ShowProduct from './ShowProduct.vue';
import BusEvent from '../../BusEvent'
export default {
    components:{
        ShowProduct
    },
    mounted(){
        this.getProducts();
        BusEvent.$on('deleteProduct',value=>{
            this.products = this.products.filter(product=>{
                return product.id != value
            })
        })
    },
    data(){
        return{
            products : []
        }
    },
    methods:{
        async getProducts(){
            await axios.get('/api/member/products').then(response=>{
                this.products = response.data.product;
            })
        }
    }
}
</script>

<style>

</style>