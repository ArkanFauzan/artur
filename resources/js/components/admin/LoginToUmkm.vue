<template>
  <main class="main px-5">
      <p class="h3 text-dark text-center" style="caption-side:top;text-align:center">Login to Dashboard UMKM</p>
      <div class="new-umkm table-responsive">
          <table class="table table-bordered table-hover">
              <thead>
                <tr class="h5 text-dark">
                    <th>UMKM</th>
                    <th>Email</th>
                    <th>Place</th>
                    <th>WA</th>
                    <th>IG</th>
                    <th>Click to Login</th>
                </tr>
              </thead>
              <tbody>
                <tr style="color:black" v-for="umkm in listUmkm" :key="umkm.id">
                    <td>{{umkm.name}}</td>
                    <td>{{umkm.email}}</td>
                    <td>{{umkm.place}}</td>
                    <td>{{umkm.wa}}</td>
                    <td>{{umkm.ig}}</td>
                    <td><a class="btn btn-sm bg-info" style="cursor:pointer" @click.prevent="loginUmkm(umkm)">Login</a></td>
                </tr>
              </tbody>
          </table>
      </div>
  </main>
</template>

<script>
export default {
    mounted(){
        this.getUmkm(); //data umkm for login to dashboard member 
    },
    data(){
        return{
            listUmkm:{},
        }
    },
    methods:{
        async getUmkm(){
            try{
                await axios.get('/api/admin/umkm').then(res=>{
                    this.listUmkm = res.data.umkm;
                })
            }catch(e){

            }
        },
        async loginUmkm(umkm){
            try{
                await axios.post('/api/admin/login-member',{id:umkm.id}).then(res=>{
                    // console.log(res.data);
                    if (res.data=='sukses') {
                        window.location.href = '/member';
                    }
                })
            }catch(e){
                console.log(e.response.data.errors);
            }
        }
    }
}
</script>

<style>

</style>