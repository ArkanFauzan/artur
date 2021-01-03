<template>
    <div class="umkm">
        <div class="crop-toko">
            <div :id="dataUmkm.id" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img class="d-block w-100" @click.prevent="showPopup(dataUmkm.products[0])" :src="'img/product/'+dataUmkm.products[0].img" onerror="this.src='img/loading.gif';" :tittle="dataUmkm.products[0].name" :alt="dataUmkm.products[0].name">
                    </div>
                    <div v-if="dataUmkm.products[1]" class="carousel-item">
                    <img class="d-block w-100" @click.prevent="showPopup(dataUmkm.products[1])" :src="'img/product/'+dataUmkm.products[1].img"  onerror="this.src='img/loading.gif';" :tittle="dataUmkm.products[1].name" :alt="dataUmkm.products[1].name">
                    </div>
                    <div v-if="dataUmkm.products[2]" class="carousel-item">
                    <img class="d-block w-100" @click.prevent="showPopup(dataUmkm.products[2])" :src="'img/product/'+dataUmkm.products[2].img"  onerror="this.src='img/loading.gif';" :tittle="dataUmkm.products[2].name" :alt="dataUmkm.products[2].name">
                    </div>
                    <div v-if="dataUmkm.products[3]" class="carousel-item">
                    <img class="d-block w-100" @click.prevent="showPopup(dataUmkm.products[3])" :src="'img/product/'+dataUmkm.products[2].img"  onerror="this.src='img/loading.gif';" :tittle="dataUmkm.products[2].name" :alt="dataUmkm.products[2].name">
                    </div>
                    <div v-if="dataUmkm.products[4]" class="carousel-item">
                    <img class="d-block w-100" @click.prevent="showPopup(dataUmkm.products[4])" :src="'img/product/'+dataUmkm.products[2].img"  onerror="this.src='img/loading.gif';" :tittle="dataUmkm.products[2].name" :alt="dataUmkm.products[2].name">
                    </div>
                </div>
                <a class="carousel-control-prev" :href="'#'+dataUmkm.id" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" :href="'#'+dataUmkm.id" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="description">
            <div class="crop-logo">
                <img :src="'img/profile/'+dataUmkm.logo"  onerror="this.src='img/loading.gif';" class="logo">
            </div>
            <div class="name">
                <h2>{{dataUmkm.name}}</h2>
                <p>{{dataUmkm.place}}</p>
            </div>
        </div>
        <div class="button-toko">
            <a :href="'https://instagram.com/'+dataUmkm.ig"  class="ig"><img src="img/ig umkm.png"><p>Instagram</p></a>
            <a :href="'https://tokopedia.com/'+dataUmkm.ecommerce" class="ecommerce"><img src="img/toko umkm.png" class="ecommers"><p>E-Commerce</p></a>
        </div>

        <div class="background"></div>

        <div v-if="popup.status" class="popup-container">
            <img src="img/close.png" class="popup-close" @click.prevent="closePopup()">
            <div class="popup-product">
                <div>
                    <img class="popup-img" :src="popup.img">
                    <p class="popup-name" v-text="popup.name"></p>
                    <p class="popup-description" v-text="popup.description"></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['umkm'],
    async mounted(){
        // get data umkm
        await axios.get(`/api/product-umkm/${this.umkm.id}`).then(res=>{
            this.dataUmkm.products = res.data.products
        })
        await axios.get(`/api/logo-umkm/${this.umkm.id}`).then(res=>{
            this.dataUmkm.logo = res.data.logo
        })

        // console.log(this.dataUmkm);
    },
    data(){
        return{
            dataUmkm:{
                id:this.umkm.id,
                name:this.umkm.name,
                place:this.umkm.place,
                logo:'',
                ig:this.umkm.ig,
                ecommerce:'alala',
                products:[
                    {img:'',name:''},
                    {img:'',name:''},
                    {img:'',name:''}
                ]
            },
            popup:{
                status:false,
                img:'',
                name:'',
                description:''
            }
        }
    },
    methods:{
        showPopup(product){
            this.popup.status = true;
            this.popup.img = `img/product/${product.img}`;
            this.popup.name = product.name;
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