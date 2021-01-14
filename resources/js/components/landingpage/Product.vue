<template>
    <div class="umkm">
        <div class="crop-toko">
            <img @click.prevent="showPopup(product)" width="100%" height="100%" :src="'img/product/'+product.img" onerror="this.src='img/loading.gif';" :tittle="product.name" :alt="product.name" style="cursor:pointer">
        </div>
        <div class="description px-3">
            <h5 class="card-title">{{product.name}}</h5>
            <div class="card-text">
                <p><i class="fas fa-tag mr-2"></i>{{product_discount}}</p>
                <p style="text-decoration:line-through;color:red">{{product.price}}</p>
                <p>{{product.description}}</p>
            </div>  
        </div>
        <div class="button-toko">
            <a :href="product.ig" target="_blank"  class="ig"><img src="img/ig umkm.png"><p>Instagram</p></a>
            <a :href="product.ecommerce" target="_blank" class="ecommerce"><img src="img/toko umkm.png"><p>E-Commerce</p></a>
        </div>

        <div class="background"></div>

        <div v-if="popup.status" class="popup-container">
            <img src="img/close.png" class="popup-close" @click.prevent="closePopup()">
            <div class="popup-product">
                <div>
                    <img class="popup-img" :src="popup.img">
                    <p class="popup-name" v-text="popup.name"></p>
                    <p class="popup-price" v-text="popup.price"></p>
                    <p class="popup-description" v-text="popup.description"></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['product'],
    mounted(){
        // console.log(this.product); 

        // set product discount. discount = 20%
        this.product_discount = parseInt(this.product.price.replace(/\D/g,''))*0.8;
        this.product_discount = 'Rp. '+ Intl.NumberFormat('de-DE').format(this.product_discount);
    },
    data(){
        return{
            product_discount:'',
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
        showPopup(product){
            this.popup.status = true;
            this.popup.img = `img/product/${product.img}`;
            this.popup.name = product.name;
            this.popup.price = product.price;
            this.popup.description = product.description;
        },
        closePopup(){
            this.popup.status = false;
        }
    }
}
</script>

<style>
    .popup-container{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(110, 106, 106, 0.5);
        z-index: 1000;

    }
    .popup-product{
        position: relative;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        width: 85%;
        height: 80vh;
    }

    .popup-product>div{
        position: absolute;
        width: 100%;
        height: 100%;
        overflow-y: scroll;
        text-align: center;
        background: white;
    }

    .popup-close{
        position: absolute;
        right: 3%;
        top: 3%;
        width: 50px;
        height: 50px;
        z-index: 1001;
    }
    .popup-close:hover{
        cursor: pointer;
    }
    .popup-img{
        width: 100%;
        height: auto;
        padding-bottom: 10px;
        border-bottom: 1px solid black;
    }

    .popup-name{
        text-align: left !important;
        margin: 15px 15px !important;
        font-size: 25px !important;
        font-weight: bold !important;
    }

    .popup-price{
        text-align: left !important;
        margin: 15px 15px !important;
        font-size: 18px !important;
        font-weight: bold !important;
    }

    .popup-description{
        text-align: left!important;
        margin: 15px 15px !important;
        font-size: 17px !important;
        padding-bottom: 20px;
    }

    .carousel-inner{
        cursor: pointer;
    }
</style>