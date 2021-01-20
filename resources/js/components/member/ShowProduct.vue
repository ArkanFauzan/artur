<template>
  <div style="width:15rem;margin:20px" >
        <div class="card" style="width: 15rem;margin:10px auto">
            <img :src="'../img/product/'+product.img" class="card-img-top" width="270px" height="180px"  
                :alt="product.name" :title="product.name" onerror="this.src='../img/profile/default picture.png';"
            >
            <div class="card-body">
                <h5 class="card-title">{{product.name}}</h5>
                <div class="card-text">
                    <p>{{product.price}} (from seller)</p>
                    <p>{{product.description}}</p>
                    <a :href="'/member/edit-product/'+product.id" class="btn btn-sm btn-primary">Edit</a>
                    <btn ref="product" @click.prevent="deleteProduct(product)" class="btn btn-sm btn-transparent">Hapus</btn>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BusEvent from '../../BusEvent' 
export default {
    props:['product'],
    methods:{
        async deleteProduct(product){
            let q = window.confirm(`are you sure want to delete ${product.name}`)
            if (q) {
                try{
                    await axios.delete(`/api/member/product/${product.id}`).then(response=>{
                        // console.log(response.data);
                        BusEvent.$emit('deleteProduct',product.id)
                    })
                }catch(e){
                    alert('something went wrong')
                }   
            }
        }
    }
}
</script>

<style>

</style>