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
                        <table-component>
                                
                        </table-component>
                    </template>
                    <template v-slot:rodape>
                            <button type="button" class="btn btn-primary btn-sm float-right">Adicionar</button>      
                    </template>
                </card-component>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
