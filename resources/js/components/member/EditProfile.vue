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
                        <input type="file" class="pl-5 mb-3" id="file" ref="file" v-on:change="handleFile"/>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <h4>UMKM's name:</h4>
                        <input type="text" class="form-control" v-model="profile.name" />
                    </div>
                    <div class="form-group">
                        <h4>UMKM's place:</h4>
                        <input type="text" class="form-control" v-model="profile.place" />
                    </div>
                </div>
                <div class="col-12 col-md-6">
                     <div class="form-group">
                        <h4>WhatsApp number</h4>
                        <input type="text" class="form-control" v-model="profile.wa" />
                    </div>
                    <div class="form-group">
                        <h4>Instagram Account</h4>
                        <input type="text" class="form-control" v-model="profile.ig" />
                    </div>
                </div>
                <div class="text-center col-12">
                    <button class="btn btn-primary" type="submit" href="/member/edit-profile">Save Changes</button>
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
            file:'',
            profile:{
                name:'',
                place:'',
                wa:'',
                ig:'',
                img:'',
            }
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
            // console.log(this.profile);
            let formData = new FormData();
            formData.append("file", this.file);
            // formData.append("data", this.profile)
            // console.log(formData);
            try{
            await axios.post('/api/member/edit-profile',formData,
                        {headers: {
                            'Content-Type': 'multipart/form-data',
                            }
                        }
            ).then(response=>{
                console.log(response.data.result);;
            })}
            catch(e){
                console.log(e.response.data.errors);
            }
        }
    }
}
</script>

<style>
div{
    box-sizing: border-box;
}

</style>