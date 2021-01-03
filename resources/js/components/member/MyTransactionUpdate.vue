<template>
    <div class="container">
        <form @submit.prevent="submitForm">
            <div class="form-group">
                <label for="product_name">Select Product</label>
                <p class="error-form" v-if="errors.product_name" >{{errors.product_name[0]}}</p>
                <input type="text" list="product" @keyup="changeProduct" class="form-control" id="product_name" />
                <datalist id="product">
                    <option v-for="product in products" :key="product.id" :value="product.name"/>
                </datalist>
            </div>
            <div class="form-group">
                <label for="net_price">Net Price</label>
                <p class="error-form" v-if="errors.net_price" >{{errors.net_price[0]}}</p>
                <input type="text" @keyup="formatPrice" class="form-control" id="net_price"/>
            </div>
            <div class="form-group">
                <label for="ongkir">Ongkos Kirim</label>
                <p class="error-form" v-if="errors.ongkir" >{{errors.ongkir[0]}}</p>
                <input type="text" @keyup="formatOngkir" class="form-control" id="ongkir"/>
            </div>
            <div class="form-group">
                <label for="gross_price">Gross Price</label>
                <p class="error-form" v-if="errors.gross_price" >{{errors.gross_price[0]}}</p>
                <input type="text" id="gross_price" :value="grossPrice" class="form-control" disabled/>
            </div>
            <div class="form-group">
                <label for="profit">Profit</label>
                <p class="error-form" v-if="errors.profit" >{{errors.profit[0]}}</p>
                <input type="text" id="profit" :value="profit" class="form-control" disabled/>
            </div>
            <div class="form-group">
                <label for="file">Upload Proof of Transaction</label>
                <p class="error-form" v-if="errors.file" >{{errors.file[0]}}</p>
                <input type="file" ref="file" @change="changeFile" id="file"/>
            </div>
            <button type="submit" class="btn btn-primary">Save
                <svg v-if="loading" class="loading" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="background: none; display: block; shape-rendering: auto;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                    <g>
                    <path d="M50 15A35 35 0 1 0 74.74873734152916 25.251262658470843" fill="none" stroke="#ffffff" stroke-width="12"></path>
                    <path d="M49 3L49 27L61 15L49 3" fill="#ffffff"></path>
                    <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                    </g>
                </svg>
            </button>
        </form>
    </div>
</template>

<script>
export default {
    mounted(){
        axios.get('/api/member/products').then(res=>{
            this.products = res.data.product;
            // console.log(this.products);
        });
    },
    data(){
        return{
            loading:false,
            products:{},
            file:'',
            form:{
                product_name:'',
                net_price:'',
                ongkir:'',
                gross_price:'',
                profit:'',
            },
            errors:{}
        }
    },
    computed:{
        // automated set and show gross and profit 
        grossPrice(){
            this.form.gross_price = Math.ceil(this.form.net_price*1.3);
            return this.formatRupiah(this.form.gross_price);
        },
        profit(){
            this.form.profit = Math.ceil(this.form.net_price*0.3);
            return this.formatRupiah(this.form.profit);
        }
    },
    methods:{
        changeProduct(e){
            this.form.product_name = e.target.value;
        },

        // format net price input
        formatPrice(e){
            let value = e.target.value;
            let number = value.replace(/\D/g,'');

            this.form.net_price = number;

            let formatRupiah = this.formatRupiah(number);
            e.target.value = formatRupiah;
        },

        // format ongkir input
        formatOngkir(e){
            let value = e.target.value;
            let number = value.replace(/\D/g,'');

            this.form.ongkir = number;

            let formatRupiah = this.formatRupiah(number);
            e.target.value = formatRupiah;
        },

        formatRupiah(number){
            return "Rp. "+Intl.NumberFormat('de-DE').format(number);
        },

        // handle select image file
        changeFile(){
            this.file = this.$refs.file.files[0];
        },

        async submitForm(){
            this.loading = true;

            let formData = new FormData();
            formData.append("product_name", this.form.product_name);
            formData.append('net_price',this.form.net_price);
            formData.append('ongkir',this.form.ongkir);
            formData.append('gross_price',this.form.gross_price);
            formData.append('profit',this.form.profit);
            formData.append('file',this.file);

            try{
                await axios.post('/api/member/transaction',formData,
                                    {headers: {
                                    'Content-Type': 'multipart/form-data',
                                    }
                        }).then(res=>{
                            this.loading = false;
                            // console.log(res.data);
                            this.errors = {}
                        })
            }catch(e){
                this.loading = false;
                this.errors = e.response.data.errors
            }
        }
    }
}
</script>

<style>
    .form-group label{
        display: block;
    }
    button.btn .loading{
        width: 21px;
        height: 21px;
        float:right;
        margin-left: 10px;
    }
</style>