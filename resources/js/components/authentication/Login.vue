<template>
    <div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block">
                        <h2 class="text-center text-primary mt-5">Clifford Technologies Challenge</h2>
                        <img class="img-profile rounded-circle"
                            src="">
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                            </div>
                            <form class="user">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user"
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Email Address..." v-model="form.email" name="email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password" v-model="form.password" name="password">
                                </div>
                                <button @click.prevent="login" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                            </form>
                        </div>
                        <hr>
                        <h2>Login With</h2>
                        <p>Email: admin@solutech.com</p>
                        <p>Password: password</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>
</template>

<script>
export default {
    name:"login",
    data(){
        return {
            form:{
                email:"",
                password:""
            },
            validationErrors:{},
            processing:false
        }
    },
    methods:{
        async login(){
            this.processing = true
            await axios.post('/api/auth/login',this.form).then( response =>{
                window.localStorage.setItem("token", response.data.data.token);
                window.localStorage.setItem("user",JSON.stringify(response.data.data.user));
                window.location.href = "/";
                // this.$router.push('/');

            }).catch(({response})=>{
                if(response.status===422){
                    this.validationErrors = response.data.errors
                }else{
                    this.validationErrors = {}
                    alert(response.data.message)
                }
            }).finally(()=>{
                this.processing = false
            })
        },
    }
}
</script>