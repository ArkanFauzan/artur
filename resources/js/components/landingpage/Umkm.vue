<template>
    <div class="umkm">
        <div class="crop-toko">
            <!-- But querySelector method uses CSS3 selectors for querying the DOM and CSS3 doesn't support ID selectors that start with a digit: -->
            <div :id="'id'+umkm.id" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div v-for="product in umkm.products" :key="product.id" class="carousel-item">
                        <img class="d-block w-100" :src="'img/product/'+product.img" onerror="this.src='img/loading.gif';" :tittle="product.name" :alt="product.name">
                    </div>
                </div>
                <a class="carousel-control-prev" :href="'#id'+umkm.id" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" :href="'#id'+umkm.id" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="description">
            <div class="crop-logo">
                <img :src="'img/profile/'+umkm.logo"  onerror="this.src='img/loading.gif';" class="logo">
            </div>
            <div class="name">
                <h2>{{umkm.name}}</h2>
                <p>{{umkm.place}}</p>
            </div>
        </div>
        <!-- <div class="button-toko">
            <a :href="'https://instagram.com/'+umkm.ig" target="_blank"  class="ig"><img src="img/ig umkm.png"><p>Instagram</p></a>
            <a :href="umkm.ecommerce" target="_blank" class="ecommerce"><img src="img/toko umkm.png" class="ecommers"><p>E-Commerce</p></a>
        </div> -->

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
    props:['umkm'],
    mounted(){
        // console.log(this.umkm);
        let tes = document.querySelector(`#id${this.umkm.id} .carousel-inner .carousel-item`).classList.add('active');
    },
    data(){
        return{
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