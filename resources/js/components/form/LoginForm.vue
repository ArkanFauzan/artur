<template>
    <div style="display:block">
        <form class="form" v-on:submit.prevent="handleForm">
            <h2>Login to your account</h2>
            <p>New user? <a href="/register">Create an account</a></p>
            <p class="error-form" v-if="errors.wrongAccount">{{errors.wrongAccount}}</p>

            <div class="form-group">
                <label for="email">Email</label>
                <p class="error-form" v-if="errors.email" >{{errors.email[0]}}</p>
                <input type="email" v-model="form.email" id="email"/>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <p class="error-form" v-if="errors.password" >{{errors.password[0]}}</p>
                <input type="password" v-model="form.password" id="password"/>
            </div>
                        
            <button class="button" type="submit">Login
                <svg v-if="loading" class="loading" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="background: none; display: block; shape-rendering: auto;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                    <g>
                    <path d="M50 15A35 35 0 1 0 74.74873734152916 25.251262658470843" fill="none" stroke="#ffffff" stroke-width="12"></path>
                    <path d="M49 3L49 27L61 15L49 3" fill="#ffffff"></path>
                    <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                    </g>
                </svg>
            </button>

            <div class="backgroud"></div>
            <div class="clear"></div>
        </form>
    </div>
    
</template>

<script>
export default {
    data(){
        return{
            errors:'',
            loading:false,
            form:{
                email:'',
                password:'',
            }
        }
    },
    methods:{
        async handleForm(){
            // console.log(this.form);
            try{
                this.loading=true;
                await axios.post('/api/login',this.form).then(response=>{

                    this.loading = false;
                    if(response.data.status==200){
                        this.errors = '';
                        window.location.href = "/member";
                    };
                    // jika email atau password tidak sesuai dengan database
                    response.data.error? this.errors = {wrongAccount: response.data.error}: '' ;
                })
            }catch(e){
                this.errors = e.response.data.errors;
                this.loading = false;
            }
        }
    }
}
</script>

<style>
    .error-form{
        display: block;
        color: red;
        margin: 0;
        padding: 0;
    }
    button.button .loading{
        width: 21px;
        height: 21px;
        float:right;
        margin-left: 10px;
    }
</style>