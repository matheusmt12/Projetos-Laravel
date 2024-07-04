<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card Pesquisa -->
                <card-component titulo="Modelo">
                    <template v-slot:conteudo>
                        <div class="form row">
                            <div class="col mb-3">
                                <inputcontainer-component id="idModeloPesquisa" titulo="ID" idHelp="idHelpModelo" tituloAjuda="Opcional. Informe o id">
                                    <input type="number" class="form-control" v-model="idPesquisa">
                                </inputcontainer-component>
                            </div>
                            <div class="col mb-3">
                                <inputcontainer-component id="idNomeModeloPesquisa" titulo="Nome" idHelp="idHelpNomeModelo" tituloAjuda="Opicional. informe o nome">
                                    <input type="text" class="form-control" v-model="nomePesquisa">
                                </inputcontainer-component>
                            </div>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-primary btn-sm float-right">Pesquisar</button>
                    </template>
                </card-component>
            </div>
            <div class="col-md-8" style="padding-top: 20px;">
                <!-- Fim Card Pesquisa -->
                <!-- Inicio Card Table -->
                <card-component titulo="Lista de pesquisa">
                   <template v-slot:conteudo>
                        <table-component :dados="modelos.data"
                        :titulos="['id','nome','imagem','lugares']"
                        :visualizacao="false"
                        :editar="false"
                        :apagar="false">

                        </table-component>
                    </template>
                    <template v-slot:rodape>
                        <button type="submit" class="btn float-right btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">Adicionar</button>
                    </template>
                </card-component>
                <!-- Fim cadr Table -->
            </div>
            <!-- Inicio modal Add -->
            <modal-component id="modalAdd" titulo="Adicionar Modelo">
                <template v-slot:conteudo>
                    <div class="form-group">
                        <inputcontainer-component id="idNomeModelo" titulo="Nome" idHelp="idHelpeModeloNome" tituloAjuda="Obrigatorio. Informe o Nome do Modelo">
                            <input type="text" id="nomeModeloAdd" class="form-control" aria-describedby="idHelp" v-model="nameModelo">
                        </inputcontainer-component>
                    </div>
                    <div class="form row">
                        <div class="col mb-3">
                            <inputcontainer-component id="imagemModeloAdd" titulo="Imagem" idHelp="imagemHelpModelo" tituloAjuda="Obrigatório. Selecione a Imagem">
                                <input type="text" id="imagemModeloAdd" class="form-control" aria-describedby="idHelp" v-model="imagemModelo">
                            </inputcontainer-component>
                        </div>
                        <div class="col mb-3">
                            <inputcontainer-component id="numPortasModelo" titulo="Número de Portas" idHelp="numPortasAjudaModelo" tituloAjuda="Obrigatório. Informe a quantidade de portas">
                                <input type="number" id="numportasModelo" class="form-control" aria-describedby="idHelp" v-model="numPortas">
                            </inputcontainer-component>
                        </div>
                        <div class="form row">
                            <div class="col mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="AbsMOdelo" v-model="abs">
                                    <label class="form-check-label" for="AbsMOdelo">
                                        Freio ABS
                                    </label>
                                </div>
                            </div>
                            <div class="col mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" v-model="airbag" id="AirBagMOdelo">
                                    <label class="form-check-label" for="AirBagMOdelo">
                                        AirBag
                                    </label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col mb-3">
                                    <Label class="form-label" for="idMarcaModelo">Marca</Label>
                                    <select class="form-select" id="idMarcaModelo">
                                        <option v-for="i in marcas.data" :value="i.id">{{ i.name }}</option>
                                    </select>
                                </div>
                                <div class="col mb-3">
                                    <inputcontainer-component id="lugaresModelo" titulo="Lugares" idHelp="lugaresHelp" tituloAjuda="Obrogatorio. Informe o numero de lugares por pessoa">
                                        <input type="number" class="form-control" aria-describedby="idHelp" v-model="lugares">
                                    </inputcontainer-component>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                <template v-slot:rodape>
                    <button type="submit" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary btn-sm" @click="salvar()">Salvar</button>
                </template>
            </modal-component>
            <!-- Fim Modal Add -->
        </div>
        
    </div>
</template>

<script>
import axios from 'axios';
import { values } from 'lodash';


    export default {
        data(){
            return{
                urlBase : 'http://127.0.0.1:8000/api/v1/modelo',
                nomePesquisa :'',
                idPesquisa : '',
                marcas: [],
                nameModelo : '',
                imagemModelo : '',
                numPortas: 0,
                abs: false,
                airbag: false,
                lugares : 0,
                modelos :[]
                
            };
           
        },
        methods:{
            carregarMarcas(){
                let urlMarca = 'http://127.0.0.1:8000/api/v1/marca'; 

                axios.get(urlMarca).then(response => {
                    this.marcas = response.data
                })

            },
            salvar(){
                let idMarca =  document.getElementById('idMarcaModelo').value;
                let dados = {
                    nome : this.nameModelo,
                    imagem : this.imagemModelo,
                    numero_portas : this.numPortas,
                    abs : this.abs,
                    air_bag : this.airbag,
                    id_marca : idMarca,
                    lugares : this.lugares
                }

                axios.post(this.urlBase, dados)
                    .then(response => {
                        console.log("Ok");
                        this.carregarModelos()
                    }).catch(erro => {
                        console.log('Erro');
                    })   
            },
            carregarModelos(){

                axios.get(this.urlBase)
                    .then(response => {
                        this.modelos=response;
                    })
            }
        },
        mounted(){
            this.carregarMarcas(); 
            this.carregarModelos();
        }
    }
</script>
