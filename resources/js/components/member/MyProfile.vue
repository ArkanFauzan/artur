<template>
    <main class="main px-5">
        <div class="profile text-center mb-3">
            <img :src="'img/profile/'+profile.img" width="300px" height="300px" alt="#" onerror="this.src='img/profile/default picture.png';this.onerror='';">
        </div>
        <div>
            <form action="#" class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <h4>UMKM's name:</h4>
                        <h5 v-text="profile.name"></h5>
                    </div>
                    <div class="form-group">
                        <h4>UMKM's place:</h4>
                        <h5 v-text="profile.place"></h5>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                     <div class="form-group">
                        <h4>WhatsApp number</h4>
                        <h5 v-text="profile.wa"></h5>
                    </div>
                    <div class="form-group">
                        <h4>Instagram Account</h4>
                        <h5 v-text="profile.ig"></h5>
                    </div>
                </div>
            </form>

            <a class="btn btn-primary" href="/member/edit-profile">Edit profile</a>
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
                // console.log(this.profile);
            })
        }
    }
}
</script>

<style>
div{
    box-sizing: border-box;
}

</style>