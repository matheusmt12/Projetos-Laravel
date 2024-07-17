<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <form method="post" @submit.prevent="login()">
                        <input type="hidden" :value="csrf_token" name="_token">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" v-model="email" required autocomplete="email" autofocus>

                                    <span class="invalid-feedback" role="alert">
                                        <strong>Invalido</strong>
                                    </span>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control " name="password" v-model="password" required autocomplete="current-password">


                                    <span class="invalid-feedback" role="alert">
                                        <strong>Invalida</strong>
                                    </span>

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" >

                                    <label class="form-check-label" for="remember">
                                        lembre-me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>


                                    <a class="btn btn-link" href="#">
                                        Esqueceu sua senha ?
                                    </a>
                               
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';

    export default{
        props: ['csrf_token'],
        data(){
            return{
                'email' : '',
                'password' : ''
            }
        },
        methods:{
            login(){
                
                let url = 'http://127.0.0.1:8000/api/login';
                let config = {
                    headers:{
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }

                }
                let dados = {
                    'email': this.email,
                    'password' : this.password,
                }
                console.log(dados);
                axios.post(url,dados).then(response => {
                        if(response.data.token){
                            document.cookie = 'token='+response.data.token+';SameSite=lax';
                            window.location.href = `/home?token=${response.data.token}`;
                        }
                });
       
            }
            
        }
    }
</script>
