<template>
    <div class="umkm" @click.prevent="showProduct(product)">
        <div class="crop-toko">
            <img width="100%" height="100%" :src="'img/product/'+product.img" onerror="this.src='img/loading.gif';" :tittle="product.name" :alt="product.name" style="cursor:pointer">
        </div>
        <div class="description px-3">
            <h5 class="card-title">{{product.name}}</h5>
            <div class="card-text">
                <p class="mt-2">
                    <span style="font-weight:bold;color:#e31f52;background-color:pink;border:2px solid pink; border-radius:5px;margin-right:5px;padding:3px">-23%</span> 
                    <span style="text-decoration:line-through;font-size:11px">{{gross}}</span>
                </p>
                <p class="mt-2" style="font-size:14px;font-weight:bold">{{price}}</p>
            </div>  
        </div>
        <div class="button-toko">
            <!-- <a :href="product.ig" target="_blank"  class="ig"><img src="img/ig umkm.png"><p>Instagram</p></a>
            <a :href="product.ecommerce" target="_blank" class="ecommerce"><img src="img/toko umkm.png"><p>E-Commerce</p></a> -->
            <a class="detail">Show Detail</a>
        </div>

        <div class="background"></div>

    </div>
</template>

<script>
export default {
    props:['product'],
    mounted(){
        // console.log(this.product); 

        this.gross = parseInt(this.product.price.replace(/\D/g,'')); //gross price from database
        this.net_price = Math.ceil(this.gross/1.3); //net price from seller
        this.price = this.net_price*1.07; //price, include profit
        this.gross = Math.ceil(this.price/77*100); // gross price. gross-23% = product price

        this.price = 'Rp. '+ Intl.NumberFormat('de-DE').format(this.price);
        this.gross = 'Rp. '+ Intl.NumberFormat('de-DE').format(this.gross);
    },
    data(){
        return{
            net_price:'',
            gross:'',
            price:'',
            popup:{
                status:false,
                img:'',
                name:'',
                price:0,
                description:''
            }
        }
    },
    methods:{
        showProduct(product){
            window.location.href = `/product/${product.id}`
        },
        closePopup(){
            this.popup.status = false;
        }
    }
}
</script>

<style>
    .umkm{
        cursor: pointer;
    }
</style>