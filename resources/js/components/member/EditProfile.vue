<template>
    <main class="main px-5">
        <div class="profile text-center mb-5">
            <img :src="'../img/profile/'+profile.img" width="300px" height="300px" alt="#" onerror="this.src='../img/profile/default picture.png';this.onerror='';">
        </div>
        <div class="text-center">
            <form class="row mt-5 text-left" v-on:submit.prevent="handleSubmit" enctype="multipart/form-data">
                <div class="col-12 text-center">
                    <div style="width:300px;display:inline-block;" class="text-center">
                        <h4>Choose profile picture</h4>
                        <p class="text-danger" v-if="errors.file">{{errors.file}}</p>
                        <input type="file" class="pl-5 mb-3" id="file" ref="file" v-on:change="handleFile"/>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <h4>UMKM's name:</h4>
                        <p class="text-danger" v-if="errors.input.name">{{errors.input.name[0]}}</p>
                        <input type="text" class="form-control" v-model="profile.name" />
                    </div>
                    <div class="form-group">
                        <h4>UMKM's place:</h4>
                        <p class="text-danger" v-if="errors.input.place">{{errors.input.place[0]}}</p>
                        <input type="text" class="form-control" v-model="profile.place" />
                    </div>
                </div>
                <div class="col-12 col-md-6">
                     <div class="form-group">
                        <h4>WhatsApp number</h4>
                        <p class="text-danger" v-if="errors.input.wa">{{errors.input.wa[0]}}</p>
                        <input type="text" class="form-control" v-model="profile.wa" />
                    </div>
                    <div class="form-group">
                        <h4>Instagram Account</h4>
                        <p class="text-danger" v-if="errors.input.ig">{{errors.input.ig[0]}}</p>
                        <input type="text" class="form-control" v-model="profile.ig" />
                    </div>
                </div>
                <div class="text-left col-12">
                    <button class="btn btn-primary" type="submit" href="/member/edit-profile">Save Changes 
                        <svg v-if="loading" class="loading" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="background: none; display: block; shape-rendering: auto;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                            <g>
                            <path d="M50 15A35 35 0 1 0 74.74873734152916 25.251262658470843" fill="none" stroke="#ffffff" stroke-width="12"></path>
                            <path d="M49 3L49 27L61 15L49 3" fill="#ffffff"></path>
                            <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                            </g>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </main>
</template>

<script>
export default {
    mounted(){
        this.getProfile();
    },
    data(){
        return{
            loading: false,
            file:'',
            profile:{
                name:'',
                place:'',
                wa:'',
                ig:'',
                img:'',
            },
            errors:{file:'',input:''}
        }
    },
    methods:{
        async getProfile(){
            await axios.get('/api/member/profile').then(response=>{
                this.profile = response.data.profile;
            })
        },
        handleFile(){
            this.file = this.$refs.file.files[0];
        },
        async handleSubmit(){
            this.loading = true;
            if (this.file!=='') {
                await this.uploadFile();
            }
            await this.updateProfile();

            this.loading = false;
            if(this.errors.file === '' && this.errors.input===''){
                window.location.href = '/member'
            }
        },
        async uploadFile(){
            let formData = new FormData();
            formData.append("file", this.file);
            // formData.append("data", this.profile)
            // console.log(formData);
            try{
            await axios.post('/api/member/edit-profile-picture',formData,
                        {headers: {
                            'Content-Type': 'multipart/form-data',
                            }
                        }
            ).then(response=>{
                // console.log(response.data.result);
                this.errors.file = '';
            })}
            catch(e){
                this.errors.file = e.response.data.errors ;
                // console.log(this.errors);
            }
        },
        async updateProfile(){
            try{
                await axios.post('/api/member/edit-profile',this.profile).then(response=>{
                    // console.log(response.data.result);
                    this.errors.input = '';
                })
            }
            catch(e){
                this.errors.input = e.response.data.errors;
                console.log(this.errors);
            }
        }
    }
}
</script>

<style>
    div{
        box-sizing: border-box;
    }
    button.btn .loading{
        width: 22px;
        height: 22px;
        float:right;
        margin-left: 10px;
        position: relative;
        top: 1.5px;
    }
</style>