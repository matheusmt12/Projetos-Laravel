<template>
    <div class="container">
        <div class="row justify-content-center">
          <!-- card de busca -->
            <div class="col-md-8">
                <card-component titulo="Busca Marca">
                    <template v-slot:conteudo>
                        <div class=" form row">
                                <div class="col mb-3">
                                    <inputcontainer-component id="id" titulo="ID" idHelpe="idHelpe" tituloAjuda="Opicional. Informe o id ">
                                        <input type="number" class="form-control" id="idMarca" aria-describedby="idHelpe">
                                    </inputcontainer-component>
                               </div>
                                <div class="mb-3 col">

                                    <inputcontainer-component id="idNomeMarca" titulo="Nome Marca" idHelpe="idHelpeNomeMArca" tituloAjuda="Opicional. Informe o nome da Marca ">
                                            <input type="text" class="form-control" id="idnomeMarca" aria-describedby="idHelpe">
                                    </inputcontainer-component>
                                </div>
                            </div>
                    </template>
                    <template v-slot:rodape>
                            <button type="submit" class="btn btn-primary btn-sm float-right">Pesquisar</button>
                    </template>
                </card-component>
            </div>
            <!-- Fim card busca -->
            <div class="col-md-8">
                <card-component titulo="Listagem de Marca">
                    <template v-slot:conteudo>
                        <table-component :dados="marcas.data" idMarca="ID" :titulos="['id','name','imagem']">
                                
                        </table-component>
                    </template>
                    <template v-slot:rodape>
                        <div class="row">
                            <div class="col-10"><paginate-component>
                                <li v-for="l,key in marcas.links" :key="key" :class=" l.active ? 'page-item active' : 'page-item' "><a class="page-link" v-html="l.label" @click="paginacao(l)"></a></li>
                            </paginate-component></div>
                            <div class="col">
                                <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal" data-bs-target="#modalMarca">Adicionar</button>   
                            </div>
                            
                        </div>
   
                    </template>
                </card-component>
            </div>
        </div>
        <!-- Modal -->
        <modal-component id="modalMarca" titulo="Adicionar Marca">
            <template v-slot:alertas>
                <alert-component tipo="success" v-if="statusRequest == 'Adicionado'" :detalhes="detalhesRequest" titulo="Sucesso ao cadastrar a marca"></alert-component> 
                <alert-component tipo="danger" v-if="statusRequest == 'Erro'" :detalhes="detalhesRequest" titulo="Falha ao salvar"></alert-component>
            </template>
            <template v-slot:conteudo>
                <div class="form-group">
                    <inputcontainer-component id="idNome" titulo="Nome" idHelpe="idHelpe" tituloAjuda="Obrigatorio. Informe o nome " >
                        <input type="text" class="form-control" id="idNomeMarcaAdd" aria-describedby="idHelpe"v-model="nomeMarca">
                    </inputcontainer-component>
                </div>
                <div class="form-group">
                    <inputcontainer-component id="idImagem" titulo="Imagem" idHelpe="idHelpeimagem" tituloAjuda="Obrigatorio. Informe a imagem ">
                        <input type="text" class="form-control" id="idImagem" aria-describedby="idHelpeimagem" v-model="imagemMarca">
                    </inputcontainer-component>
                </div>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="Salvar()">Salvar</button>
            </template>
        </modal-component>
    </div>
</template>

<script>
import axios from 'axios';
    export default {
        data(){
            return {
                url : 'http://127.0.0.1:8000/api/v1/marca',
                nomeMarca :'',
                imagemMarca:'',
                statusRequest : '',
                detalhesRequest : {},
                marcas : []
            }
        },
        methods:{
            paginacao(l){
                if(l.url){
                this.url = l.url;
                this.carregarDados();}
            },
            carregarDados(){
   
                axios.get(this.url).then(response => {
                    this.marcas = response.data
                    console.log(this.marcas);
                }).catch(erro=>{console.log(erro.response.data);})
            },

            Salvar(){
                //formData/ append
                //axios.post(<url>, <conteudo>,<config>)

                let formdata = new FormData();

                formdata.append('name' , this.nomeMarca);
                formdata.append('imagem', this.imagemMarca);
                
                //pegar token 
                const urlToken = new URLSearchParams(window.location.search);
                let token =urlToken.get('token')

                let config = {
                    headers :{
                        'Content-Type' : 'multipart/form-data',
                        'Accept' : 'application/json',
                    }
                }
                //console.log(config);
                axios.post(this.url,formdata,config)
                    .then(response => {
                        this.statusRequest = 'Adicionado';
                        this.detalhesRequest ={
                            mensagem : 'Id Registro ' + response.data.id
                        } 
                    })
                    .catch(erro =>{ 
                        this.statusRequest = 'Erro'
                        this.detalhesRequest = {
                            mensagem : erro.response.data.message,
                            dados : erro.response.data.errors
                        }
                    });
            }
        },
        mounted (){
            this.carregarDados()
        }
    }
</script>
