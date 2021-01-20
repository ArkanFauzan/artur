<template>
    <div class="umkm">
        <div class="crop-toko">
            <img @click.prevent="showPopup(product)" width="100%" height="100%" :src="'img/product/'+product.img" onerror="this.src='img/loading.gif';" :tittle="product.name" :alt="product.name" style="cursor:pointer">
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
                    <div class="popup-price">
                        <p class="mt-2 text-left">
                            <span style="font-weight:bold;color:#e31f52;background-color:pink;border:2px solid pink; border-radius:5px;margin-right:5px;padding:3px">-23%</span> 
                            <span style="text-decoration:line-through;font-size:11px">{{gross}}</span>
                        </p>
                        <p class="mt-2 text-left" style="font-size:14px;font-weight:bold">{{price}}</p>
                    </div>
                    <p class="popup-description" v-text="popup.description"></p>
                    <div class="button-toko" style="flex-direction:column;justify-content:left">
                        <a :href="product.ig" target="_blank"  class="ig mb-3"><img src="img/ig umkm.png"><p>Instagram</p></a>
                        <a :href="product.ecommerce" target="_blank" class="ecommerce"><img src="img/toko umkm.png"><p>E-Commerce</p></a>
                    </div>
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

        this.gross = parseInt(this.product.price.replace(/\D/g,'')); //gross price from database
        this.net_price = Math.ceil(this.gross/1.3); //net price from seller
        this.price = this.net_price*1.07; //price include profit
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

    .popup-description,.popup-product .button-toko{
        text-align: left!important;
        margin: 15px 15px !important;
        font-size: 17px !important;
        padding-bottom: 20px;
    }

    .carousel-inner{
        cursor: pointer;
    }
</style>