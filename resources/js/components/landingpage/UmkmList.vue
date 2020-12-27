<template>
    <div class="umkm-group">
        <umkm v-for="umkm in allUmkm" :key="umkm.id" :umkm="umkm"></umkm>
    </div>
</template>

<script>
import Umkm from './Umkm'
export default {
    components:{
        Umkm
    },
    mounted(){
        // get id of all umkm
        axios.get('api/umkm').then(response=>{
            this.allUmkm = response.data.umkm;
            // console.log(response.data.umkm);
        })
    },
    data(){
        return{
            allUmkm:{}
        }
    }
}
</script>