<template>
    <form class="container-fluid" @submit.prevent="handleSubmit">
        <div class="card">
            <div class="card-header"><h3>Edit Product</h3></div>
            <div class="p-3">
                <div class="text-center">
                    <img :src="'../../img/product/'+form.img" width="540px" height="400px"
                    :alt="form.name" :title="form.name" onerror="this.src='../../img/default picture.png';"
                    >
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Product's name</label>
                    <p class="text-danger" v-if="errors.name">{{errors.name[0]}}</p>
                    <input type="text" name="name" v-model="form.name" class="form-control" id="name">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Net price (from seller)</label>
                    <p class="text-danger" v-if="errors.price">{{errors.price[0]}}</p>
                    <input type="text" name="name"  @keyup="formatPrice" class="form-control" id="price">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <p class="text-danger" v-if="errors.description">{{errors.description[0]}}</p>
                    <textarea name="description" id="description" @change="changeDescription"  v-text="form.description" class="form-control" cols="30" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="ig" class="form-label">Link instagram filter</label>
                    <p class="text-danger" v-if="errors.ig">{{errors.ig[0]}}</p>
                    <input type="text" name="ig" v-model="form.ig" placeholder="-" class="form-control" id="ig">
                </div>
                <div class="mb-3">
                    <label for="ecommerce" class="form-label">Link product (in E-commerce)</label>
                    <p class="text-danger" v-if="errors.ecommerce">{{errors.ecommerce[0]}}</p>
                    <input type="text" name="ecommerce" v-model="form.ecommerce" placeholder="-" class="form-control" id="ecommerce">
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">Change product's photo</label>
                    <p class="text-danger" v-if="errors.file">{{errors.file}}</p>
                    <input class="form-control" @change="changeFile" ref="file" style="padding:0;height:auto" type="file" id="file">
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
            </div>
        </div>
    </form>
</template>

<script>
export default {
    mounted(){ 
        // get id product from current url
        this.productId = window.location.href.split('edit-product/')[1];

        axios.get('/api/member/product/'+this.productId).then(response=>{
            this.form = response.data.product
            console.log(this.form);

            // format to rupiah
            document.getElementById('price').value = 'Rp. '+ Intl.NumberFormat('de-DE').format(this.form.price);
        })
    },
    data(){
        return{
            loading:false,
            file:'',
            form:{
                name:'',
                price:'',
                ig:'',
                ecommerce:'',
                description:'',
            },
            productId:'',
            errors:{
                name:'',
                ig:'',
                ecommerce:'',
                description:'',
                file:''
            }
        }
    },
    methods:{
        changeDescription(e){
            this.form.description = e.target.value;
        },
        changeFile(){
            this.file = this.$refs.file.files[0];
        },
        // format net price input
        formatPrice(e){
            let value = e.target.value;
            let number = value.replace(/\D/g,'');

            this.form.price = number;

            e.target.value = 'Rp. '+Intl.NumberFormat('de-DE').format(number);
        },
        async handleSubmit(){
            // console.log(this.form);
            this.loading=true;

            let formData = new FormData();
            formData.append("file", this.file);
            formData.append('name',this.form.name);
            formData.append('price',this.form.price);
            formData.append('ig',this.form.ig);
            formData.append('ecommerce',this.form.ecommerce);
            formData.append('description',this.form.description);
            // console.log(formData);
        try{
            await axios.post(`/api/member/product/${this.productId}`,formData,
                                {headers: {
                                    'Content-Type': 'multipart/form-data',
                                    }
                                }
                ).then(response=>{
                    // console.log(response.data);
                    this.errors = ''
                    this.loading = false
                    window.location.href = "/member/my-product";
            })
        }
        catch(e){
            // console.log(e.response.data.errors);
            this.errors = e.response.data.errors;
            console.log(this.errors);
            this.loading = false
        }
        },
    }
}
</script>

<style>
    button.btn .loading{
        width: 22px;
        height: 22px;
        float:right;
        margin-left: 10px;
        position: relative;
        top: 1.5px;
    }
</style>