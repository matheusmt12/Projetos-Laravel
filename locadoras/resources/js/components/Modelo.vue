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
                                    <input type="number" class="form-control" v-model="busca.id">
                                </inputcontainer-component>
                            </div>
                            <div class="col mb-3">
                                <inputcontainer-component id="idNomeModeloPesquisa" titulo="Nome" idHelp="idHelpNomeModelo" tituloAjuda="Opicional. informe o nome">
                                    <input type="text" class="form-control" v-model="busca.nome">
                                </inputcontainer-component>
                            </div>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-primary btn-sm float-right" @click="pesquisa()">Pesquisar</button>
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
                        :visualizacao="true"
                        :editar="true"
                        :apagar="true">

                        </table-component>
                    </template>
                    <template v-slot:rodape>
                        <paginate-component>
                            <li v-for="i,key in modelos.links" :key="key" :class="i.active ? 'page-item active' :'page-item'"><a class="page-link" v-html="i.label" @click="paginacao(i)"></a></li>
                        </paginate-component>
                        <button type="submit" class="btn float-right btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">Adicionar</button>
                    </template>
                </card-component>
                <!-- Fim cadr Table -->
            </div>
            <!-- Inicio modal Add -->
            <modal-component id="modalAdd" titulo="Adicionar Modelo">
                <template v-slot:alertas>
                    <alert-component titulo="Novo modelo cadastrado" v-if="statusRequest == 'Modelo Adicionado'" :detalhes="detailsRequest" tipo="success"></alert-component>
                    <alert-component titulo="Error ao cadastrar novo modelo" v-if="statusRequest == 'Erro ao salvar Modelo'" :detalhes="detailsRequest" tipo="danger"></alert-component>
                </template>
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
                                        <option v-for="i in marcas.data" :key="i.id" :value="i.id">{{ i.name }}</option>
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
            <!-- Inicio modal Edit -->
             <modal-component id="modalEditar" titulo="Editar Modelo">
                <template v-slot:alertas>
                    <alert-component tipo="success" v-if="statusRequest == 'Editado'" :detalhes="detailsRequest" titulo="Modelo Editado com sucesso"></alert-component>
                    <alert-component tipo="danger" v-if="statusRequest == 'EditadoErro'" :detalhes="detailsRequest" titulo="Erro ao Editar o modelo"></alert-component>
                </template>
                <template v-slot:conteudo>
                    <div class="form-group">
                        <inputcontainer-component id="idNomeModelo" titulo="Nome" idHelp="idHelpeModeloNome" tituloAjuda="Obrigatorio. Informe o Nome do Modelo">
                            <input type="text" id="nomeModeloEdit" class="form-control" aria-describedby="idHelp" :value="$store.state.item.nome">
                        </inputcontainer-component>
                    </div>
                    <div class="form row">
                        <div class="col mb-3">
                            <inputcontainer-component id="imagemModeloAdd" titulo="Imagem" idHelp="imagemHelpModelo" tituloAjuda="Obrigatório. Selecione a Imagem">
                                <input type="text" id="imagemModeloEdit" class="form-control" aria-describedby="idHelp" :value="$store.state.item.imagem">
                            </inputcontainer-component>
                        </div>
                        <div class="col mb-3">
                            <inputcontainer-component id="numPortasModelo" titulo="Número de Portas" idHelp="numPortasAjudaModelo" tituloAjuda="Obrigatório. Informe a quantidade de portas">
                                <input type="number" id="numportasModeloEdit" class="form-control" aria-describedby="idHelp" :value="$store.state.item.numero_portas">
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
                                        <option v-for="i in marcas.data" :key="i.id" :value="i.id">{{ i.name }}</option>
                                    </select>
                                </div>
                                <div class="col mb-3">
                                    <inputcontainer-component id="lugaresModelo" titulo="Lugares" idHelp="lugaresHelp" tituloAjuda="Obrogatorio. Informe o numero de lugares por pessoa">
                                        <input type="number" id="lugaresmodeloid" class="form-control" aria-describedby="idHelp":value="$store.state.item.lugares">
                                    </inputcontainer-component>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                <template v-slot:rodape>
                    <button type="button" data-bs-dismiss="modal" class="btn btn-secondary btn-sm" @click="limparKanela()">Fechar</button>
                    <button type="submit" class="btn btn-sm btn-primary" @click="editar($store.state.item.id)">Salvar</button>
                </template>
             </modal-component>
            <!--Fim modal Edit -->
            <!--Inicio modal visualizar  -->
            <modal-component id="modalVisualizar" titulo="Visualizar Modelo">
                <template v-slot:conteudo>
                    <div class="form-group">
                        <inputcontainer-component id="idNomeModelo" titulo="Nome" idHelp="idHelpeModeloNome" tituloAjuda="Obrigatorio. Informe o Nome do Modelo">
                            <input type="text" id="nomeModeloVisualizar" class="form-control" aria-describedby="idHelp" :value="$store.state.item.nome">
                        </inputcontainer-component>
                    </div>
                    <div class="form row">
                        <div class="col mb-3">
                            <inputcontainer-component id="imagemModeloAdd" titulo="Imagem" idHelp="imagemHelpModelo" tituloAjuda="Obrigatório. Selecione a Imagem">
                                <input type="text" id="imagemModeloVisualizar" class="form-control" aria-describedby="idHelp" :value="$store.state.item.imagem">
                            </inputcontainer-component>
                        </div>
                        <div class="col mb-3">
                            <inputcontainer-component id="numPortasModelo" titulo="Número de Portas" idHelp="numPortasAjudaModelo" tituloAjuda="Obrigatório. Informe a quantidade de portas">
                                <input type="number" id="numportasModeloVisualizar" class="form-control" aria-describedby="idHelp" :value="$store.state.item.numero_portas">
                            </inputcontainer-component>
                        </div>
                        <div class="form row">
                            <div class="col mb-3">
                                <div class="form-check">
                                    <span v-if="$store.state.item.abs ? vsAbs = true : vsAbs=false"></span>
                                    <input class="form-check-input" type="checkbox" id="AbsMOdeloVisualizar" v-model="vsAbs" disabled>
                                    <label class="form-check-label" for="AbsMOdeloVisualizar">
                                        Freio ABS
                                    </label>
                                </div>
                            </div>
                            <div class="col mb-3">
                                <div class="form-check">
                                    <span v-if="$store.state.item.air_bag ? vsAir = true : vsAir = false"></span>
                                    <input class="form-check-input" type="checkbox" v-model="vsAir" id="AirBagMOdeloVisualizar" disabled>
                                    <label class="form-check-label" for="AirBagMOdeloVisualizar">
                                        AirBag
                                    </label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col mb-3">
                                    <Label class="form-label" for="idMarcaModeloVisualizar">Marca</Label>
                                    <input disabled class="form-control" type="text" v-for="i in marcas.data" :key="i.id" v-if="i.id === $store.state.item.id_marca" :value="i.name">
                                </div>
                                <div class="col mb-3">
                                    <inputcontainer-component id="lugaresModelo" titulo="Lugares" idHelp="lugaresHelp" tituloAjuda="Obrogatorio. Informe o numero de lugares por pessoa">
                                        <input type="number" id="lugaresmodeloidVisualizar" class="form-control" aria-describedby="idHelp":value="$store.state.item.lugares">
                                    </inputcontainer-component>
                                </div>
                            </div>
                        </div>
                    </div>                       
                </template>
                <template v-slot:rodape>
                    
                    <button type="submit" data-bs-dismiss="modal" class="btn btn-sm btn-secondary" >Fechar</button>
                </template>
            </modal-component>
            <!--Fim modal Visualizar -->
            <!-- Inicio modal Apagar -->
            <modal-component id="modalDeletar" titulo="Apagar Modelo">
                <template v-slot:conteudo>
                    <div class="form-group">
                        <inputcontainer-component id="idNomeModelo" titulo="Nome" idHelp="idHelpeModeloNome" tituloAjuda="Obrigatorio. Informe o Nome do Modelo">
                            <input type="text" id="nomeModeloVisualizar" class="form-control" aria-describedby="idHelp" :value="$store.state.item.nome">
                        </inputcontainer-component>
                    </div>
                    <div class="form row">
                        <div class="col mb-3">
                            <inputcontainer-component id="imagemModeloAdd" titulo="Imagem" idHelp="imagemHelpModelo" tituloAjuda="Obrigatório. Selecione a Imagem">
                                <input type="text" id="imagemModeloVisualizar" class="form-control" aria-describedby="idHelp" :value="$store.state.item.imagem">
                            </inputcontainer-component>
                        </div>
                        <div class="col mb-3">
                            <inputcontainer-component id="numPortasModelo" titulo="Número de Portas" idHelp="numPortasAjudaModelo" tituloAjuda="Obrigatório. Informe a quantidade de portas">
                                <input type="number" id="numportasModeloVisualizar" class="form-control" aria-describedby="idHelp" :value="$store.state.item.numero_portas">
                            </inputcontainer-component>
                        </div>
                        <div class="form row">
                            <div class="col mb-3">
                                <div class="form-check">
                                    <span v-if="$store.state.item.abs ? vsAbs = true : vsAbs=false"></span>
                                    <input class="form-check-input" type="checkbox" id="AbsMOdeloVisualizar" v-model="vsAbs" disabled>
                                    <label class="form-check-label" for="AbsMOdeloVisualizar">
                                        Freio ABS
                                    </label>
                                </div>
                            </div>
                            <div class="col mb-3">
                                <div class="form-check">
                                    <span v-if="$store.state.item.air_bag ? vsAir = true : vsAir = false"></span>
                                    <input class="form-check-input" type="checkbox" v-model="vsAir" id="AirBagMOdeloVisualizar" disabled>
                                    <label class="form-check-label" for="AirBagMOdeloVisualizar">
                                        AirBag
                                    </label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col mb-3">
                                    <Label class="form-label" for="idMarcaModeloVisualizar">Marca</Label>
                                    <input disabled class="form-control" type="text" v-for="i in marcas.data" :key="i.id" v-if="i.id === $store.state.item.id_marca" :value="i.name">
                                </div>
                                <div class="col mb-3">
                                    <inputcontainer-component id="lugaresModelo" titulo="Lugares" idHelp="lugaresHelp" tituloAjuda="Obrogatorio. Informe o numero de lugares por pessoa">
                                        <input type="number" id="lugaresmodeloidVisualizar" class="form-control" aria-describedby="idHelp":value="$store.state.item.lugares">
                                    </inputcontainer-component>
                                </div>
                            </div>
                        </div>
                    </div>      
                </template>
                <template v-slot:rodape>
                    <button type="button" data-bs-dismiss="modal" class="btn btn-secondary btn-sm">Fechar</button>
                    <button type="submit" class="btn btn-danger btn-sm" @click="apagar($store.state.item.id)">Apagar</button>
                </template>
            </modal-component>
            <!-- Fim modal apagar -->

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
                modelos :[],
                vsAbs: false,
                vsAir: false,
                urlPaginate: '',
                busca: {
                    id: '',
                    nome: ''
                },
                filtroUrl: '',
                statusRequest: '',
                detailsRequest:{}
                
            };
           
        },
        methods:{
            limparKanela(){
                this.statusRequest = '';
            },
            pesquisa(){
                let filtro = ''


                for(let chave in this.busca){
                    if(this.busca[chave]){
                        if (filtro != '') {
                            filtro +=';'
                        }
                        filtro += chave +':like:'+this.busca[chave];
                    }
                }
                if (filtro != '') {
                    this.urlPaginate= 'page=1';
                    this.filtroUrl = '&filter='+ filtro
                }else{
                    this.filtroUrl='';
                }
                console.log(this.filtroUrl);
                this.carregarModelos();
            }
            ,
            paginacao(l){
                if (l.url) {
                    
                    this.urlPaginate = l.url.split('?')[1];
                    console.log(this.urlPaginate);
                    this.carregarModelos();
                }
            },
            apagar(id){
                console.log(id);
                axios.delete(this.urlBase + '/'+id).then(response => {
                    console.log(response);
                }).catch(error =>{
                    console.log(error);
                })
            },
            editar(id){
                let idMarca =  document.getElementById('idMarcaModelo').value;
                let dados = {
                    nome : document.getElementById('nomeModeloEdit').value,
                    imagem : document.getElementById('imagemModeloEdit').value,
                    numero_portas : document.getElementById('numportasModeloEdit').value,
                    abs : this.abs,
                    air_bag : this.airbag,
                    id_marca : idMarca,
                    lugares :document.getElementById('lugaresmodeloid').value
                }
                axios.put(this.urlBase + '/' +id,dados).then(response => {
                    this.statusRequest = 'Editado';
                    this.detailsRequest = {
                        mensagem: 'Sucesso: Modelo atualizado'
                    };
                    this.carregarModelos();
                    
                }).catch(error => {
                    this.statusRequest = 'EditatoErro';
                    this.detailsRequest = {
                        mensagem: error.response.data.message,
                        dados: error.response.data.errors
                    }
                })


            },
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
                        this.statusRequest = 'Modelo Adicionado';
                        this.detailsRequest = {
                            mensagem: 'Novo modelo adiconado com sucesso'
                        };
                        this.carregarModelos();
                    }).catch(erro => {
                        this.statusRequest = 'Erro ao salvar Modelo';
                        this.detailsRequest = {
                            mensagem: erro.response.data.message,
                            dados: erro.response.data.errors
                        }
                    })   
            },
            carregarModelos(){

                let urlUse = this.urlBase + '?' + this.urlPaginate + this.filtroUrl
                console.log(urlUse);
                axios.get(urlUse)
                    .then(response => {
                        this.modelos=response.data;
                        console.log(this.modelos);
                    }).catch(error =>{
                        console.log(error);
                    })
            }
        },
        mounted(){
            this.carregarMarcas(); 
            this.carregarModelos();
        }
    }
</script>
