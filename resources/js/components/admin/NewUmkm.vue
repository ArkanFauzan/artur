<template>
  <main class="main px-5">
      <p class="h3 text-dark text-center" style="caption-side:top;text-align:center">List of UMKM Who Waiting Verification</p>
      <div class="new-umkm table-responsive">
          <table class="table table-bordered table-hover">
              <thead>
                <tr class="h5 text-dark">
                    <th>UMKM</th>
                    <th>Email</th>
                    <th>Place</th>
                    <th>WA</th>
                    <th>IG</th>
                    <th>Verified?</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="umkm in newUmkm" :key="umkm.id" v-bind:style="{color:(umkm.read==0?'blue':'black')}">
                    <td>{{umkm.name}} <span :style="{display:umkm.read==0?'inline':'none'}">(New!!!)</span></td>
                    <td>{{umkm.email}}</td>
                    <td>{{umkm.place}}</td>
                    <td>{{umkm.wa}}</td>
                    <td>{{umkm.ig}}</td>
                    <td><a class="btn btn-sm bg-info" style="cursor:pointer" @click.prevent="verified(umkm)">yes</a></td>
                </tr>
              </tbody>
          </table>
      </div>
  </main>
</template>

<script>
export default {
    mounted(){
        this.getData(); //data register umkm
    },
    data(){
        return{
            newUmkm:{},
        }
    },
    methods:{
        async getData(){
            try{
                await axios.get('/api/admin/new-umkm').then(response=>{
                this.newUmkm = response.data.newUmkm;
                // console.log(this.newUmkm);
                });
            }
            catch(e){
                // console.log(e.response);
            }
        },
        verified(umkm){
            let question = window.confirm(`Are you sure this UMKM (${umkm.email}) was verified?`);
            if (question) {
                umkm.password = window.prompt('Create password for this UMKM!');
                if(umkm.password){
                    if(umkm.password.length>=8){
                        this.createAccount(umkm);
                    }
                    else{
                        alert('minimun password length is 8 characters');
                    }
                }
            }
            // console.log(umkm);
        },
        async createAccount(umkm){
            try{
                await axios.post('/api/admin/create-umkm',umkm).then(response=>{
                    this.newUmkm = this.newUmkm.filter(umkm=>{
                        return umkm.email != response.data.umkm.email;
                    })
                })
            }catch(e){
                console.log();
            }
        }
    }
}
</script>

<style>

</style>