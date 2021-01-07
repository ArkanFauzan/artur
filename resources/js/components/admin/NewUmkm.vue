<template>
  <main class="main">
      <div class="new-umkm">
          <table>
              <tr>
                  <th>UMKM</th>
                  <th>Email</th>
                  <th>Place</th>
                  <th>WA</th>
                  <th>IG</th>
                  <th>Verified?</th>
              </tr>
              <tr v-for="umkm in newUmkm" :key="umkm.id" v-bind:style="{'color':(umkm.read==0?'blue':'black')}">
                  <td>{{umkm.name}}</td>
                  <td>{{umkm.email}}</td>
                  <td>{{umkm.place}}</td>
                  <td>{{umkm.wa}}</td>
                  <td>{{umkm.ig}}</td>
                  <td><a @click.prevent="verified(umkm)">yes</a></td>
              </tr>
          </table>
      </div>
      <div>
          <p v-for="dataUmkm in umkm" :key="dataUmkm.id"><a @click.prevent="loginUmkm(dataUmkm)">{{dataUmkm.name}}</a></p>
      </div>
  </main>
</template>

<script>
export default {
    mounted(){
        this.getData(); //data register umkm
        this.getUmkm(); //data umkm for login to dashboard member 
    },
    data(){
        return{
            newUmkm:{},
            umkm:{},
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
        },
        async getUmkm(){
            try{
                await axios.get('/api/umkm').then(res=>{
                    this.umkm = res.data.umkm;
                })
            }catch(e){

            }
        },
        async loginUmkm(umkm){
            await axios.post('api/login-member',{id:umkm.id}).then(res=>{
                if (res.data=='sukses') {
                    window.location.href = '/member';
                }
            })
        }
    }
}
</script>

<style>
    .main .new-umkm{
        width:950px;
        margin: 0 auto;
        margin-top: 50px;
    }
    .main .new-umkm table{
        width: 100%;
        text-align: left;
        border-collapse: collapse;
    }
    .main .new-umkm table a{
        color: blue;
    }
    .main .new-umkm table a:hover{
        cursor: pointer;
    }
    .main .new-umkm table td,
    .main .new-umkm table th{
        border: 1px solid black;
        padding: 10px;
        box-sizing: border-box;
    }
</style>